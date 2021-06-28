<?php

namespace App\Models\Crm;

use App\Models\Aux\Document;
use App\Models\School\Student;
use App\Models\Traits\HasAnno;
use App\Models\Traits\HasOwner;
use App\Models\Crm\SupplierType;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Crm\SupplierEmail;
use App\Models\Crm\SupplierPhone;
use App\Models\Traits\IsUserType;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasModelAvatar;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Supplier extends Model
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


    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier', 'rnc', 'address1','address2','city','state','country_id','pbox','notes',
        'profile_photo_path', 'supplier_type_id'
    ];

    protected $appends= [ 'avatar' ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    public function phones()
    {
        return $this->hasMany(SupplierPhone::class,'supplier_id');
    }

    public function emails()
    {
        return $this->hasMany(SupplierEmail::class,'supplier_id');
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
        $type=SupplierType::find($this->supplier_type_id);
        if ($type==null) return null;
        return $type;
    }

    /**
     * Get Name in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getSupplierAttribute($value)
    {
        if (config('lopsoft.suppliersname_uppercase')) return mb_strtoupper($value);
        return $value;
    }

    /**
     * Set Names in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setSupplierAttribute($value)
    {
        if (config('lopsoft.suppliersname_uppercase')) $this->attributes['supplier'] = mb_strtoupper($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('supplier', 'like', '%'.$search.'%' );
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
