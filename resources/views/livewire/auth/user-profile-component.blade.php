<div x-data='{}' class='relative '>
    @if($mode=='edit')
        <div class='absolute top-0 right-0 mt-2'>
            <a href="{{ route('users.edit', ['id' => \App\Models\User::where('username',$profileusername)->first()->id]) }}" target="_blank">
                <i class='fa fa-pencil text-cool-gray-400 hover:text-cool-gray-500 cursor-pointer'></i>
            </a>
        </div>
    @endif
    <div class='flex-block md:flex items-start justify-start '>
        <div class='p-4 flex items-center justify-center'>
            @if($mode=='create')
                <div class='w-40'>
                    <img class='rounded-full w-40 h-40' src="{{ (new \App\Models\User)->avatar }}" />
                </div>
            @endif
            @if($mode!='create')
                <div class='w-40'>
                    <a href="{{ \App\Models\User::where('username',$profileusername)->first()->avatar }}" target='_blank'>
                        <img class='rounded-full w-40 h-40' src="{{ \App\Models\User::where('username',$profileusername)->first()->avatar }}" />
                    </a>
                </div>
            @endif
        </div>
        <div class='w-full'>
            <div class='flex flex-wrap md:flex-no-wrap items-bottom justify-between'>
                <div class='w-full xl:w-2/3'>
                    <x-lopsoft.control.inputform
                        wire:model.lazy='profileusername'
                        id='profileusername'
                        x-ref='profileusername'
                        label="{{ transup('username') }}"
                        sublabel="Nombre de usuario para acceso a la plataforma."
                        classcontainer='w-full'
                        classcomponent='w-full'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                        mode="{{ $mode }}"
                    />
                </div>
                <div x-show='$wire.canGenerateUsername' class='self-end w-full md:w-auto  justify-end flex pb-4'>
                    @if($mode!='show')
                        <div class='ml-2 tooltip'>
                            <x-lopsoft.button.gray wire:click='generateProfileUsername' text='GENERAR' icon='fa fa-cogs'></x-lopsoft.button.gray>
                            <span class='md:hidden tooltiptext tooltiptext-center-left'>GENERAR USUARIO</span>
                        </div>
                    @endif
                </div>
            </div>
            <div x-show='$wire.checkedUsername' class='text-xs'>
                @if($validUsername)
                    <div class='font-bold text-green-500'>EL USUARIO NO EXISTE. PUEDE UTILIZARSE.</div>
                @else
                    <div class='font-bold text-red-500'>EL USUARIO YA EXISTE. NO PUEDE USARSE.</div>
                @endif
            </div>


            <div class='w-full mt-4'>
                <div class='flex flex-wrap md:flex-no-wrap items-bottom justify-between'>
                    <div class='w-full h-full'>
                        @livewire('controls.drop-down-component', [
                            'mode'          => $mode,
                            'label'         => transup('user_email'),
                            'sublabel'      => 'Email de recuperación de usuario. Debe ser único.',
                            'classdropdown' => 'w-full xl:w-2/3',
                            'options'       => $emailsdropdown,
                            'defaultvalue'  => $record->user->email??'',
                            'eventname'     => 'eventsetuserprofileemail',
                            'uid'           => 'userprofileemailsdropdowncomponent',
                            'modelid'       => 'profileuseremail',
                            'requiredfield' => true,
                            'help'          => transup('mandatory_unique'),
                        ])
                    </div>
                    <div x-show='$wire.canGenerateEmail' class='self-end w-full md:w-auto justify-end flex pb-4'>
                        @if($mode!='show')
                            <div class='ml-2 tooltip'>
                                <x-lopsoft.button.gray wire:click='generateProfileEmail' text='GENERAR' icon='fa fa-cogs'></x-lopsoft.button.gray>
                                <span class='md:hidden tooltiptext tooltiptext-center-left'>GENERAR EMAIL</span>
                            </div>
                        @endif
                    </div>
                </div>
                @if($checkedEmail && $mode!='show')
                    <div class='text-xs'>
                        @if($validEmail)
                            <div class='font-bold text-green-500'>EL EMAIL NO EXISTE. PUEDE UTILIZARSE.</div>
                        @else
                            <div class='font-bold text-red-500'>EL EMAIL YA EXISTE. NO PUEDE USARSE.</div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
