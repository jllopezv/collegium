<div class='mt-1 text-center'>
    <span class='text-gray-600'><b>{{ $item->slug }}</b></span>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-500'>{{ $item->name }}</span>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-500'>{{ $item->permissiongroup!=null?$item->permissiongroup->group:'' }}</span>
</div>
