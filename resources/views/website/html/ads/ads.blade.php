<div class='p-2 w-full md:w-1/2 lg:w-1/3 xl:w-1/4'>
{{--<div class='p-2 w-full md:w-1/2 xl:w-1/2'>--}}
    <a class='cursor-pointer' href="{{ route('website.showadvertisement', ['id' => $ad->id]) }}">
        <div class='m-2 p-2 rounded-lg shadow-lg bg-white h-full'>
            <div class='relative'>
                <div class='advertisementimage' style="background-image: url('{!! getImage($ad->image) !!}')"></div>
                <div class='absolute top-2 right-2 bg-blue-400 p-1 text-white font-bold rounded'>
                    {!! $ad->category->categoryName !!}
                </div>
            </div>
            <div class='text-sm text-right pr-2'>
                {{--{!! getAgo($ad->created_at) !!}--}}
            </div>
            <div class='flex items-center justify-center mt-4 mb-4 text-center h-32'>
               <div class='text-2xl font-bold'>
                        {!! $ad->title !!}
                </div>
            </div>
        </div>
    </a>
</div>
