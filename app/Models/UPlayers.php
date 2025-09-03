<?php

namespace App\Models;

use App\Models\Enums\TypePlayStyle;
use Illuminate\Database\Eloquent\SoftDeletes;

class UPlayers extends BaseModel
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
        'nick_name',
        'type_play_style',
    ];
    protected $casts = [
        // @note インフラ層にアプリ層の概念がある（アンチパターン）
        //'type_play_style' => TypePlayStyle::class,
    ];
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
