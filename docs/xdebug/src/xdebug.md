## 概要
- PhpStorm + WSL + Docker でXdebugを使用

### PhpStormの設定
1. インタプリターはコンテナ（docker-compose.yml の app）の php を使用
<div align="center">
    <img src="xdebug_1.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

2. リモートPHPを選択し各設定を入力
<div align="center">

|設定項目|設定内容|備考|
|:--|:--|:--|
|接続方式|Docker Compose||
|サーバー|docker|新規作成|
|構成ファイル|/var/www/bc.develop/docker/docker-compose.yml||
|サービス|app||
|環境変数|COMPOSE_PROJECT_NAME=bc-draft<br />__WSL_COMPOSE_PROJECT_DIR=bc.draft|docker-compose.yml<br />で使用してる.envの内容|
</div>
<div align="center">
  <img src="xdebug_2.png" style="width: 100%; max-width: 600px; height: auto;">
</div>
<div style="page-break-before: always;"></div>
<div style="display: flex; justify-content: center; align-items: flex-start; gap: 10px;">
  <img src="xdebug_3.png" style="width: 50%; max-width: 380px; height: auto;">
  <img src="xdebug_4.png" style="width: 50%; max-width: 380px; height: auto;">
</div>

3. 稼働中のコンテナを選択
<div align="center">
  <img src="xdebug_5.png" style="width: 100%; max-width: 600px; height: auto;">
</div>
<div style="page-break-before: always;"></div>
4. プロジェクトパスマッピング
<div align="center">
  <img src="xdebug_6.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

5. サーバーの設定
<div align="center">
  <img src="xdebug_7.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

6. プロファイルの設定
<div align="center">
  <img src="xdebug_8.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

<div style="page-break-before: always;"></div>

### ApiDogから実行（ブレイクポイントで止まる事を確認）
- ApiDog
<div align="center">
  <img src="xdebug_10.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

- PhpStorm
<div align="center">
  <img src="xdebug_11.png" style="width: 100%; max-width: 600px; height: auto;">
</div>

### ブレークポイントで止まらない場合
- PhpStormのデバッグの項目「PHPスクリプトの最初の行で中断する」をONにしてみる。
- PHPデバッグ接続のリッスンを停止・開始してみる。
- コンテナを再起動してみる。
