<?php

declare(strict_types=1);

namespace App\Http\Applications;

use App\Core\Http\Applications\BaseApp;
use App\Domains\RepHub;
use App\Http\Applications\UseCase\UcHub;
use App\Http\Requests\Account\ReqAccountLogin;

class AppAccount extends BaseApp
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->_Transaction::begin();

        $email = $this->_UseCase::make(UcHub::UC_ACCOUNT_MAKE_EMAIL)->execute();
        $password = $this->_UtilRandom::key32(4, 4);

        // @note このやり方は補完が効かない $rep_account->makeDraft()
        //$rep_account = $this->_Domain::rep($this->_Rep::REP_ACCOUNT);

        $rep_account = $this->_Domain::rep(RepHub::REP_ACCOUNT);
        $ent_account = $rep_account->makeDraft();
        $ent_account->name('none');
        $ent_account->email($email);
        $ent_account->password($password);
        $rep_account->persist($ent_account);

        $primary_code = $this->_UtilCompress::comp("$email:$password");
        $this->_ResponseParam::set('primary_code', $primary_code);

        $public_id = $this->_UseCase::make(UcHub::UC_ACCOUNT_MAKE_PUBLIC_ID)->execute();
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

    /**
     * @param ReqAccountLogin $req
     * @return void
     */
    public function login(ReqAccountLogin $req): void
    {
        [$email, $password] = explode(':', $this->_UtilCompress::unComp($req->primary_code));
        $bearer_token = $this->_UseCase::make(UcHub::UC_ACCOUNT_CREATE_API_TOKEN)->execute($email, $password);
        $this->_ResponseParam::set('bearer_token', $bearer_token);
    }
}
