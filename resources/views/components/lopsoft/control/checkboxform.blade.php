@props([
    'label'         =>  '',
    'color'         =>  'text-gray-500',
    'classlabel'    =>  '',
    'model'         =>  '',
])

<div class='py-3'>
    <div>
        <label class="inline-flex items-center">
            <span class="{{ $classlabel }}">{{ $label }}</span>
        </label>
    </div>
    <div class='pt-2'>
        <input type="checkbox" {{ $attributes }} wire:model='{{$model}}'
            class="form-checkbox cursor-pointer h-5 w-5 {{ $color }}
                hover:shadow-none hover:border-gray-500
                active:shadow-none
                focus:shadow-none focus:border-gray-500">
    </div>
</div>
