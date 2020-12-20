<div
    {{-- x-on:click='closeAll()' --}}
    class='flex items-center justify-between'>
    <div class='flex items-center h-10'>
        <div
            x-on:click="toggleVisibleSidebar()"
            class='w-10 pr-3 text-gray-500 cursor-pointer hover:text-white'>
            <i class='fa fa-bars fa-lg fa-fw'></i>
        </div>
        <div class=''>
        <x-lopsoft.control.image link="{{ route('dashboard') }}" class='w-32 cursor-pointer' src="{{ Illuminate\Support\Facades\Storage::disk('public')->url(config('lopsoft.vendorlogo_overblack')) }}"></x-lopsoft.control.image>
        </div>
    </div>
    <div
        x-data='{ openProfile: false }'
        @keydown.escape.window='openProfile=false'>
        <x-lopsoft.control.image
            x-on:click='openProfile = true'
            x-on:click.away='openProfile = false'
            class='w-10 bg-gray-800 rounded-full shadow-md cursor-pointer ' src="{{ Auth::user()->avatar }}"></x-lopsoft.control.image>
        <x-lopsoft.control.profilemenu
            line1='{{Auth::user()->name}}' line2='{{Auth::user()->email}}' line3='{{ Auth::user()->getUserRole() }}' />
    </div>

</div>




