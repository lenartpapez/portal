@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($company->contacts as $contact)
            <strong>{{ $contact->contact_name }}</strong> - {{ $contact->email }}<br>
        @endforeach
    </div>
@endsection