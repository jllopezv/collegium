@props([
    'active'    =>  '0',
])

<tr class="border-b border-gray-300 hover:bg-cool-gray-200  {{ $active=='1'?'bg-transparent':'bg-red-100' }}">
    {{ $slot }}
</tr>
