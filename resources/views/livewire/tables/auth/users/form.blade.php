<div class='flex flex-wrap items-center justify-center'>
    <div class='self-start w-full lg:w-1/3'>
        @include('livewire.partials.avatar' , [ 'canmodify' => ($mode=='edit' || $mode=='create')?true:false ])
    </div>
    <div class='w-full lg:w-2/3'>

        <x-lopsoft.control.inputform
            wire:model.lazy='name'
            id='name'
            x-ref='name'
            label="{{ transup('name') }}"
            classcontainer='w-full'
            nextref='username'
            autofocus
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='username'
            id='username'
            x-ref='username'
            label="{{ transup('username') }}"
            classcontainer='w-full md:w-1/2'
            nextref='email'
            requiredfield
            help="{{ transup('mandatory_unique') }}"
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='email'
            id='email'
            x-ref='email'
            label="{{ transup('email') }}"
            classcontainer='w-full'
            nextref='password'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='password'
            type='password'
            id='password'
            x-ref='password'
            label="{{ transup('password') }}"
            classcontainer='w-full md:w-1/2'
            nextref='password_confirmation'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='password_confirmation'
            type='password'
            id='password_confirmation'
            x-ref='password_confirmation'
            label="{{ transup('password_confirmation') }}"
            classcontainer='w-full md:w-1/2'
            @keydown.enter='$refs.btnCreate.click()'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />

        @livewire('controls.drop-down-multi-table-component', [
                    'model'         => \App\Models\Auth\Role::class,
                    'mode'          =>  $mode,
                    'filterraw'     => 'level>='.Auth::user()->level,
                    'sortorder'     => '-level',
                    'label'         => transup('roles'),
                    'key'           => 'id',
                    'field'         => 'role',
                    'defaultvalue'  =>  $record!=null?$record->rolesArray():null,
                    'eventname'     => 'eventsetrole',
                    'linknew'       => route('roles.create'),
                    'uid'           => 'rolecomponent',
                    'modelid'       => 'roles',
                    'isTop'         =>  true,
                    'template'      => 'components.lopsoft.dropdown.roles',
                    'requiredfield' =>  true,
                    'help'          =>  'OBLIGATORIO'
        ])

        @livewire('messages.flash-message', ['msgid' => 'usersaved'] )

    </div>
    <div class='w-full mt-4 border-t-2 border-gray-200'>
        <div class='flex flex-wrap items-start justify-center w-fullmt-4'>
            <div class='w-full py-4 pr-4 mb-4 lg:w-1/3 md:mb-0'>
                <div class='font-bold text-md'>
                    <span>PERSONALIZACIÓN REGIONAL</span>
                </div>
                <div class='text-sm text-gray-400'>
                    <span>Seleccione sus preferencias acorde con el lugar donde se encuentre</span>
                </div>
            </div>
            <div class='w-full mb-4 lg:w-2/3'>

                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\Aux\Country::class,
                    'mode'          =>  $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'country',
                    'label'         => transup('country'),
                    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                    'key'           => 'id',
                    'field'         => 'country',
                    'defaultvalue'  =>  $record->country_id??( (\App\Models\Aux\Country::where('country',config('lopsoft.country_default'))->first())->id??null),
                    'eventname'     => 'eventsetcountry',
                    'uid'           => 'countrycomponent',
                    'modelid'       => 'countries',
                    'isTop'         =>  true,
                    'template' => 'components.lopsoft.dropdown.countries',
                ])

                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\Aux\Language::class,
                    'mode'          =>  $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'language',
                    'label'         =>  transup('language'),
                    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                    'key'           => 'id',
                    'field'         => 'language',
                    'defaultvalue'  =>  $record->language_id??( (\App\Models\Aux\Language::where('code',config('lopsoft.language_default'))->first())->id??null),
                    'eventname'     => 'eventsetlanguage',
                    'uid'           => 'languagecomponent',
                    'modelid'       => 'language_id',
                    'isTop'         =>  true,
                    'template' => 'components.lopsoft.dropdown.languages',
                ])

                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\Aux\Timezone::class,
                    'mode'          =>  $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'name',
                    'label'         => transup('timezone'),
                    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                    'key'           => 'id',
                    'field'         => 'name',
                    'defaultvalue'  =>  $record->timezone_id??( (\App\Models\Aux\Timezone::where('name',config('lopsoft.timezone_default'))->first())->id??null),
                    'eventname'     => 'eventsettimezone',
                    'uid'           => 'timezonecomponent',
                    'modelid'       => 'timezone',
                    'isTop'         =>  true,
                    'template'      => 'components.lopsoft.dropdown.timezones',
                ])

                @livewire('controls.drop-down-component', [
                    'mode'          => $mode,
                    'label'         => transup('date_format'),
                    'classdropdown' => 'w-60',
                    'options'       => \App\Lopsoft\LopHelp::getDateFormatsDropDown(),
                    'defaultvalue'  => $record->dateformat??config('lopsoft.date_format'),
                    'eventname'     => 'eventsetdateformat',
                    'uid'           => 'dateformatcomponent',
                    'modelid'       => 'dateformat',
                    'isTop'         =>  true,
                ])

            </div>
        </div>
    </div>
</div>
