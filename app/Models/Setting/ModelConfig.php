<?php

namespace App\Models\Setting;

use App\Models\Traits\HasAbilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelConfig extends Model
{
    use HasAbilities;
    use HasAllowedActions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data', 'configable_type', 'configable_id'
    ];

    public function configable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        $this->morphedMany(User::class, 'configable');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('data', 'like', '%'.$search.'%' );
    }
}
