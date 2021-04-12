@php
    $item=\App\Models\Website\WebsiteAdvertisementCat::find($record['id']);
@endphp

<div class=''>
    {!! $item->categoryName !!}
</div>

