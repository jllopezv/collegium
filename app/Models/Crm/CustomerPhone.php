<?php

namespace App\Models\Crm;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\School\SchoolParent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerPhone extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'description', 'customer_id'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('phone', 'like', '%'.$search.'%' )
            ->orWhere('description','like', '%'.$search.'%' );
    }
}
