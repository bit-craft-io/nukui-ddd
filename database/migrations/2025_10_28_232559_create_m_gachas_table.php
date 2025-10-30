<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_gachas', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
            $table->string('name', 64)->comment('名前');
            $table->boolean('is_active')->default(false)->comment('公開中');
            $table->unsignedTinyInteger('type_draw')->default(1)->comment('ガチャタイプ（1: 通常抽選 | 2: ステップアップ抽選 | 3:枠確定抽選 | 4:レアリティ抽選）');
            // @note 「グループ番号」と「実行回数」より「ｎステップを表現」
            $table->unsignedInteger('group_no')->default(0)->comment('グループ番号');
            $table->unsignedInteger('exec_count')->default(0)->comment('実行回数');
            $table->unsignedBigInteger('item_id')->comment('アイテムID');
            $table->unsignedInteger('total_cost')->comment('合計コスト');
            $table->unsignedInteger('draw_count')->default(1)->comment('抽選回数');
            // @note レアリティ抽選の場合は先に使用
            $table->unsignedInteger('gacha_lot_rarity_group_no')->default(0)->comment('レアリティ抽選のグループ番号');
            // @note レアリティ抽選の場合は後に使用
            $table->unsignedInteger('gacha_lot_group_no')->default(0)->comment('ガチャ抽選のグループ番号');
            $table->timestamp('begin_at')->nullable()->comment('有効期間（開始日時）');
            $table->timestamp('end_at')->nullable()->comment('有効期間（終了日時）');
            $table->unsignedSmallInteger('display_order')->default(0)->comment('表示順');
            $table->string('banner_image_name', 128)->nullable()->comment('バナー画像名');
            $table->string('ops_memo', 128)->nullable()->comment('運用メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_gachas');
    }
};
