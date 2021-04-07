<div class='mt-1 font-bold text-center p-2'>
    <img class='rounded' src="{!! getImage(is_null($item->image)?'':$item->image->image, config('lopsoft.banners_index_showthumb')) !!}" />
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->banner !!}
</div>
<div class='mt-1 text-gray-500 text-center'>
    <i class='fa fa-arrows-alt-h'></i> {{ $item->width }} <i class='fa fa-arrows-alt-v'></i> {{ $item->height }} <i class='fa fa-image text-orange-400'></i> {{ count($item->images) }}
</div>
