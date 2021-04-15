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
                    wire:model.lazy='name'
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
                    wire:model.lazy='phone'
                    id='phone'
                    x-ref='phone'
                    label="{{ transup('phone') }}"
                    classcontainer='w-80'
                    nextref='email'
                    autofocus
                    requiredfield
                    help="{{ transup('mandatory') }}"
                    mode="edit"
                />
                <x-lopsoft.control.inputform
                    wire:model.lazy='email'
                    id='email'
                    x-ref='email'
                    label="{{ transup('email') }}"
                    classcontainer='w-full'
                    nextref='subject'
                    autofocus
                    requiredfield
                    help="{{ transup('mandatory') }}"
                    mode="edit"
                />
                <x-lopsoft.control.inputform
                    wire:model.lazy='subject'
                    id='subject'
                    x-ref='subject'
                    label="{{ transup('subject') }}"
                    classcontainer='w-full'
                    nextref='message'
                    autofocus
                    requiredfield
                    help="{{ transup('mandatory') }}"
                    mode="edit"
                />
                <x-lopsoft.control.textareaform
                    wire:model.lazy='message'
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
                <x-lopsoft.control.inputform
                    wire:model.lazy='captcha'
                    id='captcha'
                    name='captcha'
                    x-ref='captcha'
                    label="{{ transup('write_text') }} <span wire:click='regencaptcha' class='cursor-pointer text-xl fond-bold bg-blue-100 p-2 text-red-500'>{{ $captchagen }}</span>"
                    classcontainer='w-full'
                    requiredfield
                    help="{{ transup('mandatory') }}"
                    mode="edit"

                />

                <div class='text-right'>
                    <x-lopsoft.button.danger text='ENVIAR' wire:click='sendform' />
                </div>
            </div>
        </div>

    </div>
</div>
