@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @auth
            @if(Auth::user()->isAdmin())
                <div class="row text-right">
                    <div class="col p-0">
                        <form method="post" enctype="multipart/form-data" action="{{ route('import') }}">
                            @csrf
                            <label for="file-upload">Izberi<input type="file" name="import" id="file-upload"/></label>
                            <span id="filename">Nobena datoteka ni izbrana</span>
                            <button id="submit-button" type="submit">Naloži</button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
        {{--@foreach($institutes as $institute)--}}
            {{--<div class="row p-3 mb-1" style="background: #eee">--}}
                {{--<div class="col-md-3 text-left">--}}
                    {{--{{ $institute->contact_name }}--}}
                {{--</div>--}}
                {{--<div class="col-md-4 text-left">--}}
                    {{--{{ $institute->institute }}--}}
                {{--</div>--}}
                {{--<div class="col-md-1 text-left">--}}
                    {{--{{ $institute->short }}--}}
                {{--</div>--}}
                {{--<div class="col-md-3 text-left">--}}
                    {{--{{ $institute->email }}--}}
                {{--</div>--}}
                {{--<div class="col-md-1 text-left">--}}
                    {{--{{ $institute->cooperation }}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endforeach--}}

    </div>
@endsection

