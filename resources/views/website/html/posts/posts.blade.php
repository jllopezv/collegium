<div class='w-full lg:w-1/2'>
    <a class='cursor-pointer' href="{{ route('website.shownews', ['id' => $post->id]) }}">
        <div class='relative flex items-center justify-start m-2 p-2 rounded-lg shadow-lg  h-full bg-white'>
            <div class='flex flex-wrap md:flex-no-wrap items-start justify-center md:justify-start w-full h-full'>
                <div class='newsimage rounded shadow-lg' style="background-image: url('{!! getImage($post->image) !!}')"></div>
                <div class='w-full'>
                    <div class='text-sm p-2 self-start'>
                        {!! getDateCarbon($post->created_at) !!}
                    </div>
                    <div class='text-xl p-2 mb-4 font-bold justify-start h-full'>
                        {!! $post->title !!}
                    </div>

                </div>
            </div>
            <div class='z-50 absolute bottom-0 right-0 text-sm text-red-500 p-2 font-bold text-right'>
                LEER MAS
            </div>
        </div>

    </a>

</div>
