<div >

    <div class='px-4 py-5 text-xl bg-white shadow'>
        <div class="">DATOS DEL PERFIL</div>
        <div class="text-gray-500">{{ Auth::user()->name }}</div>
    </div>

    <div class='w-full px-2 pt-2 mx-auto'>

            <div class='flex flex-col items-center justify-center w-full sm:p-4'>

                {{-- AVATAR --}}
                <div class='w-full'>
                    <div class='items-center'>
                        <div class='items-center w-full p-10 mx-auto bg-white rounded-lg shadow lg:w-2/3 xl:w-1/3'>
                            @livewire('auth.user-avatar', ['canmodify'=>true])
                            <div class='mt-4 text-center'>
                                <div class=''>
                                    <span class='font-bold text-gray-500'>{{ $username}} </span>
                                </div>
                                <div class=''>
                                    <span class='text-sm text-gray-400'>{{ $email}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PERSONAL INFO --}}
                <div class='w-full mt-4 border-t-2 border-gray-200 xl:w-2/3'>
                    <div class='flex flex-wrap items-start justify-center w-full mt-4'>
                        <div class='w-full mb-4 md:w-1/2 md:mb-0'>
                            <div class='font-bold text-md'>
                                <span>INFORMACIÓN PERSONAL</span>
                            </div>
                            <div class='text-sm text-gray-400'>
                                <span>Actualice su información personal: nombre y dirección de correo electrónico</span>
                            </div>
                        </div>
                        <div class='w-full mb-4 md:w-1/2'>
                            {{-- PERSONAL INFO --}}
                            <div class='w-full p-4 overflow-hidden text-gray-700 bg-white rounded-lg shadow md:p-8'>
                                <div class='mt-2'>
                                    <x-lopsoft.control.inputform
                                        wire:model.lazy='name'
                                        x-ref='name'
                                        id='name'
                                        name='name'
                                        @keydown.tab.prevent=' $refs.email.focus() '
                                        @keydown.enter.prevent='$refs.email.focus()'
                                        label='NOMBRE'
                                        class="w-full"
                                        autofocus
                                    >
                                    </x-lopsoft.control.inputform>
                                    <x-lopsoft.control.inputform
                                        wire:model.lazy='email'
                                        x-ref='email'
                                        id='email'
                                        name='email'
                                        @keydown.tab.prevent=' $refs.oldpassword.focus() '
                                        @keydown.enter.prevent='$refs.oldpassword.focus()'
                                        label='EMAIL'
                                        class='w-full'
                                    />
                                </div>

                                @livewire('messages.flash-message', ['msgid' => 'profileInfo'] )

                                <div class='mt-4 text-right'>
                                    <x-lopsoft.button.gray
                                        wire:click='updateProfileInformation'>
                                        <div class='flex items-center justify-center'>
                                            <div wire:loading><i class="fas fa-sync fa-spin"></i></div>
                                            <div wire:loading.remove><i class="fas fa-sync"></i></div>
                                            <div  class='pl-1'>ACTUALIZAR</div>
                                        </div>
                                    </x-lopsoft.button.gray>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='w-full mb-4 border-t-2 border-gray-200 xl:w-2/3'>
                    <div class='flex flex-wrap items-start justify-center w-full mt-4'>
                        <div class='w-full mb-4 md:w-1/2 md:mb-0'>
                            <div class='font-bold text-md'>
                                <span>CONTRASEÑA</span>
                            </div>
                            <div class='text-sm text-gray-400'>
                                <span>Actualice su contraseña. Asegúrese de utilizar una contraseña lo suficientemente compleja. Usando números, letras y símbolos.</span>
                            </div>
                        </div>
                        <div class='w-full md:w-1/2'>
                            <div class='w-full p-4 overflow-hidden text-gray-700 bg-white rounded-lg shadow md:p-8'>

                                <form wire:submit.prevent='updatePassword'>
                                    <div class='mt-2'>
                                        <x-lopsoft.control.inputform
                                            wire:model.lazy='state.current_password'
                                            x-ref='current_password'
                                            id='current_password'
                                            @keydown.tab.prevent=' $refs.password.focus() '
                                            @keydown.enter.prevent=' $refs.password.focus()'
                                            label='CONTRASEÑA ACTUAL'
                                            class='w-full xl:w-3/4'
                                            type='password'
                                        />
                                        <x-lopsoft.control.inputform
                                            wire:model.lazy='state.password'
                                            x-ref='password'
                                            id='password'
                                            name='password'
                                            @keydown.tab.prevent=' $refs.password_confirmation.focus() '
                                            @keydown.enter.prevent=' $refs.password_confirmation.focus() '
                                            label='NUEVA CONTRASEÑA'
                                            class="w-full xl:w-3/4"
                                            type='password'

                                        >
                                        </x-lopsoft.control.inputform>
                                        <x-lopsoft.control.inputform
                                            wire:model.lazy='state.password_confirmation'
                                            x-ref='password_confirmation'
                                            id='password_confirmation'
                                            name='password_confirmation'
                                            @keydown.tab.prevent=' $refs.name.focus() '
                                            label='REPETIR CONTRASEÑA'
                                            class='w-full xl:w-3/4'
                                            type='password'
                                        />
                                    </div>

                                    @livewire('messages.flash-message', ['msgid' => 'passwordUpdate'] )

                                    <div class='mt-4 text-right'>
                                        <x-lopsoft.button.gray
                                            type='submit'>
                                            <div class='flex items-center justify-center'>
                                                <div wire:loading><i class="fas fa-sync fa-spin"></i></div>
                                                <div wire:loading.remove><i class="fas fa-sync"></i></div>
                                                <div  class='pl-1'>CAMBIAR</div>
                                            </div>
                                        </x-lopsoft.button.gray>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
