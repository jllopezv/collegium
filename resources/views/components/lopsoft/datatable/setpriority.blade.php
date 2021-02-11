<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    class="{{ $classrow??'' }}">
        <div class='flex items-center justify-center'>
            @if( (property_exists($item, 'hasactive') && $item->active) &&
                (
                    (property_exists($item, 'hasAvailable') && $item->available!=null) )
                    || !property_exists($item, 'hasAvailable')
                )
                <div class=''>
                    <i wire:click='upPriority({{$item->id}})' class="fa fa-angle-up fa-fw fa-lg
                        {{ $item->priority<2?'text-cool-gray-300':'cursor-pointer ' }}
                    "></i>
                </div>
                <div class=''>
                    <i wire:click='downPriority({{$item->id}})' class='cursor-pointer fa fa-angle-down fa-fw fa-lg'></i>
                </div>
            @endif
        </div>
</x-lopsoft.datatable.row-column>
