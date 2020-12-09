<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                <div class='flex flex-wrap items-center justify-center'>
                    <div class='self-start w-full lg:w-1/4'>
                        @include('livewire.partials.studentsavatar' , [ 'canmodify' => true  ])
                    </div>
                    <div class='w-full lg:w-2/3'>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='exp'
                            id='exp'
                            x-ref='exp'
                            label="{{ transup('exp') }}"
                            sublabel='Use un guión (-) para generar un expediente automáticamente.'
                            class='w-32'
                            autofocus
                            classcontainer='w-full sm:w-32'
                            requiredfield
                            help="{{ transup('mandatory_unique') }}"
                            nextref='names'
                        />
                        <x-lopsoft.control.inputform
                            wire:model.lazy='names'
                            id='names'
                            x-ref='names'
                            label="{{ transup('names') }}"
                            nextref='names'
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory') }}"
                        />
                        <x-lopsoft.control.inputform
                            wire:model.lazy='first_surname'
                            id='first_surname'
                            x-ref='first_surname'
                            label="{{ transup('first_surname') }}"
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory') }}"
                            nextref='second_surname'
                        />
                        <x-lopsoft.control.inputform
                            wire:model.lazy='second_surname'
                            id='second_surname'
                            x-ref='second_surname'
                            label="{{ transup('second_surname') }}"
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory') }}"
                            nextref='btnCreate'
                        />
                        <div class='flex flex-wrap items-center justify-start'>
                            <div class='mr-4'>
                                @livewire('controls.drop-down-component', [
                                            'mode'          => $mode,
                                            'label'         => transup('gender'),
                                            'classdropdown' => 'w-40',
                                            'options'       => \App\Lopsoft\LopHelp::getSexDropDown(),
                                            'defaultvalue'  => 'M',
                                            'eventname'     => 'eventsetgender',
                                            'uid'           => 'gendercomponent',
                                            'modelid'       => 'gender',
                                            'template'      => 'components.lopsoft.dropdown.sex',
                                            'isTop'         =>  true,
                                        ])
                            </div>
                            <div class='flex items-end justify-start'>
                                <div class='mr-4'>
                                @livewire('controls.datepicker',[
                                    'id'                =>  'birth',
                                    'modelid'           =>  'birth',
                                    'label'             =>  transup('birth'),
                                    'defaultvalue'      =>  getDateString(getDateFromDate(2000,1,1)),
                                    'uid'               =>  'birthcomponent',
                                    'eventname'         =>  'eventsetbirth',
                                ])
                                </div>
                                <div class=''>
                                    <x-lopsoft.control.textform
                                    id='age'
                                    x-ref='age'
                                    label="{{ transup('age') }}"
                                    classcontainer='w-32'>
                                        {{ $age }}
                                    </x-lopsoft.control.textform>
                                </div>
                            </div>
                        </div>

                        @livewire('messages.flash-message', ['msgid' => 'studentsaved'] )

                    </div>
                </div>

                    <div class='flex items-center justify-between mt-4' >
                        <div class=''>
                            @include('livewire.partials.navigation-buttons')
                        </div>
                        <div class=''>
                            @include('livewire.partials.editbuttons')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
