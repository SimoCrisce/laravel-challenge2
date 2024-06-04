<nav class="navbar navbar-expand-lg bg-primary mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('courses.index') }}">Corsi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> --}}
            </ul>
            {{-- <form class="d-flex" role="search" action="{{ route('courses.index') }}">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form> --}}
            <ul class="navbar-nav mb-2 mb-lg-0 ms-2 align-items-center">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Registrati</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item text-white">Ciao, <a class="text-light"
                            href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a>!
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="nav-item">
                            <button class="nav-link">Logout</button>
                        </li>
                    </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>
