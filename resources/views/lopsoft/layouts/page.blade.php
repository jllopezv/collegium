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



        <div
            x-data='InitSidebar()'
            x-init='checkWidth()'
            class=" flex flex-col h-screen">

            {{-- NAVBAR --}}
            <div class="py-4 px-4 bg-gray-700 text-white shadow">
                @include('lopsoft.layouts.partials.navbar')
            </div>

            {{-- MAIN --}}
             <div class='flex-1 h-full max-h-full overflow-y-hidden'>
                <div  class='h-full flex items-start justify-start bg-gray-800 overflow-hidden' >

                    {{-- SIDEBAR --}}
                    @include('lopsoft.layouts.partials.sidebar')

                    <div
                        {{-- x-on:click='closeAll()' --}}
                        class="w-full h-full overflow-y-auto bg-gray-100 overflow-x-hidden">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{--
             <div class='w-32'>
                footer
            </div>
            --}}

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
        </script>

    </body>
</html>
