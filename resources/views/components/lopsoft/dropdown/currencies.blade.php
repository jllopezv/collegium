@php
    $currency=\App\Models\Aux\Currency::find($record['id']);
@endphp

{!! $currency->symbol !!} - {!! $currency->currency !!}
