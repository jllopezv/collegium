@php
    $menu=App\Models\Website\WebsiteMenu::where('menu',$root)->first();
    if ($menu!=null) $childrens=$menu->childrens();
@endphp

<div class='menu-vertical'>

    @if($menu->link!='')
        <a href='{{$menu->link}}'>{{ $menu->label }}</a>
    @else
        <a href='{{ route('website.showpage', [ 'id' => $menu->website_page_id ] ) }}'>{{ $menu->label }}</a>
    @endif

</div>
