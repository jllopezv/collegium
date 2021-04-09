<div class='w-full lg:w-1/2 xl:w-1/3'>
{{--<div class='w-full'>--}}
    <a class='cursor-pointer' href="{{ route('website.shownews', ['id' => $newsitem->id]) }}">
        <div class='relative flex flex-wrap md:flex-no-wrap items-center justify-start m-2 md:pr-2 rounded-lg shadow-lg  h-full bg-white'>
            <div class='flex flex-wrap md:flex-no-wrap justify-start w-full md:w-auto'>
                <div class='flex items-center justify-center md:justify-start md:block text-center p-2 bg-red-500 text-white  w-full md:w-20 rounded-tl-lg rounded-tr-lg md:rounded-tr-none md:rounded-tl-lg md:rounded-bl-lg'>
                    <div class='newsdate justify-start text-3xl md:text-4xl font-bold'>
                        {!! $newsitem->created_at->isoFormat('d') !!}
                    </div>
                    <div class='newsdate md:self-start text-3xl pl-2 md:pl-0 md:text-xl font-bold'>
                        {!! mb_strtoupper(Str::beforeLast($newsitem->created_at->isoFormat('MMM'), '.')) !!}
                    </div>
                    <div class='newsdate pl-2 md:pl-0 md:self-end text-3xl md:text-sm font-bold'>
                        {!! $newsitem->created_at->format('Y') !!}
                    </div>
                </div>
                <div class='flex justify-center md:justify-start  w-full md:w-auto mt-2 md:mt-0'>
                    <div class='newsimage shadow-lg rounded md:rounded-none' style="background-image: url('{!! getImage($newsitem->image) !!}')"></div>
                </div>
            </div>
            <div class='flex flex-wrap md:flex-no-wrap items-start justify-center md:justify-start w-full h-full'>
                <div class=''>
                    <div class='text-xl p-2 mb-4 font-bold justify-start h-full w-full text-center'>
                        {!! $newsitem->title !!}
                    </div>
                </div>
            </div>
            <div class='z-50 absolute bottom-0 right-0 text-sm text-red-500 p-2 font-bold text-right'>
                LEER MAS
            </div>
        </div>

    </a>

</div>
