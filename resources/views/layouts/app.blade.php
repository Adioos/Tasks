<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/all.min.css') }}">
</head>
<body>
    <div class="container">
        @if(!Request::is('/') and !Request::is('register') and !Request::is('login'))
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand nav-link" href="{{ url('/') }}">
                        <h3>Главная</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tasks.index') }}">Список задач</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        Профиль
                    </div>
                    <div class="card-body">
                        <p><strong>Имя:</strong> {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger float-end"
                                    onclick="return confirm('Вы уверены, что хотите выйти из профиля {{ \Illuminate\Support\Facades\Auth::user()->name }}?')">
                                <a href="{{ route('logout') }}"></a>Выйти
                                из
                                профиля
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @yield('content')
    <footer>
        <div class="footer-text text-center">Created by Adios</div>
    </footer>
    <script src="{{ asset('assets/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
