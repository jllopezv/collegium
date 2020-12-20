<div class='mt-1 font-bold text-center'>
    @if($item->current)<i class='text-green-400 far fa-check-circle'></i>@endif {{ $item->anno }}
</div>
<div class='mt-1 text-center'>
    {{ getDateString($item->anno_start) }} - {{ getDateString($item->anno_end) }}
</div>

