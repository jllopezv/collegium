<div class='mt-1 text-center'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <div class='flex items-center justify-center '>
            <div>
                {!! $item->flag !!}
            </div>
            <div class='pt-1 pl-2 font-bold text-gray-500'>
                {{ $item->language }}
            </div>
        </div>
    </a>
</div>
