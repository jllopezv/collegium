<?php

namespace App\Models\Traits;

use App\Models\Setting\ModelConfig;
use Illuminate\Support\Facades\Auth;


/**
 * HasModelConfig
 */
trait HasModelConfig
{
    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get model's configurations
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function configs()
    {
        return $this->morphMany(ModelConfig::class, 'configable');
    }

    public function setConfig($attribute, $value)
    {
        $config=$this->configs()->first();
        if ($config==null)
        {
            return $this->configs()->create([ 'data' => $this->asJson($value)  ]);
        }
        $configs=json_decode($config->data,true);
        if ($value!=null)
        {
            $configs[$attribute]=$value;
        }
        else
        {
            unset($configs[$attribute]);
        }
        $config->data=$this->asJson($configs);
        $config->save();
        return $config;

    }

    public function getConfig($attribute)
    {
        $config=$this->configs()->first();
        $configs=json_decode($config->data,true);
        return $configs[$attribute]??null;
    }

    public function getAllConfig()
    {
        $config=$this->configs()->first();
        $configs=json_decode($config->data,true);
        return $configs;
    }


}
