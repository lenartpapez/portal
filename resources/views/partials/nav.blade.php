<nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-fixed-top">
    <div class="container-fluid m-0">
        <a class="navbar-brand" href='{{ route('home') }}'>
            INFORMACIJSKI PORTAL
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/') }}">Domov</a>
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0 mr-3" style="margin-top: -10px;" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item pt-5 pb-5" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Odjava') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-divider m-0"></div>
                        @if(Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('admin') }}">
                               Admin
                            </a>
                        @endif
                    </div>
                @else
                    <a href="{{ route('login') }}">Prijava</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registracija</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>