<td class='text-left px-4 py-2'>
    <input
        type='checkbox'
        wire:model='rowselected'
        {{ $attributes->merge([
        'class' =>  "form-checkbox h-5 w-5 text-green-400 cursor-pointer
                hover:shadow-none hover:border-gray-500
                active:shadow-none
                focus:shadow-none focus:border-gray-500"
    ]) }}
    />
</td>
