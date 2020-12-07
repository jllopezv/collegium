<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto w-full'>

                @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='group'
                        id='group'
                        x-ref='group'
                        nextref='priority'
                        label="{{ mb_strtoupper(__('lopsoft.group')) }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='priority'
                        id='priority'
                        x-ref='priority'
                        label="{{ mb_strtoupper(__('lopsoft.order')) }}"
                        sublabel='Orden en el que aparecerán en la ficha de ROL. Debe ser un número. Siendo el 1 el de mayor prioridad.'
                        class='w-full'
                        @keydown.enter='$refs.btnUpdate.click()'
                        classcontainer='w-32'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                    />
                    @livewire('messages.flash-message', ['msgid' => 'groupsaved'] )

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
