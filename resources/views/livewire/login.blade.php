<div x-data='{}'>
    <form method='POST' action="{{ route('login') }}">
        @csrf

        <div class='h-screen flex content-center items-center'>

            <div class='w-full'>
                <div class='mb-10 mt-40 sm:mt-0' >
                    <img class='w-80 mx-auto' src='{{ Illuminate\Support\Facades\Storage::disk('public')->url(config('lopsoft.vendorlogo_overblack')) }}' />
                </div>
                <div class='flex items-center justify-center '>

                    <div class='bg-white rounded-lg  mx-2 lg:w-2/3 lg:mx-0 xl:w-1/2 shadow-md py-4'>
                        <div class='sm:inline-flex w-full h-full  py-0 lg:py-10'>
                            <div class='py-10 sm:py-20 sm:w-2/4 self-center px-3  border-gray-200 border-b sm:border-b-0 sm:border-r'>
                                <img class='mx-auto' src='{{ Illuminate\Support\Facades\Storage::disk('public')->url(config('lopsoft.loginlogo')) }}' />
                                <div class='text-center pt-4 text-xl'>
                                    <span class='{{ config('lopsoft.title_line1_class') }}'>{{ config('lopsoft.title_line1') }}</span><br/>
                                    <span class='{{ config('lopsoft.title_line2_class') }}'>{{ config('lopsoft.title_line2') }}</span>
                                </div>
                            </div>
                            <div class='sm:w-2/4 self-center sm:px-4 px-6'>
                                <div class='mb-10 mt-10 sm:mt-0' >
                                    <img class='mx-auto rounded-full h-20 w-20 md:h-24 md:w-24 border-gray-200 border-4' src='{{ $avatar }}' />
                                </div>
                                    @if($errors->any())
                                        <div class=' w-full p-2 text-white bg-red-400 text-center font-bold'>
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
                                        <div class='w-full p-2 text-white bg-red-400 text-center font-bold'>
                                            {{ mb_strtoupper(__('login.auth_error')) }}
                                        </div>
                                    @endif
                                    {{-- {{ $errors->has('form.username') ? 'border-b-2 border-red-400' : 'border-b border-gray-200' }} --}}
                                <div  class='mx-6 px-6'>
                                    <x-lopsoft.control.inline-inputform
                                        wire:model.lazy='form.username'
                                        wire:focusout='loadImage'
                                        labelclass='text-gray-200'
                                        nextref='formpassword'
                                        id='formusername'
                                        placeholder="{{ mb_strtoupper(__('login.user')) }}"
                                        labelwidth='w-8'
                                        label="<i class='fa fa-user'></i>"
                                        class='text-gray-600 w-full border-shadow-0 shadow-none focus:shadow-none border-0'
                                        autofocus
                                        showerror='0'

                                        />
                                </div>
                                {{-- {{ $errors->has('form.password') ? 'border-b-2 border-red-400' : 'border-b border-gray-200' }} --}}
                                <div class='mx-6 px-6'>
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
                                        class='text-gray-600 w-full border-0 border-shadow-0 shadow-none focus:shadow-none'
                                        showerror='0'
                                        />
                                </div>
                            </div>
                        </div>
                        <div class='flex justify-between items-end'>
                            <div class='px-4 text-gray-500'>
                                <a class='hover:text-gray-700' href=''>¿Olvidó su contraseña?</a>
                            </div>
                            <div class='pt-8 pr-4 pl-4 sm:pt-0 sm:pr-4 sm:pl-4'>
                                <x-lopsoft.link.gray  id='btnLogin' wire:click='submit' text="ENTRAR" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class='self-start text-center text-gray-400 mt-4'>
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
