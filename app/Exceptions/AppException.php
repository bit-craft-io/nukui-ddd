<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
//    /**
//     * @template T of array{code:int, message:string, temp:string}
//     *
//     * @param T $message
//     * @return self
//     */
//    public function make(array $message): self
//    {
//        $this->code = $message['code'];
//        $this->message = $message['message'];
//        return $this;
//    }

    /**
     * @param TypeErrorCode $type_error_code
     * @return self
     */
    public function make(TypeErrorCode $type_error_code): self
    {
        $this->code = $type_error_code->value;
        $this->message = $type_error_code->message();
        return $this;
    }
}
