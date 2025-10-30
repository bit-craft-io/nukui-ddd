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
insert into m_items (name, type_item, max_display, max_stock, begin_at, end_at, ops_memo) values
('coin', 1, 99999999, 999999999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('ticket_a', 1, 999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('ticket_b', 1, 99, 99, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('elixir', 1, 999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('potion', 1, 999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('seal', 2, 1, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('badge', 2, 1, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('sword', 3, 99, 99, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('shield', 3, 99, 99, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('material_a', 4, 9999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null),
('material_b', 4, 9999, 9999, '2025-01-01 00:00:00', '2038-01-01 00:00:00', null);
QUERY;

        // TODO WIP
//        DB::table('m_gachas')->truncate();
//        $queries[] = /** @lang text */
//            <<<'QUERY'
//insert into m_gachas (name, is_active, type_draw, group_no, exec_count, item_id, total_cost, draw_count, gacha_lot_rarity_group_no, gacha_lot_group_no, begin_at, end_at, display_order, banner_image_name, ops_memo) values
//('Normal', 1, 1, 1, 0, 1, 100, 1, 0, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', 1, null, null),
//('Step', 1, 2, 2, 0, 1, 100, 10, 0, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', 1, null, null),
//('Step', 1, 2, 2, 1, 1, 100, 10, 0, 2, '2025-01-01 00:00:00', '2038-01-01 00:00:00', 1, null, null),
//('Fixed', 1, 3, 3, 0, 1, 1000, 10, 0, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', 1, null, null),
//('Rarity', 1, 4, 4, 0, 1, 100, 1, 0, 1, '2025-01-01 00:00:00', '2038-01-01 00:00:00', 1, null, null);
//QUERY;

        Schema::enableForeignKeyConstraints();

        foreach ($queries as $query) {
            if ($query) {
                DB::unprepared($query);
            }
        }
        DB::connection()->getSchemaBuilder()->enableForeignKeyConstraints();
    }
}
