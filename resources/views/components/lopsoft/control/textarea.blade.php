@props([
    'disabled'      => false,
    'placeholder'   => '',
    'value'         => '',
    'id'            => Str::random(20), '',
    'nextref'       => '',
    'requiredfield' => false,
    'help'          => '',
    'classcontainer'    => '',
    'mode'          => 'create',
    'errormsg'         =>  '',
    'rows'          =>  10,
    ])


<div class='flex items-start'>
    <div class=" {{ $classcontainer }}">
<textarea
    id="{{$id}}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => 'form-input px-1 pb-1 rounded-none border-b-2 border-t-1 border-l-1 border-r-1 border-gray-300
                    hover:border-gray-500 hover:shadow-none
                    active:border-gray-500 active:shadow-none
                    focus:border-gray-500 focus:shadow-none
                    transition-all duration-300 w-full'])
    }}
    placeholder='{!! $placeholder !!}'
    x-ref='{{$id}}'
    {{-- @keydown.enter='$refs.{{$nextref!=''?$nextref:$id}}.focus()' --}}
    {{-- @if($value)
        value='{!! $value !!}'
    @endif --}}
    @if($mode=='show')
        readonly
    @endif
    rows='{{ $rows }}'
>{!! $value !!}</textarea>
    </div>
    @if($errormsg=='')
        @if($requiredfield && ( $mode!='show'))
            <div class='cursor-pointer tooltip' onclick="ShowInfo('{!! $help !!}')">
                <i class='text-blue-400 fa fa-exclamation-circle fa-fw fa-xs'></i>
                @if($help!='')
                    <span class='tooltiptext tooltiptext-down-left'>
                        {!! $help !!}
                    </span>
                @endif
            </div>
        @endif
    @else
        <div onclick="ShowError('{!! $errormsg !!}')">
            <i class='text-red-400 cursor-pointer fa fa-exclamation-triangle fa-fw fa-xs'></i>
        </div>
    @endif
</div>
