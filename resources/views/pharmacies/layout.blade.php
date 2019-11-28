<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>База аптек</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <style>
      .table-tr-hover:hover {
        background: #E6E6FA;  
      }  
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/pharmacies">Elfa</a> 
      <form class="form-inline w-100"  action="/pharmacies/search" method="POST">
        @csrf
        <input class="form-control form-control-dark" name="search" type="text" placeholder="Search" aria-label="Search">
        <button class="form-control form-control-dark" type="confirm"></button> 
      </form>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
              @endif
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </div>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/pharmacies">
                  <span data-feather="home"></span>
                  Список аптек <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/create">
                  <span data-feather="plus"></span>
                  Добавить аптеку
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/custom-search">
                  <span data-feather="search"></span>
                  Расширенный поиск
                </a>
              </li>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Быстрая навигация</span>
            </h6>
            <ul class="nav flex-column mb-2">
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=vip_nets">
                  <span data-feather="corner-down-right"></span>
                  Vip сети
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=anc">
                  <span data-feather="chevron-right"></span>
                  АНЦ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=aptekar">
                  <span data-feather="chevron-right"></span>
                  Аптекарь/Виталюкс
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=vitamin">
                  <span data-feather="chevron-right"></span>
                  Витамин
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=tas">
                  <span data-feather="chevron-right"></span>
                  ТАС
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=pharmastor">
                  <span data-feather="chevron-right"></span>
                  Фармастор
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/pharmacies/selection?net=retail">
                  <span data-feather="corner-down-right"></span>
                  Розничные аптеки
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">       
            @yield('content')
          </div>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/scripscript><script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.3/examples/dashboard/dashboard.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
