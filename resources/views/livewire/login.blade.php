<div x-data='{}'>
    <form method='POST' action="{{ route('login') }}">
        @csrf

        <div class='flex items-center content-center h-screen'>

            <div class='w-full'>
                <div class='mt-40 mb-10 sm:mt-0' >
                    <img class='mx-auto w-80' src="{{ Illuminate\Support\Facades\Storage::disk('public')->url(appsetting('vendorlogo_overblack')) }}" />
                </div>

                <div class='flex items-center justify-center '>
                    <div class='py-4 mx-2 bg-white rounded-lg shadow-md lg:w-2/3 lg:mx-0 xl:w-1/2'>
                        @if(appsetting('maintenance_mode'))
                            <div class='w-full bg-red-500 text-white p-2 text-center text-xl font-bold'>
                                {{ transup('maintenance_mode') }}
                            </div>
                        @endif
                        <div class='w-full h-full py-0 sm:inline-flex lg:py-10'>

                            <div class='self-center px-3 py-10 border-b border-gray-200 sm:py-20 sm:w-2/4 sm:border-b-0 sm:border-r'>
                                <img class='mx-auto' src='{{ Illuminate\Support\Facades\Storage::disk('public')->url(appsetting('loginlogo')) }}' />
                                <div class='pt-4 text-xl text-center'>
                                    <span class='{{ appsetting('title_line1_class') }}'>{{ appsetting('title_line1') }}</span><br/>
                                    <span class='{{ appsetting('title_line2_class') }}'>{{ appsetting('title_line2') }}</span>
                                </div>
                            </div>
                            <div class='self-center px-6 sm:w-2/4 sm:px-4'>
                                <div class='mt-10 mb-10 sm:mt-0' >
                                    @if (appsetting('showavatar'))
                                        <img class='w-20 h-20 mx-auto border-4 border-gray-200 rounded-full md:h-24 md:w-24' src='{{ $avatar }}' />
                                    @endif
                                </div>
                                    @if($errors->any())
                                        <div class='w-full p-2 font-bold text-center text-white bg-red-400 '>
                                            @if ( $errors->has('form.username') )
                                                {{ mb_strtoupper(__('login.username_mandatory')) }}
                                            @elseif ( $errors->has('form.password') )
                                                @if ($form['password']=='' )
                                                    {{ mb_strtoupper(__('login.password_mandatory')) }}
                                                @else
                                                    {{ mb_strtoupper(__('login.auth_error')) }}
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ( session()->has('error') )
                                        <div class='w-full p-2 font-bold text-center text-white bg-red-400'>
                                            {{ mb_strtoupper(__('login.auth_error')) }}
                                        </div>
                                    @endif
                                    {{-- {{ $errors->has('form.username') ? 'border-b-2 border-red-400' : 'border-b border-gray-200' }} --}}
                                <div  class='px-6 mx-6'>
                                    <x-lopsoft.control.inline-inputform
                                        wire:model.lazy='form.username'
                                        wire:focusout='loadImage'
                                        labelclass='text-gray-200'
                                        nextref='formpassword'
                                        id='formusername'
                                        placeholder="{{ mb_strtoupper(__('login.user')) }}"
                                        labelwidth='w-8'
                                        label="<i class='fa fa-user'></i>"
                                        class='w-full text-gray-600 border-0 shadow-none border-shadow-0 focus:shadow-none'
                                        autofocus
                                        showerror='0'

                                        />
                                </div>
                                {{-- {{ $errors->has('form.password') ? 'border-b-2 border-red-400' : 'border-b border-gray-200' }} --}}
                                <div class='px-6 mx-6'>
                                    <x-lopsoft.control.inline-inputform
                                        wire:model.lazy='form.password'
                                        onkeydown="introLogin()"
                                        id='formpassword'
                                        nextref='formusername'
                                        type='password'
                                        labelclass='text-gray-200'
                                        placeholder="{{ mb_strtoupper(__('login.password')) }}"
                                        labelwidth='w-8'
                                        label="<i class='fa fa-lock'></i>"
                                        class='w-full text-gray-600 border-0 shadow-none border-shadow-0 focus:shadow-none'
                                        showerror='0'
                                        />
                                </div>
                            </div>
                        </div>
                        <div class='flex items-end justify-between'>
                            <div class='px-4 text-gray-500'>
                                <a class='hover:text-gray-700' href=''>¿Olvidó su contraseña?</a>
                            </div>
                            <div class='pt-8 pl-4 pr-4 sm:pt-0 sm:pr-4 sm:pl-4'>
                                <x-lopsoft.link.gray  id='btnLogin' wire:click='submit' text="ENTRAR" textxs />
                            </div>
                        </div>
                    </div>
                </div>
                <div class='self-start mt-4 text-center text-gray-400'>
                    {{-- {{ config('lopsoft.copyright') }} --}}

                    <x-lopsoft.control.span>{{ config('lopsoft.copyright') }} - </x-lopsoft.control.span>
                    <x-lopsoft.control.link link="{{ config('lopsoft.vendorlink') }}">{{ config('lopsoft.vendorweb') }}</x-lopsoft.control.link>
                </div>
            </div>
        </div>
    </form>


</div>

<script>

    function tabNext()
    {

        if (event.which==13)
        {
            element=document.getElementById('form.password').focus();
        }

    }

    function introLogin()
    {
        if (event.which==13)
        {
            element=document.getElementById('btnLogin').click();
            document.getElementById('username').focus();
        }

    }

</script>
