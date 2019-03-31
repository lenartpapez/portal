@extends("layouts.app")
@section("content")
    <div class="container-fluid p-0">
        <div class="row">
            <?php
                $max = 4;
                $pages = ["Inštituti", "Podjetja", "SRIP3", "SRIP4", "Extra1", "Extra2", "Extra3", "Extra4"];
            ?>
            @auth
                <?php $max = 8; ?>
            @endauth
            @for ($i = 0; $i < $max; $i++)
                <?php $opacity = ($i+5) * 0.06; ?>
                <div class="col-md-3 col-sm-6 col-6 p-0">
                    <a href="{{ route('subpage', ['slug' => str_slug($pages[$i])]) }}" style="text-decoration: none; color: #404346">
                        <div class="card" id="link" style="background: rgba(55, 163, 53, <?php echo $opacity ?>)">
                            <div class="card-body pr-5 pl-5">
                                <h3>{{ $pages[$i] }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="mb-3">ZADNJE NOVICE</h1>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card wlcom">
                        <img height="200px" class="card-img-top" src="{{ $post->image }}">
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
                <a class="btn btn-primary postsBtn mt-4" href="{{ route('posts') }}" role="button">Vse novice  <i class="fas fa-angle-right ml-2"></i></a>
            </div>
        </div>
    </div>
@endsection
