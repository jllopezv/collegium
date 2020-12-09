@props([ 'readonly' => false])

<td class='px-4 py-2 text-left'>
    <input
        type='checkbox'
        wire:model='rowselected'
        {{ $attributes->merge([
        'class' =>  "form-checkbox h-5 w-5 text-green-400 cursor-pointer
                hover:shadow-none hover:border-gray-500
                active:shadow-none
                focus:shadow-none focus:border-gray-500"
    ]) }}
        {{ $readonly!==false ? 'disabled' : '' }}
    />
</td>
