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
insert into m_items (id, name, type_item, max_display, max_stock, begin_at, end_at, created_at, updated_at) values
(1, 'elixir', 1, 999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(2, 'potion', 1, 999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(3, 'seal', 2, 1, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(4, 'badge', 2, 1, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(5, 'sword', 3, 99, 99, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(6, 'shield', 3, 99, 99, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(7, 'material_a', 4, 9999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null),
(8, 'material_b', 4, 9999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null, null);
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
