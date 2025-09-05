<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * MInfos
 */
class MInfos extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'content',
        'notice_begin_at',
        'notice_end_at',
        'is_stopped',
        'sort_priority',
    ];

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->store(__METHOD__)->find(
            fn () => $this->newQuery()->get()->toArray()
        );
    }

    /**
     * @param int $id
     * @return array
     * @throws ExException
     */
    public function findOrFailedById(int $id): array
    {
        $remember_key = __METHOD__ . '::' . $id;
        $model = $this->store($remember_key)->find(
            fn (): ?array => $this->newQuery()
                ->where([
                    'id' => '?',
                ])
                ->setBindings([$id])
                ->first()?->toArray()
        );

        if (empty($model)) {
            // TODO
            //$this->_exException()->failed(self::FAILED_ERROR);
        }

        return $model;
    }
}
