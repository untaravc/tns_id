@extends('front.Layout')

@section('body')
    @include('front.post_detail.PageTitle', ['title' => 'Berita'])
    @include('front.post_detail.Show')
@endsection
