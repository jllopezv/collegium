@include('components.lopsoft.datatable.rowcolumnavatar')
<x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}">
    <div class=''>
        {{ $item->exp }}
    </div>
    <div class='font-bold'>
        {{ $item->name }}
    </div>
</x-lopsoft.datatable.row-column>
{{-- <x-lopsoft.datatable.row-column
    canshow="{{ $item->canShowRecord() && $item->allowShow() }}"
    link="{{ route($table.'.show',$item->id) }}">
    <div class=''>
        {{ \App\Models\School\SchoolGrade::find($item->params['grade_id'])->grade??'' }}
    </div>
    <div class=''>
        {{ $item->section }}
    </div>
    <div class=''>
        {{ \App\Models\School\SchoolModality::find($item->params['modality_id'])->modality??'' }}
    </div>
</x-lopsoft.datatable.row-column> --}}

@include('components.lopsoft.datatable.rowcolumn', ['slot'=> \App\Models\School\SchoolGrade::find($item->params['grade_id'])->grade??'' ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->section ])
@include('components.lopsoft.datatable.rowcolumn', ['slot'=> \App\Models\School\SchoolModality::find($item->params['modality_id'])->modality??'' ])
@include('components.lopsoft.datatable.row-priority')
@include('components.lopsoft.datatable.setpriority')
