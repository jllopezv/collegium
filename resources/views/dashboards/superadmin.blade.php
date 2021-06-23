@extends('lopsoft.layouts.page')

@section('content')

    <div class='flex items-center justify-start'>
        <div>
            @livewire('controls.currency-input-form', [
                'uid'           =>  'pricecomponent',
                'model'         =>  'inputbox',
                'nextref'       =>  'price2component_input',
                'showcurrency'  =>  false,
                'value'         =>  132.34,
                'showpercent'   =>  true,
                'mode'          =>  'edit',
            ])
        </div>
        <div>
            @livewire('controls.currency-input-form', [
                'uid'           =>  'price2component',
                'model'         =>  'inputbox',
                'nextref'       =>  'price2component_input',
                'currencydefault' => 2,
                'showpercent'   =>  true,
                'mode'          =>  'edit',
            ])
        </div>
        <div class=''>
            <x-lopsoft.control.input
                id='input'
                class='bg-transparent text-right'
                classcontainer="w-full"
                placeholder="0.00"
            />
        </div>
    </div>
@endsection
