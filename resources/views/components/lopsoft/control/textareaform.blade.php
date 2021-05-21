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



<div class='py-4 {{ $classcomponent }}'>
    <x-lopsoft.control.label
        class="font-bold {{ $labelclass }} {{ $errors->has($id)?'text-red-600 ':''}}"
        {{-- text="{!! $label .( $requiredfield ? '<span class=\'text-red-500\'> *</span>' : '' ) !!}" --}}
        text="{!! $label !!}"
        labelwidth="{{ $labelwidth }}"/>
        @if($sublabel)
            <div class='text-sm text-gray-400'>{{ $sublabel}}</div>
        @endif
    <x-lopsoft.control.textarea
        id="{{$id}}"
        name="{{$id}}"
        disabled='{{ $disabled ? "disabled" : "" }}'
        classcontainer="{{$classcontainer}}"
        {{ $attributes->merge([
            'class' => ($errors->has($id)?'border-red-500 bg-transparent':' bg-transparent')
        ]) }}
        placeholder='{{ $placeholder }}'
        nextref='{{$nextref}}'
        requiredfield='{{$requiredfield}}'
        help='{!! $help !!}'
        mode='{{ $mode }}'
        value='{!! $value !!}'
        errormsg="{{ $errors->has($id)?($errors->get($id))[0]:'' }}"
    />

    @if($showerror)
        {{-- @if( $errors->has($id) )
            <div>
                <span class='text-red-500'>{{ ($errors->get($id))[0] }}</span>
            </div>
        @endif --}}
    @endif

    {{ $slot }}

</div>
