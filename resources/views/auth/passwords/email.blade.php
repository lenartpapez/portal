@extends('layouts.app')

@section('content')
    <div class="fullscreen">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="form-login">
            @csrf
            <ul class="login-nav text-center">
                <li class="login-nav__item active">
                    <a>Ponastavitev gesla</a>
                </li>
            </ul>
            <p class="text-center" style="color: #fff; margin-bottom: 30px">Vnesite email, s katerim ste se registrirali. Na vaš naslov boste prejeli navodila za ponastavitev gesla.</p>
            <label for="email" class="login__label">
                Email
            </label>
            <input id="email" type="email" class="login__input" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email') or $errors->has('password') or $errors->has('name'))
                <div class="alert-danger mt-2 p-2">
                    {{ $errors->first() }}
                </div>
            @endif
            <button class="login__submit" type="submit">Potrdi</button>
        </form>
    </div>
@endsection
