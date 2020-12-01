<span class='bg-blue-500 text-white py-0.5 px-1 text-xs rounded font-bold'>ID {{ $item->id }}</span>
@if ($item->active)
    <span class='bg-green-400 text-white py-0.5 px-1 text-xs rounded font-bold'>ACTIVO</span>
@else
    <span class='bg-red-500 text-white py-0.5 px-1 text-xs rounded font-bold'>NO ACTIVO</span>
@endif
