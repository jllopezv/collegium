<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('lopsoft.layouts.partials.meta')
        @include('lopsoft.layouts.partials.styles')
        @include('lopsoft.layouts.partials.scripts')

        <title>{{ config('app.name') }}</title>

        @livewireStyles

    </head>

    <body class="subpixel-antialiased bg-gray-100">



        @php
            App::setLocale(Auth::user()->language->code??config('lopsoft.locale_default'));
        @endphp

        <div
            x-data='InitSidebar()'
            {{-- x-init='checkWidth()' --}}
            class="relative flex flex-col h-screen">

            {{-- NAVBAR --}}
            <div class="px-4 py-4 text-white bg-gray-700 shadow">
                @include('lopsoft.layouts.partials.navbar')
            </div>

            {{-- MAIN --}}
            <div class='relative flex-1 h-full max-h-full overflow-y-hidden'>

                {{-- SIDEBAR --}}
                @include('lopsoft.layouts.partials.sidebar')

                <div  class='flex items-start justify-start h-full overflow-hidden bg-gray-800' >

                    <div class='w-full h-full'>
                        {{-- INFOBAR --}}
                        @include('lopsoft.layouts.partials.infobar')

                        <div class="w-full h-full overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div id='tophtml'></div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @livewire('messages.modal-alert')
        @livewire('messages.modal-confirm')

        @if(session()->has('status_success'))
            <script> ShowSuccess("{{ session('status_success') }}"); </script>
        @endif
        @if(session()->has('status_error'))
            <script> ShowError("{{ session('status_error') }}"); </script>
        @endif
        @if(session()->has('status_info'))
            <script> ShowInfo("{{ session('status_info') }}"); </script>
        @endif
        @if(session()->has('status_warning'))
            <script> ShowWarning("{{ session('status_warning') }}"); </script>
        @endif

        @livewireScripts

        <script>
            $('html,body').scrollTop(0); // top right now
            // window.addEventListener('setelementvalue', event => {
            //     console.log(event.detail);
            //     alert('ID: ' + event.detail.objectid+ " value: "+event.detail.objectvalue);
            // })

            window.addEventListener('settimeout', event => {
                alert("bien");
                setTimeout(function() {
                    Livewire.emit(event.detail.event)
                }, event.detail.timeout);
            });

            window.addEventListener('scrolltop', event => {
                window.scrollTo(0,0);
            });


        </script>

    </body>
</html>
