@extends('lopsoft.layouts.voidpage')

@section('content')

<div class='flex items-center justify-center w-full h-screen bg-cool-gray-800'>
    <div class='block text-center'>
        <div class='text-lg font-bold text-white'>BIENVENIDO A LOPSOFT.COM</div>
        <div class='mt-4'>
            <x-lopsoft.link.success link="{{ route('login') }}" text='LOGIN' textxs/>
        </div>
    </div>
</div>
@endsection
