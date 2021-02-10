@props([
    'itemid'    =>  '0',
    'table'     =>  '',
    'module'    =>  '',
    'active'    =>  '0',
    'model'     =>  null,
    'actioncandelete'  =>  'true',
    'actioncanedit'    =>  'true',
    'actioncanlock'    =>  'true',
])

@php
    $record=$model::find($itemid);
@endphp

@if(!is_null($record))
    <td class='px-4 py-2 text-right'>
        {{-- Edit --}}
        @if($actioncanedit==='true')
            @if($record->allowEdit())
                @if($record->canEditRecord())
                    <div class='tooltip'>
                        <a href='{{ route($table.'.edit',$itemid) }}'><i  class='fa fa-pencil-alt fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i></a>
                        <span class='tooltiptext tooltiptext-center-left'>EDITAR</span>
                    </div>
                @endif
            @endif
        @endif
        {{-- Delete --}}
        @if($actioncandelete==='true')
            @if($record->allowDelete())
                @if($record->canDeleteRecord())
                    <div class='tooltip'>
                        <i wire:click="delete({{ $itemid }})" class='cursor-pointer fa fa-trash fa-lg fa-fw text-cool-gray-400 hover:text-red-600'></i>
                        <span class='tooltiptext tooltiptext-center-left'>BORRAR</span>
                    </div>
                @endif
            @endif
        @endif
        {{-- Available --}}
        @if (property_exists($record, 'hasAvailable'))
            @if($record->available)
                <div class='tooltip'>
                    <i wire:click="unAvailable({{ $itemid }})" class='cursor-pointer far fa-eye-slash fa-lg fa-fw text-cool-gray-400 hover:text-red-600'></i>
                    <span class='tooltiptext tooltiptext-center-left'>DESHABILITAR</span>
                </div>
            @else
                <div class='tooltip'>
                    <i wire:click="available({{ $itemid }})" class='cursor-pointer far fa-eye fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
                    <span class='tooltiptext tooltiptext-center-left'>HABILITAR</span>
                </div>
            @endif
        @endif
        {{-- Lock/Unlock --}}
        @if($actioncanlock==='true')
            @if(property_exists($model,'hasactive'))
                @if($record->allowLock())
                    @if($active!='1')
                        @if($record->canUnlockRecord())
                            @hasAbilityOr([$table.'.lock', $table.'.lock.owner'])
                            {{-- Unlock --}}
                            <div class='tooltip'>
                                <i wire:click="unlock({{ $itemid }})" class='cursor-pointer fa fa-unlock fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
                                <span class='tooltiptext tooltiptext-center-left'>DESBLOQUEAR</span>
                            </div>
                            @endhasAbilityOr
                        @endif
                    @else
                        @if($record->canLockRecord())
                            @hasAbilityOr([$table.'.lock', $table.'.lock.owner'])
                            {{-- Lock --}}
                            <div class='tooltip'>
                                <i wire:click="lock({{ $itemid }})" class='cursor-pointer fa fa-lock fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
                                <span class='tooltiptext tooltiptext-center-left'>BLOQUEAR</span>
                            </div>
                            @endhasAbilityOr
                        @endif
                    @endif
                @endif
            @endif
        @endif
        @includeIf('livewire.tables.'.$module.'.'.$table.'.actions')
    </td>
@endif
