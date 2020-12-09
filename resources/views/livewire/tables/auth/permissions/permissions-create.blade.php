<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto max-w-3xl w-full'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')

                    <x-lopsoft.control.inputform
                        wire:model.lazy='slug'
                        id='slug'
                        x-ref='slug'
                        label="{{ mb_strtoupper(__('lopsoft.slug')) }}"
                        classcontainer='w-1/2'
                        nextref='name'
                        requiredfield
                        help="{{ transup('mandatory_unique') }}"
                        autofocus
                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='name'
                        id='name'
                        x-ref='name'
                        label="{{ mb_strtoupper(__('lopsoft.name')) }}"
                        classcontainer='w-full'
                        nextref='description'
                        requiredfield
                        help="{{ transup('mandatory') }}"

                    />
                    <x-lopsoft.control.inputform
                        wire:model.lazy='description'
                        id='description'
                        x-ref='description'
                        label="{{ mb_strtoupper(__('lopsoft.description')) }}"
                        classcontainer='w-full'
                        nextref='btnCreate'
                    />
                    @livewire('controls.drop-down-table-component', [
                        'model'         => \App\Models\Auth\PermissionGroup::class,
                        'mode'          =>  $mode,
                        'filterraw'     => '',
                        'label'         => mb_strtoupper(trans('lopsoft.group')),
                        'key'           => 'id',
                        'field'         => 'group',
                        'defaultvalue'  => null,
                        'eventname'     => 'eventsetgroup',
                        'linknew'       => route('permission_groups.create'),
                        'uid'           => 'groupcomponent',
                        'modelid'       => 'group',
                        // 'template' => 'components.lopsoft.dropdown.example',
                         ])
                    @livewire('messages.flash-message', ['msgid' => 'usersaved'] )
                    <div class='text-right mt-8'>
                        @include('livewire.partials.createbuttons', ['nextref' => '$refs.name.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
