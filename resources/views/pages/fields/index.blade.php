@extends('layouts.app')
@section('content')
<div class="container">
    <h5 class="text-muted mb-3">Fokusno področje</h5>
    @foreach($srips as $srip)
        <a role="button" href="{{ route('fields', ['id' => $srip->id]) }}" 
            class="btn btn-outline-dark {{ basename(request()->path()) == $srip->id ? 'active' : '' }}">
            {{ $srip->name == 'SRIP3' ? '3' : '4' }}. fokusno področje
        </a>
    @endforeach
    @isset($fields) 
        <h5 class="text-muted mt-5 mb-3">Področja</h5>
        <ul class="nav" id="fields" role="tablist" style="margin-left: -.25rem">
            @foreach($fields as $field)
                <a class="btn btn-outline-dark m-1 {{ $loop->first ? 'active' : '' }}" data-toggle="tab" role="tab"
                    href="#{{ $field->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $field->name }}
                </a>
            @endforeach
        </ul>
        
        <h5 class="text-muted mt-5 mb-3">Cilji</h5>
        <div class="tab-content" style="min-height: 500px">
            @foreach($fields as $field)
            <div id="{{ $field->id }}" role="tabpanel"
                class="tab-pane fade {{ $loop->first ? 'active show' : '' }}">
                <ul class="list-group list-group-flush">
                    @foreach($field->goals as $goal)
                        <li class="list-group-item">
                            {{ $goal->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    @endisset
</div>
@endsection