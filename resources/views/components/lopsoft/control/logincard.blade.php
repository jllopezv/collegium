<form method='POST' action="{{ route('login') }}">
    @csrf

    @if ($errors->any())
        <div >
            <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class='h-screen flex content-center items-center'>
        <div class='w-full'>
            <div class='flex items-center justify-center '>
                <div class='bg-white rounded-lg  mx-2 lg:w-2/3 lg:mx-0 xl:w-1/2 shadow-md py-4'>
                    <div class='sm:inline-flex w-full h-full px-6 py-0 lg:py-10'>
                        <div class='py-10 sm:py-20 sm:w-2/4 self-center px-3  border-gray-200 border-b sm:border-b-0 sm:border-r'>
                            <img class='mx-auto' src='images/logo.png' />
                            <div class='text-center font-bold pt-4 text-xl'>
                                <span>CENTRO EDUCATIVO</span><br/>
                                <span>TIA SANDRA SCHOOL</span>
                            </div>
                        </div>
                        <div class='sm:w-2/4 self-center sm:px-10 px-6'>
                            <div class='mb-10 mt-10 sm:mt-0' >
                                <img class='mx-auto rounded-full h-20 w-20 md:h-24 md:w-24 border-white border-2' src='images/user.png' />
                            </div>
                            <div class='border-b border-gray-200 px-2'>
                                <x-lopsoft.control.inline-inputform
                                    labelclass='text-gray-200'
                                    id='email'
                                    placeholder='USUARIO'
                                    labelwidth='w-8'
                                    label="<i class='fa fa-user'></i>"
                                    class='text-gray-600 w-full border-0 border-shadow-0 shadow-none focus:shadow-none'/>
                            </div>
                            <div class='border-b border-gray-200 px-2'>
                                <x-lopsoft.control.inline-inputform
                                    id='password'
                                    labelclass='text-gray-200'
                                    placeholder='CONTRASEÑA'
                                    labelwidth='w-8'
                                    label="<i class='fa fa-lock'></i>"
                                    class='text-gray-600 w-full border-0 border-shadow-0 shadow-none focus:shadow-none' />
                            </div>

                        </div>

                    </div>
                    <div class='text-right pt-8 pr-4 pl-4 sm:pt-0 sm:pr-4 sm:pl-4'>
                        <x-lopsoft.button.gray  text="ENTRAR" />
                    </div>
                </div>

            </div>
            <div class='self-start text-center text-gray-400 mt-4'>
                (c) Lopsoft Sistemas 2020
            </div>
        </div>

    </div>
</form>

