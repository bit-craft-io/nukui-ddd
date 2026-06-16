# 概要

**GitHub:** https://github.com/bit-craft-io/nukui-ddd

---

### 設計思想

- **責務分離**：誰が何を知るべきかを構造で強制する
- **DDD**：ビジネスルールをコードで自然言語化する
- **ユビキタス言語**：設計者と開発者が同じ言葉で話せる状態を作る
---

### レイヤー構成

<div style="border: 2px solid #333; padding: 15px; width: 100%; box-sizing: border-box;">

```plantuml
@startuml
top to bottom direction
!pragma layout smetana
skinparam roundCorner 15

skinparam rectangle {
    BorderColor<<dummy>> transparent
    BackgroundColor<<dummy>> transparent
    Shadowing<<dummy>> false
    FontColor<<dummy>> transparent
}

frame "プレゼンテーション層" #FFF5F5 {
      rectangle Request #FFFFFF
      rectangle Response #FFFFFF
      rectangle Controller #FFFFFF

      Request -[hidden]r-> Response
      Response -[hidden]r-> Controller

      ' spacing
      rectangle " " as right1 <<dummy>>
      rectangle " " as left1 <<dummy>>
      left1 -[hidden]r-> Request
      Controller -[hidden]r-> right1

      frame "アプリケーション層" #E6F1FB {
            rectangle Application #FFFFFF
            rectangle Repository #FFFFFF

            Application -[hidden]r-> Repository
            Request -[hidden]d-> Application

            ' spacing
            rectangle " " as right2 <<dummy>>
            rectangle " " as left2 <<dummy>>
            left2 -[hidden]r-> Application
            Repository -[hidden]r-> right2

            frame "ドメイン層" #FAECE7 {
                  rectangle Entity #FFFFFF
                  rectangle ValueObject #FFFFFF
                  rectangle ValueProxy #FFFFFF {
                        
                  }

                  Entity -[hidden]r-> ValueObject
                  ValueObject -[hidden]r-> ValueProxy
                  Application -[hidden]d-> Entity

                  ' spacing
                  rectangle " " as right3 <<dummy>>
                  rectangle " " as left3 <<dummy>>
                  left3 -[hidden]r-> Entity
                  ValueProxy -[hidden]r-> right3

                  frame "インフラ層" #F1EFE8 {
                        rectangle DataSources #FFFFFF
                        rectangle Model #FFFFFF

                        DataSources -[hidden]r-> Model
                        Entity -[hidden]d-> DataSources

                        ' spacing
                        rectangle " " as right4 <<dummy>>
                        rectangle " " as left4 <<dummy>>
                        rectangle " " as dummy4 <<dummy>>
                        left4 -[hidden]r-> DataSources
                        Model -[hidden]r-> right4
                        ' right4 の右に dummy4 を配置
                        right4 -[hidden]r-> dummy4
                  }
            }
      }
}
@enduml
```
</div>

---

### 主な設計ポイント

- DataSources 経由で ORM を操作し、ドメイン層が DB を意識しない構造
- Entity / ValueObject の集合を Iterator で表現（メモリ効率重視）
- Transaction と Response の制御を Middleware に集約
- ValueProxy で Mutable な状態管理を明示的に分離
---

<div style="page-break-before: always;"></div>

### シーケンス図

<div style="border: 2px solid #333; padding: 15px; width: 100%; box-sizing: border-box;">

```plantuml
@startuml

hide footbox

skinparam sequenceArrowThickness 1.5
skinparam roundcorner 6
skinparam sequenceParticipantBorderThickness 1
skinparam defaultFontSize 14

skinparam BoxPadding 20
skinparam sequenceMessageAlign center

skinparam sequenceLifeLineBorderThickness 1
skinparam sequenceLifeLineBorderColor #black

header " "
footer " "

participant "       Client       \n       (HTTP)       " as Client #E6F1FB
participant " Request / Response \n"                     as Req #FFF5F5
participant "    Middleware      \n"                     as MW #EEEDFE
participant "    Controller      \n"                     as Ctrl #E1F5EE
participant "    Application     \n     (Use case)     " as App #FAECE7
participant "     Repository     \n"                     as Rep #FAECE7
participant "       Entity       \n"                     as Ent #FAECE7
participant "    DataSources     \n     (ORM/Model)    " as DS #F1EFE8

' == HTTPリクエスト受付 ==

Client -> Req : POST /api/...
activate Client
activate Req

Req -> Req : バリデーション実行
Req -> MW : validated request
activate MW
deactivate Req

opt
MW -> MW : Transaction Begin
end

' == コントローラー呼び出し ==

MW -> Ctrl : validated request
activate Ctrl

Ctrl -> App : execute(dto)
activate App

' == リポジトリ生成 ==

group ドメインロジックA

    App -> Rep ** : new Rep()
    activate Rep

    ' == データ取得 → エンティティ生成 ==

    App -> Rep : makeDraft() / find(id)

    Rep -> DS : DataSource::make()->get()
    activate DS
    DS -> DS : Model (ORM) クエリ実行
    DS --> Rep : Model
    deactivate DS

    Rep -> Ent ** : Domain::ent()->init(model)
    activate Ent
    Rep --> App : EntXxx

    ' == ドメインロジック ==

    App -> Ent : ビジネスロジック実行
    App -> Ent : ValueObject / ValueProxy 操作
    Ent --> App : result
    deactivate Ent

    ' == 永続化 ==

    App -> Rep : save(entity)

    Rep -> DS : persist(entity)
    activate DS
    DS --> Rep : saved
    deactivate DS

    Rep --> App : saved
    deactivate Rep

    Rep -[hidden]-> Rep : dummy_space
end


group ドメインロジックB
    note right of App
    別の処理
    end note
    App -[hidden]-> DS
    DS -[hidden]-> DS : Model (ORM) dummy____
    DS -[hidden]-> App
end

group ユースケースA
    note right of App
    Entityを介さずModelを操作
    end note

    App -> Rep
    activate Rep
    Rep -> DS : DataSource::make()->get()
    activate DS
    DS -> DS : Model (ORM) クエリ実行
    DS --> Rep : Model
    deactivate DS
    Rep --> App
    deactivate Rep

    Rep -[hidden]-> Rep : dummy_space
end

' == レスポンス生成 ==

App --> Ctrl : result
deactivate App

Ctrl --> MW : response data
deactivate Ctrl

note right of MW
  Transaction Commit
  (スレーブ参照へ切替: sticky = true)
end note

MW -> Req : JSON生成
activate Req
Req --> Client : JSON 200 OK
deactivate Req

== エラー発生時 ==

alt 例外発生
    note right of MW
    Bootstrapの定義でエラーをキャッチ
    end note
    MW -> MW : 例外キャッチ\n(Core/Exceptions)
    MW -> MW : Transaction Rollback
    MW -> Req : エラーJSON生成
    activate Req
    Req --> Client : エラーレスポンス\n(Exceptions/Enum のコード付き)
    deactivate Req
    
    Rep -[hidden]-> Rep : dummy_space
end

deactivate MW
deactivate Client

@enduml
```
</div>

---

### 使用技術

- Laravel（PHP 8.4）
- Docker（MySQL, Redis）
- AWS（EC2, RDS, Valkey）
