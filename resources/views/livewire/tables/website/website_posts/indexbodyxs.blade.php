<div class='mt-1 font-bold text-center'>
    {!! $item->title !!}
</div>
<div class='flex items-center justify-center w-full mt-1 font-bold '>
    <div class='mx-auto'>
        <img src="{!! $item->postImage !!}" class='{{ config('lopsoft.posts_index_showthumb')?'h-26':'h-20' }} rounded-lg shadow-lg' />
    </div>
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->category->categoryName !!}
</div>
