<?php

declare(strict_types=1);

namespace App\Models;

//use _deletes\LibUseful;
use App\Models\Enums\TypePlayStyle;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * UPlayables
 */
class UPlayables extends BaseModel
{
    //use LibUseful;
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'nick_name',
        'stamina_count',
        'type_play_style',
    ];
    protected $casts = [
        // TODO アンチパターン
        'type_play_style' => TypePlayStyle::class,
    ];
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
