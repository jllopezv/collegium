<?php

namespace App\Models;

use App\Models\Auth\Role;
use App\Models\Aux\Timezone;
use App\Models\Traits\HasOwner;
use Laravel\Jetstream\HasTeams;
use App\Models\Traits\HasActive;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\HasAbilities;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
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
        'active', 'name', 'email', 'username', 'level', 'password', 'profile_photo_path', 'dateformat', 'timezone_id', 'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'avatar',
    ];

    /**
     * Get Roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->where('active',1);
    }

    public function rolesArray()
    {
        return $this->belongsToMany(Role::class)->where('active',1)->select('roles.id')->pluck('id')->toArray();
    }

    public function getUserLevel()
    {
        return $this->belongsToMany(Role::class)->where('active',1)->select('roles.level')->pluck('level')->min();
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function getRolesTags()
    {
        $tag='';
        foreach($this->roles as $role)
        {
            $tag.=$role->getRoleTagAttribute()." ";
        }
        return $tag;
    }

    /*********************************************/
    /* Methods
    /*********************************************/

    public function isAdmin()
    {
        if (Auth::user()->level<=config('lopsoft.maxLevelAdmin')) return true;
        return false;
    }

    public function isSuperadmin()
    {
        if (Auth::user()->level==1) return true;
        return false;
    }

    /**
     * Get Avatar, if not exists return defaul avatar
     *
     * @return void
     */
    public function getAvatarAttribute()
    {
        if (is_null($this->profile_photo_path)) return Storage::disk('public')->url(config('lopsoft.default_avatar'));
        if ( !Storage::disk('public')->exists( 'thumbs/'.$this->profile_photo_path ) )
        {
            if ( !Storage::disk('public')->exists( $this->profile_photo_path ) )
            {
                return Storage::disk('public')->url(config('lopsoft.default_avatar'));
            }
            else
            {
                return Storage::disk('public')->url( $this->profile_photo_path );
            }
        }
        return Storage::disk('public')->url( 'thumbs/'.$this->profile_photo_path );
    }

    /**
     * Set avatar path for user
     *
     * @param  mixed $value
     * @return void
     */
    public function setAvatarAttribute($value)
    {
        $this->profile_photo_path=$value;
    }

    /**
     * Query to search in model
     *
     * @param  mixed $query
     * @param  mixed $search
     * @return void
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%' )
            ->orWhere('username', 'like', '%'.$search.'%' )
            ->orWhere('email', 'like', '%'.$search.'%' );
    }


    /**
     * Check if user has ability. If $slug is an array then AND logic
     *
     * @param  String|Array $slug
     * @return boolean
     */
    public function hasAbility($slug)
    {
        if (Auth::user()->level==1) return true;    // Superuser always has this ability

        $roles=$this->roles;
        if (!is_array($slug))
        {
            foreach($roles as $role)
            {
                if ($role->hasAbility($slug)) return true; // At least one role has slug
            }
            return false;
        }

        // Array slug. Only true if user has ALL permissions ( can be in diferent roles )

        foreach($slug as $permissionslug)
        {
            if (!Auth::user()->hasAbility($permissionslug)) return false;
        }
        return true;

    }

    public function hasAbilityOr($slug)
    {
        if (Auth::user()->level==1) return true;    // Superuser always has this ability

        $roles=$this->roles;
        if (!is_array($slug))
        {
            foreach($roles as $role)
            {
                if ($role->hasAbility($slug)) return true; // At least one role has slug
            }
            return false;
        }

        // Array slug. Only true if user has al least one permission ( can be in diferent roles )

        foreach($slug as $permissionslug)
        {
            if (Auth::user()->hasAbility($permissionslug)) return true;
        }
        return false;
    }

    /**
     * Get the name of the mayor role ( level role )
     *
     * @return String
     */
    public function getUserRole()
    {
        $role=Role::where('level',$this->level)->first();
        return($role->role??"");
    }


    /* Can rules */

    /**
     * General rule for destroy record
     *
     * @return void
     */
    public function canBeDeleted()
    {
        if ($this->id==Auth::user()->id) return false;  // Rule 1: Nobody can destroy itself
        if (Auth::user()->level==1) return true;        // Rule 2: Superuser can destroy everyone

    }
}
