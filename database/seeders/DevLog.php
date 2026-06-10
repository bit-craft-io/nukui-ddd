<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DevLog extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('log_access_infos')->truncate();
        $queries[] = /** @lang text */
            <<<'QUERY'
QUERY;

        foreach ($queries as $query) {
            if ($query) {
                DB::unprepared($query);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
