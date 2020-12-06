@php
    $record=\App\Models\Aux\Language::find($record['id']);
@endphp

<div class=''>
    {{ $record->language }}
</div>

