@extends('layouts.app')
@section('content')
<div class="fullscreen">
    <form method="POST" action="{{ route('login') }}" class="form-login" autocomplete="off">
        @csrf
        <ul class="login-nav text-center">
            <li class="login-nav__item active">
                <a>Prijava</a>
            </li>
        </ul>
        <label for="login-input-user" class="login__label">
            Email
        </label>
        <input name="email" id="email" class="login__input" type="email" autocomplete="nope" />
        <label for="login-input-password" class="login__label">
            Geslo
        </label>
        <input id="password" name="password" class="login__input" type="password" autocomplete="new-password" />
        <label for="login-sign-up" class="login__label--checkbox">
            <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"
                class="login__input--checkbox" />
            Ostani prijavljen
        </label>
        @if ($errors->has('email') or $errors->has('password'))
        <div class="alert-danger mt-2 p-2">
            {{ "Napačni podatki za prijavo." }}
        </div>
        @endif
        <button class="login__submit" type="submit">Prijava</button>
        <hr class="divider" style="margin-top: 40px; background-color: rgba(255, 255, 255, 0.7)" />
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="login__forgot">Pozabljeno geslo?</a>
        @endif
    </form>
</div>
@endsection