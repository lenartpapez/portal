@extends('layouts.app')

@section('content')
    <div>
        @foreach($fields as $field)
            <li>{{ $field->name }}</li>
        @endforeach
    </div>
@endsection

