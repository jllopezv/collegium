<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full max-w-3xl mx-auto'>

                @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                <div class='items-center justify-start w-full sm:flex'>
                    <div class='w-full sm:pr-4 sm:w-3/4'>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='country'
                            id='country'
                            x-ref='country'
                            label="{{ mb_strtoupper(__('lopsoft.country')) }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory_unique') }}"
                            nextref='nicename'
                        />
                    </div>
                    <div class='w-full sm:w-1/4'>
                        <div class='w-full py-4 ml-auto mr-0 sm:pr-4'>
                            <div class='w-full'>
                                <x-lopsoft.control.label
                                    class="font-bold"
                                    text="{{ mb_strtoupper(__('lopsoft.flag')) }}"
                                />
                            </div>
                            <div class='w-full'>
                                {!! $flag??'' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <x-lopsoft.control.inputform
                            wire:model.lazy='nicename'
                            id='nicename'
                            x-ref='nicename'
                            label="{{ mb_strtoupper(__('lopsoft.nicename')) }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full'
                            nextref='iso'
                        />
                <div class='items-center justify-start w-full sm:flex'>
                    <div class='w-full sm:pr-4 sm:w-1/2'>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='iso'
                            id='iso'
                            x-ref='iso'
                            label="{{ mb_strtoupper(__('lopsoft.code')) }}"
                            nextref='iso3'
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory') }}"
                        />
                    </div>
                    <div class='w-full ml-auto mr-0 sm:w-1/2 '>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='iso3'
                            id='iso3'
                            x-ref='iso3'
                            label="{{ mb_strtoupper(__('lopsoft.alpha3')) }}"
                            nextref='numcode'
                            classcontainer='w-full'
                            requiredfield
                            help="{{ transup('mandatory') }}"
                        />
                    </div>
                </div>
                <div class='items-center justify-start w-full sm:flex'>
                    <div class='w-full sm:pr-4 sm:w-1/2'>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='numcode'
                            id='numcode'
                            x-ref='numcode'
                            label="{{ mb_strtoupper(__('lopsoft.numcode')) }}"
                            nextref='phonecode'
                            classcontainer='w-full'
                        />
                        </div>
                        <div class='w-full ml-auto mr-0 sm:w-1/2 '>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='phonecode'
                            id='phonecode'
                            x-ref='phonecode'
                            label="{{ mb_strtoupper(__('lopsoft.phonecode')) }}"
                            nextref='language'
                            classcontainer='w-full'
                        />
                    </div>
                </div>
                <x-lopsoft.control.inputform
                    wire:model.lazy='language'
                    id='language'
                    x-ref='language'
                    label="{{ mb_strtoupper(__('lopsoft.language')) }}"
                    nextref='btnCreate'
                    classcontainer='w-full sm:w-1/3'
                    requiredfield
                    help="{{ transup('mandatory') }}"
                />

                    @livewire('messages.flash-message', ['msgid' => 'countrysaved'] )

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
