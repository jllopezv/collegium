@props([
    'label'         => '',
    'sublabel'      => '',
    'placeholder'   => '',
    'disabled'      => true,
    'labelwidth'    => '',
    'labelclass'    => '',
    'id'            => Str::random(20),
    'showerror'     => true,
    'requiredfield' => false,
    'nextref'       => '',
    'help'          => '',
    'classcontainer' => '',
])



<div class='py-4 {{ $classcontainer }}'>
    <x-lopsoft.control.label
        class="font-bold {{ $labelclass }} {{ $errors->has($id)?'text-red-600 ':''}}"
        {{-- text="{!! $label .( $requiredfield ? '<span class=\'text-red-500\'> *</span>' : '' ) !!}" --}}
        text="{!! $label !!}"
        labelwidth="{{ $labelwidth }}"/>
        @if($sublabel)
            <div class='text-sm text-gray-400'>{{ $sublabel}}</div>
        @endif
        <div class='w-full px-1 pb-1 transition-all duration-300 border-t-0 border-b-2 border-l-0 border-r-0 border-gray-300 rounded-none form-input hover:border-gray-500 hover:shadow-none active:border-gray-500 active:shadow-none focus:border-gray-500 focus:shadow-none'>
            {{ $slot }}
        </div>
</div>
