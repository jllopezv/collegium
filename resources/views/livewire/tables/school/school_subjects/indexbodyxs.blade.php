<div class='mt-1 font-bold text-gray-500 text-center'>
    {!! $item->code !!}
</div>
<div class='mt-1 font-bold text-center'>
    {!! $item->subject !!}
</div>
<div class='mt-1 font-bold text-center text-gray-600'>
    {!! $item->grade->grade??'' !!}
</div>
@include('components.lopsoft.datatable.showannoxs')

