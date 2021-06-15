@php
    $record=\App\Models\Crm\Employee::find($record['id']);
@endphp

<div class='flex flex-wrap md:flex-no-wrap items-center justify-start md:bg-transparent bg-opacity-50'>
    <div class='w-full flex items-center justify-center  md:w-12 mr-2'>
        <img class='w-8 rounded-full' src="{!! $record->avatar !!}" />
    </div>
    <div class='md:text-left text-center w-full md:w-auto md:mr-2'>
        {!! $record->employee !!}
    </div>
    <div class='w-full md:w-auto  text-cool-gray-400 text-xs md:text-base md:text-left text-center'>
        ({!! $record->type->type??'' !!})
    </div>
</div>
