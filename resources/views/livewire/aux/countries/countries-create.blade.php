<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-3xl mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='country'
                        id='country'
                        x-ref='country'
                        label="{{ mb_strtoupper(__('lopsoft.country')) }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help='OBLIGATORIO Y ÚNICO'
                        nextref='code'
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='code'
                        id='code'
                        x-ref='code'
                        label="{{ mb_strtoupper(__('lopsoft.code')) }}"
                        nextref='btnCreate'
                        classcontainer='w-1/3'
                        requiredfield
                        help='OBLIGATORIO'
                    />

                    <div class='py-4'>
                        <x-lopsoft.control.label
                            class="font-bold"
                            text="{{ mb_strtoupper(__('lopsoft.flag')) }}"
                        />
                        <div class=''>
                            {!! $flag !!}
                        </div>
                    </div>

                    @livewire('messages.flash-message', ['msgid' => 'colorsaved'] )
                    <div class='mt-4 text-right'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.country.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
