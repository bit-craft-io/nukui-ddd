<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\Rep;
use App\Http\Applications\UseCase\UC;
use App\Http\Requests\Account\ReqAccountLogin;

class AppAccount extends BaseApp
{
    public function register(ReqNone $req): void
    {
        $this->_transaction::begin();

        $email = $this->_service::uc(UC::UC_ACCOUNT_MAKE_EMAIL)->execute();
        //$password = StlStaRandom::key32(4,4);
        $password = $this->_util()->random::key32(4, 4);

        $rep_account = $this->_domain::rep(Rep::REP_ACCOUNT);
        $ent_account = $rep_account->mekDraft();
        $ent_account->name('none');
        $ent_account->email($email);
        $ent_account->password($password);
        $rep_account->persist($ent_account);

        $primary_data = "$email:$password";
        //$primary_code = StlStaCompress::comp($primary_data);
        $primary_code = $this->_util()->compress::comp($primary_data);
        $this->_response()->param::set('primary_code', $primary_code);

        $public_id = $this->_service::uc(UC::UC_ACCOUNT_MAKE_PUBLIC_ID)->execute();
        $rep_user = $this->_domain::rep(Rep::REP_USER);
        $ent_user = $rep_user->makeDraft();
        $ent_user->id($ent_account->id);
        $ent_user->public_id($public_id);
        $ent_user->nick_name('none');
        $ent_user->energy(100);
        $ent_user->energy_max_regen(100);
        $ent_user->energy_max_stock(100);
        $rep_user->persist($ent_user);
    }

    public function login(ReqAccountLogin $req): void
    {
        //[$email, $password] = explode(':', StlStaCompress::unComp($req->primary_code));
        [$email, $password] = explode(':', $this->_util()->compress::unComp($req->primary_code));

        $bearer_token = $this->_service::uc(UC::UC_ACCOUNT_CREATE_API_TOKEN)->execute($email, $password);
        $this->_response()->param::set('bearer_token', $bearer_token);
    }

    /**
     * @param ReqNone $req
     * @return void
     */
    public function dummy(ReqNone $req): void
    {
        $repUser = $this->_domain::rep(Rep::REP_USER);
        $entUser = $repUser->makeDraft();

        // TODO
        //$except = $this->_except(Except::EXCEPT_APP)->make(TypeExcept::AppUserNotFound);
        $except = $this->_except::app(TypeExcept::AppUserNotFound);

        //make(self::CODE_APP_USER_NOT_FOUND);
        //$except->make($except->type());
    }
}
