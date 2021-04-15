@extends('website.layouts.cleanlayout')

@section('content')

    <div x-data='{}' style='min-height: 500px'>

        <div class='w-full flex flex-wrap items-center justify-center'>
        <div class='bg-white flex flex-wrap items-center justify-center p-4 m-4 w-full md:max-w-7xl'>
            <div class='w-full xl:w-1/2'>
                <div class='text-center font-bold text-red-500 text-4xl '>
                    {{ appsetting('website_business_name')}}
                </div>
                <div class='text-center font-bold text-gray-400 text-xl '>
                    {{ appsetting('website_business_address1')}}
                </div>
                <div class='text-center font-bold text-gray-400 text-xl '>
                    {{ appsetting('website_business_address2')}}
                </div>
                <div class='text-center text-gray-400 hover:text-gray-600 text-lg mt-8'>
                    <a href='tel: {{ appsetting('website_phone_main')}}'><i class='text-red-400 fa fa-phone-alt'></i> {{ appsetting('website_phone_main')}}</a>
                </div>
                <div class='text-center text-gray-400 text-lg hover:text-gray-600'>
                    <a href='tel: {{ appsetting('website_whatsapp_main')}}'><i class='text-green-400 fab fa-whatsapp'></i> {{ appsetting('website_whatsapp_main')}}</a>
                </div>
                <div class='mt-4 text-center text-gray-400 text-lg hover:text-gray-600'>
                    <a href='mailto: {{ appsetting('website_email_main')}}'><i class='text-red-400 fa fa-envelope'></i> {{ appsetting('website_email_main')}}</a>
                </div>
                @if(appsetting('website_email2')!="")
                    <div class='mt-4 text-center text-gray-400 text-lg hover:text-gray-600'>
                        <a href='mailto: {{ appsetting('website_email2')}}'><i class='text-red-400 fa fa-envelope'></i> {{ appsetting('website_email2')}}</a>
                    </div>
                @endif
                @if(appsetting('website_email3')!="")
                    <div class='mt-4 text-center text-gray-400 text-lg hover:text-gray-600'>
                        <a href='mailto: {{ appsetting('website_email3')}}'><i class='text-red-400 fa fa-envelope'></i> {{ appsetting('website_email3')}}</a>
                    </div>
                @endif
                <div class='text-center mt-4 mb-8'>
                    <x-lopsoft.link.danger link="{{ route('website.contactus') }}" text='CONTACTAR' />
                </div>
            </div>
            <div class='w-full xl:w-1/2 bg-yellow-100'>
                <iframe class='shadow-lg bg-white h-80 md:h-96' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3779.4190277204857!2d-68.45104086976045!3d18.690049045898114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ea8eb6df8a1744b%3A0xa5e01b8dcdcb6d87!2sTia%20Sandra%20School!5e0!3m2!1ses-419!2sdo!4v1591050415372!5m2!1ses-419!2sdo" width="100%" height="auto" frameborder="0" style="" allowfullscreen="1" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>

    </div>

@endsection
