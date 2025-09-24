<?php

namespace App\Exceptions;

use Exception;

class ExceptApp extends Exception
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
     * @param TypeExcept $type_except
     * @return self
     */
    public function make(TypeExcept $type_except): self
    {
        $this->code = $type_except->value;
        $this->message = $type_except->message();
        return $this;
    }
}
