@if(appsetting('customers_avatar'))
    <div class='flex items-center justify-center mt-4'>
        <a href="{{ route($table.'.show',$item->id) }}">
            <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
        </a>
    </div>
@endif
<div class='mt-1 font-bold text-center'>
    {!! $item->customer !!}
</div>
<div class='mt-1 text-cool-gray-500 text-center'>
    <div class='text-gray-600 font-bold'>
        {{ $item->rnc }}
    </div>
</div>
<div class='mt-1 font-bold text-center text-cool-gray-400'>
    {!! $item->type->type??'' !!}
</div>


