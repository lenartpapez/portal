@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="mb-0 d-inline-block">{{ $company->name }}</h3> <h5 class="ml-1 mb-0 d-inline-block text-muted">({{ $company->short }})</h5>
        <hr class="divider-details" />
        <div class="row">
            <div class="col-6">
                <h5 class="mb-3">Kontakti</h5>
                @foreach($company->contacts as $contact)
                    <strong>{{ $contact->contact_name }}</strong> - {{ $contact->email }}<br>
                @endforeach
            </div>
            <div class="col-6">
                <h5 class="mb-3">Spletna stran</h5>
                {{ $company->website }}
            </div>
        </div>
        <hr class="divider-details" />
        <h5>Področja in cilji</h5>
        <div class="row mt-4">
            @foreach($company->goals as $goal)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $goal->field->name }}</h5>
                            <h6 class="card-title text-muted mb-4">{{ $goal->name }}</h6>
                            <div class="goal-data">
                                <span class="title">Pomanjkljivosti in potrebna pomoč:</span>
                                <span class="description">{{ $goal->pivot->help }}</span>
                            </div>
                            <div class="goal-data">
                                <span class="title">Investicijski plan:</span>
                                <span class="description">{{ $goal->pivot->investment_plan }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection