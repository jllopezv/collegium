<div class='mt-3 mr-2 text-right'>
    {!! $item->getStatusFormatted() !!}
</div>
<div class='mr-2 text-right'>
    <span  class='text-gray-600'>{!! $item->showed !!}</span> <i class='fa fa-eye text-green-500'></i>
</div>
<div class='flex items-center justify-center w-full mt-1 font-bold '>
    <div class='mx-auto'>
        <img src="{!! $item->postImage !!}" class='{{ config('lopsoft.posts_index_showthumb')?'h-26':'h-20' }} rounded-lg shadow-lg' />
    </div>
</div>
<div class='mt-1  text-center text-xl'>
    {!! $item->title !!}
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->category->categoryName !!}
</div>
