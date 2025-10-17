<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Instance;

use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Stateful\Static\StfStaInstance;

final class StfInsResponseModify
{
    protected ?BaseRes $_response = null;

    public function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = StfStaInstance::singleton($response_class);
        $this->_response = $response;
    }

    public function find(): ?BaseRes
    {
        return $this->_response;
    }
}
