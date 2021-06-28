<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use App\Models\Aux\Currency;

class CurrencyInputForm extends Component
{
    public $uid;
    public $mode;
    public $model;
    public $borderless=true;
    public $arrowless=true;
    public $classinput='';
    public $currency_id;
    public $currency;
    public $nextref;
    public $showcurrency=true;
    public $currencydefault;
    public $value=0.00;
    public $showedvalue;
    public $showpercent=false;
    public $isPercent=false;

    protected function getListeners()
    {
        return [
            $this->uid.'_setcurrency'   =>  'setCurrency',
            $this->uid.'_setvalue'      =>  'setValue',
            'dropdownupdated'           =>  'currencySync',
        ];
    }


    public function mount()
    {
        $this->currency=Currency::find($this->currency_id);
        if ($this->mode=='create') $this->setCurrency($this->currency_id);
        $this->currencydefault=$this->currency_id;

    }

    /* Events */

    public function setCurrency($currency_id)
    {
        if ($currency_id==null) return;

        $this->currency_id=$currency_id;
        $this->currency=Currency::find($currency_id);
        $this->setShowedValue($this->value);
    }

    public function setValue($value, $sendstatus=true)
    {
        $this->value=$value;
        $this->setShowedValue($this->value);
        if ($sendstatus) $this->sendStatus();
    }

    public function updatedValue()
    {
        // Clean value
        $this->value = mb_strtolower($this->value);
        $this->value = preg_replace("/[a-z]+/", "", $this->value);
        $this->value = doubleval($this->value);
    }

    public function focusout()
    {
        if ($this->mode!='show')
        {
            $this->value=$this->showedvalue;
            $this->setShowedValue($this->value);
            $this->sendStatus();
        }
    }

    public function focus()
    {
        if ($this->mode=='show')
        {
            $this->setShowedValue($this->value);
            return;
        }
        $this->showedvalue=$this->value;
    }

    public function setShowedValue($value)
    {
        $this->updatedValue($value);
        if (!$this->isPercent)
        {
            $this->showedvalue=$this->currency!=null?$this->currency->getString($value):'';
        }
        else
        {
            $this->showedvalue=$value; //.'%';
        }
    }

    public function currencySync($uid, $currency_id, $change)
    {
        if ($this->uid.'_currency'==$uid)
        {
            $this->setCurrency($currency_id);
        }
    }

    public function sendStatus()
    {
        $this->emit('currencyinputformupdated', $this->uid, $this->value, $this->currency_id, $this->isPercent );
    }

    public function setPercent($value)
    {
        $this->isPercent=$value;
        if ($this->isPercent)
        {
            $this->emit('enabledropdown', $this->uid.'_currency', false);
        }
        else
        {
            if ($this->mode=='show')
            {
                $this->emit('enabledropdown', $this->uid.'_currency', false);
            }
            else
            {
                $this->emit('enabledropdown', $this->uid.'_currency', true);
            }
        }
        $this->setShowedValue($this->value);
        $this->sendStatus();
    }

    /* Render */

    public function render()
    {
        return view('livewire.controls.currency-input-form');
    }
}
