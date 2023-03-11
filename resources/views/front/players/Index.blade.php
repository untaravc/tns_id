@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => 'Daftar Pemain'])
    @include('front.players.List')
@endsection
