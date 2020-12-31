<div class='h-full'>
    @if($page==null)
        LISTA DE COFIGURACIONES
    @else
        <div class='w-full p-2 border-b border-l bg-cool-gray-300 border-cool-gray-400'>
            <div class='text-xl font-bold text-gray-700'>{{ $page->settingpage??'' }}</div>
            <div class='text-lg text-gray-600'>{{ $page->description??'' }}</div>
        </div>
        <div class='p-2 bg-white border-l border-cool-gray-400'>
            @foreach($settings as $index => $setting)

                    @if ($setting->type=='text' || $setting->type=='number')
                        <x-lopsoft.control.inputform
                            id='{{ $setting->settingkey }}'
                            label="{{ $setting->settingkey }}"
                            sublabel="{{ $setting->settingdesc }}"
                            autofocus
                            classcontainer="{{ $setting->type=='text'?'w-full':'w-80' }}"
                            value="{{ $setting->settingvalue }}"
                            wire:model='settingsvalues.{{ $setting->settingkey }}'
                        />
                    @endif
                    @if ($setting->type=='boolean')
                        <x-lopsoft.control.checkboxform
                            id='{{ $setting->settingkey }}'
                            label="{{ $setting->settingkey }}"
                            sublabel="{{ $setting->settingdesc }}"
                            color='text-blue-400' classlabel='font-bold'
                            wire:model='settingsvalues.{{ $setting->settingkey }}'
                            />
                    @endif
                    @if ($setting->type=='image')
                        <x-lopsoft.control.imageform
                            id='{{ $setting->settingkey }}'
                            label="{{ $setting->settingkey }}"
                            sublabel="{{ $setting->settingdesc }}"
                            classcontainer='w-full'
                            mode="create"
                            fileid="filetypeimage"
                            modelid='{{ $setting->settingkey }}'
                            wire:model='settingsvalues.{{ $setting->settingkey }}'
                            params='types:jpg,png'
                        />
                    @endif
                    {{-- <input type='text' value='{{ $setting->type }}' /> --}}

            @endforeach
        </div>

        <div class='p-4 border-l border-cool-gray-400'>
            @livewire('messages.flash-message', ['msgid' => 'configpagecontent'] )
        </div>


        <div class='h-32 text-right bg-white border-l border-cool-gray-400'>
            <div class='mr-4'>
                <x-lopsoft.button.gray x-ref='btnUpdate' icon='fa fa-check' text="ACTUALIZAR" wire:click='update({{ $page->id }})' class='ml-1' />
            </div>
        </div>
    @endif

    @livewire('filemanager.filemanager', ['uuid' => 'filemanager-settings', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

</div>
