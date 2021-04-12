@php
    $item=\App\Models\Website\WebsiteNewsCat::find($record['id']);
@endphp

<div class=''>
    {!! $item->categoryName !!}
</div>

