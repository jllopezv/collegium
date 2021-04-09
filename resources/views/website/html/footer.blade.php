<div class=' bg-gray-800 text-white p-4'>
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

    <div class='text-center mt-4 mb-2'>
        (C) 2020 Lopsoft - <a href='https://www.lopsoft.com'>www.lopsoft.com</a>
    </div>
</div>
