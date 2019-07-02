@extends('layouts.app')
@section('content')
<div class="container" id="posts">
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <img class="mb-5" style="border-radius: 20px; max-width: 100%" src="{{ $post->getFirstMediaUrl('featured', 'medium') }}">
        </div>
        <div class="col-md-6">
            <p><b>{{ date("d.m.Y h:i:s", strtotime($post->created_at)) }}</b></p>
            <h5 class="card-title mb-3">{{ $post->title  }}</h5>
            <p class="card-text" style="font-size: 14px; line-height: 18px">{!! $post->content !!}</p>
        </div>
    </div>
    @auth
    <div class="row" id="app">

    </div>
    @else
    <div v-else class="mt-5">
        <p>Za dodajanje komentarjev se morate prijaviti.</p>
    </div>
    @endauth
</div>
@endsection