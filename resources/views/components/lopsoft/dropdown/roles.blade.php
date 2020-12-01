@php
    if($record!=null) $role=\App\Models\Auth\Role::find($record['id']);
@endphp
<div>
    @if($record!=null)
        <div class="flex items-center justify-between">
            <div class=''>
                {!! $role->getRoleTagAttribute() !!}
            </div>
            <div class=''>
                @if($isSelected!==false)
                    <i class='fa fa-check'></i>
                @endif
            </div>
        </div>
    @else
        {{-- Selected --}}
        @foreach($selected as $selectedrole)
            @php
                $record=\App\Models\Auth\Role::find($selectedrole);
            @endphp
            {!! $record->getRoleTagAttribute() !!}
        @endforeach
    @endif
</div>
