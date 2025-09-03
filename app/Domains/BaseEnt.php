<?php

declare(strict_types=1);

namespace App\Domains;

use App\Libraries\FactoryVo;
use App\Libraries\Shared\SharedHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use IntBackedEnum;
use ReflectionClass;
use Exception;

abstract class BaseEnt
{
    /**
     * @return FactoryVo
     */
    protected function _vo(): FactoryVo
    {
        return SharedHelper::singleton(FactoryVo::class);
    }

    // @note use のネスト構造になる為、本クラスに移動
    //<editor-fold desc="use EntAccessor">
    /** @var array 変更したプロパティ名 */
    protected array $_model_data_modified_keys = [];
    /** @var array プロパティ一覧（ドラフト） */
    protected array $_model_data_draft = [];
    /** @var array プロパティ一覧 */
    protected ?Model $_model = null;
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
        $value = $this->_model->{$member_name} ?? null;
        $value = $this->_castValue($member_name, $value, $this->_type_member_get);
        return match (strtok($member_name, '_')) {
            //'type' => $this->_castType($member_name, $value),
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
        $arguments['_parent'] = &$this;
        //SharedVoFactory::find();
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
            if (!$this->_model->{$key} ?? false) {
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
            $value = match (strtok($key, '_')) {
                'type' => $value->value,
                default => $this->_castValue($member_name, $value, $this->_type_member_modify),
            };
        }
        //$model_value = $this->_model->{$key} ?? false;
        //if ($model_value !== $value) {
        $this->_model_data_draft[$key] = $value;
        $this->_model_data_modified_keys[] = $key;
        //}
    }

    public function draftFill(array $arguments): void
    {
        $this->_model_data_draft = array_merge($this->_model_data_draft, $arguments);
        //$this->_model->forceFill($arguments);
    }

    /**
     * @param string $member_name
     * @param mixed $value
     * @param array $type_map
     * @return mixed
     */
    protected function _castValue(string $member_name, mixed $value, array $type_map): mixed
    {
//        dd($type_map, $member_name);
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
        //foreach ($this->_model_data_draft as $key => $value) {
        //    $this->_model[$key] = $value;
        //}
        $this->_model->forceFill($this->_model_data_draft);
    }

    /**
     * @param ?Model $model
     * @return void
     */
    public function setFromModel(?Model $model): void
    {
        $this->_model = $model;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->_model->toArray();
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
        $this->_model = null;
        // TODO vo を分離させたい
        $this->_vo()->flush();
    }
    //</editor-fold>
}
