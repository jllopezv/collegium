<?php

namespace App\Http\Livewire\Controls;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\WithAlertMessage;

class Datepicker extends Component
{

    use WithAlertMessage;

    public $date;
    public $uid='';                 // Unique ID in components in page
    public $modelid;                // Bind model
    public $mode='';                // Mode
    public $showcontent=false;      // trigger fot show box content
    public $text;                   // text input value
    public $contenttoshow;          // Content to show in select
    public $value;                  // key selected
    public $defaultvalue;           // default key. null to select first
    public $classchevron='';        // class for chevron ( hover or not hover )
    public $label;                  // label for inputgroup
    public $requiredfield=false;    // show info
    public $help='';                // show help for requiredfield
    public $readonly=false;         // Readonly property
    public $validationerror='';     // VAlidation errors

    public $eventname='';           // eventname to fire in parent component
    public $isTop=false;            // where show seach list

    public $firstdayofweek;
    public $today;
    public $month;
    public $year;
    public $tempdate;
    public $currentdate;
    public $skip;
    public $lastdaymonth;
    public $firstdaytoshow;
    public $firstweekdaytoshow;
    public $weekdays;
    public $monthname;
    public $daystr=['D','L','M','M','J','V','S'];
    public $closeafterselect=true;
    public $valuedate=null;

    protected $listeners=[
        'setvalue'  =>  'setValue',
        'getvalue'  =>  'getValue',
        'validationerror'   =>  'validationError'
    ];

    public function mount()
    {
        if ($this->label=='') $this->label="FECHA";
        $this->classchevron='text-gray-300 hover:text-gray-700';
        $this->contenttoshow=false;
        $this->isTop=true;
        $this->validationerror="";
        $this->showcontent=false;
        $this->weekdays=Carbon::getWeekendDays();
        $this->monthname=getDateFromDate(2000,1,1);
        $this->setToday();
        $this->month=$this->today->month;
        $this->year=$this->today->year;
        if ($this->defaultvalue=='')
        {
            $this->currentdate=$this->createDate($this->year,$this->month,1);
        }
        else
        {
            $this->currentdate=getDateFromFormat($this->defaultvalue);
            $this->month=$this->currentdate->month;
            $this->year=$this->currentdate->year;
        }
        $this->value=getDateString($this->currentdate);
        $this->valuedate=getDateFromDate($this->currentdate->year, $this->currentdate->month, $this->currentdate->day,);
        //Establish first day
        for($i=0;$i<config('lopsoft.firstweekday');$i++)
        {
            array_push($this->daystr, array_shift($this->daystr));
        }
        $this->updateMonthData();

    }


    public function createDate($year, $month, $day)
    {
        return getDateFromDate($year, $month, $day);
    }

    public function setToday()
    {
        $this->today=getToday();
    }

    public function setCalendar()
    {
        $this->tempdate = getDateFromDate($this->year, $this->month, 1);
        $this->skip=$this->currentdate->dayOfWeek;
        if ( $this->skip < config('lopsoft.firstweekday' )) $this->skip=7;
        for($i=config('lopsoft.firstweekday');$i<$this->skip;$i++,$this->tempdate->subDay());

    }

    public function updateMonthData()
    {
        $this->month=$this->currentdate->month;
        $this->year=$this->currentdate->year;
        $this->currentdate = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1);
        $this->lastdaymonth = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1)->setTimezone(config('lopsoft.timezone_default'));
        $this->lastdaymonth->addMonth()->subDay();
        $this->setCalendar();
    }

    public function prevMonth()
    {
        $this->currentdate->subMonth();
        $this->updateMonthData();

    }

    public function nextMonth()
    {
        $this->currentdate->addMonth();
        $this->updateMonthData();

    }

    public function goMonth($m)
    {
        $this->month=$m+1;
        $this->currentdate = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1)->setTimezone('Europe/Madrid')->locale(config('lopsoft.locale_default')); // Current Month
        $this->updateMonthData();

    }

    public function goYear($y)
    {
        $this->year=$y;
        $this->currentdate = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1)->setTimezone('Europe/Madrid')->locale(config('lopsoft.locale_default')); // Current Month
        $this->updateMonthData();

    }

    public function goDate($m, $y)
    {
        $this->month=$m;
        $this->year=$y;
        $this->currentdate = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1)->setTimezone('Europe/Madrid')->locale(config('lopsoft.locale_default')); // Current Month
        $this->updateMonthData();
    }

    public function goToday()
    {
        $this->setToday();
        $this->year=$this->today->year;
        $this->month=$this->today->month;
        $this->currentdate = $this->createDate($this->year, $this->month, 1); //Carbon::createFromDate($this->year, $this->month, 1)->setTimezone('Europe/Madrid')->locale(config('lopsoft.locale_default')); // Current Month
        $this->selectday($this->today->day, $this->today->month, $this->today->year);
    }

    public function selectday($day,$month,$year)
    {
        $this->valuedate=getDateFromDate($year,$month,$day);
        $this->value=$this->valuedate->format( Auth::user()->dateformat??config('lopsoft.date_format') );
        $this->updateMonthData();
        if ($this->closeafterselect)
        {
            $this->hidebody();
        }
        $this->emit( $this->eventname, $this->value );
    }

    public function hydrate()
    {
        $this->tempdate=$this->currentdate;

        // if ($this->value!='')
        // {
        //     $this->valuedate=getDateFromFormat($this->value);
        //     $this->goDate($this->valuedate->month, $this->valuedate->year);
        // }
    }

    public function updatedValue()
    {
        try
        {
            $this->valuedate=getDateFromFormat($this->value);
            if ($this->valuedate->year<100)
            {
                $this->valuedate->addYear(1900);
            }
            $this->goDate($this->valuedate->month, $this->valuedate->year);
            $this->updateMonthData();
            if ($this->closeafterselect)
            {
                $this->hidebody();
            }
            $this->emit( $this->eventname, $this->value );
            $this->value=getDateString($this->valuedate);
            $this->emit( $this->eventname, $this->value );
        } catch (\Exception $e) {
            // Invalid date
            $this->ShowError("FECHA INVÁLIDA","","EL FORMATO ACEPTADO ES ".Auth::user()->dateformat??config('lopsoft.date_format'),false,6000);
            $this->valuedate=$this->createDate($this->today->year, $this->today->month, $this->today->day );
            $this->goToday();
            $this->emit( $this->eventname, $this->value );
        }


    }

    /**
     * Set value
     *
     * @param  mixed $date
     * @return void
     */
    public function setValue($uid, $date)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->value=$date;
        }
    }

    public function getValue($uid)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->emit( $this->eventname, $this->value );
        }
    }

    public function validationError($errors)
    {
        $this->validationerror='';
        if (Arr::has($errors,$this->modelid))
        {
            $this->validationerror=$errors[$this->modelid][0];
        }
    }

    /**
     * Show Box of search
     *
     * @return void
     */
    public function showbody()
    {

        if ($this->readonly) return;
        $this->showcontent=true;
        $this->classchevron='text-gray-700';
        $this->setCalendar();
    }

    /**
     * Hide Box of Search
     *
     * @return void
     */
    public function hidebody()
    {
        $this->showcontent=false;
        $this->classchevron='text-gray-300 hover:text-gray-700';

    }


    /**
     * Toggle box of search visibility
     *
     * @return void
     */
    public function togglebody()
    {
        if ($this->readonly) return;
        if (!$this->showcontent)
        {
            $this->showbody();

        }
        else
        {
            $this->hidebody();
        }
    }

    public function render()
    {
        return view('livewire.controls.datepicker');
    }
}
