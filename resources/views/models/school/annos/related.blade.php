@section('related')
    <div class='bg-gray-200 pt-1 px-3 border-t border-gray-300'>
        @hasAbility('annos.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('annos.index')}}" textxs text="{{ transup('annos')}}"   />
        @endhasAbility
        @hasAbility('school_periods.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_periods.index')}}" textxs text="{{ transup('periodtypes')}}"   />
        @endhasAbility
        @hasAbility('school_levels.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_levels.index')}}" textxs text="{{ transup('levels')}}"   />
        @endhasAbility
        @hasAbility('school_grades.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_grades.index')}}" textxs text="{{ transup('grades')}}"   />
        @endhasAbility
        @hasAbility('school_sections.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_sections.index')}}" textxs text="{{ transup('sections')}}"   />
        @endhasAbility
        @hasAbility('school_batches.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_batches.index')}}" textxs text="{{ transup('batches')}}"   />
        @endhasAbility
        @hasAbility('school_modalities.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_modalities.index')}}" textxs text="{{ transup('modalities')}}"   />
        @endhasAbility
    </div>
@endsection
