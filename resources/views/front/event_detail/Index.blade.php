@extends('front.Layout')

@section('body')
    @include('front.event_detail.PageTitle', ['title' => $page_name])
    @include('front.event_detail.List')
@endsection
