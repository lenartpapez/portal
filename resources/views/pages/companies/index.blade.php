@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-bordered table-hover center">
            <tr>
                <th width="50%">@sortablelink('name', 'Ime')</th>
                <th>Spletna stran</th>
                <th width="20px"></th>
            </tr>
            @if($companies->count())
                @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->website }}</td>
                            <td>
                                <a class="btn btn-dark" role="button" href="{{ route('singleCompany', $company->id) }}">
                                    Več
                                </a>
                            </td>
                        </tr>
                @endforeach
            @endif
        </table>
        {{ $companies->links() }}
    </div>
@endsection