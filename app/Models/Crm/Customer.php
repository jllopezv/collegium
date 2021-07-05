<?php

namespace App\Models\Crm;

use App\Models\Aux\Document;
use App\Models\School\Student;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Crm\CustomerEmail;
use App\Models\Crm\CustomerPhone;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasInvoices;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasModelAvatar;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Customer extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /* Profile */
    use IsUserType;

    /* Has Avatar */
    use HasModelAvatar;

    /* Anno Support */
    //use HasAnno;
    //use HasPriority;
    //use HasAvailable;

    /* Has Invoices */
    use HasInvoices;


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'customer', 'rnc', 'address1','address2','city','state','country_id','pbox','notes',
        'profile_photo_path', 'customer_type_id'
    ];

    protected $appends= [ 'avatar' ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function phones()
    {
        return $this->hasMany(CustomerPhone::class,'customer_id');
    }

    public function emails()
    {
        return $this->hasMany(CustomerEmail::class,'customer_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'customer_id');
    }

    /**
     * Get all of the models's documents
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    public function getTypeAttribute()
    {
        $type=CustomerType::find($this->customer_type_id);
        if ($type==null) return null;
        return $type;
    }

    /**
     * Get Name in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getCustomerAttribute($value)
    {
        if (config('lopsoft.customersname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set Names in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setCustomerAttribute($value)
    {
        if (config('lopsoft.customersname_uppercase')) $this->attributes['customer'] = mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('customer', 'like', '%'.$search.'%' );
    }

    /*******************************************/
    /* Actions
    /*******************************************/

    public function postDelete()
    {
        $this->user->delete();  // Delete asocciated user
    }

    public function postLock()
    {
        $this->user->lock();  // Lock asocciated user
    }

    public function postUnlock()
    {
        $this->user->unlock(); // Unlock assocciated user
    }
}
