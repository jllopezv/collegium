<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto max-w-3xl w-full'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='name'
                        id='name'
                        x-ref='name'
                        label="{{ mb_strtoupper(__('lopsoft.name')) }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help='OBLIGATORIO Y ÚNICO'
                        nextref='textcolor'
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='textcolor'
                        id='textcolor'
                        x-ref='textcolor'
                        label="{{ mb_strtoupper(__('lopsoft.textcolor')) }}"
                        sublabel='Vea la documentación sobre los valores aceptados (ej. green-500)'
                        nextref='background'
                        classcontainer='w-1/3'
                        requiredfield
                        help='OBLIGATORIO'
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='background'
                        id='background'
                        x-ref='background'
                        label="{{ mb_strtoupper(__('lopsoft.backgroundcolor')) }}"
                        sublabel='Vea la documentación sobre los valores aceptados (ej. blue-200)'
                        classcontainer='w-1/3'
                        requiredfield
                        help='OBLIGATORIO'
                        nextref='btnCreate'
                    />

                    <div class='py-4'>
                        <x-lopsoft.control.label
                            class="font-bold"
                            text="{{ mb_strtoupper(__('lopsoft.preview')) }}"
                        />
                        <div class=''>
                            {!! $muestra !!}
                        </div>
                    </div>

                    @livewire('messages.flash-message', ['msgid' => 'colorsaved'] )
                    <div class='text-right mt-4'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.name.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
