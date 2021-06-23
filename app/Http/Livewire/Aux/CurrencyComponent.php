<?php

namespace App\Http\Livewire\Aux;

use Livewire\Component;
use App\Models\Aux\Currency;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\HasCommon;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithFlashMessage;
use App\Http\Livewire\Traits\WithModalConfirm;
use Illuminate\Support\Facades\Http;

class CurrencyComponent extends Component
{
    use WithPagination;
    use HasCommon;
    use WithFlashMessage;
    use WithAlertMessage;
    use WithModalAlert;
    use WithModalConfirm;

    public  $currency;
    public  $code;
    public  $symbol;
    public  $left;
    public  $decimals;
    public  $spaces;
    public  $decimals_separator;
    public  $thousands_separator;
    public  $rate;
    public  $current=false;
    public  $preview='';


    protected $listeners=[
        'refreshDatatable'      => 'refreshDatatable',
        'refreshForm'           => 'refreshForm',           // Refresh all components in show or edit mode
        'deleteRecord'          => 'deleteRecord',
        'actionDestroyBatch'    => 'actionDestroyBatch',
        'actionLockBatch'       => 'actionLockBatch',
        'actionUnLockBatch'     => 'actionUnLockBatch',

    ];

    /**
     * Mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->table='currencies';
        $this->module='aux';
        $this->commonMount();
        // Default order for table
        $this->sortorder='currency';
        if ($this->mode=='create')
        {
            // default create options
            $this->loadDefaults();
        }
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'currency'              => 'required|string|max:255|unique:currencies,currency,'.$this->recordid,
            'symbol'                => 'required',
            'spaces'                => 'required|numeric|min:0|max:10',
            'code'                  => 'required|max:3',
            'decimals_separator'    => 'required|different:thousands_separator',
            'thousands_separator'   => 'required|different:decimals_separator',
            'rate'                  => 'numeric',
        ];
    }

    public function loadDefaults()
    {
        $this->code='';
        $this->decimals=2;
        $this->spaces=1;
        $this->left=true;
        $this->current=false;
        $this->decimals_separator=',';
        $this->thousands_separator='.';
    }

    public function resetForm()
    {
        $this->currency='';
        $this->code='';
        $this->symbol='';
        $this->left=true;
        $this->decimals=2;
        $this->spaces=2;
        $this->decimals_separator=',';
        $this->thousands_separator='.';
        $this->rate=1.0;
        $this->current=false;
    }

    public function loadRecordDef()
    {
        $this->currency=$this->record->currency;
        $this->code=$this->record->code;
        $this->symbol=$this->record->symbol;
        $this->left=$this->record->left;
        $this->decimals=$this->record->decimals;
        $this->spaces=$this->record->spaces;
        $this->decimals_separator=$this->record->decimals_separator;
        $this->thousands_separator=$this->record->thousands_separator;
        $this->rate=$this->record->rate;
        $this->current=$this->record->current;

        $this->updated();
    }

    public function getKeyNotification($record)
    {
        return ($record->currency);
    }

    /**
     * Save or Update record data
     *
     * @return void
     */
    public function saveRecord()
    {
        return [
            'currency'              =>  $this->currency,
            'code'                  =>  $this->code,
            'symbol'                =>  $this->symbol,
            'left'                  =>  $this->left,
            'spaces'                =>  $this->spaces,
            'decimals'              =>  $this->decimals,
            'decimals_separator'    =>  $this->decimals_separator,
            'thousands_separator'   =>  $this->thousands_separator,
            'rate'                  =>  $this->rate,
            'current'               =>  $this->current,

        ];
    }

    public function setCurrent($id)
    {
        $record=Currency::find($id);

        if ($record==null) return;
        $record->setCurrent();
    }

    public function preSortOrder()
    {
        $this->data->orderBy('current','desc');
    }

    public function lockingRecord($record)
    {
        if ($record->current) return false;
        return true;
    }

    public function customFieldsValidation()
    {
        $fails=false;
        $this->resetErrorBag();
        $validator=Validator::make(
            [
                'decimals_separator'    =>  $this->decimals_separator,
                'thousands_separator'   =>  $this->thousands_separator,
            ],
            [
                'decimals_separator' =>  'required|different:thousands_separator',
                'thousands_separator' =>  'required|different:decimals_separator',
            ],
        );

        $fails=$validator->fails();
        if ($fails)
        {
            $this->addError('decimals_separator', 'LOS SEPARADORES DEBEN SER DISTINTOS');
            $this->addError('thousands_separator', 'LOS SEPARADORES DEBEN SER DISTINTOS');
            $this->showFlashError($this->flashmessageid,"ERROR EN LOS DATOS");
        }

        return !$fails;
    }

    public function postStore($storedRecord)
    {
        if (Currency::count()==1)
        {
            $storedRecord->setCurrent();
        }
    }

    public function updated()
    {

        if (is_numeric($this->spaces)==false) $this->spaces=0;
        if (is_numeric($this->decimals)==false) $this->decimals=2;

        if (!$this->customFieldsValidation()) return;

        $currency=new Currency;
        $currency->symbol=$this->symbol;
        $currency->left=$this->left;
        $currency->decimals=$this->decimals;
        $currency->spaces=$this->spaces;
        $currency->decimals_separator=$this->decimals_separator;
        $currency->thousands_separator=$this->thousands_separator;

        $this->preview=$currency->getString('-123456789.8383');

    }

    public function updateCurrency()
    {
        if (Currency::count()==0)
        {
            $this->rate=1;
            return;
        }
        if ($this->mode!='create')
        {
            if ($this->record->current)
            {
                $this->rate=1;
                return; // no rate for current currency
            }
        }
        $current=Currency::getCurrent();
        if ($current==null)
        {
            $this->ShowError('NO HAY DEFINIDA UNA DIVISA POR DEFECTO');
            return;
        }
        if ($this->code=='' || $this->code==null)
        {
            $this->ShowError('NO SE ESPECIFICÓ EL CÓDIGO DE LA DIVISA');
            return;
        }

        $data=Currency::getRates();
        if (isset($data['conversion_rates'][$this->code])) $this->rate=$data['conversion_rates'][$this->code];

        $this->updated();
    }

    public function updateCurrencyManual($currency_id)
    {
        $currency=Currency::find($currency_id);
        if ($currency==null) return;
        $currency->updateRate();

    }

    public function updateCurrencyAuto()
    {
        Currency::updateRates();
    }


}
