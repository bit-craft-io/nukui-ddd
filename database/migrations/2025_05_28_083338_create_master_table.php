<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::beginTransaction();

            Schema::create('m_infos', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
                $table->string('title', 50)->comment('タイトル');
                $table->text('content')->comment('本文');
                $table->dateTime('notice_begin_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('公開開始日時');
                $table->dateTime('notice_end_at')->nullable()->comment('公開終了日時');
                $table->unsignedTinyInteger('is_stopped')->default(0)->comment('停止フラグ');
                $table->unsignedSmallInteger('sort_priority')->default(10)->comment('ソート優先度（大きい数値が優先）');
                $table->timestamp('created_at')->useCurrent()->comment('作成日時');
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->comment('更新日時');
                $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            });
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::beginTransaction();

            Schema::dropIfExists('m_infos');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
};
