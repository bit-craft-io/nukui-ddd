<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;

class EntGacha extends BaseEnt
{
    //protected array $_m_gacha_map = [];

    protected VpUGachaInfo $_vp_u_gacha_info;

    protected int $_exec_count = 0;
    protected array $_vp_params = [];

    public function initOnce(): void
    {
        //$models = $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable();
        //$this->_m_gacha_map = $models->keyBy('id')->toArray();
        $this->_vp_params = ['_exec_count' => &$this->_exec_count];
        $this->_vp_u_gacha_info = $this->_Domain::vp(VpHub::VP_U_GACHA_INFO)->init($this->_vp_params);
    }

    public function initAfter(): void
    {
        // TODO: Implement initAfter() method.
    }

    public function validMaster(int $gacha_id): bool
    {
        return true;
    }

    public function addExecCount(): void
    {
        $this->_vp_u_gacha_info->addExecCount();
    }

    public function toArray(): array
    {
        return [
            'vp_u_gacha_info' => (object)($this->vp_u_gacha_info ?? [])
        ];
    }
}
