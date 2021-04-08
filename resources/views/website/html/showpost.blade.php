@extends('website.layouts.postlayout')

@php
    $post=\App\Models\Website\WebsitePost::find($id);
@endphp

@section('content')

    <img src='{{ $post->image }}' />

@endsection
