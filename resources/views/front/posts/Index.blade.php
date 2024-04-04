@extends('front.Layout')

@section('body')
    @include('front.components.PageTitle', ['title' => 'Berita'])
    @include('front.posts.List')
@endsection
