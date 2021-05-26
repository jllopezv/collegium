<div>

    <div>
        <div class='overflow-x-auto nosb' >
            <div class='mb-4'>
                @if($mode!='show')
                    <x-lopsoft.link.success wire:click='addDocument' text='DOCUMENTO' icon='fa fa-plus fa-fw' textxs/>
                @endif
            </div>
            <div class='hidden md:block' style='min-width: 700px'>
                <div class='hidden md:flex items-center justify-start p-2 mb-2 font-bold text-green-300 bg-gray-700'>
                    @if($mode=='edit')
                        <div class='w-20 mx-2'>

                        </div>
                    @endif
                    <div class='w-2/3 mx-2'>
                        ARCHIVO
                    </div>
                    <div class='mx-2 w-1/3 hidden sm:block'>
                        DESCRIPCIÓN
                    </div>
                </div>
                @foreach($documentlist as $key => $item)
                    <div class='hidden md:flex items-center justify-start mb-2 hover:bg-cool-gray-200 p-2'>
                        @if($mode=='edit')
                            <div class='w-20 mx-2 flex items-center justify-start'>
                                <div>
                                    <i wire:click="editDocument({{$item['id']}}, {{$key}} )" class='cursor-pointer text-cool-gray-400 hover:text-cool-gray-600 fa fa-pencil-alt fa-fw fa-lg'></i>
                                </div>
                                <div>
                                    <i wire:click='deleteDocument({{$item['id']}})' class='cursor-pointer text-cool-gray-400 hover:text-red-600 fa fa-trash fa-fw fa-lg'></i>
                                </div>
                            </div>
                        @endif
                        <div class='w-2/3 mx-2'>
                            <a class='hover:text-blue-500' href='{{ Storage::disk('public')->url($item['document']) }}' target='_blank'>
                                {{ basename($item['document']) }}
                            </a>
                            <div class='block md:hidden'>
                                {{ $item['description'] }}
                            </div>
                        </div>
                        <div class='mx-2 w-1/3 hidden md:block'>
                            {{ $item['description'] }}
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- xs card --}}
            <div class='md:hidden'>
                @foreach($documentlist as $key => $item)
                    <div class='bg-white p-2 rounded-lg mb-4'>
                        @if($mode=='edit')
                            <div class='flex items-center justify-end w-full'>
                                <div>
                                    <i wire:click="editDocument({{$item['id']}}, {{$key}} )" class='cursor-pointer text-cool-gray-400 hover:text-cool-gray-600 fa fa-pencil-alt fa-fw fa-lg'></i>
                                </div>
                                <div>
                                    <i wire:click='deleteDocument({{$item['id']}})' class='cursor-pointer text-cool-gray-400 hover:text-red-600 fa fa-trash fa-fw fa-lg'></i>
                                </div>
                            </div>
                        @endif

                        <div class='text-center mt-4'>
                            <a class='hover:text-blue-500 text-gray-600 font-bold' href='{{ Storage::disk('public')->url($item['document']) }}' target='_blank'>
                                {{ $item['description'] }}
                            </a>
                        </div>
                        <div class='text-center mt-1'>
                            <a class='hover:text-blue-500 text-gray-400 text-xs sm:text-sm' href='{{ Storage::disk('public')->url($item['document']) }}' target='_blank'>
                                {{ basename($item['document']) }}
                            </a>
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
                <div   class='z-50 w-full p-0 mx-4 overflow-y-auto bg-white rounded-lg shadow-lg xl:mx-auto md:max-w-3xl'>
                    <div class="z-50 px-2 pt-2 pb-3 bg-white rounded-lg shadow">
                        <div class="p-4">
                            <div class='flex items-center justify-start'>
                                <div
                                    @if($mode!='show')
                                        wire:click="$emitTo('filemanager.filemanager','showFilemanager','filemanager-{{$table}}', 'document', '')"
                                    @endif
                                    class="">
                                    {{--
                                    <x-lopsoft.button.gray icon='fa fa-file' text='SELECCIONAR' />
                                    --}}

                                </div>
                                @if($record_id==0)
                                    <div class="">
                                        <x-lopsoft.button.gray @click='$refs.inputfile.click()' icon='fa fa-upload' text='SUBIR' />
                                    </div>
                                @endif
                            </div>

                            <div class='w-full mt-4 h-12'>
                                @if($document=='')
                                    <div class='my-4 text-red-400 font-bold'>NINGÚN ARCHIVO SELECCIONADO</div>
                                @else
                                    <div class="my-4 text-cool-gray-400 font-bold {{ $record_id!=0?'text-xl':'' }}">{{ basename($document) }}</div>
                                @endif
                            </div>

                            {{--
                                @livewire('filemanager.filemanager', ['uuid' => 'filemanager-'.$table, 'multiselect' => false, 'root' => "{{$documents_root}}", 'allowedmimetypes' => '', 'downloadmimetypes' => '', 'onlyimages' => false ])
                            --}}

                            <input x-ref='inputfile' wire:model='inputfile' type='file' hidden/>

                            <x-lopsoft.control.inputform
                                wire:model.lazy='description'
                                id='description'
                                x-ref='description'
                                label="{{ transup('description') }}"
                                sublabel="Texto descriptivo para mostrar junto al documento"
                                class='w-full'
                                autofocus
                                classcontainer='w-full'
                                mode="{{ $mode }}"
                                nextref='btnCreate'
                            />

                            {{--@if($record_id==0)
                                <div class='my-4 text-red-400'>
                                    Despues de añadir el documento podrá editarlo para modificar la descripción.
                                </div>
                            @endif--}}

                            <div class='flex items-center justify-end'>
                                @if($record_id==0)
                                    <div class='mr-2 text-right'>
                                        <x-lopsoft.link.gray wire:click='storeDocument(0)' text='AÑADIR' icon='fa fa-check'></x-lopsoft.link.gray>
                                    </div>
                                    <div class='mr-2 text-right'>
                                        <x-lopsoft.link.gray wire:click='storeDocument' text='AÑADIR Y SALIR' icon='fa fa-check'></x-lopsoft.link.gray>
                                    </div>
                                @else
                                    <div class='mr-2 text-right'>
                                        <x-lopsoft.link.gray wire:click='updateDocument' text='ACTUALIZAR' icon='fa fa-sync'></x-lopsoft.link.gray>
                                    </div>
                                @endif
                                <div class='text-right'>
                                    <x-lopsoft.link.danger wire:click='cancelDocument' text='CERRAR' icon='fa fa-times'></x-lopsoft.link.gray>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    </div>
