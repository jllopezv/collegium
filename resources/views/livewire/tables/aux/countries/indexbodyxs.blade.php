<div class='mt-1 text-center'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <div>{!! $item->flag !!}</div>
        <div><span class='pr-2 font-bold'>{!! $item->country !!}</span></div>
        <div><span class='pr-2 text-gray-500'>{{ $item->iso }}{{ ($item->iso3!='')?' / '.$item->iso3:'' }}{{ ($item->numcode!='')?' / '.$item->numcode:'' }}{{ ($item->phonecode!='')?' / +'.$item->phonecode:'' }}{{ ($item->language!='')?' / '.$item->language:'' }}</span></div>
    </a>
</div>
