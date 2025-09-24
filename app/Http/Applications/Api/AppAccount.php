<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Domains\Reps;
use App\Exceptions\Excepts;
use App\Exceptions\TypeExcept;
use App\Http\Applications\BaseApp;
use App\Http\Requests\Api\Account\ReqAccountLogin;
use App\Http\Requests\ReqNone;
use App\Libraries\Helpers\HelpCompress;
use App\Libraries\Helpers\HelpRandom;
use App\Libraries\Utils\UtilGlobals;
use App\UseCase\UCs;

class AppAccount extends BaseApp
{
    public function register(ReqNone $req): void
    {
        $ucMakeEmail = $this->_useCase(UCs::UC_MAKE_EMAIL);
        $email = $ucMakeEmail->execute();
        $password = HelpRandom::key32(4,4);

        $repAccount = $this->_rep(Reps::REP_ACCOUNT);
        $entAccount = $repAccount->draft();
        $entAccount->_name('none');
        $entAccount->_email($email);
        $entAccount->_password($password);
        $repAccount->persist($entAccount);

        // @note 意識高い系の実装です
        $primary_data = "$email:$password";
        $primary_code = HelpCompress::comp($primary_data);
        UtilGlobals::set('primary_code', $primary_code);

        $ucMakePublicId = $this->_useCase(UCs::UC_MAKE_PUBLIC_ID);
        $public_id = $ucMakePublicId->execute();

        $repUser = $this->_rep(Reps::REP_USER);
        $entUser = $repUser->draft();
        $entUser->_id($entAccount->id);
        $entUser->_public_id($public_id);
        $entUser->_nick_name('none');
        $entUser->_energy(100);
        $entUser->_energy_max_regen(100);
        $entUser->_energy_max_stock(100);
        $repUser->persist($entUser);
    }

    public function login(ReqAccountLogin $req): void
    {
        [$email, $password] = explode(':', HelpCompress::unComp($req->primary_code));

        $ucCreateApiToken = $this->_useCase(UCs::UC_CREATE_API_TOKEN);
        $bearer_token = $ucCreateApiToken->execute($email, $password);
        UtilGlobals::set('bearer_token', $bearer_token);
    }

    /**
     * @param ReqNone $req
     * @return void
     */
    public function dummy(ReqNone $req): void
    {
        $repUser = $this->_rep(Reps::REP_USER);
        $entUser = $repUser->draft();

        // TODO
        $except = $this->_except(Excepts::EXCEPT_APP)->make(TypeExcept::app_user_not_found);

        /** @var class-string<TypeExcept> $aaa */
        $aaa = self::$error_code;

        //make(self::CODE_APP_USER_NOT_FOUND);
        //$except->make($except->type());
    }
}
