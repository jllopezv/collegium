@php
    $record=\App\Models\Aux\Country::find($record['id']);
@endphp

<div class='flex items-center justify-start'>
    <div class=''>
        {!! $record->flag!!}
    </div>
    <div class='pt-1 pl-2'>
        {{ $record->country }}
    </div>
</div>
