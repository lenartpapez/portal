@extends('errors/illustrated-layout')

@section('code', 200)
@section('title', __('Napaka'))

@section('image')
    <div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', "Ta stran ne obstaja.")
