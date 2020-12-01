@props([
    'disabled'      => false,
    'placeholder'   => '',
    'value'         => '',
    'id'            => Str::random(20), '',
    'nextref'       => '',
    'requiredfield' => false,
    'help'          => '',
    'classcontainer'    => '',
    ])


<div class='flex items-center'>
    <div class=" {{ $classcontainer }}">
<input
    id="{{$id}}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => 'form-input px-1 pb-1 text-lg rounded-none border-b-2 border-t-0 border-l-0 border-r-0 border-gray-300
                    hover:border-gray-500 hover:shadow-none
                    active:border-gray-500 active:shadow-none
                    focus:border-gray-500 focus:shadow-none
                    transition-all duration-300 w-full'])
    }}
    placeholder='{!! $placeholder !!}'
    x-ref='{{$id}}'
    @keydown.enter='$refs.{{$nextref!=''?$nextref:$id}}.focus()'
    @if($value)
        value='{!! $value !!}'
    @endif
>
    </div>
@if($requiredfield)
<div class='tooltip  cursor-pointer'>
    <i class='fa fa-exclamation-circle fa-fw fa-xs text-red-400'></i>
    @if($help!='')
        <span class='tooltiptext tooltiptext-down-left'>
            {!! $help !!}
        </span>
    @endif
</div>
@endif
</div>
