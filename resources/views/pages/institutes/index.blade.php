@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-bordered table-striped center">
            <thead class="thead-dark">
                <tr>
                    <th width="50%">@sortablelink('name', 'Ime')</th>
                    <th>Spletna stran</th>
                    <th width="20px"></th>
                </tr>
            </thead>
            @if($institutes->count())
                @foreach($institutes as $institute)
                    <tbody>
                        <tr>
                            <td>{{ $institute->name }}</td>
                            <td>{{ $institute->website }}</td>
                            <td>
                                <a class="btn btn-dark" role="button" href="{{ route('singleInstitute', $institute->id) }}">
                                    Več
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
        {{ $institutes->links() }}
    </div>
@endsection