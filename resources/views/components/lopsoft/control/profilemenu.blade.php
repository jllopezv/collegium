@props(['line1','line2','line3'])

<div id='profilemenu'
    x-show='openProfile'
    x-cloak
    class="absolute z-10 mt-1 origin-top-right rounded-md shadow-lg right-3 w-80">
    <div class="bg-gray-800 rounded-md shadow-xs">
      <div class="flex flex-col"  >
          <div class='px-4 py-3 bg-gray-900 rounded-t-lg'>
              <div class='font-bold text-white text-md'>{{$line1}}</div>
              <div class='text-sm font-bold text-green-300 '>{{$line2}}</div>
              <div class='text-sm font-bold text-gray-500'>{{$line3}}</div>
              <div class='text-sm font-bold text-gray-500'><span class=''>{!! Auth::user()->country->flagsm() !!}</span><span class='ml-2'>{{ Auth::user()->country->country }}</span></div>
            {{ App::getLocale() }}
          </div>
          <div class='p-2 rounded-b-lg'>
                <x-lopsoft.control.profilemenu-link link="{{ route('profile') }}" class='hover:text-green-300'>PERFIL</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-link link='faf' class='hover:text-green-500'>OPCION 2</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-link link='faf' class='hover:text-blue-500'>OPCION 3</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-separator />
                <x-lopsoft.control.profilemenu-link onclick="document.getElementById('formlogout').submit();" class='hover:text-red-500'>
                    <form id='formlogout' method="POST" action="{{route('logout')}}">
                    @csrf
                        <i class='fa fa-sign-out fa-fw '></i> SALIR
                    </form>
                </x-lopsoft.control.profilemenu-link>
            </div>
      </div>
    </div>
  </div>
