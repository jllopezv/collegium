@props([
    'active'    =>  '0',
    'model'     =>  '',
    'index'     =>  '',
    'table'     =>  '',
])

@php
    $record=$model::find($index);
@endphp

@if($record!=null)
    <tr class="border-b border-gray-300
        @if(!$active)
            bg-red-100  hover:bg-red-200
        @else
            @if( Schema::hasColumn($table, 'current') && $record->current)
            bg-green-200  hover:bg-green-300
            @else
                bg-transparent  hover:bg-cool-gray-200
            @endif
        @endif
        ">
        {{ $slot }}
    </tr>
@endif
