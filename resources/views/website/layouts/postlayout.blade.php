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

                <div class='' style='min-height: 500px; '>

                    @yield('content')

                </div>


                <div class=''>

                    @include('website.html.footer')

                </div>

            </div>


        </div>


        @livewireScripts

        @yield('scripts')

    </body>
</html>
