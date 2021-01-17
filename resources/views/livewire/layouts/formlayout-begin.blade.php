<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')
    @include('livewire.partials.custom-message')

    <div
            @if(!$disableloading) wire:loading.delay.class='opacity-25' @endif
            @if($showcustommessage) class='opacity-25' @endif
        >

        <div class='w-full {{ $classcard }} mx-auto'>

            @include('livewire.partials.topcard')

                @includeWhen( $mode=='create' ,'livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')
