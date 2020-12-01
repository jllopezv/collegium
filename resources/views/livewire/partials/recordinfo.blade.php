@if($mode!='create')
    <div class='bg-gray-200 m-0 text-right px-4 pt-0 pb-1 flex items-center justify-between'>
        <div class=''>
            @if($mode=='show')
                Lop
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
