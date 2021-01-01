<div>
    @foreach($pages as $page)
        @if( ($page->onlysuperadmin && Auth::user()->level==1) || !$page->onlysuperadmin )
            <div wire:click='selectPage({{ $page->id }})' class='p-2 m-2 rounded-md shadow cursor-pointer hover:bg-cool-gray-700 hover:text-white
            @if($currentpage==$page->id)
                bg-cool-gray-500 text-white
            @else
                bg-white text-black
            @endif
            '>

                {{ $page->settingpage }}
            </div>
        @endif
    @endforeach
</div>
