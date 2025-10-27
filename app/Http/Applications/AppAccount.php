<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Applications\BaseApp;
use App\Core\Http\Requests\ReqNone;
use App\Domains\RepHub;
use App\Http\Applications\UseCase\UcHub;
use App\Http\Requests\Account\ReqAccountLogin;

class AppAccount extends BaseApp
{
    public function register(ReqNone $req): void
    {
        $this->_Transaction::begin();

        $email = $this->_Service::uc(UcHub::UC_ACCOUNT_MAKE_EMAIL)->execute();
        $password = $this->_UtilRandom::key32(4, 4);

        $rep_account = $this->_Domain::rep(RepHub::REP_ACCOUNT);
        $ent_account = $rep_account->mekDraft();
        $ent_account->name('none');
        $ent_account->email($email);
        $ent_account->password($password);
        $rep_account->persist($ent_account);

        $primary_data = "$email:$password";
        $primary_code = $this->_UtilCompress::comp($primary_data);
        $this->_ResponseParam::set('primary_code', $primary_code);

        //$val = $this->_DevTool::getValueSize('hoge-fuga');
        //$this->_DevLog::emergency((string)$val);

        $public_id = $this->_Service::uc(UcHub::UC_ACCOUNT_MAKE_PUBLIC_ID)->execute();
        $rep_user = $this->_Domain::rep(RepHub::REP_USER);
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
        [$email, $password] = explode(':', $this->_UtilCompress::unComp($req->primary_code));
        //dd($email, $password);

        $bearer_token = $this->_Service::uc(UcHub::UC_ACCOUNT_CREATE_API_TOKEN)->execute($email, $password);
        $this->_ResponseParam::set('bearer_token', $bearer_token);
    }

    /**
     * @param ReqNone $req
     * @return void
     */
    public function dummy(ReqNone $req): void
    {
        $repUser = $this->_Domain::rep(RepHub::REP_USER);
        $entUser = $repUser->makeDraft();

        // TODO
        //$except = $this->_except(Except::EXCEPT_APP)->make(TypeExcept::AppUserNotFound);
        $except = $this->_Except::app(TypeExcept::AppUserNotFound);

        //make(self::CODE_APP_USER_NOT_FOUND);
        //$except->make($except->type());
    }
}
