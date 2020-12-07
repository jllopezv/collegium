<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-3xl mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')


                    <x-lopsoft.control.inputform
                        wire:model.lazy='language'
                        id='language'
                        x-ref='language'
                        label="{{ mb_strtoupper(__('lopsoft.language')) }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                        nextref='code'
                    />

                    <x-lopsoft.control.inputform
                        wire:model.lazy='code'
                        id='code'
                        x-ref='code'
                        label="{{ mb_strtoupper(__('lopsoft.code')) }}"
                        nextref='btnCreate'
                        classcontainer='w-60'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                    />

                    @livewire('messages.flash-message', ['msgid' => 'languagesaved'] )
                    <div class='mt-4 text-right'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.language.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
