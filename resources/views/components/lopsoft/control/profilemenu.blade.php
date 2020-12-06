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
            <div class='flex items-center justify-start text-sm font-bold text-gray-500'>
                <div>
                      <span class=''>{!! Auth::user()->country->flagsm() !!}</span>
                </div>
                <div class='pt-1'>
                      <span class='ml-2'>{{ Auth::user()->country->country??'' }}</span>
                </div>
            </div>
            <div class='text-xs font-bold text-gray-500'><i class='text-gray-400 fa fa-language'></i> {{ Auth::user()->language->language??'N/A' }}</div>
          </div>
          <div class='p-2 rounded-b-lg'>
                <x-lopsoft.control.profilemenu-link link="{{ route('profile') }}" class='hover:text-green-300'>{{ mb_strtoupper(__('lopsoft.profile')) }}</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-link link='faf' class='hover:text-green-500'>OPCION 2</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-link link='faf' class='hover:text-blue-500'>OPCION 3</x-lopsoft.control.profilemenu-link>
                <x-lopsoft.control.profilemenu-separator />
                <x-lopsoft.control.profilemenu-link onclick="document.getElementById('formlogout').submit();" class='hover:text-red-500'>
                    <form id='formlogout' method="POST" action="{{route('logout')}}">
                    @csrf
                        <i class='fa fa-sign-out fa-fw '></i> {{ mb_strtoupper(__('lopsoft.exit')) }}
                    </form>
                </x-lopsoft.control.profilemenu-link>
            </div>
      </div>
    </div>
  </div>
