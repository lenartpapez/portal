@extends("layouts.app")
@section("content")
<div class="container">
    <h4 class="mb-5">ZADNJE NOVICE</h4>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card wlcom">
                <img class="card-img-top" src="{{ $post->getFirstMediaUrl('featured', 'medium') }}">
                <div class="card-body d-flex flex-column justify-content-end">
                    <h5 class="card-title mb-3" style="font-size: 1.2rem">{{ $post->title  }}</h5>
                    <p class="card-text font-weight-normal" style="font-size: .8rem">
                        {!! Str::words($post->content, 13) !!}
                    </p>
                    <a class="btn btn-primary w-50 postsBtn" href="{{ route('singlePost', $post->id) }}">Preberi</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col text-right">
            <a class="btn btn-primary postsBtn mt-4" href="/posts" role="button">Vse novice <i
                    class="fas fa-angle-right ml-2"></i></a>
        </div>
    </div>
</div>
@endsection