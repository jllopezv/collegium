<?php

namespace App\Models\Aux;

use App\Models\Crm\Customer;
use App\Models\Crm\Employee;
use App\Models\Traits\HasAbilities;
use App\Models\Website\WebsiteBanner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\HasAllowedActions;

class Document extends Model
{
    use HasAbilities;
    use HasAllowedActions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document', 'data', 'description'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function students()
    {
        $this->morphedMany(Student::class, 'documentable');
    }

    public function employees()
    {
        $this->morphedMany(Employee::class, 'documentable');
    }

    public function customers()
    {
        $this->morphedMany(Customer::class, 'documentable');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('document', 'like', '%'.$search.'%' )
            ->orWhere('description', 'like', '%'.$search.'%');
    }

}
