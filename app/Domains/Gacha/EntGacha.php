<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\Entity\BaseEnt;

/**
 * @method void id(integer $value)
 * @method void user_id(integer $value)
 * @method void gacha_info(array $values)
 * @property-read integer $id
 * @property-read integer $user_id
 * @property-read array $gacha_info
 */
class EntGacha extends BaseEnt
{
    protected VpGachaInfo $_vp_gacha_info;

    //protected int $_exec_count = 0;
    //protected string $_exec_at = '';

    public function initOnce(): void
    {
        // TODO: Implement initAfter() method.
    }

    public function initAfter(): void
    {
        //$this->_vp_gacha_info = $this->_Domain::vp(VpHub::VP_GACHA_INFO)->init([
        //    '_exec_count' => &$this->_exec_count,
        //    '_exec_at' => &$this->_exec_at
        //]);
        $this->_vp_gacha_info = $this->_Domain::vp(VpHub::VP_GACHA_INFO)->init($this);
    }

    public function addExecCount(int $group_no): void
    {
        //$info = $this->gacha_info ?? [];
        //if ($info[$group_no] ?? false) {
        //    $this->_exec_count = $info[$group_no]['_exec_count'];
        //    $this->_exec_at = $info[$group_no]['_exec_at'];
        //}

        //$info[$group_no] = $this->_vp_gacha_info->toArray();
        //$this->gacha_info($info);

        $this->_vp_gacha_info->addExecCount($group_no);
    }

    public function getExecCount(int $group_no): int
    {
        return $this->_vp_gacha_info->getExecCount($group_no);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'gacha_info' => $this->gacha_info
        ];
    }
}
