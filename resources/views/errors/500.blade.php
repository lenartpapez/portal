@extends('errors/illustrated-layout')

@section('code', 401)
@section('title', __('Napaka'))

@section('image')
<div style="background-image: url({{ asset('/svg/404.svg') }});"
    class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', 'Za dostop do te strani morate biti prijavljeni.')