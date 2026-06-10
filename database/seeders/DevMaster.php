<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DevMaster extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('accounts')->truncate();
        $queries[] = /** @lang text */
            <<<'QUERY'
QUERY;

        DB::table('u_users')->truncate();
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
