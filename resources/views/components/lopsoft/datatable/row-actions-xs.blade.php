@props([
    'itemid'    =>  '0',
    'table'     =>  '',
    'active'    =>  '0',
    'model'     =>  null,
    'actioncandelete'  =>  'true',
    'actioncanedit'    =>  'true',
    'actioncanlock'    =>  'true',
])

<div class='mt-4'>
    {{-- Edit --}}
    <div class='tooltip'>
        <a href='{{ route($table.'.edit',$itemid) }}'><i  class='fa fa-pencil-alt fa-lg fa-fw text-blue-400 hover:text-blue-600'></i></a>
        <span class='tooltiptext tooltiptext-up-left'>EDITAR</span>
    </div>
    {{-- Delete --}}
    <div class='tooltip'>
        <i wire:click="delete({{ $itemid }})" class='fa fa-trash fa-lg fa-fw text-red-400 hover:text-red-600 cursor-pointer'></i>
        <span class='tooltiptext tooltiptext-up-left'>BORRAR</span>
    </div>
    @if($active!='1')
        {{-- Unlock --}}
        <div class='tooltip'>
            <i wire:click="unlock({{ $itemid }})" class='fa fa-unlock fa-lg fa-fw text-green-400 hover:text-green-600 cursor-pointer'></i>
            <span class='tooltiptext tooltiptext-up-left'>DESBLOQUEAR</span>
        </div>
    @else
        {{-- Lock --}}
        <div class='tooltip'>
            <i wire:click="lock({{ $itemid }})" class='fa fa-lock fa-lg fa-fw text-orange-400 hover:text-orange-600 cursor-pointer'></i>
            <span class='tooltiptext tooltiptext-up-left'>BLOQUEAR</span>
        </div>
    @endif
</div>

