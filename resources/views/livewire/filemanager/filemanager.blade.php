<div>
    <div x-data='{}'>
        @if($isOpen)
        <div class="fixed top-0 left-0 z-40 flex items-center justify-center w-full h-full">
            <div class="absolute w-full h-full p-4 bg-gray-900 opacity-75" wire:click="close"></div>
            <div class='z-40 w-full h-full overflow-y-hidden bg-white rounded-md shadow-lg cursor-pointer nosb '>
                <div class='relative p-2 text-white bg-cool-gray-800 '>
                    <div class='absolute top-0 right-0 z-50 m-1' x-show='$wire.showoptions && !$wire.renamebox'>
                        <div class='w-auto p-2 bg-gray-600 rounded-md'>
                            <x-lopsoft.button.success wire:click='applySelect' class='m-1' buttonxs icon='fa fa-check fa-fw' />
                            <x-lopsoft.button.purple wire:click='openSelect' class='m-1' buttonxs icon='fa fa-image fa-fw' />
                            <x-lopsoft.button.pink wire:click='copy' class='m-1' buttonxs icon='fa fa-copy fa-fw' />
                            <x-lopsoft.button.info wire:click='move' class='m-1' buttonxs icon='fa fa-cut fa-fw' />
                            <x-lopsoft.button.warning wire:click='rename' class='m-1' buttonxs icon='fa fa-i-cursor fa-fw' />
                            <x-lopsoft.button.danger wire:click='deleteSelect' class='m-1' buttonxs icon='fa fa-trash fa-fw' />
                            <x-lopsoft.button.danger wire:click='cancelOptions' class='m-1' buttonxs icon='fa fa-times fa-fw'></x-lopsoft.button.danger>
                        </div>
                    </div>
                    <div class='absolute top-0 right-0 z-50 m-1' x-show='!$wire.renamebox && $wire.showoptionsfolder'>
                        <div class='w-auto p-2 bg-gray-600 rounded-md'>
                            <x-lopsoft.button.warning wire:click='rename' class='m-1' buttonxs icon='fa fa-i-cursor fa-fw' />
                            <x-lopsoft.button.danger wire:click='deleteSelect' class='m-1' buttonxs icon='fa fa-trash fa-fw' />
                            <x-lopsoft.button.danger wire:click='cancelOptions' class='m-1' buttonxs icon='fa fa-times fa-fw'></x-lopsoft.button.danger>
                        </div>
                    </div>
                    <div class='absolute top-0 right-0 z-50 m-1'  x-show='$wire.renamebox'>
                        <div class='w-auto p-2 bg-gray-600 rounded-md'>
                            <x-lopsoft.button.success wire:click='applyRename' class='m-1' buttonxs icon='fa fa-check fa-fw' />
                            <x-lopsoft.button.danger wire:click='cancelAction' class='m-1' buttonxs icon='fa fa-times fa-fw' />
                        </div>
                    </div>
                    <div class='absolute top-0 right-0 z-50 m-1'  x-show='$wire.copybox'>
                        <div class='w-auto p-2 bg-gray-600 rounded-md'>
                            <x-lopsoft.button.success wire:click='applyCopy' class='m-1' buttonxs icon='fa fa-check fa-fw' />
                            <x-lopsoft.button.danger wire:click='cancelAction' class='m-1' buttonxs icon='fa fa-times fa-fw' />
                        </div>
                    </div>
                    <div class='absolute top-0 right-0 z-50 m-1'  x-show='$wire.movebox'>
                        <div class='w-auto p-2 bg-gray-600 rounded-md'>
                            <x-lopsoft.button.success wire:click='applyMove' class='m-1' buttonxs icon='fa fa-check fa-fw' />
                            <x-lopsoft.button.danger wire:click='cancelAction' class='m-1' buttonxs icon='fa fa-times fa-fw' />
                        </div>
                    </div>
                   <div class='relative flex flex-wrap items-center justify-between h-full'>
                        <div class='absolute top-0 right-2'><i wire:click='close' class='text-red-300 fa fa-times'></i></div>
                        <div class=''>
                            {{-- <div>UUID: {{ $uuid }}</div> --}}
                            <div><i class='fa fa-user'></i> {{ Auth::user()->username }}</div>
                            <div><i class='fa fa-folder'></i> {{ $dir }}</div>
                            {{--<div> Root: {{ $root }}</div>
                            <div> currentdir: {{ $currentdir }}</div>
                            <div> path: {{ $path }}</div>
                            <div> dir: {{ $dir }}</div>
                            <div> getPath: {{ $root.$path.$dir }}</div>--}}
                        </div>
                        <div class='pt-1 text-right'>
                            <i @click='$refs.filemanager_selectfile.click()' class='mr-2 text-indigo-300 fas fa-cloud-upload-alt fa-lg fa-fw'></i>
                            <i wire:click='createFolder' class='mr-2 text-green-300 fa fa-folder-plus fa-lg fa-fw'></i>
                            <i wire:click='syncFiles' class='mr-12 text-blue-300 fa fa-sync fa-lg fa-fw'></i>
                        </div>
                   </div>
                </div>
                <div wire:loading.delay.class='opacity-50' class='w-full h-full overflow-y-scroll nosb'>
                    {!! $filestoshow !!}
                </div>

                @include('livewire.partials.loading-message')
                <input  type='file' x-ref='filemanager_selectfile' wire:model='fileupload' />


                @if($uploading)
                <div class='absolute top-0 left-0 z-10 w-full h-full'>
                    <div class='flex items-center content-center justify-center w-full h-full'>
                        <div class='p-4 mx-auto text-lg text-green-300 bg-gray-700 rounded-md'>
                            <div class='flex items-center justify-center'>
                                <div>
                                    <i class='fa fa-spinner fa-pulse'></i>
                                </div>
                                <div class='pl-2 text-lg font-bold'>SUBIENDO ARCHIVO</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    @if($openShowImage)
    <div class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full overflow-y-auto bg-gray-800">
        <div class=''>
            <div class=''>
                <img src="{{ $previewImage }}" class="p-2 bg-white rounded-lg shadow-lg" />
            </div>
            <div class='text-center text-white'>
                <div>{{ $previewImage }}</div>
                <div>{{ $previewImageWidth }} x {{ $previewImageHeight }}</div>
            </div>
            <div class='mt-1 text-center text-white'>
                <x-lopsoft.button.danger wire:click='closePreview' text='CERRAR'></x-lopsoft.button.danger>
            </div>
        </div>
    </div>
    @endif
</div>
