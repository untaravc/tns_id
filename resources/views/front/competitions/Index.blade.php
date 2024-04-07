@extends('front.Layout')

@section('body')
    @include('front.competitions.PageTitle', ['title' => 'Turnamen'])
    @include('front.competitions.List')
@endsection
