<div class='mt-1 font-bold text-center'>
    @if($item->current)<i class='text-green-400 far fa-check-circle'></i>@endif {{ $item->currency }}
</div>
<div class='mt-1 font-bold text-center text-cool-gray-600'>
    {{ $item->code }}
</div>
<div class='mt-1 font-bold text-center text-cool-gray-500'>
    {{ ($item->rate!=1?number_format($item->rate,2):$item->rate).($item->rate!=1?' / '.number_format(1/$item->rate,2):' / '.$item->rate) }}
</div>
<div class='mt-1 font-bold text-center text-cool-gray-400'>
    {{ $item->getString('1234567.0123456789') }}
</div>


