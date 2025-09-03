<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $sql = /** @lang text */
                <<<SQL
insert into m_infos (id, title, content, notice_begin_at, notice_end_at, is_stopped, sort_priority, created_at, updated_at, deleted_at) values
( 1, 'テスト01', 'お知らせ内容', '2024-08-31 00:00:00', '2024-07-31 00:00:00', 0, 10, '2024-07-18 18:52:37', null, null),
( 2, 'テスト02', 'お知らせ内容', '2024-07-31 00:00:00', '2024-07-31 00:00:00', 0, 10, '2024-07-18 18:52:37', null, null)
;
SQL;
            DB::statement($sql);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
