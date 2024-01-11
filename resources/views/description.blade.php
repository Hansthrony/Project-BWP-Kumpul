<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description Page</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>
        .row 
        {
            margin: 3%;
            width: 100%;
            height: 80%;
            background-color: aqua;
            display: flex;
            align-items: center;
        }

        .row .desc 
        {
            color: blue;
            display: inline;
            float: left;
        }
    </style>
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
    </header>

    <div class="container">
        <div class="row">
            <h1 class="text-center">Description</h1>
            <p class="desc">
                Toko Buku Moyai is a book shop that sells <br>
                something like book and writing tool and anything else
            </p>
        </div>
    </div>
</body>

</html>