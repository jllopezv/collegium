<div class='bg-white shadow-md rounded-b-md'>

    @include('livewire.partials.recordcard-header', [
        'title'     => $title,
        'subtitle'  => $subtitle,
    ])

    <hr>

    @include('livewire.partials.recordinfo')
