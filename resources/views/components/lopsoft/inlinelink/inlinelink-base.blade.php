@props([
    'text'  => null,
    'icon'  => null,
    'link'  => null,
    'ref'   => '',
    'help'  => '',
    'helpclass' => 'tooltiptext-up-center',
    'textxs' => false  ])

<a
    @if($ref)
        x-ref="{{$ref}}"
    @endif
    {{ $attributes->merge([
    'class' => 'inline-flex items-center tooltip
                border border-transparent
                rounded-md font-bold text-sm text-white uppercase
                focus:outline-none  focus:shadow-none
                cursor-pointer transition ease-in-out duration-150
                bg-transparent hover:bg-transparent'
    ]) }}

    @if($link)
        href='{!! $link !!}'
    @endif

    >

    <div class='flex items-center justify-center '>
        @if($icon)
            <div class="">
                <i class='{!! $icon !!}'></i>
            </div>
        @endif
        @if($text)
            <div class="{{ ($slot!='' && $textxs!==false)?'mr-1':'ml-1' }}  {{ $textxs===false?'hidden sm:block':'block' }}">
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
