<x-lopsoft.datatable.header-th x-cloak x-show='!$wire.showOnlyAnno' class='w-32' justify='center'>{{ transup('year') }}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority' class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
<x-lopsoft.datatable.header-th x-cloak x-show='$wire.showPriority' class='w-24' justify='center' >
    <i wire:click='syncPriority' class='text-green-300 cursor-pointer fa fa-sort-numeric-down fa-sm fa-fw'></i>
</x-lopsoft.datatable.header-th>
