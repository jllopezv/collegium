@extends('lopsoft.layouts.voidpage')

@section('content')

<div class='w-full h-screen flex items-center justify-center'>
    <div class='block text-center'>
        <div class='text-white font-bold text-lg'>BIENVENIDO A LOPSOFT.COM</div>
        <div class='mt-4'>
            <x-lopsoft.link.success link="{{ route('login') }}" text='LOGIN' />
        </div>
    </div>
</div>
@endsection
