<?php

declare(strict_types=1);

namespace App\Libraries\Exceptions;
use Exception;
use Illuminate\Support\Facades\Log;

class ExException extends Exception
{
    private string $_message = '';

    private int $_code = 0;

    private array $_options = [];

    ///**
    // * @return $this
    // */
    //public function report(): static
    //{
    //    $this->code = $this->_code;
    //    $this->message = $this->_message;
    //    $this->file = $this->_options['file'] ?? '';
    //    $this->line = $this->_options['line'] ?? 0;
    //    return $this;
    //}
    //
    ///**
    // * @return array
    // */
    public function getErrorMap(): array
    {
        $map = [];
        $map['is_success'] = false;
        $map['message'] = $this->_message;
        $map['code'] = $this->_code;
        return $map;
    }

    /**
     * @param array $failed_map
     * @return void
     * @throws ExException
     */
    public function failed(array $failed_map = []): void
    {
        $this->_message = $failed_map['message'] ?? '';
        $this->_code = $failed_map['code'] ?? 0;

        $trace = debug_backtrace();
        $this->_options = [];
        if (isset($trace[0])) {
            $current = $trace[0];
            $this->_options = [
                'file' => $current['file'] ?? '',
                'line' => $current['line'] ?? ''
            ];
        }
        Log::error( '---------- ' . __CLASS__ . '::' . __LINE__);
//        exit;
        throw $this;
    }
}
