<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto w-full'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='group'
                        id='group'
                        x-ref='group'
                        label="{{ mb_strtoupper(__('lopsoft.group')) }}"
                        class='w-full'
                        nextref='priority'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help='OBLIGATORIO'
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='priority'
                        id='priority'
                        x-ref='priority'
                        label="{{ mb_strtoupper(__('lopsoft.order')) }}"
                        sublabel='Orden en el que aparecerán en la ficha de ROL. Debe ser un número. Siendo el 1 el de mayor prioridad.'
                        class='w-full'
                        @keydown.enter='$refs.btnCreate.click()'
                        classcontainer='w-32'
                        requiredfield
                        help='OBLIGATORIO'
                    />
                    @livewire('messages.flash-message', ['msgid' => 'groupsaved'] )
                    <div class='text-right mt-4'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.group.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
