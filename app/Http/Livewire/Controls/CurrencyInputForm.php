<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use App\Models\Aux\Currency;

class CurrencyInputForm extends Component
{
    public $inputbox;
    public $tempinputbox=0.00;
    public $uid;
    public $mode;
    public $model;
    public $showvalue;
    public $borderless=true;
    public $arrowless=true;
    public $classinput='';
    public $currency_id;
    public $currency;
    public $nextref;
    public $showcurrency=true;
    public $currencydefault;
    public $value=0.00;
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

        if ($this->value!='')
        {
            $this->tempinputbox=$this->value;
            $this->focus();
            $this->focusout();
        }


        $this->currencydefault=$this->currency_id;


    }

    /* Events */

    public function setCurrency($currency_id)
    {
        if ($currency_id==null) return;

        $this->currency_id=$currency_id;
        $this->currency=Currency::find($currency_id);
        $this->focus();
        $this->focusout();
    }

    public function setValue($value, $sendstatus=true)
    {
        $this->inputbox=$value;
        $this->tempinputbox=$value;
        $this->focus();
        $this->focusout($sendstatus);
    }

    public function updatedInputbox()
    {
        $this->inputbox=mb_strtolower($this->inputbox);
        $this->inputbox = preg_replace("/[a-z]+/", "", $this->inputbox);
        $this->inputbox=doubleval($this->inputbox);
    }

    public function focusout($sendstatus=true)
    {
        $this->tempinputbox=$this->inputbox;
        $this->setShowValue($this->inputbox);
        $this->inputbox=$this->showvalue;

        if ($sendstatus) $this->sendStatus();
    }

    public function focus()
    {
        if ($this->mode=='show') return;
        $this->inputbox=$this->tempinputbox;
    }

    public function setShowValue($value)
    {

        if (!$this->isPercent)
        {
            $this->showvalue=$this->currency!=null?$this->currency->getString($value):'';
        }
        else
        {
            $this->showvalue=$value; //.'%';
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
        $this->emit('currencyinputformupdated', $this->uid, $this->tempinputbox, $this->currency_id, $this->isPercent );
    }

    public function setPercent($value)
    {
        if ($this->mode=='show') return;
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
        $this->setCurrency($this->currency_id);
    }

    /* Render */

    public function render()
    {
        return view('livewire.controls.currency-input-form');
    }
}
