@if($mode!='create')
    <div class='flex items-center justify-between px-4 pt-0 pb-1 m-0 text-right bg-gray-200'>
        <div class=''>
            @if($mode=='show')
                {{ $record->owner==null?'SYSTEM':$record->owner->username }} ({{ $record->created_aged }})
            @endif
        </div>
        <div>
            <span class='bg-blue-500 text-white py-0.5 px-1 text-xs rounded font-bold'>ID {{ $record->id }}</span>
            @if ($record->active)
                <span class='bg-green-400 text-white py-0.5 px-1 text-xs rounded font-bold'>ACTIVO</span>
            @else
                <span class='bg-red-500 text-white py-0.5 px-1 text-xs rounded font-bold'>NO ACTIVO</span>
            @endif
        </div>
    </div>
@endif
