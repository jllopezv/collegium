<a href='{{ route('students.show', ['id' => $student->id])}}'>
    <div class='relative'>
        <div class='flex items-center justify-start'>
            <div class='w-10'>
                <div class='absolute top-0 w-4 h-8 bg-transparent border-b-2 border-l-2 left-4 border-cool-gray-500'></div>
                @if(!$loop->last)
                    <div class='absolute w-4 h-10 border-l-2 left-4 top-8 border-cool-gray-500'></div>
                @endif
            </div>
            <div class="border-b border-gray-300 flex items-center justify-start w-full pl-2 {{ $loop->odd?'bg-cool-gray-200':'bg-cool-gray-300' }} hover:bg-cool-gray-400">

                <div class='flex items-center justify-start w-full h-16 px-2'>
                    <div class='h-10 pr-2 m-4 mx-auto md:m-0'>
                        <div class='w-12'>
                            <img class='w-full h-auto rounded-full shadow' src='{{ $student->avatar }}' />
                        </div>
                    </div>
                    <div class='flex flex-wrap items-center justify-start w-full text-xs text-left md:flex-no-wrap md:text-lg md:text-left'>
                        <div class='w-32 ml-0 font-bold md:pl-4'>
                            {{ $student->exp }}
                        </div>
                        <div class='w-full ml-0 font-bold md:pl-4 '>
                            {{ $student->name }}
                        </div>

                    </div>
                </div>

            </div>
            <div class='w-8'></div>
        </div>
    </div>
</a>
