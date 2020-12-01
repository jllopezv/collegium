@props([
    'label'         =>  '',
    'color'         =>  'text-gray-500',
    'classlabel'    =>  '',
    'model'         =>  '',
    'positionlabel' =>  'after',    // after, before
])

<div>
    <label class="inline-flex items-center">
        @if($positionlabel=='before') <span class="mr-2 text-sm {{ $classlabel }}">{{ $label }}</span> @endif
        <input type="checkbox" {{ $attributes }} wire:model='{{$model}}'
            class="form-checkbox cursor-pointer h-5 w-5 {{ $color }}
                hover:shadow-none hover:border-gray-500
                active:shadow-none
                focus:shadow-none focus:border-gray-500">
        @if($positionlabel=='after') <span class="ml-2 text-sm {{ $classlabel }}">{{ $label }}</span> @endif
    </label>
</div>
