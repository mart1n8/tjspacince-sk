

<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000033;">
  <a class="navbar-brand" href="{{ route('/') }}">
    <img src="{{ asset('images/home.png') }}" class="navbar-brand img-responsive" style="height: 34px; width:24px" alt="homepage">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            A TÍM
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('matchs.index', ['team_slug'=>'a-tim']) }}">ZÁPASY</a>
            <a class="dropdown-item" href="{{ route('tables.show', ['team_slug'=>'a-tim']) }}">TABUĽKA</a>
            <a class="dropdown-item" href="{{ route('player.players') }}">HRÁČI</a>
          </div>
      </li> 
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DORAST
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('matchs.index', ['team_slug'=>'dorast']) }}">ZÁPASY</a>
            <a class="dropdown-item" href="{{ route('tables.show', ['team_slug'=>'dorast']) }}">TABUĽKA</a>
          </div>
      </li>  
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ŽIACI
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('matchs.index', ['team_slug'=>'ziaci']) }}">ZÁPASY</a>
            <a class="dropdown-item" href="{{ route('tables.show', ['team_slug'=>'ziaci']) }}">TABUĽKA</a>
          </div>
      </li>  
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PRÍRAVKA
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('matchs.index', ['team_slug'=>'pripravka-u12']) }}">ZÁPASY U12</a>
            <a class="dropdown-item" href="{{ route('tables.show', ['team_slug'=>'pripravka-u12']) }}">TABUĽKA U12</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('matchs.index', ['team_slug'=>'pripravka-u09']) }}">ZÁPASY U9</a>
            <a class="dropdown-item" href="{{ route('tables.show', ['team_slug'=>'pripravka-u09']) }}">TABUĽKA U9</a>
          </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            KLUB
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('page.show', ['page_slug'=>'klub']) }}">KONTAKT</a>
            <a class="dropdown-item" href="{{ route('page.show', ['page_slug'=>'historia']) }}">HISTÓRIA</a>
          </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('article.index') }}">ČLÁNKY</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            NA STIAHNUTIE
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('pdf.plagat') }}" target="_blank">PLAGÁT</a>
            <a class="dropdown-item" href="{{ route('pdf.fixtures') }}">ROZLOSOVANIE</a>
            <a class="dropdown-item" href="{{ route('page.show', ['page_slug'=>'stiahnut-o-klube']) }}">KLUBOVÉ SYMBOLY</a>
          </div>
      </li>
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
      @guest()
        <li class="nav-item">
          <a href="https://www.facebook.com/tjspacince/" target="_blank" title="TJ Špačinace na Facebooku" style="text-align: right">
              <img src="{{ asset('images/facebook_white.png') }}" alt="TJ Špačince - facebook fanpage" style="height:2em; padding:0px; margin:0px">
          </a>
        </li>
      @else
          @if(Auth::check() && Auth::user()->roles>1)
          <li class="nav-item">
            <a href="{{ route('admin.index') }}" >
                <img src="{{ asset('images/setting.png') }}" class="img-responsive" title="administrácia" style="height: 1.5em; margin-right: 20px" alt="admin">
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('logout') }}" >
                <img src="{{ asset('images/logout.png') }}" class="img-responsive" title="odhlásiť" style="height: 25px;" alt="odhlásiť" >
            </a>
          </li>
      @endguest
    </ul>
  </div>
</nav>
