<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use App\Models\Setting\AppSettingPage;

class ConfigPageComponent extends Component
{
    public $pages;
    public $currentpage;

    public function mount()
    {
        $this->pages=AppSettingPage::active()->orderBy('priority','asc')->get();
        $this->currentpage=$this->pages->first()->id;
    }

    public function selectPage($id)
    {
        $this->currentpage=$id;
        $this->emit("configchangepage",$id);
    }

    public function render()
    {
        return view('livewire.setting.config-page-component');
    }


}
