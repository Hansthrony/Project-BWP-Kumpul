<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gramedia')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.5);">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('description')}}">
                    <img src="Image/toko_icon.png" alt="Toko Buku" width="250" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home')}}" style="color:navy;">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:navy;">Alat Tulis</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="post">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button> 
                    </form>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color:navy;">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('navbar')
    </header>
    <div class="container" style="padding:20px;">
        <div class="row">
            <div class="col-md-7">
                <div id="carouselExample" class="carousel slide" style="border-radius: 15px; overflow: hidden;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Image/gramedia-carosel.jpg" class="d-block w-100" alt="..." width="" height="350px">
                        </div>
                        <div class="carousel-item">
                            <img src="Image/gramedia-carosel2.jpg" class="d-block w-100" alt="..." width="" height="350px">
                        </div>
                        <div class="carousel-item">
                            <img src="Image/gramedia-carosel3.jpg" class="d-block w-100" alt="..." width="" height="350px"> 
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5">
                <img src="Image/gramedia-promo.jpg" alt="" style="margin-bottom:20px; border-radius: 15px;" width="500px" height="165px">
                <img src="Image/gramedia-promo2.jpg" alt="" style="margin-bottom:20px; border-radius: 15px;" width="500px" height="165px">
            </div>
        </div>
    </div>
    @yield('carousel')

    <div class="container">
        <div class="row">
            <h2>Daftar Buku</h2>
            @yield('daftar')
        </div>
    </div>
</body>

</html>