<?php

namespace App\Models\Aux;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;

class Translation extends Model
{
    use HasOwner;
    use HasActive;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'locale',
    ];

    /**
     * Get all of the owning translatable models.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function translatable()
    {
        return $this->morphTo();
    }

}
