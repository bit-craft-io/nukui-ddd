<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $queries = [];
            $queries[] = /** @lang text */
                <<<'QUERY'
insert into u_players (id, nick_name, level, created_at, updated_at, deleted_at) values
(1, 'test1', 1, '2025-07-12 14:36:12', '2025-07-13 08:04:41', null),
(2, 'test2', 1, '2025-07-13 08:01:41', '2025-07-13 08:04:41', null),
(3, 'test3', 1, '2025-07-13 08:01:41', '2025-07-13 08:04:41', null);
QUERY;

            $queries[] = /** @lang text */
                <<<'QUERY'
insert into u_playables (id, nick_name, stamina_count, type_play_style, u_guild_id, created_at, updated_at, deleted_at) values
(1, 'solo1', 2000, 1, 1, '2025-05-17 00:00:00', '2025-05-25 00:00:00', null),
(2, 'solo2', 2000, 1, 1, '2025-05-17 00:00:00', '2025-05-25 00:00:00', null),
(3, 'solo3', 1000, 2, 1, '2025-05-17 00:00:00', '2025-05-25 00:00:00', null),
(4, '20250518', 100, 2, 2, '2025-05-17 00:00:00', '2025-05-25 00:00:00', null),
(5, '20250518', 100, 2, 2, '2025-05-17 00:00:00', '2025-05-25 00:00:00', null);
QUERY;

            $queries[] = /** @lang text */
                <<<'QUERY'
insert into u_guilds (id, name, upper_limit_count, created_at, updated_at, deleted_at) values
(1, 'Low-Kick-Style', 10, '2025-05-28 00:00:00', '2025-05-28 00:00:00', null),
(2, 'Private-Party-Play', 5, '2025-05-28 00:00:00', '2025-05-28 00:00:00', null);
QUERY;

            $queries[] = /** @lang text */
                <<<'QUERY'
insert into u_guild_members (id, u_guild_id, u_playable_id, created_at, updated_at, deleted_at) values
(1, 1, 1, '2025-05-28 01:11:50', null, null),
(2, 1, 2, '2025-05-28 01:12:13', null, null),
(3, 1, 3, '2025-05-28 01:12:13', null, null),
(4, 2, 4, '2025-05-28 01:12:13', null, null),
(5, 2, 5, '2025-05-28 01:12:13', null, null);
QUERY;

            foreach ($queries as $query) {
                DB::statement($query);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
