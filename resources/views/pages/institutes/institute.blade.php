@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($institute->contacts as $contact)
            <strong>{{ $contact->contact_name }}</strong> - {{ $contact->email }}<br>
        @endforeach
    </div>
@endsection