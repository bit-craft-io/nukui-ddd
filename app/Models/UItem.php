<?php

namespace App\Models;

use App\Models\Enums\TypeItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'amount',
        'enabled_end_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'item_id' => 'integer',
        'amount' => 'integer',
        'enabled_end_at' => 'datetime',
    ];
}
