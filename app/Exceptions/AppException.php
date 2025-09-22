<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    /**
     * @template T of array{code:int, message:string, temp:string}
     *
     * @param T $error_info
     * @return self
     */
    public function exception(array $error_info): AppException
    {
        $this->code = $error_info['code'];
        $this->message = $error_info['message'];
        return $this;
    }
}
