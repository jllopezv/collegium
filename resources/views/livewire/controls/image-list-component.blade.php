<div>

<div>
    <div class='overflow-x-auto nosb' >
        <div class='mb-4'>
            @if($mode!='show')
                <x-lopsoft.link.success wire:click='addImage' text='AÑADIR IMAGEN' icon='fa fa-plus fa-fw' textxs/>
            @endif
        </div>
        <div class='' style='min-width: 700px'>
            <div class='flex items-center justify-start p-2 mb-2 font-bold text-green-300 bg-gray-700'>
                @if($mode=='edit')
                    <div class='w-16 mx-2'>

                    </div>
                @endif
                <div class='w-16 mx-2'>
                    IMAGEN
                </div>
                <div class='w-1/2 mx-2'>
                    ARCHIVO
                </div>
                <div class='mx-2 w-60'>
                    ETIQUETA
                </div>
            </div>
            @foreach($imagelist as $item)
                <div class='flex items-center justify-start mb-2'>
                    @if($mode=='edit')
                        <div class='w-16 mx-2 ml-4'>
                            <form method="POST" action="{{ route('images.edit', [ 'id' => $item['id'] ]) }}">
                                @csrf
                                <input class='hidden' name='callback_success' value="website_banners.edit" />
                                <input class='hidden' name='callback_success_params' value='{"id": {{ $imageable_id??0 }} }' />
                                <input class='hidden' name='callback_cancel' value="website_banners.edit" />
                                <input class='hidden' name='callback_cancel_params' value='{"id": {{ $imageable_id??0 }} }' />
                                <div class='flex items-center justify-center'>
                                    @if($item['id']!=0)
                                        <div>
                                            <x-lopsoft.button.transparent type='submit' nopadding class='cursor-pointer text-cool-gray-400 hover:text-cool-gray-600' icon='fa fa-pencil-alt fa-lg'></x-lopsoft.button.transparent>
                                        </div>
                                    @endif
                                    <div>
                                        {{-- <i wire:click="editImage({{$item['id']}})" class='cursor-pointer text-cool-gray-400 hover:text-cool-gray-600 fa fa-pencil-alt fa-fw fa-lg'></i> --}}
                                        <i wire:click='deleteImage({{$item['id']}})' class='cursor-pointer text-cool-gray-400 hover:text-red-600 fa fa-trash fa-fw fa-lg'></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class='w-16 mx-2 ml-4'>
                        <img src="{{ getImage($item['image']) }}" class='w-16 rounded-lg shadow-lg' />
                    </div>
                    <div class='w-1/2 mx-2'>
                        {{ $item['image'] }}
                    </div>
                    <div class='mx-2 w-60'>
                        {{ $item['tag'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>




{{-- Modal --}}

<div>
    @if($openModal)
    <div wire:transition.fade>
        <div class="fixed top-0 left-0 z-10 flex items-center justify-center w-full h-full">
            <div class="absolute z-20 w-full h-full bg-gray-900 opacity-75" wire:click="close"></div>
            <div   class='z-50 w-full p-0 mx-4 overflow-y-auto bg-white rounded-lg shadow-lg cursor-pointer xl:mx-auto md:max-w-7xl'>
                <div class="z-50 px-2 pt-2 pb-3 bg-white rounded-lg shadow">
                    <div class="p-4">
                        <div class='flex'>
                            <div
                                @if($mode!='show')
                                    wire:click="$emitTo('filemanager.filemanager','showFilemanager','filemanager-{{$table}}', 'image', '')"
                                @endif
                                class="mx-auto {{ $mode!='show' ? 'cursor-pointer' : '' }} "><img class='rounded-lg shadow-lg' src="{{getImage( $image, false )}}" style='max-width: auto; max-height: 300px' /></div>
                        </div>

                        <div class='flex flex-wrap items-center justify-start hidden md:flex-no-wrap'>
                            <div class='w-full'>
                                <x-lopsoft.control.imageform
                                    wire:model.lazy='image'
                                    id='image'
                                    x-ref='image'
                                    label="{{ transup('image').' ('.appsetting('posts_default_width').'x'.appsetting('posts_default_height').')' }}"
                                    autofocus
                                    classcontainer='w-full'
                                    requiredfield
                                    help="{{ transup('mandatory_unique') }}"
                                    nextref='type'
                                    mode="{{ $mode }}"
                                    fileid="fileimage"
                                    modelid='image'
                                    uuid='filemanager-'.$table
                                />
                            </div>
                        </div>

                        <div class='h-32'></div>

                        @livewire('filemanager.filemanager', ['uuid' => 'filemanager-'.$table, 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '', 'downloadmimetypes' => 'jpg,jpeg,png', 'onlyimages' => true ])

                        <x-lopsoft.control.inputform
                            wire:model.lazy='tag'
                            id='tag'
                            x-ref='tag'
                            label="{{ transup('tag') }}"
                            sublabel="Permite especificar una etiqueta para marcar la imagen"
                            class='w-full'
                            autofocus
                            classcontainer='w-60'
                            mode="{{ $mode }}"
                            nextref='btnCreate'
                        />

                        <div class='my-4 text-red-400'>
                            Despues de añadir la imagen podrá editarla para modificar el contenido.
                        </div>

                        <div class='flex items-center justify-end'>
                            <div class='mr-2 text-right'>
                                <x-lopsoft.link.gray wire:click='storeImage' text='AÑADIR' icon='fa fa-check'></x-lopsoft.link.gray>
                            </div>
                            <div class='text-right'>
                                <x-lopsoft.link.danger wire:click='cancelImage' text='CERRAR' icon='fa fa-times'></x-lopsoft.link.gray>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


</div>
