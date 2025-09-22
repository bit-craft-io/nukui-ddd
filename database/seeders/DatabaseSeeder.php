<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Account::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

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
(2, '永続アイテム', 2, 99, 99, null, null, null, null),
(3, '装備アイテム', 3, 9, 9, null, null, null, null),
(4, '素材アイテム', 4, 9999, 9999, null, null, null, null);
QUERY;

        foreach ($queries as $query) {
            DB::unprepared($query);
        }
        DB::connection()->getSchemaBuilder()->enableForeignKeyConstraints();
    }
}
