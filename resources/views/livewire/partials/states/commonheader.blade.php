@if($mode=='create')
    @include('livewire.partials.headeraaction', ['headertext' => 'CREAR NUEVO REGISTRO', 'routeback' => $routeback??''])
@endif

@if($mode=='edit')
    @include('livewire.partials.headeraaction', ['headertext' => 'MODIFICAR REGISTRO', 'routeback' => $routeback??''])
@endif

@if($mode=='show')
    @include('livewire.partials.headeraaction', ['headertext' => 'VER REGISTRO', 'routeback' => $routeback??''])
@endif

@if($mode=='index')
    @include('livewire.partials.headeraaction', ['headertext' => $title , 'routeback' => $routeback??''])
@endif
