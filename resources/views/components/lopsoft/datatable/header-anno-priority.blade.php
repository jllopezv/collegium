@if($showOnlyAnno)
    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
    @include('components.lopsoft.datatable.header-setpriority')
@else
    <x-lopsoft.datatable.header-th class='w-40' justify='center'>{{ transup('year') }}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='end' columnname='priority'>{{ transup('priority')}}</x-lopsoft.datatable.header-th>
    <x-lopsoft.datatable.header-th class='w-24' justify='center' ><i class='text-white  fa fa-sort-numeric-down fa-sm fa-fw'></i></x-lopsoft.datatable.header-th>
@endif
