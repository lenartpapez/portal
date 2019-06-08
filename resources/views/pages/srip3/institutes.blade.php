@extends('layouts.app')
@section('content')
    <div class="container">
       <h4>Inštituti in njihova sorodna podjetja</h4>
       <span class="text-muted">Izberite inštitut in izpisala se bodo podjetja z enakimi cilji</span>
        <select onchange="filter(this.value, 'institute')" class="form-control mt-3 mb-5" name="for_company" id="for_company">
            <option value="">Izberite inštitut</option>
            @foreach($institutes as $institute)
                <option value="{{ $institute->id }}">
                    {{ $institute->name }}
                </option>
            @endforeach
        </select>
        @isset($selectedInstitute)
            <h6 class="text-muted mt-2">Podjetja z vsaj enim enakim ciljem kot inštitut: <strong>{{ $selectedInstitute->name }}</strong></h6>
        @endisset
       @isset($companies)
            <table class="table table-bordered table-hover center mt-4">
                <tr>
                    <th width="50%">Ime</th>
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
       @endisset
    </div>
@endsection