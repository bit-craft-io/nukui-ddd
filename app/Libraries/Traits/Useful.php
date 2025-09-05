<?php

declare(strict_types=1);

namespace App\Libraries\Traits;

use App\Libraries\Shared\SharedGlobals;
use App\Libraries\Shared\SharedHelper;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait Useful
{
    protected function _globals(): SharedGlobals
    {
        return Sharedhelper::singleton(SharedGlobals::class);
    }

    protected function _useTransaction(): void
    {
        DB::beginTransaction();
    }

    public function storage(string $env_filesystem_disk = 'local'): Filesystem
    {
        return Storage::disk($env_filesystem_disk);
    }
}
