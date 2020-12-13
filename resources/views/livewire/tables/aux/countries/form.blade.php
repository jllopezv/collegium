<div class='items-center justify-start w-full sm:flex'>
    <div class='w-full sm:pr-4 sm:w-3/4'>
        <x-lopsoft.control.inputform
            wire:model.lazy='country'
            id='country'
            x-ref='country'
            label="{{ transup('country') }}"
            class='w-full'
            autofocus
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory_unique') }}"
            nextref='nicename'
            mode="{{ $mode }}"
        />
    </div>
    <div class='w-full sm:w-1/4'>
        <div class='w-full py-4 ml-auto mr-0 sm:pr-4'>
            <div class='w-full'>
                <x-lopsoft.control.label
                    class="font-bold"
                    text="{{ transup('flag') }}"
                />
            </div>
            <div class='w-full'>
                {!! $flag??'' !!}
            </div>
        </div>
    </div>
</div>
<x-lopsoft.control.inputform
            wire:model.lazy='nicename'
            id='nicename'
            x-ref='nicename'
            label="{{ transup('nicename') }}"
            class='w-full'
            autofocus
            classcontainer='w-full'
            nextref='iso'
            mode="{{ $mode }}"
        />
<div class='items-center justify-start w-full sm:flex'>
    <div class='w-full sm:pr-4 sm:w-1/2'>
        <x-lopsoft.control.inputform
            wire:model.lazy='iso'
            id='iso'
            x-ref='iso'
            label="{{ transup('code') }}"
            nextref='iso3'
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
    </div>
    <div class='w-full ml-auto mr-0 sm:w-1/2 '>
        <x-lopsoft.control.inputform
            wire:model.lazy='iso3'
            id='iso3'
            x-ref='iso3'
            label="{{ transup('alpha3') }}"
            nextref='numcode'
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
    </div>
</div>
<div class='items-center justify-start w-full sm:flex'>
    <div class='w-full sm:pr-4 sm:w-1/2'>
        <x-lopsoft.control.inputform
            wire:model.lazy='numcode'
            id='numcode'
            x-ref='numcode'
            label="{{ transup('numcode') }}"
            nextref='phonecode'
            classcontainer='w-full'
            mode="{{ $mode }}"
        />
        </div>
        <div class='w-full ml-auto mr-0 sm:w-1/2 '>
        <x-lopsoft.control.inputform
            wire:model.lazy='phonecode'
            id='phonecode'
            x-ref='phonecode'
            label="{{ transup('phonecode') }}"
            nextref='language'
            classcontainer='w-full'
            mode="{{ $mode }}"
        />
    </div>
</div>
<x-lopsoft.control.inputform
    wire:model.lazy='language'
    id='language'
    x-ref='language'
    label="{{ transup('language') }}"
    nextref='btnCreate'
    classcontainer='w-full sm:w-1/3'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
