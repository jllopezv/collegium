@props([
    'label'         =>  '',
    'color'         =>  'text-gray-500',
    'classlabel'    =>  '',
    'classtext'     =>  '',
    'model'         =>  '',
    'positionlabel' =>  'after',    // after, before
    'mode'          =>  'create',
    'classcomponent'=>  '',
    'help'          =>  '',
    'group'         =>  'radiogroup',
    'options'       =>  [],
])

<div >
    <div class='mb-2'>
        <span class='{{ $classlabel }}'>{!! $label !!}</span>
    </div>
    @foreach($options as $option)
        <div class='tooltip {{ $classcomponent }} mr-4'>
            <label class="inline-flex items-center">
                @if($positionlabel=='before') <span class="mr-2 {{ $classtext }}">{!! $option['text'] !!}</span> @endif
                <input type="radio" {{ $attributes }} wire:model='{{$model}}'
                    class="form-radio cursor-pointer h-5 w-5 {{ $color }}
                        hover:shadow-none hover:border-gray-500
                        active:shadow-none
                        focus:shadow-none focus:border-gray-500"
                        @if($mode=='show')
                            onclick="return false;"
                        @endif
                    name='{{ $group }}'
                    value="{{ $option['value'] }}"
                >
                @if($positionlabel=='after') <span class="ml-1 text-sm {{ $classtext }}">{!! $option['text'] !!}</span> @endif
            </label>
            @if($help!='')
                <span class='tooltiptext tooltiptext-down-left'>{!! $help !!}</span>
            @endif
        </div>
    @endforeach
</div>
