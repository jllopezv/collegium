@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->configable_type])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->configable_id, 'classrow' => 'text-right' ])
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }} pl-12"
    link="{{ route($table.'.show',$item->id) }}">
        @php
            $itemdata=json_decode($item->data??'',true);
        @endphp
        @if ($itemdata!=null)
            @foreach($itemdata as $key => $value)
                <div class=''>
                    <span class='font-bold'>{!! $key !!}</span> = <span class=''>{!! $value !!}</span>
                </div>
            @endforeach
        @endif
</x-lopsoft.datatable.row-column>
