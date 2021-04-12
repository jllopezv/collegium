@extends('website.layouts.cleanlayout')


@section('content')

    <div class='flex items-center justify-center'>
        <div class='w-full max-w-7xl bg-white my-4 p-2' style='min-height: 500px; '>
            <div class='mt-4 border-b border-red-400'>
                <div class='text-red-500 font-bold text-4xl text-center'>
                    FORMULARIO DE CONTACTO
                </div>
            </div>
            <div class='flex items-center justify-center'>
                <div class='mt-8 w-full max-w-3xl'>
                    <x-lopsoft.control.inputform

                        id='name'
                        x-ref='name'
                        label="{{ transup('name') }}"
                        classcontainer='w-full'
                        nextref='phone'
                        autofocus
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        mode="edit"
                    />
                    <x-lopsoft.control.inputform
                        id='phone'
                        x-ref='phone'
                        label="{{ transup('phone') }}"
                        classcontainer='w-80'
                        nextref='username'
                        autofocus
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        mode="edit"
                    />
                    <x-lopsoft.control.inputform
                        id='email'
                        x-ref='email'
                        label="{{ transup('email') }}"
                        classcontainer='w-full'
                        nextref='username'
                        autofocus
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        mode="edit"
                    />
                    <x-lopsoft.control.inputform
                        id='asunto'
                        x-ref='asunto'
                        label="{{ transup('asunto') }}"
                        classcontainer='w-full'
                        nextref='username'
                        autofocus
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        mode="edit"
                    />
                    <x-lopsoft.control.textareaform
                        id='message'
                        x-ref='message'
                        label="{{ transup('message') }}"
                        classcontainer='w-full'
                        nextref='username'
                        autofocus
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        mode="edit"
                    />
                    <div class='text-right'>
                        <x-lopsoft.button.danger text='ENVIAR' />
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
