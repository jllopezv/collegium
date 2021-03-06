@props([
    'width'         => '',
    'columnname'    => 'columnname',
    'sortorder'         => '',
    'sortable'      => false,
    'justify'       => 'start',
    'style'         =>  '',
])

<th
    @if($sortable)
        wire:click="sortBy('{{$columnname}}')"
    @endif
    {{ $attributes->merge([
        'class' =>  ( $sortable || ( $sortorder==$columnname || $sortorder=='-'.$columnname ) )?"text-green-300 cursor-pointer bg-gray-700":" bg-gray-700 text-white",
        'width' =>  $width,
    ]) }}
    style='{{$style}}'
    >
    <div class='flex items-center justify-{{ $justify }} mx-2 py-2'>
        <div class=''>
            {{ $slot }}
        </div>
        <div class='ml-1'>
            @if($sortable)
                @if ( $sortorder==$columnname || $sortorder=='-'.$columnname )
                    @if( \Illuminate\Support\Str::startsWith($sortorder,'-') )
                        <i class='fa fa-angle-down'></i>
                    @else
                        <i class='fa fa-angle-up'></i>
                    @endif
                @else
                    {{-- <i class='fa fa-sort'></i> --}}
                @endif
            @endif
        </div>
    </div>
</th>
