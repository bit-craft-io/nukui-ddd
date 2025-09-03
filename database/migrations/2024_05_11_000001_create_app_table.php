<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::beginTransaction();

            Schema::create('u_players', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
                $table->string('nick_name', 64)->nullable()->comment('渾名');
                $table->unsignedSmallInteger('level')->default(1)->comment('レベル');
                $table->timestamp('created_at')->useCurrent()->comment('作成日時');
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->comment('更新日時');
                $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            });

            Schema::create('u_playables', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
                $table->string('nick_name', 64)->nullable()->comment('渾名');
                $table->unsignedSmallInteger('stamina_count')->default(0)->comment('スタミナ数');
                $table->unsignedTinyInteger('type_play_style')->default(1)->comment('タイプ：プレイスタイル（1 = ソロ, 2 = エンジョイ, 3 = ガチ、4 = コレクター）');
                $table->unsignedBigInteger('u_guild_id')->default(0)->comment('ギルドID');
                $table->timestamp('created_at')->useCurrent()->comment('作成日時');
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->comment('更新日時');
                $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            });

            Schema::create('u_guilds', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
                $table->string('name', 50)->comment('名前');
                $table->unsignedTinyInteger('upper_limit_count')->default(1)->comment('加入数（上限）');
                $table->timestamp('created_at')->useCurrent()->comment('作成日時');
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->comment('更新日時');
                $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            });

            Schema::create('u_guild_members', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
                $table->unsignedBigInteger('u_guild_id')->default(0)->comment('ギルドID');
                $table->unsignedTinyInteger('u_playable_id')->default(1)->comment('加入数（上限）');
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

            Schema::dropIfExists('u_players');
            Schema::dropIfExists('u_playables');
            Schema::dropIfExists('u_guilds');
            Schema::dropIfExists('u_guild_members');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
};
