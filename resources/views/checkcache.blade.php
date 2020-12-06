@extends('lopsoft.layouts.voidpage')

@section('content')

    @livewire('controls.drop-down-table-component', [
        'model'         => \App\Models\Aux\Country::class,
        'mode'          =>  'create',
        'filterraw'     => '',
        'sortorder'     => 'country',
        'label'         => mb_strtoupper(trans('lopsoft.country')),
        'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
        'key'           => 'id',
        'field'         => 'country',
        'defaultvalue'  =>  (\App\Models\Aux\Country::where('country',config('lopsoft.country_default'))->first())->id??null,
        'eventname'     => 'eventsetcountry',
        'uid'           => 'countrycomponent',
        'modelid'       => 'countries',
        'isTop'         =>  false,
        'template'      => 'components.lopsoft.dropdown.countries',
    ])

@endsection
