<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto max-w-3xl w-full'>

            @include('livewire.partials.topcard')

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
                        help="{{ transup('mandatory_unique') }}"
                        nextref='textcolor'
                        disabled
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='textcolor'
                        id='textcolor'
                        x-ref='textcolor'
                        label="{{ mb_strtoupper(__('lopsoft.textcolor')) }}"
                        sublabel='Color en forma de clase de Tailwind (ej. text-blue-300)'
                        autofocus
                        classcontainer='w-1/3'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        disabled
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='background'
                        id='background'
                        x-ref='textcolor'
                        label="{{ mb_strtoupper(__('lopsoft.backgroundcolor')) }}"
                        sublabel='Color en forma de clase de Tailwind (ej. bg-blue-600)'
                        autofocus
                        classcontainer='w-1/3'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        disabled
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

                    @livewire('messages.flash-message', ['msgid' => 'colorssaved'] )

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
