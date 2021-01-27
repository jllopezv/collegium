<div  class='h-full overflow-x-scroll' style='min-width: 500px'>
    {{-- <div class='flex items-center justify-start p-2'>
        <div class='w-40'>
            <div class='flex justify-center'>
                PREVIEW
            </div>
        </div>
        <div class='w-full overflow-x-hidden'>
            ARCHIVO
        </div>
        <div class='w-40 text-right'>
            TAMAÑO
        </div>
    </div> --}}
    @foreach($filesindir as $index => $fileindir)
        <div
            class="flex items-center justify-start p-2 cursor-pointer hover:text-gray-800 {{ $fileindir['selected']==true ? 'hover:bg-green-300' : 'hover:bg-gray-200' }}  {{ $fileindir['selected']==true ? 'bg-green-200' : '' }} "
             >
            <div class='w-40'>
                <div class='flex justify-center' wire:click='select({{ $index }})'>
                    @if( in_array($fileindir['mime_type'], ['image/jpeg', 'image/png']) )
                        <img  src="{{ getImageUrl($fileindir['url']) }}" style='width: auto; max-width: 100px; height: 50px' />
                    @else
                        @if($fileindir['type']=='folder')
                            <img src="{{ asset(Storage::disk('public')->url('fileicons/folder.png') ) }}" width='50px' />
                        @else
                            @if($fileindir['mime_type']=='text/plain')
                                <img src="{{ asset(Storage::disk('public')->url('fileicons/txt.png') ) }}" width='50px' />
                            @else
                                <img src="{{ asset(Storage::disk('public')->url('fileicons/file.png') ) }}" width='50px' />
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            @php
                if ($fileindir['type']!='folder' && in_array($fileindir['mime_type'], ['image/jpeg', 'image/png']) )
                {
                    $widthimage=$fileindir['width'];
                    $heightimage=$fileindir['height'];
                }
            @endphp
            <div class='w-full h-full overflow-x-hidden' wire:click='select({{ $index }})'>
                @if(!$renamebox || $fileindir['selected']==false)
                    <div>{{ $fileindir['basename'] }}</div>
                    <div class='md:hidden'>@if($fileindir['type']!='folder' && in_array($fileindir['mime_type'], ['image/jpeg', 'image/png']) ) {{ $widthimage.'x'.$heightimage }} @endif</div>
                    <div class='md:hidden'>@if($fileindir['type']!='folder'){{ humanFileSize($fileindir['size']) }}@endif</div>
                @else
                    <input wire:model='temporaryfilename' type='text' class='w-full form-input' value="{{ $fileindir['basename'] }}" autofocus/>
                @endif
            </div>
            <div class='w-40'>
                <div class='invisible md:visible'>@if($fileindir['type']!='folder' && in_array($fileindir['mime_type'], ['image/jpeg', 'image/png'])) {{ $widthimage.'x'.$heightimage }} @endif</div>
            </div>
            <div class='w-40 text-right'>
                <div class='invisible md:visible'>@if($fileindir['type']!='folder'){{ humanFileSize($fileindir['size']) }}@endif</div>

            </div>
        </div>
    @endforeach
    <div class='h-32'></div>
</div>
