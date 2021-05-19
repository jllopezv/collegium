<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showOnlyAnno==0' class='w-32' justify='center'>{{ transup('year') }}</x-lopsoft.datatable.header-th>

{{-- With OnlyAnno --}}
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority==1 && $wire.showOnlyAnno==1' class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority==1 && $wire.showOnlyAnno==1' class='w-24' justify='center' >
    <i wire:click='syncPriority' class='text-green-300 cursor-pointer fa fa-sort-numeric-down fa-sm fa-fw'></i>
</x-lopsoft.datatable.header-th>
{{-- Without OnlyAnno --}}
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority==1 && $wire.showOnlyAnno==0' class='w-24' justify='end' >{{ transup('priority')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority==1 && $wire.showOnlyAnno==0' class='w-24' justify='center' >
    <i class='text-white cursor-pointer fa fa-sort-numeric-down fa-sm fa-fw'></i>
</x-lopsoft.datatable.header-th>
