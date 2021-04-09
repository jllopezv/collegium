<div x-data="{}"
    x-init="$('#barmenu').slideUp()"
    @resize.window="$('#barmenu').slideUp()"
    class='p-2'>

    <div class='flex items-center justify-between'>
        <div class='flex items-center justify-start'>
            <div>
                <a href="{{ route('website.welcome') }}">
                    <img class='navigation-logo' src='{{ getImage(appsetting('WEBSITE_LOGO_SMALL')) }}' >
                </a>
            </div>
            <div class='text-left ml-2'>
                <div class='website_name'>TIA SANDRA SCHOOL</div>
                <div class='website_subname'>20 años de experiencia nos avalan</div>
            </div>
        </div>
        <div  class=''>
            <div class='flex items-center justify-end pr-2'>
                <div class='hidden md:block text-right'>
                    @if(appsetting('WEBSITE_EMAIL_MAIN')!='')
                        <div class='text-right'><a href="mailto: {{ appsetting('WEBSITE_EMAIL_MAIN') }}"><i class='fa fa-envelope text-red-400'></i> <span class=' hover:text-cool-gray-800'>{{ appsetting('WEBSITE_EMAIL_MAIN') }}</span></a></div>
                    @endif
                    <div class='text-right'>
                        @if(appsetting('WEBSITE_PHONE_MAIN')!='')
                            <a href="tel: {{ appsetting('WEBSITE_PHONE_MAIN') }}"><i class='fa fa-phone-alt text-red-400'></i> <span class=' hover:text-cool-gray-800'>{{ appsetting('WEBSITE_PHONE_MAIN') }}</span></a>
                        @endif
                    </div>
                    <div class='text-right'>
                        @if(appsetting('WEBSITE_WHATSAPP_MAIN')!='')
                            <a href="tel: {{ appsetting('WEBSITE_WHATSAPP_MAIN') }}"><i class='fab fa-whatsapp text-green-400'></i> <span class=' hover:text-cool-gray-800'>{{ appsetting('WEBSITE_WHATSAPP_MAIN') }}</span></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class='md:hidden pr-2 text-red-400 text-right'>
                <i
                    @click.prevent="$('#barmenu').slideToggle();"
                    class='fas fa-bars cursor-pointer'></i>
            </div>

        </div>
    </div>
    {{-- BARMENU --}}
    @if(appsetting('website_maintenance_mode')=='false')
        <div {{--x-show.transition.opacity='showbarmenu'--}}
            id='barmenu'
            class='hidden'>
            @include('website.html.menus.menubuildervertical', [
                'root' => 'ROOT',
                'home' => route('website.welcome'),
                'login' => '', //route('login')
            ])
        </div>
    @endif
</div>
{{-- MENU --}}
@if(appsetting('website_maintenance_mode')=='false')
    <div class='invisible md:visible'>
        <div class='flex items-start justify-center absolute w-full'>
            @include('website.html.menus.menubuilderhorizontal', [
                'root' => 'ROOT',
                'home' => route('website.welcome'),
                'login' => '', //route('login')
            ])
        </div>

    </div>
@endif
