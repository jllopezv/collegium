@props([
    'minheight' =>  '500px'
])

<div x-data='{showOption: [], optionActive: 1}' x-init='showOption[1]=true'
    class='h-full px-2 py-4 mt-4 border-gray-300' style="min-height: {{$minheight}}">
    <div class='flex flex-wrap items-center justify-start border-b border-gray-200'>
        {!! $tabs !!}
    </div>
    <div class='px-2'>
        {!! $tabscontent !!}
    </div>
</div>
