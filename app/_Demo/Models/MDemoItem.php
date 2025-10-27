<?php

declare(strict_types=1);

namespace App\_Demo\Models;

use App\Models\Enums\TypeItem;
use Illuminate\Database\Eloquent\Model;

class MDemoItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type_item',
        'max_display',
        'max_stock',
        'begin_at',
        'end_at',
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
        'name' => 'string',
        'type_item' => TypeItem::class,
        'max_display' => 'integer',
        'max_stock' => 'integer',
        'begin_at' => 'datetime:Y-m-d H:i:s',
        'end_at' => 'datetime:Y-m-d H:i:s',
    ];
}
