<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('lopsoft.layouts.partials.meta')
        @include('lopsoft.layouts.partials.styles')
        @include('lopsoft.layouts.partials.scripts')

        <title>{{ config('app.name') }}</title>

    </head>

    <body class="subpixel-antialiased bg-gray-800">

        @yield('content')

        @stack('modals')
        @stack('scripts')

        @livewireScripts
    </body>
</html>

