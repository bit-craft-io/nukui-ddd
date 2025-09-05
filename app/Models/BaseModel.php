<?php

declare(strict_types=1);

namespace App\Models;

//use _deletes\AppLibException;
//use _deletes\Depends\ExException;
use App\Libraries\Exceptions\ExException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseModel extends Model
{
    //use AppLibException;

    /**
     * @param int $id
     * @return Model|null
     * @throws Exception
     */
    public function findOrFailed(int $id): ?Model
    {
        $model = $this->newQuery()
            ->find($id)
            ->first();

        if (!$model) {
            // TODO App Error
            //self::ExException()->failed();
            Log::error( '---------- ' . __CLASS__ . '::' . __LINE__);
            (new ExException("Model not found"))->failed();
        }

        return $model;
    }
}
