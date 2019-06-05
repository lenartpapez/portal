@extends("layouts.app")
@section("content")
    <div class="container">
        <h1 class="mb-3">ZADNJE NOVICE</h1>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card wlcom">
                        <img height="200px" class="card-img-top" src="http://lorempixel.com/400/200/nature/">
                        <div class="card-body">
                            <h5 class="card-title" style="height: 60px">{{ $post->title  }}</h5>
                            <p class="card-text" style="font-size: 14px">{!! substr($post->content, 0, 60) !!} ...</p>
                            <a class="btn btn-primary postsBtn" href="{{ route('singlePost', $post->id) }}">Preberi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-primary postsBtn mt-4" href="/posts" role="button">Vse novice  <i class="fas fa-angle-right ml-2"></i></a>
            </div>
        </div>
    </div>
@endsection
