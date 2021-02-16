<div class='flex items-center justify-center mt-4'>
    <a href="{{ route($table.'.show',$item->id) }}">
        <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
    </a>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-600'><b>{{ $item->exp }}</b></span>
</div>
<div class='mt-1 text-center'>
    <span class='text-gray-500'>{{ $item->name }}</span>
</div>
<div class='mt-1 font-bold text-center'>
    <span class='text-gray-500 text-md'>{{ \App\Models\School\SchoolGrade::find($item->params['grade_id'])->grade??'' }}</span>
</div>
<div class='mt-1 text-center'>
    <span class='text-xs text-gray-400'>{{ $item->section }}</span> <span class='text-xs text-gray-400'>{{ \App\Models\School\SchoolModality::find($item->params['modality_id'])->modality??'' }}</span>
</div>

