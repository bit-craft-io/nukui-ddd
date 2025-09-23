<?php

namespace App\Libraries\Traits;

use App\Exceptions\AppException;
use App\Libraries\Utils\UtilInstance;

trait TraitAppException
{
    // @note 以下にコードをメッセージを追加
    const array ERR_APP_USER_NOT_FOUND = ['code' => 1001, 'message' => 'User not found'];

    public function _appException(array $error_info)
    {
//        $class = UtilInstance::new(AppException::class);
//        return $class->exception($error_info);
    }
}
