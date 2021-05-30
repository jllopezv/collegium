@php
    $record=\App\Models\Crm\Employee::find($record['id']);
@endphp

<div class='flex items-center justify-start'>
    <div class='w-8 mr-2'>
        <img class='rounded-full' src="{!! $record->avatar !!}" />
    </div>
    <div class='mr-2 '>
        {!! $record->employee !!}
    </div>
    <div class='text-cool-gray-400'>
        ({!! $record->type->type??'' !!})
    </div>
</div>
