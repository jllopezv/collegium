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
    <div class='pt-3'>
        {{-- Edit --}}
        @if($actioncanedit==='true')
            @if($record->allowEdit())
                @if($record->canEditRecord())
                    <div class='tooltip'>
                        <a href='{{ route($table.'.edit',$itemid) }}'><i  class=' fa fa-pencil-alt fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i></a>
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
                        <i wire:click="delete({{ $itemid }})" class='text-red-400 cursor-pointer fa fa-trash fa-lg fa-fw hover:text-red-600'></i>
                        <span class='tooltiptext tooltiptext-center-left'>BORRAR</span>
                    </div>
                @endif
            @endif
        @endif
        @if($actioncanlock==='true')
            @if(property_exists($model,'hasactive'))
                @if($record->allowLock())
                    @if($active!='1')
                        @if($record->canUnlockRecord())
                            {{-- Unlock --}}
                            <div class='tooltip'>
                                <i wire:click="unlock({{ $itemid }})" class='cursor-pointer fa fa-unlock fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
                                <span class='tooltiptext tooltiptext-center-left'>DESBLOQUEAR</span>
                            </div>
                        @endif
                    @else
                        @if($record->canLockRecord())
                            {{-- Lock --}}
                            <div class='tooltip'>
                                <i wire:click="lock({{ $itemid }})" class='cursor-pointer fa fa-lock fa-lg fa-fw text-cool-gray-400 hover:text-cool-gray-600'></i>
                                <span class='tooltiptext tooltiptext-center-left'>BLOQUEAR</span>
                            </div>
                        @endif
                    @endif
                @endif
            @endif
        @endif
        @includeIf('livewire.tables.'.$module.'.'.$table.'.actions-xs')
    </div>
@endif

