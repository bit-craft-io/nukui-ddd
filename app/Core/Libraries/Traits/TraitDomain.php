<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaDomain;
//use App\Domains\RepHub;

trait TraitDomain
{
    // @note このやり方は補完が効かない
    //public string|RepHub $_Rep = RepHub::class;
    public string|StlStaDomain $_Domain = StlStaDomain::class;
}
