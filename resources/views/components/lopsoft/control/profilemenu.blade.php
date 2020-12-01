@props(['line1','line2','line3'])

<div id='profilemenu'
    x-show='openProfile'
    x-cloak
    class="origin-top-right absolute right-3 mt-1  w-80 rounded-md shadow-lg z-10">
    <div class="rounded-md bg-gray-800  shadow-xs">
      <div class="flex flex-col"  >
          <div class='bg-gray-900 rounded-t-lg py-3 px-4'>
              <div class='text-white text-md font-bold'>{{$line1}}</div>
              <div class='text-green-300 text-sm font-bold '>{{$line2}}</div>
              <div class='text-gray-500 text-sm font-bold'>{{$line3}}</div>

          </div>
          <div class='rounded-b-lg p-2'>
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
