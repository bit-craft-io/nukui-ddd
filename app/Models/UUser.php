<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'public_id',
        'nick_name',
        'icon_no',
        'energy',
        'energy_max_regen',
        'energy_max_stock',
        'meta_data',
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
        'icon_no' => 'integer',
        'energy' => 'integer',
        'energy_max_regen' => 'integer',
        'energy_max_stock' => 'integer',
        'meta_data' => 'json',
    ];
}
