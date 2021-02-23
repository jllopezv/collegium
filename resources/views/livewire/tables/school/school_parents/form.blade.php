    <x-lopsoft.control.inputform
        wire:model.lazy='parent'
        id='parent'
        x-ref='parent'
        label="{{ transup('parent') }}"
        sublabel='Nombre completo del pariente'
        class='w-full'
        autofocus
        classcontainer='w-full'
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{ $mode }}"
        nextref='relationship'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='relationship'
        id='relationship'
        x-ref='relationship'
        label="{{ transup('relationship') }}"
        sublabel='Ej.: PADRE / MADRE / TIO'
        autofocus
        classcontainer='w-80'
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{ $mode }}"
        nextref='address1'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='address1'
        id='address1'
        x-ref='address1'
        label="{{ transup('address') }}"
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='address2'
    />
    <x-lopsoft.control.inputform
        wire:model.lazy='address2'
        id='address2'
        x-ref='address2'
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='pbox'
    />

    <div class='flex flex-wrap items-center justify-start w-full md:flex-no-wrap'>
        <div class='pr-2'>
            <x-lopsoft.control.inputform
                wire:model.lazy='pbox'
                id='pbox'
                x-ref='pbox'
                label="{{ transup('pbox') }}"
                autofocus
                classcontainer='w-32'
                mode="{{ $mode }}"
                nextref='city'
            />
        </div>
        <div class='w-full'>
            <x-lopsoft.control.inputform
                wire:model.lazy='city'
                id='city'
                x-ref='city'
                label="{{ transup('city') }}"
                autofocus
                classcontainer='w-full'
                mode="{{ $mode }}"
                nextref='state'
            />
        </div>
    </div>
    <x-lopsoft.control.inputform
        wire:model.lazy='state'
        id='state'
        x-ref='state'
        label="{{ transup('state') }}"
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='username'
    />

    @livewire('controls.drop-down-table-component', [
        'model'         => \App\Models\Aux\Country::class,
        'mode'          =>  $mode,
        'filterraw'     => '',
        'sortorder'     => 'country',
        'label'         => transup('country'),
        'classdropdown' => 'w-full md:w-3/4 lg:w-2/4 xl:w-1/3',
        'key'           => 'id',
        'field'         => 'country',
        'defaultvalue'  =>  $record->country_id??( (\App\Models\Aux\Country::where('country',config('lopsoft.country_default'))->first())->id??null),
        'eventname'     => 'eventsetcountry',
        'uid'           => 'countrycomponent',
        'modelid'       => 'countries',
        'isTop'         =>  true,
        'template' => 'components.lopsoft.dropdown.countries',
    ])

    @livewire('controls.phones-table-component',[
        'mode'  =>  $mode,
        'uid'   =>  'parentsphones',
        'phones'=>  $record==null?null:getPhones($record->phones),
    ])

    @livewire('controls.emails-table-component',[
        'mode'  =>  $mode,
        'uid'   =>  'parentsemails',
        'emails'=>  $record==null?null:getEmails($record->emails),
    ])

    <x-lopsoft.control.tabs minheight='600px'>
        <x-slot name='tabs'>
            <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
            <x-lopsoft.control.tabs-index title='ESTUDIANTES' index='2'></x-lopsoft.control.tabs-index>
        </x-slot>
        <x-slot name='tabscontent'>
            <x-lopsoft.control.tabs-content index='1'>
                {{-- USER --}}
                <div class=''>
                    <div class='flex items-baseline justify-start'>
                        <div class='w-full md:w-3/4 lg:w-3/4 xl:w-1/2'>
                            @livewire('controls.drop-down-component', [
                                'mode'          => $mode,
                                'label'         => transup('user_email'),
                                'sublabel'      => 'Email para crear el usuario. Debe ser único.',
                                'classdropdown' => '',
                                'options'       => $emailsdropdown,
                                'defaultvalue'  => $record->user->email??null,
                                'eventname'     => 'eventsetuseremail',
                                'uid'           => 'emailsdropdowncomponent',
                                'modelid'       => 'useremail',
                                'requiredfield' => true,
                                'help'          => transup('mandatory_unique'),
                            ])
                        </div>
                    </div>
                    @if($checkedEmail && $mode!='show')
                        <div class='ml-2 text-xs'>
                            @if($validEmail)
                                <div class='font-bold text-green-500'>EL EMAIL NO EXISTE. PUEDE UTILIZARSE PARA CREAR UN USUARIO.</div>
                            @else
                                <div class='font-bold text-red-500'>EL EMAIL YA EXISTE. NO PUEDE USARSE PARA CREAR UN USUARIO.</div>
                            @endif
                        </div>
                    @endif
                </div>

                <x-lopsoft.control.inputform
                    wire:model.lazy='username'
                    id='username'
                    x-ref='username'
                    label="{{ transup('username') }}"
                    sublabel="Nombre de usuario para que el pariente acceda a la plataforma. Se generará automáticamente al cambiar el nombre del pariente."
                    classcontainer='w-60'
                    requiredfield
                    help="{{ transup('mandatory') }}"
                    mode="{{ $mode }}"
                />
                @if($checkedUsername)
                    <div class='ml-2 text-xs'>
                        @if($validUsername)
                            <div class='font-bold text-green-500'>EL USUARIO NO EXISTE. PUEDE UTILIZARSE PARA CREAR UN USUARIO.</div>
                        @else
                            <div class='font-bold text-red-500'>EL USUARIO YA EXISTE. NO PUEDE USARSE PARA CREAR UN USUARIO.</div>
                        @endif
                    </div>
                @endif

            </x-lopsoft.control.tabs-content>
            <x-lopsoft.control.tabs-content index='2'>
                ESTUDIANTES INFO
            </x-lopsoft.control.tabs-content>
        </x-slot>
    </x-lopsoft.control.tabs>
