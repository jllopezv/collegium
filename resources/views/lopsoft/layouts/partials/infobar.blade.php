<div x-data='{showAnno: false}' class="relative p-1 text-white bg-gray-900">
    <div @click='showAnno=!showAnno' class='flex items-center justify-end'>
        <span class='px-2 mr-4 text-sm font-bold
        {{ (Auth::user()->anno!=null)?( Auth::user()->anno->id!=(new \App\Models\School\Anno)->current()->id ? 'text-white bg-red-400': 'text-green-300 bg-cool-gray-600'  ):'text-green-300 bg-cool-gray-600'}}
          rounded-md cursor-pointer '>{{ (Auth::user()->anno!=null)?Auth::user()->anno->anno:(new \App\Models\School\Anno)->current()->anno }}</span>
    </div>
    @hasAbility('users.changeannosession')
        <div id='anno_display'
            @click.away='showAnno=false'
            x-show='showAnno'
            x-cloak
            class="absolute z-10 h-32 mt-1 overflow-y-scroll origin-top-right rounded-md shadow-lg right-3 w-80 bg-cool-gray-600 nosb">
            <div class='p-2 rounded-b-lg'>
                @php
                    $annos=\App\Models\School\Anno::active()->orderBy('id','desc')->get();
                @endphp
                @foreach($annos as $anno)
                    <form x-ref='form{{$anno->id}}' method='POST' action='{{ route('changeannosession',['id' => $anno->id ]) }}'>
                        @csrf
                        <div @click="$refs.form{{$anno->id}}.submit()" class='block px-4 py-2 text-sm font-bold leading-5
                        {{ ($anno->current)?'text-green-300':'text-white' }}
                        transition-all duration-300 rounded-md cursor-pointer hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-100 focus:text-gray-900'>
                        {{ $anno->anno }}
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    @endhasAbility
</div>
