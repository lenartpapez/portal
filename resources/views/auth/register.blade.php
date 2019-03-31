@extends('layouts.app')
@section('content')
    <div class="fullscreen">
            <form method="POST" action="{{ route('register') }}" class="form-register">
                @csrf
                <ul class="login-nav text-center">
                    <li class="login-nav__item active">
                        <a>Registracija</a>
                    </li>
                </ul>
                <label for="name" class="login__label">
                    Ime in priimek
                </label>
                <input id="name" type="text" class="login__input" name="name" value="{{ old('name') }}" required autofocus />
                <label for="email" class="login__label">
                    Email
                </label>
                <input id="email" type="email" class="login__input" name="email" value="{{ old('email') }}" required>
                <label for="password" class="login__label">
                    Geslo
                </label>
                <input id="password" type="password" class="login__input" name="password" required>
                <label for="password-confirm" class="login__label">
                    Potrdi geslo
                </label>
                <input id="password-confirm" type="password" class="login__input mb-3" name="password_confirmation" required>
                @if ($errors->has('email') or $errors->has('password') or $errors->has('name'))
                    <div class="alert-danger mt-2 p-2">
                        {{ $errors->first() }}
                    </div>
                @endif
                <button class="login__submit" type="submit">Registracija</button>
            </form>
    </div>
@endsection