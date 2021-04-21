@extends('website.layouts.pagelayout')

@php
    $section=\App\Models\Website\WebsiteSection::find($id);
@endphp

@section('content')

    @if($section!=null)
        <div class='w-full flex justify-center'>
            <div class='w-full max-w-7xl bg-white my-4 p-4'>
                @if($section->image!='')
                    <div class='flex items-center justify-start'>
                        <img class='mx-auto' src='{!! getImage($section->image,false)  !!}' />
                    </div>
                @endif
                <div class='text-center'>
                    <div class='mt-4 font-bold text-2xl'>
                        {!! $section->title !!}
                    </div>
                </div>
                <div class=''>
                    <div class='mt-4'>
                        {!! $section->body !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
