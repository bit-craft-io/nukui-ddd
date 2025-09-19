<?php

declare(strict_types=1);

namespace App\Domains\VOs;

use App\Libraries\Helpers\HelpCompress;

/**
 * @property-read $email
 * @property-read $password
 * @property-read $primary_code
 */
final class VoPrimaryCode extends BaseVo
{
    public function init(array $arguments): self
    {
        if ($arguments['primary_code'] ?? false) {
            [$email, $password] = explode(':', HelpCompress::unComp($arguments['primary_code']));
            $primary_code = $arguments['primary_code'];
        }
        if (($arguments[0] ?? false) && ($arguments[1] ?? false)) {
            $email = $arguments[0];
            $password = $arguments[1];
            $primary_code = HelpCompress::comp("$arguments[0]:$arguments[1]");
        }
        // @note 処理的に空はありえない
        $this->_props['email'] = $email ?? '';
        $this->_props['password'] = $password ?? '';
        $this->_props['primary_code'] = $primary_code ?? '';
        return $this;
    }
}
