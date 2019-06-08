@extends('layouts.app')
@section('content')
    <div class="container">
       <h4>Podjetja in njihovi sorodni inštituti</h4>
       <span class="text-muted">Izberite podjetje in izpisali se bodo inštituti z enakimi cilji</span>
        <select onchange="filter(this.value, 'company')" class="form-control mt-3 mb-5" name="for_company" id="for_company">
            <option value="">Izberite podjetje</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        @isset($selectedCompany)
            <h6 class="text-muted mt-2">Inštituti z vsaj enim enakim ciljem kot podjetje: <strong>{{ $selectedCompany->name }}</strong></h6>
        @endisset
       @isset($institutes)
            <table class="table table-bordered table-hover center mt-4">
                <tr>
                    <th width="50%">Ime</th>
                    <th>Spletna stran</th>
                    <th width="20px"></th>
                </tr>
                @if($institutes->count())
                    @foreach($institutes as $institute)
                            <tr>
                                <td>{{ $institute->name }}</td>
                                <td>{{ $institute->website }}</td>
                                <td>
                                    <a class="btn btn-dark" role="button" href="{{ route('singleInstitute', $institute->id) }}">
                                        Več
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                @endif
            </table>
       @endisset
    </div>
@endsection