@if($mode!='create')
    @includeIf('livewire.tables.'.$module.'.'.$table.'.recordinfocustom')
    <div class='flex items-center justify-between px-4 py-2 m-0 text-right bg-gray-600'>
        <div class=''>
            @if( $mode=='show' && Auth::user()->level<=config('lopsoft.maxLevelAdmin') )
                <span class='px-2 text-sm font-bold bg-green-300 rounded-md text-cool-gray-600'>{{ $record->owner==null?'SYSTEM':$record->owner->username }}</span> <span class='text-xs text-gray-300'>{{ $record->created_aged!=''?"( $record->created_aged )":'' }}</span>
            @endif
        </div>
        <div>
            <span class='bg-blue-500 text-white py-0.5 px-1 text-xs rounded font-bold'>ID {{ $record->id }}</span>
            @if ($record->active)
                <span class='bg-green-400 text-white py-0.5 px-1 text-xs rounded font-bold'>ACTIVO</span>
            @else
                <span class='bg-red-500 text-white py-0.5 px-1 text-xs rounded font-bold'>NO ACTIVO</span>
            @endif
            @if (property_exists($record,'hasAvailable'))
                @if ($record->available)
                    <span class='bg-indigo-400 text-white py-0.5 px-1 text-xs rounded font-bold'>VISIBLE</span>
                @else
                    <span class='bg-red-500 text-white py-0.5 px-1 text-xs rounded font-bold'>INVISIBLE</span>
                @endif
            @endif
        </div>
    </div>
@endif
