@php
    $item=\App\Models\School\SchoolSection::find($index);
@endphp

<div class=''>
    @if($item==null)
        TODOS
    @else
        {!! $item->sectionLabel !!}
    @endif
</div>


