<div x-data='{}' class='w-full relative'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='mx-auto max-w-3xl w-full'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.bottomcard')

                <x-lopsoft.control.inputform
                wire:model.lazy='slug'
                id='slug'
                x-ref='slug'
                label="{{ mb_strtoupper(__('lopsoft.slug')) }}"
                classcontainer='w-1/2'
                nextref='description'
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
                    nextref='slug'
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
                    'defaultvalue'  => $group,
                    'eventname'     =>  'eventsetgroup',
                    'linknew'       =>  route('permission_groups.create'),
                    'uid'           =>  'groupcomponent',
                    // 'template' => 'components.lopsoft.dropdown.example',
                    ])
                    @livewire('messages.flash-message', ['msgid' => 'usersaved'] )
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
