<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('h_access_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->comment('識別子');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->unsignedSmallInteger('level')->default(1)->comment('ログレベル');
            $table->string('api', 256)->nullable()->comment('実行API');
            $table->json('param')->default(new Expression('(JSON_OBJECT())'))->comment('パラメータ');
            $table->string('file', 256)->nullable()->comment('発生ファイル');
            $table->unsignedInteger('line')->default(0)->comment('発生行');
            $table->json('option')->default(new Expression('(JSON_OBJECT())'))->comment('オプション項目');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_access_infos');
    }
};
