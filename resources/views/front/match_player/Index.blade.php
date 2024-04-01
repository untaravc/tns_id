@extends('front.Layout')

@section('body')
    @include('front.match_player.PageTitle', ['title' => 'Pemain'])
    @include('front.match_player.Player')
@endsection
