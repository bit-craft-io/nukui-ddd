<?php

namespace App\Core\Jobs;

use App\Core\Jobs\Contexts\AccessInfo;
use App\Models\HAccessInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobAccessInfo implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public AccessInfo $_access_info,
    ) {}

    public function handle(): void
    {
        HAccessInfo::query()->create([
            'user_id' => $this->_access_info->_user_id,
            'level' => $this->_access_info->_level,
            'api' => $this->_access_info->_api,
            'param' => $this->_access_info->_param,
            'file' => $this->_access_info->_file,
            'line' => $this->_access_info->_line,
            'option' => $this->_access_info->_option,
        ]);
    }
}
