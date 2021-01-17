@php
    $item=\App\Models\Website\WebsitePostCat::find($record['id']);
@endphp

<div class=''>
    {!! $item->categoryName !!}
</div>

