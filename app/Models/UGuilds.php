<?php

declare(strict_types=1);

namespace App\Models;

//use _deletes\LibUseful;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * UGuilds
 */
class UGuilds extends BaseModel
{
    //use LibUseful;
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'upper_limit_count',
    ];
    protected $casts = [];
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
