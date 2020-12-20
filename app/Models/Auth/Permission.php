<?php

namespace App\Models\Auth;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Permission extends Model
{
    use HasActive;
    use HasOwner;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'group'
    ];


    public static function boot()
    {
        parent::boot();
        static::created(function($model){
            $roles=Role::all();
            foreach($roles as $role)
            {
                Cache::forget('role'.$role->id.'permissions');
            }
        });

        static::deleted(function($model){
            $roles=Role::all();
            foreach($roles as $role)
            {
                Cache::forget('role'.$role->id.'permissions');
            }
        });

        static::updated(function($model){
            $roles=Role::all();
            foreach($roles as $role)
            {
                Cache::forget('role'.$role->id.'permissions');
            }
        });

        static::saved(function($model){
            $roles=Role::all();
            foreach($roles as $role)
            {
                Cache::forget('role'.$role->id.'permissions');
            }
        });
    }

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Permission Group
     *
     * @return void
     */
    public function permissiongroup()
    {
        return $this->belongsTo(PermissionGroup::class,'group','id','permission_groups');
    }

    /**
     * Get Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->where('active',1);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get slug in lowercase
     *
     * @param  string  $value
     * @return string
     */
    public function getSlugAttribute($value)
    {
        return strtolower($value);
    }

    /**
     * Set slug in lowercase
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('slug', 'like', '%'.$search.'%' )
            ->orWhere('name', 'like', '%'.$search.'%' )
            ->orWhere('description', 'like', '%'.$search.'%' );
    }

    static public function getTables()
    {
        $permissions=Permission::active()->get();

        $grouped = $permissions->groupBy(function ($item, $key) {
            return substr($item['slug'],0, strpos($item['slug'], '.'));
        });

        return array_keys($grouped->all());
    }

    static public function getTablesFromCollection($permissions)
    {
        $grouped = $permissions->groupBy(function ($item, $key) {
            return substr($item['slug'],0, strpos($item['slug'], '.'));
        });

        return array_keys($grouped->all());
    }



}
