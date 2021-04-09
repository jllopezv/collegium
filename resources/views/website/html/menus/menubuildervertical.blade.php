@php
    $parentmenu=App\Models\Website\WebsiteMenu::where('menu',$root)->first();
    if ($parentmenu!=null)
    {
        $menu=App\Models\Website\WebsiteMenu::where('parent_id',$parentmenu->id)->get();
    }
@endphp

@if($home!='')
    <div class='menu-root'>
        <a href='{{$home}}'>INICIO</a>
    </div>
@endif

@forelse($menu as $menuitem)
    <div x-data='{ showmenu{{$menuitem->id}}:false, activemenu: false}' class=''>
        <div class="menu-root relative"
            x-bind:class="{ 'active': (activemenu==true) }"
            @click.away="showmenu{{$menuitem->id}}=false;activemenu=false "
            @if (count($menuitem->childrens()))
                @click.prevent="showmenu{{$menuitem->id}}=true;activemenu=true;showbarmenu=true"
            @else
                @click="showmenu{{$menuitem->id}}=true;activemenu=true"
            @endif
            >
            @if (count($menuitem->childrens()))
                {{ $menuitem->label }} <i class='fa fa-caret-down'></i>
            @else
                @if($menuitem->link!='')
                    <a href='{{$menuitem->link}}'>{{ $menuitem->label }}</a>
                @else
                    <a href='{{ route('website.showpage', [ 'id' => $menuitem->website_page_id ] ) }}'>{{ $menuitem->label }}</a>
                @endif
            @endif

        </div>
        <div
            x-cloak
            x-show.transition.opacity.duration.750ms='showmenu{{$menuitem->id}}' class='bg-white' style='min-width: 200px;'>
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


