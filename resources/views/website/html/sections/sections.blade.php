<div class='w-full max-w-7xl h-full border-t border-dashed border-red-500'>
    <a class='cursor-pointer' href="{{ route('website.showsection', ['id' => $section->id]) }}">
        <div class=' h-full'>
            <div class='flex flex-wrap sm:flex-no-wrap items-start justify-start mt-4 mb-4 bg-white'>
                @if($section->image!='')
                    <div class='w-full md:w-1/2 p-2'>
                        <img class='rounded-lg shadow-lg' src='{!! getImage($section->image, false) !!}' />
                    </div>
                @endif
                <div class='w-full'>
                        @if($section->title!='')
                            <div class='text-2xl text-center font-bold '>
                                {!! $section->title !!}
                            </div>
                        @endif
                        <div class=''>
                            {!! $section->description !!}
                        </div>
                </div>
            </div>
        </div>

    </a>
</div>
