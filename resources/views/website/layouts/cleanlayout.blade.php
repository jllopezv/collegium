<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('website.html.meta')
        @include('website.html.styles')
        @include('website.html.scripts')

        <title>{{ config('app.name') }}</title>

        @livewireStyles

    </head>

    <body class="subpixel-antialiased bg-gray-100">

        @php
            App::setLocale(Auth::user()->language->code??config('lopsoft.locale_default'));
        @endphp

        <div>

            <div class='relative md:h-40 w-full bg-white'>

                @include('website.html.navigation')

            </div>

            <div class='p-0 m-0'>

                @yield('content')

                <div class=''>

                    @include('website.html.footer')

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

        @yield('scripts')

    </body>
</html>
