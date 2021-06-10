@props([
    'placeholder'   => '',
    'value'         => '',
    'id'            => Str::random(20),
    'classcontainer'    => '',
    'mode'          => 'create',
    'errormsg'      =>  $errors->has('showed')?($errors->get('showed'))[0]:'',
    ])


<div class='flex items-center'>
    <div class=" {{ $classcontainer }}">
<input
    type='text'
    {{ $attributes->merge([
        'class' => 'form-input px-1 pb-1 rounded-none border-b-2 border-t-0 border-l-0 border-r-0'
                    .( $errormsg!='' ?' border-red-500 ':' border-gray-300 ' ).
                    'hover:border-gray-500 hover:shadow-none
                    active:border-gray-500 active:shadow-none
                    focus:border-gray-500 focus:shadow-none
                    focus-visible:border-gray-500 focus-visible:shadow-none
                    transition-all duration-300 w-full bg-transparent'])
    }}
    placeholder='{!! $placeholder !!}'
    @if($value)
        value='{!! $value !!}'
    @endif
>
    </div>
</div>
