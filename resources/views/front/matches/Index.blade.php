@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => 'Daftar Pemain'])
    @include('front.events.List')
@endsection
