<?php

namespace App\Models\Auth;

use App\Models\Aux\Color;
use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Role extends Model
{
    use HasActive;
    use HasOwner;
    use HasAbilities;
    use HasAllowedActions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'level', 'dashboard', 'color_id', 'quota', 'unlimited_quota'
    ];

    /*******************************************/
    /* Relationships
    /*******************************************/

    /**
     * Get Color
     *
     * @return void
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->where('active',1);
    }

    /**
     * Get Array of permissions
     *
     * @return void
     */
    public function permissionsArray()
    {
        return $this->belongsToMany(Permission::class)->where('active',1)->select('permissions.id')->pluck('id')->toArray();
    }

    /**
     * Get Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->where('active',1);
    }

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Get role in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getRoleAttribute($value)
    {
        return mb_strtoupper($value);
    }

    /**
     * Set slug in uppercase
     *
     * @param  string  $value
     * @return void
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = mb_strtoupper($value);
    }


    public function getRoleNameAttribute($value)
    {
        return $this->color->getCustomTag($this->role);
    }

    /*******************************************/
    /* Abilities
    /*******************************************/

    public function hasAbility($slug)
    {
        if (Auth::user()->isSuperadmin()) return true;
        $permission=$this->permissions()->where('slug',$slug)->first();
        return ($permission?true:false);
    }

    /*******************************************/
    /* Methods
    /*******************************************/

    public function getRoleTagAttribute()
    {
        return $this->color->getCustomTag($this->role);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('role', 'like', '%'.$search.'%' )
            ->orWhere('dashboard', 'like', '%'.$search.'%' );
    }



}
