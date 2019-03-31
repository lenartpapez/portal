@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5" id="posts">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card wlcom">
                        <img height="200px" class="card-img-top" src="{{ $post->image }}">
                        <div class="card-body">
                            <h5 class="card-title" style="height: 60px">{{ $post->title  }}</h5>
                            <p class="card-text" style="font-size: 14px">{!! substr($post->content, 0, 55) !!} ...</p>
                            <a class="btn btn-primary postsBtn" href="{{ route('singlePost', $post->id) }}">Preberi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
@endsection