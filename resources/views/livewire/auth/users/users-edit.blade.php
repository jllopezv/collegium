<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-5xl p-2 mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                    <div class='flex flex-wrap items-center justify-center'>
                        <div class='self-start w-full lg:w-1/3'>
                            @include('livewire.partials.avatar' , [ 'canmodify' => true ])
                        </div>
                        <div class='w-full lg:w-2/3'>

                            <x-lopsoft.control.inputform
                                wire:model.lazy='name'
                                id='name'
                                x-ref='name'
                                label="{{ mb_strtoupper(__('lopsoft.name')) }}"
                                classcontainer='w-full'
                                nextref='username'
                                autofocus
                                requiredfield
                                help="OBLIGATORIO"
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='username'
                                id='username'
                                x-ref='username'
                                label="{{ mb_strtoupper(__('lopsoft.username')) }}"
                                classcontainer='w-full md:w-1/2'
                                nextref='email'
                                requiredfield
                                help="OBLIGATORIO Y ÚNICO"
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='email'
                                id='email'
                                x-ref='email'
                                label="{{ mb_strtoupper(__('lopsoft.email')) }}"
                                classcontainer='w-full'
                                nextref='password'
                                requiredfield
                                help="OBLIGATORIO"
                            />

                            <div class='mt-16 mb-4 text-gray-500'>
                                Si desea cambiar la contraseña puede completar los siguientes campos.
                                En caso contrario déjelos en blanco para que la contraseña no cambie.
                            </div>
                            <x-lopsoft.control.inputform
                                wire:model.lazy='password'
                                type='password'
                                id='password'
                                x-ref='password'
                                label="{{ mb_strtoupper(__('lopsoft.password')) }}"
                                classcontainer='w-full md:w-1/2'
                                nextref='password_confirmation'
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='password_confirmation'
                                type='password'
                                id='password_confirmation'
                                x-ref='password_confirmation'
                                label="{{ mb_strtoupper(__('lopsoft.password_confirmation')) }}"
                                classcontainer='w-full md:w-1/2'
                                @keydown.enter='$refs.btnCreate.click()'
                            />
                            @livewire('controls.drop-down-multi-table-component', [
                                'model'         => \App\Models\Auth\Role::class,
                                'mode'          =>  $mode,
                                'filterraw'     => 'level>='.Auth::user()->level,
                                'sortorder'     => '-level',
                                'label'         => mb_strtoupper(trans('lopsoft.roles')),
                                'key'           => 'id',
                                'field'         => 'role',
                                'defaultvalue'  => $record->rolesArray(),
                                'eventname'     => 'eventsetrole',
                                'linknew'       => route('roles.create'),
                                'uid'           => 'rolecomponent',
                                'modelid'       => 'roles',
                                'isTop'         =>  true,
                                'template' => 'components.lopsoft.dropdown.roles',
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
                                            'label'         => mb_strtoupper(trans('lopsoft.country')),
                                            'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                                            'key'           => 'id',
                                            'field'         => 'country',
                                            'defaultvalue'  =>  $record->country_id,
                                            'eventname'     => 'eventsetcountry',
                                            'uid'           => 'countrycomponent',
                                            'modelid'       => 'country_id',
                                            'isTop'         =>  true,
                                            'template' => 'components.lopsoft.dropdown.countries',

                                        ])

                                        @livewire('controls.drop-down-table-component', [
                                            'model'         => \App\Models\Aux\Language::class,
                                            'mode'          =>  $mode,
                                            'filterraw'     => '',
                                            'sortorder'     => 'language',
                                            'label'         =>  mb_strtoupper(trans('lopsoft.language')),
                                            'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                                            'key'           => 'id',
                                            'field'         => 'language',
                                            'defaultvalue'  =>  $record->language_id,
                                            'eventname'     => 'eventsetlanguage',
                                            'uid'           => 'languagecomponent',
                                            'modelid'       => 'language_id',
                                            'isTop'         =>  true,
                                            'template'      => 'components.lopsoft.dropdown.languages',
                                        ])

                                        @livewire('controls.drop-down-table-component', [
                                            'model'         => \App\Models\Aux\Timezone::class,
                                            'mode'          =>  $mode,
                                            'filterraw'     => '',
                                            'sortorder'     => 'name',
                                            'label'         => mb_strtoupper(trans('lopsoft.timezone')),
                                            'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
                                            'key'           => 'id',
                                            'field'         => 'name',
                                            'defaultvalue'  =>  $record->timezone_id,
                                            'eventname'     => 'eventsettimezone',
                                            'uid'           => 'timezonecomponent',
                                            'modelid'       => 'timezone_id',
                                            'isTop'         =>  true,
                                            'template'      => 'components.lopsoft.dropdown.timezones',

                                        ])

                                        @livewire('controls.drop-down-component', [
                                            'mode'          => $mode,
                                            'label'         => mb_strtoupper(trans('lopsoft.date_format')),
                                            'classdropdown' => 'w-60',
                                            'options'       => \App\Lopsoft\LopHelp::getDateFormatsDropDown(),
                                            'defaultvalue'  =>  $record->dateformat,
                                            'eventname'     => 'eventsetdateformat',
                                            'uid'           => 'dateformatcomponent',
                                            'modelid'       => 'dateformat',
                                            'isTop'         =>  true,

                                        ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='mt-8 text-right'>
                                @include('livewire.partials.editbuttons', [ 'saveandexit' => true ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
