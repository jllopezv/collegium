<div class=' bg-gray-800 text-white p-4'>

    <div class='flex flex-wrap items-start justify-between'>
        <div class='w-full md:w-1/2 border-r-0  md:border-r border-dashed border-gray-400 text-center md:text-left'>
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
                        <i class='fa fa-phone-alt'></i> {!! appsetting('WEBSITE_PHONE_MAIN') !!}
                    </a>
                @endif
            </div>
            <div class='text-md'>
                @if(appsetting('WEBSITE_WHATSAPP_MAIN')!='')
                    <a href='tel:{!! appsetting('WEBSITE_WHATSAPP_MAIN') !!}'>
                        <i class='fab fa-whatsapp '></i> {!! appsetting('WEBSITE_WHATSAPP_MAIN') !!}
                    </a>
                @endif
            </div>
            <div class='text-md'>
                @if(appsetting('WEBSITE_EMAIL_MAIN')!='')
                    <a href='mailto:{!! appsetting('WEBSITE_EMAIL_MAIN') !!}'>
                        <i class='fa fa-envelope '></i> {!! appsetting('WEBSITE_EMAIL_MAIN') !!}
                    </a>
                @endif
            </div>
        </div>
        <div class='w-full md:w-1/2 md:text-right border-t border-dashed border-gray-400 mt-4 mb-4 md:mt-0 md:border-t-0 text-center'>
            @if(appsetting('WEBSITE_SOCIAL_FACEBOOK')!='' || appsetting('WEBSITE_SOCIAL_TWITTER')!='' || appsetting('WEBSITE_SOCIAL_INSTAGRAM')!='' || appsetting('WEBSITE_SOCIAL_YOUTUBE')!='')
                <div class='mt-4 md:mt-0'>
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
