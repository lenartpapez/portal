@extends('layouts.app')
@section('content')
    <div class="container">
        <button class="btn btn-light float-right mb-2">
            <a style="text-decoration: none; color: unset" href="{{ route('export') }}">
                <i class="fas fa-download mr-1"></i> Izvozi v .xlsx
            </a>
        </button>
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
                                <a class="btn btn-dark" style="padding: .2rem .75rem" role="button" href="{{ route('singleCompany', $company->id) }}">
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