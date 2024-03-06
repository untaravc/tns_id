@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => 'Daftar Pemain'])
    @include('front.matches.List')
@endsection
