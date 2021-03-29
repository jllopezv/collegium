@props(['text' => '', 'labelwidth' => 'w-full'])

<label {{ $attributes->merge([
    'class' => 'block '.$labelwidth])
    }}>
    {!! $text==''?$slot:$text !!}
</label>
