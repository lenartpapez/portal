<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container-fluid m-0 p-0">
        <a class="navbar-brand d-inline-flex align-items-center" href='/'>
            <img class="d-inline-block logo" src="{{ asset('assets/img/srip-logo.png') }}" style="height: 95px" />
            <div style="font-size: 16px">
                <span class="d-block">3. FP - Napredna oprema in tehnologije</span>
                <span>4. FP - Higiena, varnost in kakovost hrane</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburgerContent"
            aria-controls="hamburgerContent" aria-expanded="false" aria-label="{{ __('Toggle menu') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Route::has('login'))
        <div class="collapse navbar-collapse top-right links justify-content-end" id="hamburgerContent">
            @auth
            <a href="/">Domov</a>
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0 mr-3" style="margin-top: -10px;"
                aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item pt-5 pb-5" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Odjava') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div class="dropdown-divider m-0"></div>
                @if(Auth::user()->hasRole(['admin', 'super_admin', 'editor']))
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
@if ( !Request::is('login') && !Request::is('register'))
<div class="container-fluid p-0" id="lower-nav">
    <div class="row mr-0 ml-0">
        @php
        $pages = config('pages');
        @endphp
        @foreach ($pages as $slug => $name)
        @php
        $opacity = ($loop->index+5) * 0.06;
        $isDropdown = $slug == 'srip3' || $slug == 'srip4';
        @endphp
        @if($isDropdown)
        <div (click)="{{ route('subpage', ['slug' => $slug]) }}" class="col-md-3 col-sm-6 col-6 p-0 srip dropdown"
            id="sripdropdown">
            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" data-hover="dropdown"
                style="text-decoration: none; color: #404346; cursor: pointer">
                <div class="card {{ Request::is($slug.'/*') ? 'active' : '' }}" id="link"
                    style="background: rgba(55, 163, 53, <?php echo $opacity ?>)">
                    <div class="card-body pr-5 pl-5">
                        <h3>{{ $name }}</h3>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/{{ $slug }}/institutes">Za inštitucije</a>
                <a class="dropdown-item" href="/{{ $slug }}/companies">Za podjetja</a>
            </div>
        </div>
        @else
        <div class="col-md-3 col-sm-6 col-6 p-0">
            <a href="{{ route('subpage', ['slug' => $slug]) }}" style="text-decoration: none; color: #404346">
                <div class="card {{ Request::is($slug) ? 'active' : '' }}" id="link"
                    style="background: rgba(55, 163, 53, <?php echo $opacity ?>)">
                    <div class="card-body pr-5 pl-5">
                        <h3>{{ $name }}</h3>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif