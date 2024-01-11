<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.5);">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img src="/Image/toko_icon.png" alt="Toko Buku" width="250" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:navy;">Welcome, {{ Auth::user()->nama}}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('author-book') }}" style="color:navy;">Lihat Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authorUploadBook') }}" style="color:navy;">Upload Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authorNonBook') }}" style="color:navy;">Upload Non-Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" style="color:navy;">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('navbar')
    </header>
    <div class="container">
        <div class="row">
            @yield('daftar')
        </div>
    </div>
</body>

</html>
