@extends('website.layouts.mainlayout')

@section('content')

    @include('website.html.mainbanner')

    @include('website.html.sections.listsections')

    @include('website.html.ads.listads')

    @include('website.html.news.listnews')

@endsection
