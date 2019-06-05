<nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-fixed-top">
    <div class="container-fluid m-0">
        <a class="navbar-brand" href='/'>
            INFORMACIJSKI PORTAL
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="/">Domov</a>
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
@if ( !Request::is('login') && !Request::is('register'))
    <div class="container-fluid p-0" id="lower-nav">
            <div class="row mr-0 ml-0">
                <?php
                    $max = 4;
                    $pages = ["Institutes", "Companies", "SRIP3", "SRIP4", "Extra1", "Extra2", "Extra3", "Extra4"];
                ?>
                @auth
                    <?php $max = 8; ?>
                @endauth
                @for ($i = 0; $i < $max; $i++)
                    <?php 
                        $opacity = ($i+5) * 0.06; 
                        $isDropdown = $pages[$i] == 'SRIP3' || $pages[$i] == 'SRIP4';  
                    ?>
                    @if($isDropdown) 
                        <div class="col-md-3 col-sm-6 col-6 p-0 dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" style="text-decoration: none; color: #404346; cursor: pointer">
                                <div class="card {{ Request::is(str_slug($pages[$i]).'/*') ? 'active' : '' }}" id="link" style="background: rgba(55, 163, 53, <?php echo $opacity ?>)">
                                    <div class="card-body pr-5 pl-5">
                                        <h3>{{ $pages[$i] }}</h3>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/{{ str_slug($pages[$i]) }}/institutes">Za inštitute</a>
                                <a class="dropdown-item" href="/{{ str_slug($pages[$i]) }}/companies">Za podjetja</a>
                            </div>
                        </div>
                    @else
                        <div class="col-md-3 col-sm-6 col-6 p-0">
                            <a href="{{ route('subpage', ['slug' => str_slug($pages[$i])]) }}" style="text-decoration: none; color: #404346">
                                <div class="card {{ Request::is(str_slug($pages[$i])) ? 'active' : '' }}" id="link" style="background: rgba(55, 163, 53, <?php echo $opacity ?>)">
                                    <div class="card-body pr-5 pl-5">
                                        <h3>{{ $pages[$i] }}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endfor
            </div>
    </div>
@endif