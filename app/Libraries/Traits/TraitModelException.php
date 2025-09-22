<?php

namespace App\Libraries\Traits;

use App\Exceptions\ModelException;
use App\Libraries\Utils\UtilInstance;

trait TraitModelException
{
    // @note 以下にコードをメッセージを追加
    const array ERR_MDL_DATA_NOT_FOUND = ['code' => 100, 'message' => 'Data not found'];

    public function _modelException(array $error_info)
    {
        $class = UtilInstance::new(ModelException::class);
        return $class->exception($error_info);
    }
}
