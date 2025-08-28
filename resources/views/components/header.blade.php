<nav class="navbar navbar-expand-lg nav-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">ESPORTZ</a>
        <div>
            @auth
                <a href="{{ route('profile.edit') }}"><i class="bi bi-person-circle d-lg-none"
                        style="font-size: 1.5rem;cursor:pointer"></i></a>
            @endauth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <button class="rounded d-lg-none" id="darkmode">
                <i class="bi bi-moon moon" id="moon1"></i>
                <i class="bi bi-brightness-high sun" id="sun1" style="display: none"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-2 gap-lg-5">
                <!-- Voci riservate agli admin -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Articoli</a>
                </li>
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('earnings') }}">Guadagni</a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->role == 'user')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.user-orders') }}">Ordini</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('earnings') }}">Guadagni</a>
                    </li> --}}
                @endif
                @if (!auth()->check() || auth()->user()->role != 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contattaci') }}">Contattaci</a>
                    </li>
                @endif

                <div class="d-lg-none">
                    @auth
                        @if (auth()->user()->role == 'user')
                            <button class="btn btn-custom--sec  mb-2" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><i
                                    class="bi bi-cart"></i></button>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-custom  mb-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom--sec mb-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-custom mb-2">Registrati</a>
                    @endauth
                </div>
            </ul>
        </div>
        <div class="d-none d-lg-flex gap-2 align-items-center">
            @auth
                <a href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"
                        style="font-size: 1.5rem;cursor:pointer"></i></a>
                <p class="my-auto">Benvenuto, {{ auth()->user()->name }}</p>
                </p>
                @if (auth()->user()->role == 'user')
                    <button class="btn btn-custom--sec" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><i
                            class="bi bi-cart"></i></button>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-custom">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-custom--sec">Login</a>
                <a href="{{ route('register') }}" class="btn btn-custom">Registrati</a>
            @endauth
            <button class="rounded d-none d-lg-block" id="darkmode2">
                <i class="bi bi-moon moon" id="moon2"></i>
                <i class="bi bi-brightness-high sun" id="sun2" style="display: none"></i>
            </button>
        </div>
    </div>
</nav>
@auth
    <x-cart />
@endauth
