@props([ 'text' => null, 'icon' => null,  'ref' => '', 'help' => '', 'helpclass' =>'tooltiptext-up-center', 'textxs' => false ])

<button
    @if($ref)
        x-ref="{{$ref}}"
    @endif
    {{ $attributes->merge([
    'class' => 'inline-flex items-center tooltip
                px-4 py-2 border border-transparent
                rounded-md font-bold text-sm text-white uppercase
                focus:outline-none  focus:shadow-none
                cursor-pointer transition ease-in-out duration-150
                bg-gray-500 hover:bg-gray-600 active:bg-gray-500 focus:border-gray-500'
    ]) }}
    >

    <div class='flex items-center justify-center'>
        @if($icon)
            <div class="{{ ($text  && $textxs!==false)?'mr-1':'' }}">
                <i class='{{$icon}}'></i>
            </div>
        @endif
        @if($text)
            <div class="{{ ($slot!='' && $textxs!==false)?'mr-1':'ml-1' }} {{ $textxs===false?'hidden sm:block':'block' }}">
                {!! $text !!}
            </div>
        @endif
        <div>
            {{ $slot }}
        </div>
        @if($help!="")
            <span class='tooltiptext {{ $helpclass }}'>
                {!! $help !!}
            </span>
        @endif
    </div>
</a>
