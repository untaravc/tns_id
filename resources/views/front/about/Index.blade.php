@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => $page_name])
    @include('front.about.Content')
@endsection
