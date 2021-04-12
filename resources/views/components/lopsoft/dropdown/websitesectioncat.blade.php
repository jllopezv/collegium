@php
    $item=\App\Models\Website\WebsiteSectionCat::find($record['id']);
@endphp

<div class=''>
    {!! $item->categoryName !!}
</div>

