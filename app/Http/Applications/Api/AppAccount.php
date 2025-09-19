<?php

declare(strict_types=1);

namespace App\Http\Applications\Api;

use App\Http\Applications\BaseApp;
use App\Http\Responses\ResNone;
use App\Libraries\Helpers\HelpCompress;
use App\Libraries\Helpers\HelpRandom;
use App\Libraries\Utils\UtilGlobals;

class AppAccount extends BaseApp
{
    public function register(array $params): void
    {
        $ucMakeEmail = $this->_useCase(self::UC_MAKE_EMAIL);
        $email = $ucMakeEmail->execute();
        $password = HelpRandom::key32(4,4);

        $repAccount = $this->_rep(self::REP_ACCOUNT);
        $entAccount = $repAccount->draft();
        $entAccount->_name('none');
        $entAccount->_email($email);
        $entAccount->_password($password);
        $repAccount->persist($entAccount);

        // @note 意識高い系の実装です
        //$primary_data = "$email:$password";
        //$primary_code = HelpCompress::comp($primary_data);
        //UtilGlobals::set('primary_code', $primary_code);
        //dd(__LINE__);
        $vo_primary_code = $this->_vo(self::VO_PRIMARY_CODE)->init([$email, $password]);

        UtilGlobals::set('primary_code', $vo_primary_code->primary_code);

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
        $vo_primary_code = $this->_vo(self::VO_PRIMARY_CODE)->init($params);
        $ucCreateApiToken = $this->_useCase(self::UC_CREATE_API_TOKEN);
        $bearer_token = $ucCreateApiToken->execute($vo_primary_code->email, $vo_primary_code->password);
        UtilGlobals::set('bearer_token', $bearer_token);
    }

    public function dummy(array $params): void
    {
        // TODO response に特化したクラスを作成するか？
        UtilGlobals::set('response', ResNone::class);
    }
}
