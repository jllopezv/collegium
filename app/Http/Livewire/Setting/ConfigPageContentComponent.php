<?php

namespace App\Http\Livewire\Setting;

use App\Http\Livewire\Traits\WithFlashMessage;
use Livewire\Component;
use App\Models\Setting\AppSetting;
use App\Models\Setting\AppSettingPage;
use App\Http\Livewire\Traits\WithModalAlert;

class ConfigPageContentComponent extends Component
{
    use WithModalAlert;
    USE WithFlashMessage;

    public $page_id;
    public $page = null;
    public $settings = null;
    public $settingsvalues=[];

    protected $listeners=[
        'configchangepage'  =>  'configChangePage',
        'filemanagerselect' =>  'filemanagerSelect',
    ];

    public function configChangePage($id)
    {
        $this->page_id=$id;
        $this->page=AppSettingPage::find($id);
        $this->settings = $this->page->settings;
        $sets=$this->page->settings;
        foreach($sets as $set)
        {
            if ($set->type!='boolean')
            {
                $this->settingsvalues[$set->settingkey]=$set->settingvalue;
            }
            else
            {
                $this->settingsvalues[$set->settingkey]=$set->settingvalue==='true'?true:false;
            }
        }
    }

    public function filemanagerSelect($uuid, $dir, $file, $modelid)
    {
        $this->settingsvalues[$modelid]=$dir.$file[0]['basename']; // Only 1 image
    }

    public function update($page)
    {
        $this->resetErrorBag();
        $this->showFlashSuccess('configpagecontent','INFORMACIÓN ACTUALIZADA');
        foreach($this->settings as $set)
        {
            $setting=AppSetting::find($set->id);
            if ($setting!=null)
            {
                $setting->settingvalue=$this->settingsvalues[$setting->settingkey];
                if ($setting->type=='boolean') $setting->settingvalue=$this->settingsvalues[$setting->settingkey]==true?'true':'false';
                if ($setting->type=='number')
                {
                    if (!is_numeric($this->settingsvalues[$setting->settingkey]))
                    {
                        $this->addError($setting->settingkey, 'DEBE SER UN NÚMERO');
                        $this->showFlashError('configpagecontent',"ERROR AL ACTUALIZAR");
                        return;
                    }
                }
                $setting->save();
            }
            else
            {
                $this->showFlashError('configpagecontent','ERROR AL ACTUALIZAR INFORMACIÓN');
                return;
            }
        }
    }

    public function render()
    {
        return view('livewire.setting.config-page-content-component');
    }
}
