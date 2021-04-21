@php
    $parentmenu=App\Models\Website\WebsiteMenu::where('menu',$root)->first();
    if ($parentmenu!=null)
    {
        $menu=App\Models\Website\WebsiteMenu::where('parent_id',$parentmenu->id)->orderBy('priority','asc')->get();
    }
@endphp

@if($home!='')
    <div class='menu-root'>
        <a href='{{$home}}'>INICIO</a>
    </div>
@endif

@forelse($menu as $menuitem)
    <div x-data='{ showmenu{{$menuitem->id}}:false, activemenu: false}' class='z-50'>
        <div class="menu-root"
            x-bind:class="{ 'active': (activemenu==true) }"
            @mouseenter="showmenu{{$menuitem->id}}=true"
            @mouseleave="showmenu{{$menuitem->id}}=false"
            >
            @if (count($menuitem->childrens()))
                {!! $menuitem->label !!}
            @else
                @if($menuitem->link!='')
                    <a href='{{$menuitem->link}}'>{!! $menuitem->label !!}</a>
                @else
                    <a href='{{ route('website.showpage', [ 'id' => $menuitem->website_page_id??0 ] ) }}'>{!! $menuitem->label !!}</a>
                @endif
            @endif

        </div>
        <div
            @mouseenter="showmenu{{$menuitem->id}}=true;activemenu=true"
            @mouseleave="showmenu{{$menuitem->id}}=false;activemenu=false"
            x-cloak
            x-show.transition.opacity.duration.750ms='showmenu{{$menuitem->id}}' class='absolute bg-red-100 rounded' style='min-width: 200px;'>
            @foreach($menuitem->childrens() as $child)
                @include('website.html.menus.menubuilderitemsvertical', ['root' => $child->menu])
            @endforeach
        </div>
    </div>
@empty
    <div class=''></div>
@endforelse

@if($login!='')
    <div class='menu-root'>
        <a href='{{$login}}'>LOGIN</a>
    </div>
@endif


