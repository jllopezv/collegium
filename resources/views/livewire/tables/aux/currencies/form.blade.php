<x-lopsoft.control.inputform
    wire:model.lazy='currency'
    id='currency'
    x-ref='currency'
    label="{{ transup('currency') }}"
    nextref='symbol'
    classcontainer='w-full sm:w-2/3'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='code'
    id='code'
    x-ref='code'
    label="{{ transup('code') }}"
    sublabel="<a class='hover:text-cool-gray-600 cursor-pointer' href='https://www.iso.org/iso-4217-currency-codes.html' target='_blank'>ISO 4217</a>( USD, EUR, DOP, ... )"
    nextref='symbol'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='symbol'
    id='symbol'
    x-ref='symbol'
    label="{{ transup('symbol') }}"
    nextref='left'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.checkboxform
    id='left'
    label="{{ transup('left_position') }}"
    sublabel='Posición del símbolo'
    color='text-blue-400' classlabel='font-bold'
    wire:model='left'
/>

<x-lopsoft.control.inputform
    wire:model.lazy='spaces'
    id='spaces'
    x-ref='spaces'
    label="{{ transup('spaces') }}"
    nextref='left'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='decimals'
    id='decimals'
    x-ref='decimals'
    label="{{ transup('decimals') }}"
    nextref='left'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='decimals_separator'
    id='decimals_separator'
    x-ref='decimals_separator'
    label="{{ transup('decimals_separator') }}"
    nextref='left'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='thousands_separator'
    id='thousands_separator'
    x-ref='thousands_separator'
    label="{{ transup('thousands_separator') }}"
    nextref='left'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<div class='flex items-center justify-start'>
    <div class=''>
        <x-lopsoft.control.inputform
            wire:model.lazy='rate'
            id='rate'
            x-ref='rate'
            label="{{ transup('rate') }}"
            nextref='left'
            classcontainer='w-32'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
    </div>
    @if($mode!='show')
        <div class=''>
            <x-lopsoft.button.gray  icon='fa fa-download' wire:click='updateCurrency'  class='ml-1'/>
        </div>
    @endif
</div>

<x-lopsoft.control.inputform
    wire:model.lazy='preview'
    id='preview'
    x-ref='preview'
    label="{{ transup('preview') }}"
    nextref='btnCreate'
    classcontainer='w-full'
    mode="show"
/>
