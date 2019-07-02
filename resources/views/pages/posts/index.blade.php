@extends('layouts.app')
@section('content')
<div class="container mb-5" id="posts">
    <h5 class="mb-5">Novice in dogodki</h5>
    <ul class="list-group list-group-flush mb-5">
        <li class="list-group-item">
            <a href="https://www.gzs.si/srip-hrana/vsebina/Aktualno" target="_blank">
                SRIP HRANA - Novice
            </a>
        </li>
        <li class="list-group-item">
            <a href="https://www.gzs.si/srip-hrana/vsebina/Dogodki" target="_blank">
                SRIP HRANA - Dogodki
            </a>
        </li>
    </ul>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card wlcom">
                <img class="card-img-top" src="{{ $post->getFirstMediaUrl('featured', 'thumb') }}">
                <div class="card-body">
                    <h5 class="card-title mb-3" style="font-size: 1.2rem">{{ $post->title  }}</h5>
                    <p class="card-text font-weight-normal" style="font-size: .8rem">
                        {!! Str::words($post->content, 10) !!}
                    </p>
                    <a class="btn btn-primary mt-2 postsBtn" href="{{ route('singlePost', $post->id) }}">Preberi</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection