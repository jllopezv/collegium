<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto w-full'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                   <x-lopsoft.control.inputform
                        wire:model.lazy='role'
                        id='role'
                        x-ref='role'
                        label="{{ mb_strtoupper(__('lopsoft.role')) }}"
                        classcontainer='w-1/2'
                        nextref='level'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                        autofocus
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='level'
                        id='level'
                        x-ref='level'
                        label="{{ mb_strtoupper(__('lopsoft.level')) }}"
                        classcontainer='w-20'
                        nextref='description'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='dashboard'
                        id='dashboard'
                        x-ref='dashboard'
                        label="{{ mb_strtoupper(__('lopsoft.dashboard')) }}"
                        classcontainer='w-1/2'
                        nextref='color'
                    />
                    <div class='w-3/4 sm:w-1/3'>
                        @livewire('controls.drop-down-table-component', [
                            'model'         => \App\Models\Aux\Color::class,
                            'mode'          =>  $mode,
                            'filterraw'     => '',
                            'label'         => mb_strtoupper(trans('lopsoft.color')),
                            'key'           => 'id',
                            'field'         => 'name',
                            'defaultvalue'  => null,
                            'eventname'     => 'eventsetcolor',
                            'linknew'       => route('colors.create'),
                            'uid'           => 'colorcomponent',
                            'modelid'       => 'color_id',
                            'template'      => 'components.lopsoft.dropdown.colors',
                            'cansearch'     => false,
                        ])
                    </div>

                    @livewire('messages.flash-message', ['msgid' => 'rolesaved'] )

                    <div class='text-right mt-8'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.role.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
