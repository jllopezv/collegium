<div class='mt-1 text-center'>
    <div class=''>
        {{ $item->configable_type }}
    </div>
    <div class='mb-4 text-xs'>
        <span class='px-2 font-bold text-green-300 rounded-md bg-cool-gray-700'>{{ $item->configable_id }}</span>
    </div>
    @php
        $itemdata=json_decode($item->data,true);
    @endphp
    @if ($itemdata!=null)
        @foreach($itemdata as $key => $value)
            <div class=''>
                <span class='font-bold'>{!! $key !!}</span> = <span class=''>{!! $value !!}</span>
            </div>
        @endforeach
    @endif
</div>
