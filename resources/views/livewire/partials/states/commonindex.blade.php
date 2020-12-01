@include('livewire.partials.states.commonheader', ['mode' => 'index'] )

<div class='px-2 py-4'>

    @livewire($module.'.'.$component.'-component', [
        'table'     =>  $table,
        'model'     =>  $model,
        'mode'      =>  'index',
        'title'     =>  $title,
        'subtitle'  =>  $subtitle])

</div>
