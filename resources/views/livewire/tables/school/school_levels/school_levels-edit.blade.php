@include('livewire.layouts.formlayout-begin', ['classcard' => ''])

    @include('livewire.tables.'.$module.'.'.$table.'.form')

@include('livewire.layouts.formlayout-end', ['flassmessage' => $table.'saved', 'firstref' => 'priority' ])
