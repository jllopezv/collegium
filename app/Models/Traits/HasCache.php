<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * HasCache
 */
trait HasCache
{
    public function allCache($relations="")
    {
        return Cache::rememberForever(self::getTable().".all", function () use ($relations) {
            $data=self::getModel()::query();
            if ($relations!="") $data=$data->with($relations);
            return $data->get();
        });
    }
}
