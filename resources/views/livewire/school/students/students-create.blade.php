<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                    <div class='flex flex-wrap items-center justify-center'>
                        <div class='self-start w-full lg:w-1/4'>
                            @include('livewire.partials.studentsavatar' , [ 'canmodify' => true, 'username' => '', 'email' => '' ])
                        </div>
                        <div class='w-full lg:w-2/3'>
                            <x-lopsoft.control.inputform
                                wire:model.lazy='exp'
                                id='exp'
                                x-ref='exp'
                                label="{{ mb_strtoupper(__('lopsoft.exp')) }}"
                                sublabel='Use un guión (-) para generar un expediente automáticamente.'
                                class='w-32'
                                autofocus
                                classcontainer='w-full sm:w-32'
                                requiredfield
                                help='OBLIGATORIO Y ÚNICO'
                                nextref='names'
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='names'
                                id='names'
                                x-ref='names'
                                label="{{ mb_strtoupper(__('lopsoft.names')) }}"
                                nextref='names'
                                classcontainer='w-full'
                                requiredfield
                                help='OBLIGATORIO'
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='first_surname'
                                id='first_surname'
                                x-ref='first_surname'
                                label="{{ mb_strtoupper(__('lopsoft.first_surname')) }}"
                                classcontainer='w-full'
                                requiredfield
                                help='OBLIGATORIO'
                                nextref='second_surname'
                            />
                            <x-lopsoft.control.inputform
                                wire:model.lazy='second_surname'
                                id='second_surname'
                                x-ref='second_surname'
                                label="{{ mb_strtoupper(__('lopsoft.second_surname')) }}"
                                classcontainer='w-full'
                                requiredfield
                                help='OBLIGATORIO'
                                nextref='btnCreate'
                            />

                            {{ $birth }}

                            @livewire('controls.datepicker',[
                                'id'                =>  'birth',
                                'modelid'           =>  'birth',
                                'requiredfield'     =>  true,
                                'help'              =>  'OBLIGATORIO',
                                'uuid'              =>  'birth',
                                'eventname'         =>  'setBirth',
                            ])


                            @livewire('messages.flash-message', ['msgid' => 'studentsaved'] )

                        </div>
                    </div>


                    <div class='mt-4 text-right'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.name.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
