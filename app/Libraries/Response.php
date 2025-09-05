<?php

declare(strict_types=1);

namespace App\Libraries;

class Response
{
    protected ?string $_response_class = null;
    protected string $_redirect_api = '';
    protected array $_redirect_params = [];

    /**
     * @param string $response_class
     * @return void
     */
    public function modify(string $response_class): void
    {
        $this->_response_class = $response_class;
    }

    /**
     * @return string|null
     */
    public function findModify(): ?string
    {
        return $this->_response_class;
    }

    /**
     * @param string $redirect_api
     * @param array $redirect_params
     * @return void
     */
    public function redirect(string $redirect_api, array $redirect_params = []): void
    {
        $this->_redirect_api = $redirect_api;
        $this->_redirect_params = $redirect_params;
    }

    /**
     * @return string
     */
    public function findRedirectUrl(): string
    {
        if (empty($this->_redirect_api)) {
            return '';
        }
        $query_param = http_build_query($this->_redirect_params);
        return "{$this->_redirect_api}?$query_param";
    }
}
