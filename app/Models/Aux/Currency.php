<?php

namespace App\Models\Aux;

use App\Models\Traits\HasActive;
use App\Models\Traits\HasCommon;
use App\Models\Traits\HasAbilities;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasAllowedActions;

class Currency extends Model
{

    use HasActive;
    use HasCommon;
    use HasAbilities;
    use HasAllowedActions;

    /*******************************************/
    /* Properties
    /*******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency', 'code', 'symbol', 'left', 'spaces', 'decimals', 'decimals_separator', 'thousands_separator', 'rate'
    ];


    /*******************************************/
    /* Relationships
    /*******************************************/

    /*******************************************/
    /* Accessors and mutators
    /*******************************************/

    /**
     * Set Code Uppercase
     *
     * @param  String $value
     * @return void
     */
    public function setCodeAttribute($value)
    {
        $this->attributes['code']=mb_strtoupper($value);
    }

    /**
     * Get Code in uppercase
     *
     * @param  string  $value
     * @return string
     */
    public function getCodeAttribute($value)
    {
        return mb_strtoupper($value);

    }

    public function getString($value)
    {
        $value=trim($value);
        $value=doubleval($value);
        $ret=number_format($value, $this->decimals, $this->decimals_separator, $this->thousands_separator);
        if ($this->left)
        {
            $ret=$this->symbol.str_repeat(' ',$this->spaces).$ret;
        }
        else
        {
            $ret.=str_repeat(' ',$this->spaces).$this->symbol;
        }
        return $ret;
    }

    static public function getCurrent()
    {
        return Currency::where('current', true)->first();
    }


    /*******************************************/
    /* Methods
    /*******************************************/

    public function scopeSearch($query, $search)
    {
        return $query->where('currency', 'like', '%'.$search.'%' )
            ->orWhere('code', 'like', '%'.$search.'%' );
    }

    public function setCurrent()
    {
        $currents=Currency::where('current', true)->get();
        foreach($currents as $current)
        {
            $current->current=false;
            $current->save();
        }
        $this->current=true;
        $this->rate=1;
        $this->save();
        Currency::updateRates();
    }

    public function current()
    {
        return Currency::where('current', true)->first();
    }

    public function updateRate()
    {
        $current=Currency::getCurrent();
        if ($current==null || $this->code=='' || $this->code==null || $this->current) return;
        $data=Currency::getRates();
        if (isset($data['conversion_rates'][$this->code]))
        {
            $this->rate=$data['conversion_rates'][$this->code];
            $this->save();
        }


    }

    static public function getRates()
    {
        $current=Currency::getCurrent();
        $rates=Cache::get('currency_rates_'.$current->code);
        if ($rates==null || ($rates!=null && $rates['result']=='error'))
        {
            Cache::forget('currency_rates_'.$current->code);
            $rates=Cache::remember('currency_rates_'.$current->code,60*60*24, function() {
                $current=Currency::getCurrent();
                $response = Http::get(config('lopsoft.currency_api').$current->code);
                return $response->json();
            });
        }

        return $rates;

    }

    static public function updateRates()
    {
        $current=Currency::getCurrent();
        if ($current==null) return;
        $currencies=Currency::query()->active()->get();
        $data=Currency::getRates();
        foreach($currencies as $currency)
        {
            if (!$currency->current)
            {
                if (isset($data['conversion_rates'][$currency->code]))
                {
                    $currency->rate=$data['conversion_rates'][$currency->code];
                    $currency->save();
                }
            }

        }
    }

    public function convert($currency_id, $value)
    {
        $currency=Currency::find($currency_id);
        if ($currency==null) return null;
        return doubleval(($currency->rate/$this->rate)*$value);
    }

    /*******************************************/
    /* Events
    /*******************************************/

    public function canLockRecordCustom()
    {
        return ($this->canBeLocked());
    }

    public function canBeLocked()
    {
        if ($this->current) return false;
        return true;
    }

    public function canDeleteRecordCustom()
    {
        return ($this->canBeDeleted());
    }

    public function canBeDeleted()
    {
        if ($this->current) return false;
        return true;
    }
}
