<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Enums\TypeItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MItem extends Model
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
        'enabled_from_at',
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
        'name' => 'string',
        'type_item' => TypeItem::class,
        'max_display' => 'integer',
        'max_stock' => 'integer',
        'enabled_from_at' => 'datetime:Y-m-d H:i:s',
        'enabled_end_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function scopeEnable(Builder $query): Builder
    {
        // TODO baseModel
        $now = now();
        return $query
            ->where(function ($query) use ($now) {
                $query->whereNull('enabled_from_at')
                    ->orWhere('enabled_from_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('enabled_end_at')
                    ->orWhere('enabled_end_at', '>=', $now);
            });
    }
}
