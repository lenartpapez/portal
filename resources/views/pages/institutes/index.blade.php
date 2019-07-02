@extends('layouts.app')
@section('content')
<div class="container">
    <button class="btn btn-light float-right mb-2">
        <a style="text-decoration: none; color: unset" href="{{ route('exportAll', [ 'slug' => 'institutes']) }}">
            <i class="fas fa-download mr-1"></i> Izvozi v .xlsx
        </a>
    </button>
    <table class="table table-bordered table-hover center">
        <tr>
            <th width="75%">@sortablelink('name', 'Ime')</th>
            <th>3. FP</th>
            <th>4. FP</th>
            <th width="20px"></th>
        </tr>
        @if($institutes->count())
        @foreach($institutes as $institute)
        <tr>
            <td>{{ $institute->name }}</td>
            <td class="text-center">
                @if($institute->fp3)
                    <i class="fa fa-check" />
                @endif
            </td>
            <td class="text-center">
                @if($institute->fp4)
                    <i class="fa fa-check" />
                @endif
            </td>
            <td>
                <a class="btn btn-dark" style="padding: .2rem .75rem" role="button"
                    href="{{ route('singleInstitute', $institute->id) }}">
                    Več
                </a>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    {{ $institutes->links() }}
</div>
@endsection