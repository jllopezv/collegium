<div class='h-full'>
    @if($page==null)
        <div class='w-full p-2 border-b border-l bg-cool-gray-300 border-cool-gray-400'>
            <div class='text-xl font-bold text-gray-700'>CONFIGURACIÓN DEL SISTEMA</div>
            <div class='text-lg text-gray-600'>SELECCIONE LA PÁGINA DE OPCIONES QUE QUIERE CONFIGURAR</div>
        </div>
    @else
        <div class='w-full p-2 border-b border-l bg-cool-gray-300 border-cool-gray-400'>
            <div class='text-xl font-bold text-gray-700'>{{ $page->settingpage??'' }}</div>
            <div class='text-lg text-gray-600'>{{ $page->description??'' }}</div>
        </div>
        @if (count($settings))
            <div class='p-2 bg-white border-l border-cool-gray-400'>
                @foreach($settings as $index => $setting)

                        @if ($setting->type=='text' || $setting->type=='number')
                            <x-lopsoft.control.inputform
                                id='{{ $setting->settingkey }}'
                                label="{{ $setting->settingkey }}"
                                sublabel="{{ $setting->settingdesc }}"
                                autofocus
                                classcontainer="{{ $setting->type=='text'?'w-full':'w-80' }}"
                                classcomponent="{{ true?'bg-cool-gray-100 px-2':''}}"
                                class="{{ true?'bg-cool-gray-100':''}}"
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
                                classcomponent="{{ true?'bg-cool-gray-100 px-2':''}}"
                                />
                        @endif
                        @if ($setting->type=='image')
                            <div class='flex flex-wrap md:flex-no-wrap items-center justify-start {{ true?'bg-cool-gray-100':''}}'>
                                <div class='w-full'>
                                    <x-lopsoft.control.imageform
                                        id='{{ $setting->settingkey }}'
                                        label="{{ $setting->settingkey }}"
                                        sublabel="{{ $setting->settingdesc }}"
                                        classcontainer='w-full'
                                        mode="create"
                                        fileid="filetypeimage"
                                        modelid='{{ $setting->settingkey }}'
                                        wire:model='settingsvalues.{{ $setting->settingkey }}'
                                        params='types:jpg,png,jpeg'
                                        classcomponent="{{ true?'bg-cool-gray-100 px-2':''}}"
                                        class="{{ true?'bg-cool-gray-100':''}}"
                                        uuid="filemanager-settings"
                                    >

                                    </x-lopsoft.control.imageform>

                                </div>
                                <div class='pr-2 {{ true?'bg-cool-gray-100':''}} h-full mx-auto pb-2 md:pb-0'>
                                    <img src="{{getImage( $settingsvalues[$setting->settingkey] )}}" style='max-height: 100px' />
                                </div>
                            </div>
                        @endif
                        <div class='h-2 border-t border-cool-gray-200'></div>

                @endforeach
            </div>


            <div class='p-4 bg-white border-l border-cool-gray-400'>
                @livewire('messages.flash-message', ['msgid' => 'configpagecontent'] )
            </div>


            <div class='h-32 text-right bg-white border-l border-cool-gray-400'>
                <div class='mr-4'>
                    <x-lopsoft.button.gray x-ref='btnUpdate' icon='fa fa-check' text="ACTUALIZAR" wire:click='update({{ $page->id }})' class='ml-1' />
                </div>
            </div>
        @else
            <div class='mt-4'>
                <span class='font-bold text-red-500'>NO HAY CONFIGURACIONES DISPONIBLES EN ESTA PÁGINA</span>
            </div>
        @endif
    @endif

    @livewire('filemanager.filemanager', ['uuid' => 'filemanager-settings', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])

</div>
