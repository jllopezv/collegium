<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-3xl mx-auto'>

            @include('livewire.partials.topcard')

            @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='group'
                        id='group'
                        x-ref='group'
                        label="{{ mb_strtoupper(__('lopsoft.group')) }}"
                        class='w-full'
                        nextref='priority'
                        autofocus
                        disabled='disabled'
                        classcontainer='w-full'
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
                    />
                    @livewire('messages.flash-message', ['msgid' => 'groupsaved'] )

                    <div class='flex items-center justify-between mt-4' >
                        <div class=''>
                            @include('livewire.partials.navigation-buttons')
                        </div>
                        <div class=''>
                            @include('livewire.partials.showbuttons')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
