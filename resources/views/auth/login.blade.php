<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('lopsoft.layouts.partials.meta')
        @include('lopsoft.layouts.partials.styles')
        @include('lopsoft.layouts.partials.scripts')

        <title>{{ config('app.name') }}</title>
    </head>
    <body class="antialiased bg-gray-700">

        @livewire('auth.login-component')
        @livewireScripts

    </body>
</html>

