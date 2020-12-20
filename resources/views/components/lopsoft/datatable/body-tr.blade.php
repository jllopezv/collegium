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
        @include('livewire.partials.cardstates', [ 'record' => $record ])
        ">
        {{ $slot }}
    </tr>
@endif
