<div>
    @foreach($pages as $page)
        <div wire:click='selectPage({{ $page->id }})' class='p-2 m-2 rounded-md shadow cursor-pointer hover:bg-cool-gray-700 hover:text-white
        @if($currentpage==$page->id)
            bg-cool-gray-500 text-white
        @else
            bg-white text-black
        @endif
        '>
            {{ $page->settingpage }}
        </div>
    @endforeach
</div>
