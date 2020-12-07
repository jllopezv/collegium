<div>
    @if($option['value']=='M')
    <i class='text-blue-400 fa fa-mars'></i>
    @else
        <i class='text-pink-400 fa fa-venus'></i>
    @endif
    {!! $option['text'] !!}
</div>
