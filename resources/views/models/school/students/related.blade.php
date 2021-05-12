@section('related')
    <div class='bg-gray-200 pt-1 px-3 border-t border-gray-300'>
        @hasAbility('students.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('students.index')}}" textxs text="{{ transup('students')}}"   />
        @endhasAbility
        @hasAbility('school_parents.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('school_parents.index')}}" textxs text="{{ transup('parents')}}"   />
        @endhasAbility
    </div>
@endsection
