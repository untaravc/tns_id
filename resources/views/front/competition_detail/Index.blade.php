@extends('front.Layout')

@section('body')
    @include('front.competition_detail.PageTitle', ['title' => $page_name])
    @include('front.competition_detail.List')
@endsection
