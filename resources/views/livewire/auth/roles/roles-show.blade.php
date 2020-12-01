<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto max-w-3xl w-full'>

            @include('livewire.partials.topcard')

            @include('livewire.partials.bottomcard')

                <x-lopsoft.control.inputform
                    wire:model.lazy='role'
                    id='role'
                    x-ref='role'
                    label="{{ mb_strtoupper(__('lopsoft.role')) }}"
                    classcontainer='w-1/2'
                    nextref='level'
                    requiredfield
                    help='OBLIGATORIO Y ÚNICO'
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
                    help='OBLIGATORIO'
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
                        'defaultvalue'  => $record->color_id,
                        'eventname'     => 'eventsetcolor',
                        'linknew'       => route('colors.create'),
                        'uid'           => 'colorcomponent',
                        'modelid'       => 'color_id',
                        'template'      => 'components.lopsoft.dropdown.colors',
                        'cansearch'     => false,
                        'readonly'      => true,
                    ])
                </div>
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
