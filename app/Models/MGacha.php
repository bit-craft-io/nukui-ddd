<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Enums\TypeDraw;
use Illuminate\Database\Eloquent\Model;

class MGacha extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'is_active',
        'type_draw',
        'group_no',
        'exec_count',
        'item_id',
        'total_cost',
        'draw_count',
        'gacha_lot_rarity_group_no',
        'gacha_lot_group_no',
        'begin_at',
        'end_at',
        'display_order',
        'banner_image_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'ops_memo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'is_active' => 'boolean',
        'type_draw' => TypeDraw::class,
        'group_no' => 'integer',
        'exec_count' => 'integer',
        'item_id' => 'integer',
        'total_cost' => 'integer',
        'draw_count' => 'integer',
        'gacha_lot_rarity_group_no',
        'gacha_lot_group_no',
        'begin_at' => 'datetime:Y-m-d H:i:s',
        'end_at' => 'datetime:Y-m-d H:i:s',
        'display_order' => 'integer',
        'banner_image_name' => 'string',
    ];
}
