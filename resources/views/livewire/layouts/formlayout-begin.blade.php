<div x-data='{}' class='relative w-full'>

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50' >

        <div class='w-full {{ $classcard }} mx-auto'>

            @include('livewire.partials.topcard')

                @include('livewire.partials.createmultiples')

                @include('livewire.partials.bottomcard')
