@props([
    'label'         => '',
    'sublabel'      => '',
    'placeholder'   => '',
    'disabled'      => false,
    'labelwidth'    => '',
    'labelclass'    => '',
    'id'            => Str::random(20),
    'showerror'     => true,
    'requiredfield' => false,
    'nextref'       => '',
    'help'          => '',
    'classcontainer' => '',
    'mode'          =>  'create',
    'value'         =>  '',
    'classcomponent' => '',
])

<div class='{{ $label!=""?'py-4':''}} {{ $classcomponent }}'>
    @if($label!='')
        <x-lopsoft.control.label
            class="font-bold {{ $labelclass }} {{ $errors->has($id)?'text-red-600 ':''}}"
            {{-- text="{!! $label .( $requiredfield ? '<span class=\'text-red-500\'> *</span>' : '' ) !!}" --}}
            labelwidth="{{ $labelwidth }}">
            {!! $label !!}
            @if($sublabel!="")
                <div class='text-sm text-gray-400 font-normal'>{!! $sublabel !!}</div>
            @endif
        </x-lopsoft.control.label>
    @endif
    <x-lopsoft.control.input
        id="{{$id}}"
        name="{{$id}}"
        disabled='{{ $disabled ? "disabled" : "" }}'
        classcontainer="{{$classcontainer}}"
        {{ $attributes->merge([
            'class' => ($errors->has($id)?'border-red-500':'')
        ]) }}
        placeholder='{{ $placeholder }}'
        nextref='{{$nextref}}'
        requiredfield='{{$requiredfield}}'
        help='{!! $help !!}'
        mode='{{ $mode }}'
        value='{!! $value !!}'
        errormsg="{{ $errors->has($id)?($errors->get($id))[0]:'' }}"
    >

    {{ $slot }}

    </x-lopsoft.control.input>
</div>
