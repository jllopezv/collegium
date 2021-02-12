@props([
    'textcolor' => 'text-gray-600',
])

<div {{ $attributes->merge([ 'class' => 'flex items-center justify-start pl-0 md:pl-2 mt-2']) }}>
    {{-- <div class='px-2'><i class='text-gray-500 fa fa-search fa-fw'></i></div> --}}
    <x-lopsoft.control.input class='bg-transparent {{ $textcolor }} w-full' wire:model.lazy='search' wire:keydown.escape='clearSearch' placeholder="Buscar..."></x-lopsoft.control.input>
</div>
