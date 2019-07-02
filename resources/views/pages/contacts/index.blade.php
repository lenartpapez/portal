@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="mb-5">Kontakti</h5>
    <ul class="list-group list-group-flush mb-5">
        @foreach($links as $link)
        <li class="list-group-item">
            <a href="{{ $link->url }}" target="_blank">
                {{ $link->text }}
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection