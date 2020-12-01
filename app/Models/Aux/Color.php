<?php

namespace App\Models\Aux;

use App\Models\Traits\HasOwner;
use App\Models\Traits\HasActive;
use App\Models\Traits\HasAbilities;
use App\Models\Traits\HasAllowedActions;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
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
        'name', 'textcolor', 'background',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name']=mb_strtoupper($value);
    }

    public function getNameAttribute($value)
    {
        return mb_strtoupper($value);
    }

    public function setTextcolorAttribute($value)
    {
        $this->attributes['textcolor']=mb_strtolower($value);
    }

    public function getTextcolorAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function setBackgroundAttribute($value)
    {
        $this->attributes['background']=mb_strtolower($value);
    }

    public function getBackgroundAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getTagAttribute()
    {
        return "<span class='px-2 text-sm font-bold ".($this->textcolor==''?"text-white":strtolower('text-'.$this->textcolor))." ".($this->background==''?"bg-cool-gray-600":strtolower('bg-'.$this->background))." rounded-md'>".($this->name==''?"MUESTRA":$this->name)."</span>";
    }

    public function getCustomTag($tag)
    {
        return "<span class='px-2 text-sm font-bold ".($this->textcolor==''?"text-white":strtolower('text-'.$this->textcolor))." ".($this->background==''?"bg-cool-gray-600":strtolower('bg-'.$this->background))." rounded-md'>".$tag."</span>";
    }


    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%' );
    }



}
