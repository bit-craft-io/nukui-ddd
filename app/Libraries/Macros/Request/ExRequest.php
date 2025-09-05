<?php

declare(strict_types=1);

namespace App\Libraries\Macros\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExRequest extends Request
{
    private ?FormRequest $_caller_class = null;
    public function init($caller_class): void
    {
        $this->_caller_class = $caller_class;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return (int) auth()->id();
    }

    /**
     * @param string $key
     * @param string|int|array|null $value
     * @return void
     */
    public function optionalDefault(string $key, string|int|array|null $value): void
    {
        if (is_subclass_of($this->_caller_class, Request::class)) {
            $this->_caller_class->merge([$key => $this->_caller_class->input($key, $value)]);
            request()->merge([$key => request()->input($key, $value)]);
        }
    }

    /**
     * @param array $rules
     * @return void
     */
    public function fixParamType(array $rules): void
    {
        if (is_subclass_of($this->_caller_class, Request::class)) {
            foreach ($rules as $key => $valid) {
                $valid_rules = explode('|', $valid);
                $casted_value = null;
                //if ($this->_caller_class->get($key) !== null) {
                $value = $this->_caller_class[$key];
                $casted_value = in_array('integer', $valid_rules) ? (int)$value : $casted_value;
                $casted_value = in_array('string', $valid_rules) ? (string)$value : $casted_value;
                $casted_value = in_array('array', $valid_rules) ? (array)$value : $casted_value;
                if ($casted_value !== null) {
                    $this->_caller_class->merge([$key => $casted_value]);
                    request()->merge([$key => $casted_value]);
                }
                //}
                $is_array = false;
                if (isset($rules["{$key}.*"])) {
                    $is_array = $rules["{$key}.*"];
                }
                $array_values = $this->_caller_class[$key];
                if ($is_array && $array_values) {
                    $valid_rules = explode('|', $rules["{$key}.*"]);
                    $casted_values = [];
                    foreach ($array_values as $array_value) {
                        // @note 配列中の 0 は除外
                        if (empty($array_value)) {
                            continue;
                        }
                        $casted_values[] = in_array('integer', $valid_rules) ? (int) $array_value : null;
                        $casted_values[] = in_array('string', $valid_rules) ? (string) $array_value : null;
                    }
                    if (!empty($casted_values)) {
                        $this->_caller_class->merge([$key => collect($casted_values)->whereNotNull()->values()->toArray()]);
                        request()->merge([$key => collect($casted_values)->whereNotNull()->values()->toArray()]);
                    }
                }
            }
        }
    }

    /**
     * @param string $key
     * @return void
     */
    public function fixNewlineCharacter(string $key): void
    {
        $value = $this->_caller_class->get($key);
        if (is_null($value) || gettype($value) !== 'string') {
            return;
        }
        $replaced_value = str_replace("\r\n", "\n", $value);
        $this->_caller_class->merge([$key => $replaced_value]);
        request()->merge([$key => $replaced_value]);
    }

    /**
     * @param string $key
     * @param string $rule
     * @return bool
     */
    public function nullableValid(string $key, string $rule): bool
    {
        $value = $this->_caller_class->get($key);
        if (isset($value) && (string) $value != 'null') {
            $validator = Validator::make(
                [$key => $value],
                [$key => $rule]
            );
            if ($validator->fails()) {
                return false;
            }
        }
        return true;
    }
}
