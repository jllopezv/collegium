<div class='mt-1 font-bold text-center'>
    {!! $item->grade !!}
</div>
<div class='mt-1 font-bold text-center text-gray-600'>
    {!! $item->level!=null?$item->level->level:null !!}
</div>
@include('components.lopsoft.datatable.showannoxs')

