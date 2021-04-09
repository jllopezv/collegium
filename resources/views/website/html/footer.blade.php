<div class=' bg-gray-800 text-white p-4'>

    <div class='flex flex-wrap items-start justify-between'>
        <div class='w-full md:w-1/2'>
            <div class='text-2xl font-bold'>
                {!! appsetting('WEBSITE_BUSINESS_NAME') !!}
            </div>
            <div class='text-sm'>
                {!! appsetting('WEBSITE_BUSINESS_ADDRESS1') !!}
            </div>
            <div class='text-sm'>
                {!! appsetting('WEBSITE_BUSINESS_ADDRESS2') !!}
            </div>
            <div class='text-md mt-4'>
                @if(appsetting('WEBSITE_PHONE_MAIN')!='')
                    <a href='tel:{!! appsetting('WEBSITE_PHONE_MAIN') !!}'>
                        <i class='fa fa-phone-alt text-red-400'></i> {!! appsetting('WEBSITE_PHONE_MAIN') !!}
                    </a>
                @endif
            </div>
            <div class='text-md'>
                @if(appsetting('WEBSITE_WHATSAPP_MAIN')!='')
                    <a href='tel:{!! appsetting('WEBSITE_WHATSAPP_MAIN') !!}'>
                        <i class='fab fa-whatsapp text-green-400'></i> {!! appsetting('WEBSITE_WHATSAPP_MAIN') !!}
                    </a>
                @endif
            </div>
            <div class='text-md'>
                @if(appsetting('WEBSITE_EMAIL_MAIN')!='')
                    <a href='mailto:{!! appsetting('WEBSITE_EMAIL_MAIN') !!}'>
                        <i class='fa fa-envelope text-red-400'></i> {!! appsetting('WEBSITE_EMAIL_MAIN') !!}
                    </a>
                @endif
            </div>
        </div>
        <div class='w-full md:w-1/2 text-right'>
            @if(appsetting('WEBSITE_SOCIAL_FACEBOOK')!='' || appsetting('WEBSITE_SOCIAL_TWITTER')!='' || appsetting('WEBSITE_SOCIAL_INSTAGRAM')!='' || appsetting('WEBSITE_SOCIAL_YOUTUBE')!='')
                <div class=''>
                    SIGUENOS EN
                </div>
                @if(appsetting('WEBSITE_SOCIAL_FACEBOOK')!='')
                    <span class=''><a href='https://www.facebook.com/{{ appsetting('WEBSITE_SOCIAL_FACEBOOK') }}'><i class='fab fa-facebook fa-2x text-blue-500'></i></a></span>
                @endif
                @if(appsetting('WEBSITE_SOCIAL_INSTAGRAM')!='')
                    <span class=''><a href='https://www.instagram.com/{{ appsetting('WEBSITE_SOCIAL_INSTAGRAM') }}'><i class='fab fa-instagram fa-2x text-pink-500'></i></a></span>
                @endif
                @if(appsetting('WEBSITE_SOCIAL_TWITTER')!='')
                    <span class=''><a href='https://twitter.com/{{ appsetting('WEBSITE_SOCIAL_TWITTER') }}'><i class='fab fa-twitter fa-2x text-blue-300'></i></a></span>
                @endif
                @if(appsetting('WEBSITE_SOCIAL_YOUTUBE')!='')
                    <span class=''><a href='https://youtube.com/{{ appsetting('WEBSITE_SOCIAL_YOUTUBE') }}'><i class='fab fa-youtube fa-2x text-red-500'></i></a></span>
                @endif
            @endif
        </div>
    </div>

    <div class='text-center mt-4 mb-2'>
        (C) 2020 Lopsoft - <a href='https://www.lopsoft.com'>www.lopsoft.com</a>
    </div>
</div>
