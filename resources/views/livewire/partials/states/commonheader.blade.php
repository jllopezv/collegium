@if($mode=='create')
    @include('livewire.partials.headeraaction', ['headertext' => 'CREAR NUEVO REGISTRO'])
@endif

@if($mode=='edit')
    @include('livewire.partials.headeraaction', ['headertext' => 'MODIFICAR REGISTRO'])
@endif

@if($mode=='show')
    @include('livewire.partials.headeraaction', ['headertext' => 'VER REGISTRO'])
@endif

@if($mode=='index')
    @include('livewire.partials.headeraaction', ['headertext' => $title ])
@endif
