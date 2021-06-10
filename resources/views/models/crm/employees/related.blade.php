@section('related')
    <div class='bg-gray-200 pt-1 px-3 border-t border-gray-300'>
        @hasAbility('employees.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('employees.index')}}" textxs text="{{ transup('employees')}}"   />
        @endhasAbility
        @hasAbility('employee_types.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('employee_types.index')}}" textxs text="{{ transup('employee_types')}}"   />
        @endhasAbility
        @hasAbility('customers.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('customers.index')}}" textxs text="{{ transup('customers')}}"   />
        @endhasAbility
        @hasAbility('customer_types.access')
            <x-lopsoft.inlinelink.gray class='mb-1 bg-cool-gray-300 text-cool-gray-600 hover:bg-cool-gray-700 hover:text-green-300 p-2' link="{{route('customer_types.index')}}" textxs text="{{ transup('customer_types')}}"   />
        @endhasAbility
    </div>
@endsection
