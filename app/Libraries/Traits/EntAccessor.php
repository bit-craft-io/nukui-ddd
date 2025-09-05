<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use Exception;
use Illuminate\Support\Str;
use IntBackedEnum;
use ReflectionClass;

trait EntAccessor
{
    // TODO use の ネスト をやめる
    //use LibDomain;

    /** @var array 変更したプロパティ名 */
    protected array $_model_data_modified_keys = [];
    /** @var array プロパティ一覧（ドラフト） */
    protected array $_model_data_draft = [];
    /** @var array プロパティ一覧 */
    protected array $_model_data = [];
    /** @var array|null プロパティに対応した型（getter） */
    protected ?array $_type_member_get = null;
    /** @var array|null プロパティに対応した型（modify） */
    protected ?array $_type_member_modify = null;
    /** @var array プロパティに対応したValueObject（modify）  */
    protected array $_find_vos = [];

    public function __construct()
    {
        $ref = new ReflectionClass($this);
        $doc = $ref->getDocComment();
        if ($doc) {
            preg_match_all('/@property-read\s+([^\s]+)\s+\$([^\s]+)/', $doc, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $this->_type_member_get[$match[2]] = $match[1];
            }
            preg_match_all('/@method\s+([^\s(]+)\(\s*([^\s]+)\s+\$[^\s]+\)/', $doc, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $this->_type_member_modify[$match[1]] = $match[2];
            }
        }
    }

    /**
     * @template T
     * @param T $member_name
     * @return T
     * @throws Exception
     */
    public function __get($member_name)
    {
        $key = ltrim($member_name, '_');
        $value = $this->_model_data[$key] ?? null;
        $value = $this->_castValue($member_name, $value, $this->_type_member_get);
        return match (strtok($key, '_')) {
            'type' => $this->_castType($member_name, $value),
            'vo' => $this->_castVo($member_name),
            default => $value,
        };
    }

    /**
     * @param $member_name
     * @param $value
     * @return object
     */
    private function _castType($member_name, $value): object
    {
        dd($value);
        $class = "\\App\\Models\\Enums\\{$this->_type_member_get[$member_name]}";
        /** @var IntBackedEnum $class */
        return $class::from($value);
    }

    /**
     * @param $member_name
     * @return object
     * @throws Exception
     */
    private function _castVo($member_name): object
    {
        [$class, $args] = $this->_find_vos[$member_name];
        $arguments = [];
        foreach ($args as $arg) {
            $arguments[$arg] = $this->{$arg};
        }
        // TODO use のネスト
//        return $this->_findVo($class, $arguments);
        $arguments['_parent'] = &$this;
        return $this->_vo()->find($class, $arguments);
    }

    /**
     * @param string $member_name
     * @param string[] $arguments
     * @return void|null
     */
    public function __call(string $member_name, array $arguments = [])
    {
        $snake_case = Str::snake($member_name);
        if ('_' === $snake_case[0]) {
            $key = substr($snake_case, 1);
            //if (!$this->_model_data[$key]) {
            if (!array_key_exists($key, $this->_model_data)) {
                return;
            }

            // @note 案：オブジェクトの状態は変えない、一時保存で持っておき、永続化の時に反映する
            //  setterと違う所はオブジェクトの状態を保持するところ
            //  永続化の前に ent->commit（一時保存の状態のものを設定） をして実行

            $value = $arguments[0];
            $this->_modify($member_name, $value);
        }
    }

    /**
     * @param string $member_name
     * @param mixed $value
     * @return void
     */
    public function _modify(string $member_name, mixed $value): void
    {
        // @note null は許容であるか確認
        $key = substr($member_name, 1);
        if (is_null($value)) {
            $type = $this->_type_member_modify[$member_name] ?? false;
            if (!preg_match('/\bnull\b|\?/', $type)) {
                return;
            }
        } else {
            //$value = $this->_castValue($member_name, $value, $this->_type_member_modify);
            $value = match (strtok($key, '_')) {
                'type' => $value->value,
                default => $this->_castValue($member_name, $value, $this->_type_member_modify),
            };
        }
        // TODO 変更がある場合
        if ($this->_model_data[$key] !== $value ) {
            $this->_model_data_draft[$key] = $value;
            $this->_model_data_modified_keys[] = $key;
        }
    }

    /**
     * @param string $member_name
     * @param mixed $value
     * @param array $type_map
     * @return mixed
     */
    protected function _castValue(string $member_name, mixed $value, array $type_map): mixed
    {
        return match ($type_map[$member_name]) {
            'int', 'integer' => (int)$value,
            'array' => (array)$value,
            'boolean' => (bool)$value,
            'string' => (string)$value,
            '?int', '?integer' => is_null($value) ? null : (int)$value,
            '?array' => is_null($value) ? null : (array)$value,
            '?boolean' => is_null($value) ? null : (bool)$value,
            '?string' => is_null($value) ? null : (string)$value,
            default => $value,
        };
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        //$pre_model_data = [];
        foreach ($this->_model_data_draft as $key => $value) {
            $this->_model_data[$key] = $value;
            //$pre_model_data[$key] = $value;
        }
        // @note 変更箇所のみに絞り込みをしようとしたが
        //  永続化の時に既存のデータは id の設定が要る為、
        //  $this->_model_data を変更したものを永続化の時に使用
        //dd(array_diff($pre_model_data, $this->_model_data));
    }

    /**
     * @param array $model_data
     * @return void
     */
    public function setFromModelData(array $model_data): void
    {
        $this->_model_data = $model_data;
    }

    /**
     * @return array
     */
    public function getToModelData(): array
    {
        return $this->_model_data;
    }

    /**
     * @return void
     */
    // TODO EntAccessor::entInitialize BaseEnt::initialize のメソッド名を改善
    //public function initEntAccessor(): void
    public function initEnt(): void
    {
        $this->_model_data_modified_keys = [];
        $this->_model_data_draft = [];
        $this->_model_data = [];
        $this->_vo()->flush();
    }
}
