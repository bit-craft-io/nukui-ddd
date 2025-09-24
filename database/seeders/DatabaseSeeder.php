<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
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

        DB::table('m_items')->truncate();
        $queries[] = /** @lang text */
            <<<'QUERY'
insert into m_items (id, name, type_item, max_display, max_stock, enabled_from_at, enabled_end_at, created_at, updated_at) values
(1, '消費アイテム', 1, 999, 9999, null, null, null, null),
(2, '永続アイテム', 2, 99, 99, null, '2038-01-01 00:00:00', null, null),
(3, '装備アイテム', 3, 9, 9, null, '2038-01-01 00:00:00', null, null),
(4, '素材アイテム', 4, 9999, 9999, null, '2038-01-01 00:00:00', null, null);
QUERY;
        Schema::enableForeignKeyConstraints();

        foreach ($queries as $query) {
            if ($query) {
                DB::unprepared($query);
            }
        }
        DB::connection()->getSchemaBuilder()->enableForeignKeyConstraints();
    }
}
