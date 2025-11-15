<?php

declare(strict_types=1);

namespace App\DataSources;

use App\Core\DataSources\BaseDs;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class DsAccount extends BaseDs
{
    /**
     * @return Model|null
     */
    public function getDraft(): ?Model
    {
        return $this->_model;
    }

    /**
     * @param string $email
     * @return Account|null
     */
    public function findByEmail(string $email): Account|null
    {
        return $this->_model
            ->newQuery()
            ->where('email', $email)
            ->first();
    }

    /**
     * @param array $values
     * @return void
     */
    public function upsert(array $values): void
    {
        $uniqueBy = ['email'];
        $this->_model
            ->newQuery()
            ->upsert($values, $uniqueBy);
    }
}
