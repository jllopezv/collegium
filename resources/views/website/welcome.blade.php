@extends('website.layouts.mainlayout')

@php
    $posts=\App\Models\Website\WebsitePost::orderBy('fixed','desc')->orderBy('top','desc')->orderBy('created_at','asc')->get();
@endphp

@section('content')

    @dump($posts);
@endsection
