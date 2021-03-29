<div class='mt-1 font-bold text-center'>
    {!! $item->menu !!}
</div>
<div class='text-center'>
    @if($item->link!='')
        <i class='fa fa-link text-blue-300'></i> {{ $item->link }}
    @else
        @if($item->page!='')
            <i class='fa fa-file-alt text-orange-300'></i> {{ $item->page->page }}
        @endif
    @endif
</div>
