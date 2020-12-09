<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                <x-lopsoft.control.inputform
                        wire:model.lazy='showorder'
                        id='showorder'
                        x-ref='showorder'
                        label="{{ transup('showorder') }}"
                        sublabel='Orden en el que se mostrará cuando vaya a elegir el nivel en otro formulario'
                        nextref='level'
                        classcontainer='w-24'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='level'
                        id='level'
                        x-ref='level'
                        label="{{ transup('schoollevel') }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                        nextref='btnCreate'
                    />

                    @livewire('messages.flash-message', ['msgid' => 'schoollevelsaved'] )

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
