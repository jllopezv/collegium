<div class='flex items-center justify-center mt-4'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
    </a>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-600'><b>{{ $item->name }}</b></span>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-500'>{{ $item->username }}</span>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-400'>{{ $item->email }}</span>
</div>
