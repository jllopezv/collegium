@props([
    'justify'   =>  'center'
])
<th
    {{ $attributes->merge([ 'class' => 'text-left px-4 py-2 text-white' ]) }} style='min-width: 100px;'>
    <div class='flex items-center justify-{{$justify}}'>
        ACCIONES
    </div>
</th>
