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
        Schema::create('m_gacha_draw_entities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('group_no')->default(0)->comment('グループ番号');
            $table->unsignedTinyInteger('type_rarity')->default(1)->comment('レアリティ（1: N | 2: R | 3:SR | 4:SSR）');
            $table->unsignedBigInteger('item_id')->comment('アイテムID');
            $table->unsignedSmallInteger('rate')->default(0)->comment('抽選率（10000分率）');
            $table->string('ops_memo', 128)->nullable()->comment('運用メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_gacha_draw_entities');
    }
};
