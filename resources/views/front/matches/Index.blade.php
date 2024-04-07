@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => 'Pertandingan'])
    @include('front.matches.List')
@endsection
