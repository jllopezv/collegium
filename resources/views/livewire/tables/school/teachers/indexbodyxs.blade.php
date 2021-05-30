<div class='flex items-center justify-center mt-4'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
    </a>
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->teacher !!}
</div>
<div class='mt-1 text-cool-gray-500 text-center'>
    {!! $item->user->username??'' !!}
</div>
<div class='mt-1 text-cool-gray-400 text-center'>
    {!! $item->user->email??'' !!}
</div>
