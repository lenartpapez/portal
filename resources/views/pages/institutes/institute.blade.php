@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="d-inline-block">{{ $institute->name }}</h3> <h5 class="ml-1 d-inline-block text-muted">({{ $institute->short }})</h5>
        <hr class="mt-5 mb-5" />
        <div class="row">
            <div class="col-6">
                <h5 class="mb-3">Kontakti</h5>
                @foreach($institute->contacts as $contact)
                    <strong>{{ $contact->contact_name }}</strong> - {{ $contact->email }}<br>
                @endforeach
            </div>
            <div class="col-6">
                <h5 class="mb-3">Spletna stran</h5>
                {{ $institute->website }}
            </div>
        </div>
        <hr class="mt-5 mb-5" />
        <h5 class="mt-5">Področja in cilji</h5>
        <div class="row mt-4">
            @foreach($institute->goals as $goal)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $goal->field->name }}</h5>
                            <h6 class="card-title text-muted mb-4">{{ $goal->name }}</h6>
                            <div class="goal-data">
                                <span class="title">Storitve, ki jo nudijo:</span>
                                <span class="description">{{ $goal->pivot->services }}</span>
                            </div>
                            <div class="goal-data">
                                <span class="title">Možnost aplikacije v prakso:</span>
                                <span class="description">{{ $goal->pivot->possibilities }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection