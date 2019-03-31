@extends('layouts.app')
@section('content')
    <div>
        <ul>
            @foreach($companies as $company)
                <li>{{ $company->name }}</li>
                <ul>
                    @foreach($company->goals as $goal)
                        <li>{{ $goal->field->name }} - {{ $goal->name }}</li>
                    @endforeach
                </ul>
            @endforeach
        </ul>

    </div>
@endsection