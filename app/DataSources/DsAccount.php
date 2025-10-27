<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class DsAccount extends BaseDs
{
    public function getDraft(): ?Model
    {
        return $this->_model;
    }

    public function findByEmail(string $email): Account|null
    {
        return $this->_model
            ->newQuery()
            ->where('email', $email)
            ->first();
    }

    public function upsert(array $values): void
    {
        $uniqueBy = ['email'];
        $this->_model
            ->newQuery()
            ->upsert($values, $uniqueBy);
    }
}
