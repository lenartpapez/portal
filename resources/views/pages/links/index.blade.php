@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs" role="tablist">
        @foreach($categories as $category)
            @if($category->title != 'Kontakti')
                <a style="color: #343a40" class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" role="tab"
                    href="#{{ $category->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $category->title }}
                </a>
            @endif
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($categories as $category)
            <div id="{{ $category->id }}" role="tabpanel"
                class="p-5 tab-pane fade {{ $loop->first ? 'show' : '' }} active tab-details">
                @if($category->text)
                <h6 class="text-muted mb-4">
                    {!! $category->text !!}
                </h6>
                @endif
                <ul class="list-group list-group-flush">
                    @foreach($category->links as $link)
                    <li class="list-group-item">
                        <a href="{{ $link->url }}" target="_blank">
                            {{ $link->text }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection