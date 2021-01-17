@php
    $record=\App\Models\Website\WebsitePostCat::find($record['id']);
@endphp

<div class=''>
    {!! $record->categoryName !!}
</div>

