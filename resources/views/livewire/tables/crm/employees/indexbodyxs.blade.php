<div class='flex items-center justify-center mt-4'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
    </a>
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->type->type??'' !!}
</div>
<div class='mt-1 text-cool-gray-500 text-center'>
    <div class='text-gray-600 font-bold'>
        {{ getDateString($item->hired) }}
    </div>
    <div class='text-sm'>
        {{ getHiredTime($item->hired) }}
    </div>
</div>

