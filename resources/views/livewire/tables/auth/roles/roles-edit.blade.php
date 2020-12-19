@include('livewire.layouts.formlayout-begin', ['classcard' => 'max-w-2xl xl:max-w-4xl'])

    @include('livewire.tables.'.$module.'.'.$table.'.form')

@include('livewire.layouts.formlayout-end', ['flassmessage' => $table.'saved', 'firstref' => 'role' ])
