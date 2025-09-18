<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Http\Applications\BaseApp;
use App\Libraries\Helpers\HelpRandom;
use App\Libraries\Utils\UtilGlobals;

class AppAccount extends BaseApp
{
    public function register(array $params): void
    {
        $ucMakeEmail = $this->_useCase(self::UC_MAKE_EMAIL);
        $email = $ucMakeEmail->execute();
        $password = HelpRandom::key(4,4);

        $repAccount = $this->_rep(self::REP_ACCOUNT);
        $entAccount = $repAccount->draft();
        $entAccount->_name('none');
        $entAccount->_email($email);
        $entAccount->_password($password);
        $repAccount->persist($entAccount);

        UtilGlobals::set('email', $email);
        UtilGlobals::set('password', $password);

        $ucMakePublicId = $this->_useCase(self::UC_MAKE_PUBLIC_ID);
        $public_id = $ucMakePublicId->execute();

        $repUser = $this->_rep(self::REP_USER);
        $entUser = $repUser->draft();
        $entUser->_id($entAccount->id);
        $entUser->_public_id($public_id);
        $entUser->_nick_name('none');
        $entUser->_energy(100);
        $entUser->_energy_max_regen(100);
        $entUser->_energy_max_stock(100);
        $repUser->persist($entUser);
    }

    public function login(array $params): void
    {
        $ucCreateApiToken = $this->_useCase(self::UC_CREATE_API_TOKEN);
        $token = $ucCreateApiToken->execute($params['email'], $params['password']);
        dd($token);
    }
}
