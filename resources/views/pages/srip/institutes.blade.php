@php
    if($number == 3) {
        $text = '3. fokusno področje - Napredna oprema in tehnologije za pridelavo in predelavo hrane';
        $url = 'https://www.gzs.si/srip-hrana/vsebina/Podro%C4%8Dja/Napredna-oprema-in-tehnologije-za-pridelavo-in-predelavo-hrane';
    } else {
        $text = '4. fokusno področje - Higiena, varnost in kakovost hrane';
        $url = 'https://www.gzs.si/srip-hrana/vsebina/Podro%C4%8Dja/Higiena-varnost-in-kakovost-hrane';
    }
@endphp

@extends('layouts.app')
@section('content')
<div class="container">
    <h5 class="mb-5">
        {{ $text }}
    </h5>
    <ul class="list-group list-group-flush mb-5">
        <li class="list-group-item">
            <a href="{{ $url }}" target="_blank">
                Področja in cilji
            </a>
        </li>
    </ul>
    <h4>Inštitucije in sorodna podjetja</h4>
    <span class="text-muted">Izberite inštitucijo in izpisala se bodo podjetja z enakimi cilji</span>
    <select onchange="filter('{{route('sripItems', ['number' => $number, 'slug' => $slug])}}', this.value)"
        class="form-control mt-3 mb-5">
        <option value="">Izberite inštitucijo</option>
        @foreach($items as $institute)
        <option value="{{ $institute->id }}">
            {{ $institute->name }}
        </option>
        @endforeach
    </select>
    @isset($item)
        <select
            onchange="filter('{{ route('showSripItem', ['number' => $number, 'slug' => $slug, 'itemId' => $item->id])}}', this.value)"
            class="form-control mb-4">
            <option value="">Izberite področje in cilj</option>
            @foreach($item->goals as $selectedGoal)
            <option value="{{ $selectedGoal->id }}">
                <b>{{ $selectedGoal->field->name }}</b> - {{ $selectedGoal->name }}
            </option>
            @endforeach
        </select>
        <h6 class="text-muted mt-2 mb-1">Izbrana inštitucija: <strong>{{ $item->name }}</strong></h6>
    @endisset
    @isset($goal)
        <h6 class="text-muted mt-2 mb-3">Izbrano področje in cilj: <strong>{{ $goal->field->name }}</strong> - {{ $goal->name }}
        </h6>
    @endisset
    @isset($related)
    <div class="d-flex justify-content-between align-items-center">
        <div class="mt-3" style="font-size: 14px">
            <span class="d-block mb-3">
                <strong>Storitve, ki jih nudijo:</strong><br>
                {{  $goal->pivot->services }}
            </span>
            <span>
                <strong>Možnost aplikacije v prakso:</strong><br>
                {{ $goal->pivot->possibilities }}
            </span>
        </div>
    </div>
    <button class="btn btn-light float-right mb-2 mt-3">
        <a style="text-decoration: none; color: unset"
            href=" {{ route('exportResults', ['slug' => $slug, 'itemId' => $item->id, 'goalId' => $goal->id]) }}">
            <i class="fas fa-download mr-1"></i> Izvozi v .xlsx
        </a>
    </button>
    <table class="table table-bordered table-hover center mt-3">
        <tr>
            <th width="50%">Ime</th>
            <th>Cilj</th>
            <th width="20px"></th>
        </tr>
        @if($related->count())
        @foreach($related as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td class="p-0">
                <div id="accordion">
                    <div class="card" style="border: none">
                        <div class="card-header text-left" style="border: none" id="{{ $company->id }}-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link pl-0" data-toggle="collapse"
                                    data-target="#{{ $company->id }}-details" aria-expanded="false"
                                    aria-controls="{{ $company->id }}-details">
                                    Podrobnosti
                                </button>
                            </h5>
                        </div>
                        <div id="{{ $company->id }}-details" class="collapse"
                            aria-labelledby="{{ $company->id }}-header" data-parent="#accordion">
                            <div class="card-body pt-1">
                                @foreach($company->goals as $goal)
                                @if($goal->id == basename(request()->path()))
                                <div class="mt-3" style="font-size: 13px">
                                    <span class="d-block mb-3">
                                        <strong>Pomanjkjivosti in potrebna pomoč:</strong><br>
                                        {{  $goal->pivot->help }}
                                    </span>
                                    <span>
                                        <strong>Investicijski plan:</strong><br>
                                        {{ $goal->pivot->investment_plan }}
                                    </span>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </td>
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