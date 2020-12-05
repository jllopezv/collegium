<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-3xl mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                <x-lopsoft.control.inputform
                        wire:model.lazy='language'
                        id='language'
                        x-ref='language'
                        label="{{ mb_strtoupper(__('lopsoft.language')) }}"
                        class='w-full'
                        autofocus
                        classcontainer='w-full'
                        nextref='code'
                        readonly
                    />

                    <x-lopsoft.control.inputform
                        wire:model.lazy='code'
                        id='code'
                        x-ref='code'
                        label="{{ mb_strtoupper(__('lopsoft.code')) }}"
                        nextref='btnCreate'
                        classcontainer='w-60'
                        readonly

                    />

                    @livewire('messages.flash-message', ['msgid' => 'languagesaved'] )

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
