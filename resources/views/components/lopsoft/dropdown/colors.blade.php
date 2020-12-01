@php
    $color=\App\Models\Aux\Color::find($record['id']);
@endphp

{!! $color->tag !!}
