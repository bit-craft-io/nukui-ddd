<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Exceptions\Except;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Core\Libraries\Stateless\Static\StlStaCompress;
use App\Core\Libraries\Stateless\Static\StlStaRandom;
use App\Domains\Rep;
use App\Http\Applications\UseCase\UC;
use App\Http\Requests\Account\ReqAccountLogin;

class AppAccount extends BaseApp
{
    public function register(ReqNone $req): void
    {
        $this->_useTransaction();

        $ucMakeEmail = $this->_useCase(UC::UC_ACCOUNT_MAKE_EMAIL);
        $email = $ucMakeEmail->execute();
        $password = StlStaRandom::key32(4,4);

        $repAccount = $this->_rep(Rep::REP_ACCOUNT);
        $entAccount = $repAccount->mekDraft();
        $entAccount->name('none');
        $entAccount->email($email);
        $entAccount->password($password);
        $repAccount->persist($entAccount);

        $primary_data = "$email:$password";
        $primary_code = StlStaCompress::comp($primary_data);
        $this->_responseParamSet('primary_code', $primary_code);
        //$this->_param()->set('primary_code', $primary_code);

        $ucMakePublicId = $this->_useCase(UC::UC_ACCOUNT_MAKE_PUBLIC_ID);
        $public_id = $ucMakePublicId->execute();

        $repUser = $this->_rep(Rep::REP_USER);
        $entUser = $repUser->makeDraft();
        $entUser->id($entAccount->id);
        $entUser->public_id($public_id);
        $entUser->nick_name('none');
        $entUser->energy(100);
        $entUser->energy_max_regen(100);
        $entUser->energy_max_stock(100);
        $repUser->persist($entUser);
    }

    public function login(ReqAccountLogin $req): void
    {
        [$email, $password] = explode(':', StlStaCompress::unComp($req->primary_code));

        $ucCreateApiToken = $this->_useCase(UC::UC_ACCOUNT_CREATE_API_TOKEN);
        $bearer_token = $ucCreateApiToken->execute($email, $password);

        $this->_responseParamSet('bearer_token', $bearer_token);
    }

    /**
     * @param ReqNone $req
     * @return void
     */
    public function dummy(ReqNone $req): void
    {
        $repUser = $this->_rep(Rep::REP_USER);
        $entUser = $repUser->makeDraft();

        // TODO
        $except = $this->_except(Except::EXCEPT_APP)->make(TypeExcept::AppUserNotFound);

        /** @var class-string<TypeExcept> $aaa */
        $aaa = self::$error_code;

        //make(self::CODE_APP_USER_NOT_FOUND);
        //$except->make($except->type());
    }
}
