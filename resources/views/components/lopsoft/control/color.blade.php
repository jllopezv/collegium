@props([
    'label'         => '',
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
])



<div class='py-4'>
    <x-lopsoft.control.label
        class="font-bold {{ $labelclass }} {{ $errors->has($id)?'text-red-600 ':''}}"
        {{-- text="{!! $label .( $requiredfield ? '<span class=\'text-red-500\'> *</span>' : '' ) !!}" --}}
        text="{!! $label !!}"
        labelwidth="{{ $labelwidth }}"
    />

    <div class='flex items-center justify-start {{$classcontainer}}'>
        <div class=''>
            <input
                type='color'
                id="{{$id}}"
                name="{{$id}}"
                disabled='{{ $disabled ? "disabled" : "" }}'
                {{ $attributes->merge([
                    'class' => ($errors->has($id)?'border-red-500':'').' cursor-pointer '
                ]) }}
            />
        </div>
        <div class='pb-2'>
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
    </div>
    @if($showerror)
        @if( $errors->has($id) )
            <div>
                <span class='text-red-500'>{{ ($errors->get($id))[0] }}</span>
            </div>
        @endif
    @endif
    {{ $slot }}

</div>
