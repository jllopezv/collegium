@php
    $record=\App\Models\Aux\Timezone::find($record['id']);
@endphp

{!! $record->name !!} ({{ $record->offset }})
