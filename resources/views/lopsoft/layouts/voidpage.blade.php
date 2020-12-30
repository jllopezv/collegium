<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('lopsoft.layouts.partials.meta')
        @include('lopsoft.layouts.partials.styles')
        @include('lopsoft.layouts.partials.scripts')

        <title>{{ config('app.name') }}</title>

    </head>

    <body class="subpixel-antialiased">

        <div class='w-full h-full'>

            @yield('content')

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

