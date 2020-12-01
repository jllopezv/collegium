@props([
    'label'         => '',
    'placeholder'   => '',
    'disabled'      => false,
    'labelwidth'    => '',
    'labelclass'    => '',
    'id'            => '',
    'showerror'     => true,
    'requiredfield' => false,
    'nextref'       => '',
    'help'          => '',
])

<div class='inline-flex items-center justify-center text-left py-2 w-full'>
    <div>
        <x-lopsoft.control.label class="{{ $labelclass }}" text="{!! $label !!}"  labelwidth="{{ $labelwidth }}" />
    </div>
    <div class='w-full'>
        <x-lopsoft.control.input
            id='{{ $id }}'
            disabled='{{ $disabled ? "disabled" : "" }}'
            {{ $attributes }}
            placeholder='{{ $placeholder }}'
            nextref='{{ $nextref }}'
            requiredfield='{{$requiredfield}}'
            help='{!! $help !!}'
            />
            @if($showerror)
                @if( $errors->has($id) )
                    <span class='text-red-500'>{{ ($errors->get($id))[0] }}</span>
                @endif
            @endif

            {{ $slot }}
    </div>
</div>
