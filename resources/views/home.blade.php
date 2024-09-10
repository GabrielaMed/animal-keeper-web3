<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F3FCFF;
        }
        .header {
            background-color: #E7F2FF;
        }
        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .dropdown-item, .navbar-brand, .nav-link {
            color: black !important;
        }
        .dropdown-item:hover, .dropdown-item:focus, .navbar-brand:hover, .nav-link:hover {
            color: black !important;
            background-color: #E7F2FF !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg header">
        <div class="container">
            <a class="navbar-brand text-black" href="#">Animal Keeper</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('home') }}">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('imgs/' . Auth::user()->avatar_path) }}" alt="User Image" class="user-image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">Perfil</a>
                            <a class="dropdown-item" href="{{ route('animals') }}">Animais</a>
                            <a class="dropdown-item" href="{{ route('houses') }}">Casas</a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>