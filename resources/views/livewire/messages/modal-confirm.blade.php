<div>
    @if($isOpen)
    <div wire:transition.fade>
        <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="absolute w-full h-full bg-gray-900 opacity-75" wire:click="close"></div>
            <div class='w-11/12 md:max-w-2xl mx-auto shadow-lg z-50 overflow-y-auto bg-transparent cursor-pointer'>

                @if(!$modaltitle)
                    <div
                    class="
                        {{ $modaltype=='error'?'bg-red-500 text-white':''}}
                        {{ $modaltype=='success'?'bg-green-400 text-white':''}}
                        {{ $modaltype=='info'?'bg-blue-400 text-white':''}}
                        {{ $modaltype=='warning'?'bg-orange-400 text-white':''}}
                        font-bold text-md rounded-t-lg p-1
                    ">
                    </div>
                    <<div class="
                        {{ $modaltype=='error'?'bg-red-500 text-white':''}}
                        {{ $modaltype=='success'?'bg-green-400 text-white':''}}
                        {{ $modaltype=='info'?'bg-blue-400 text-white':''}}
                        {{ $modaltype=='warning'?'bg-orange-400 text-white':''}}
                        rounded-b-lg px-2 pt-2 pb-3">

                    <div class="p-4 text-center text-md font-bold">
                        {{-- BODY --}}
                        {!! $modalmessage !!}
                    </div>
                </div>
                @else
                    <div
                    class="
                            {{ $modaltype=='error'?'bg-red-400 text-white':''}}
                            {{ $modaltype=='success'?'bg-green-400 text-white':''}}
                            {{ $modaltype=='info'?'bg-blue-400 text-white':''}}
                            {{ $modaltype=='warning'?'bg-orange-400 text-white':''}}
                            font-bold text-md rounded-t-lg p-2"
                        >
                        <span ><i class='
                            {{ $modaltype=='error'?'fa fa-exclamation-triangle fa-fw':'' }}
                        '></i>
                        <span>
                            {!! $modaltitle !!}
                        </span>

                    </div>
                    <div class="
                            {{ $modaltype=='error'?'text-red-500 bg-white':''}}
                            {{ $modaltype=='success'?'text-green-400 bg-white':''}}
                            {{ $modaltype=='info'?'text-blue-400 bg-white':''}}
                            {{ $modaltype=='warning'?'text-orange-400 bg-white':''}}
                            rounded-b-lg px-2 pt-2 pb-3"
                    >

                    <div class="p-4 text-center text-md font-bold">
                        {{-- BODY --}}
                        {!! $modalmessage !!}
                    </div>
                    <div class="p-4 text-center text-md font-bold">
                        {{-- BUTTONS --}}
                        <x-lopsoft.button.coolgray wire:click="sendEvent('{{$callOK}}','{{$params}}')" icon='fa fa-check' text='SI' />
                        <x-lopsoft.button.danger  wire:click='{{$callCANCEL}}' class='ml-1' icon='fa fa-times' text='NO' />
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
