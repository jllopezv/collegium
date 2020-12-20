@if(property_exists($model,'hasactive') && !$record->active)
    bg-red-100  hover:bg-red-200
@else
    @if( Schema::hasColumn($table, 'current') && $record->current)
        bg-green-200  hover:bg-green-300
    @else
        bg-transparent  hover:bg-cool-gray-200
    @endif
@endif
