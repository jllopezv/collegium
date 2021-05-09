@section('related')
    <div class='bg-gray-200 py-2 px-3 border-t border-gray-300'>
        @hasAbility('students.access')
            <x-lopsoft.inlinelink.gray link="{{route('students.index')}}" textxs text="{{ transup('students')}}"   />
        @endhasAbility
        @hasAbility('school_parents.access')
            <x-lopsoft.inlinelink.gray link="{{route('school_parents.index')}}" textxs text="{{ transup('parents')}}"   />
        @endhasAbility
    </div>
@endsection
