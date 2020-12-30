@include('livewire.layouts.formlayout-begin', ['classcard' => 'max-w-3xl'])

    @include('livewire.tables.'.$module.'.'.$table.'.form')

@include('livewire.layouts.formlayout-end', ['flassmessage' => $table.'saved', 'firstref' => 'settingpage' ])
