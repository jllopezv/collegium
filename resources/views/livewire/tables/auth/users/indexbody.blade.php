@include('components.lopsoft.datatable.rowcolumnavatar')
<x-lopsoft.datatable.row-column canshow="{{ $item->canShowRecord() && $item->allowShow() }}" >
    <div class='text-lg font-bold'><a href="{{ route($table.'.show',$item->id) }}">{{ $item->name }}</a></div>
    <div class='text-sm text-gray-500'>
        {{-- <a href='mailto: {{ $item->email }}'>{{ $item->email }}</a> --}}
        <a href="{{ route($table.'.show',$item->id) }}">{{ $item->email }}</a>
    </div>
</x-lopsoft.datatable.row-column>
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->username])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->level, 'classrow' => 'text-right'])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->getRolesTags()])
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}" >
    <div class='flex items-center justify-start'>
        <div>{!! $item->country->flag !!}</div>
        <div class='pt-1 ml-1 text-sm'>{{ strtoupper($item->language->code??'') }}</div>
    </div>
</x-lopsoft.datatable.row-column>
