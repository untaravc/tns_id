@extends('front.Layout')

@section('body')
    @include('front.events.PageTitle', ['title' => 'Turnamen'])
    @include('front.events.List')
@endsection
