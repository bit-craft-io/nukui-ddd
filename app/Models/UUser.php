<?php

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
        'icon_no' => 'int',
        'energy' => 'int',
        'energy_max_regen' => 'int',
        'energy_max_stock' => 'int',
        'meta_data' => 'json',
    ];
}
