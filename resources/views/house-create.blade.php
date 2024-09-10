<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Casa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F3FCFF;
        }

        .header {
            background-color: #E7F2FF;
            padding: 10px;
            height: 6rem;
            position: relative;
        }

        .navbar-brand img {
            width: 16px;
            height: 16px;
            position: absolute;
            top: 16px;
            left: 16px;
        }

        .form-container {
            background-color: #E7F2FF;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar header">
        <div class="container">
            <a class="navbar-brand" href="{{ route('houses') }}">
                <img src="{{ asset('imgs/left-arrow.png') }}" alt="Back">
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="rua">Rua</label>
                    <input type="text" class="form-control" id="rua" name="rua" required>
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
                <div class="form-group">
                    <label for="animals">Animais</label>
                    <div id="animals">
                        @if($animals)
                            @foreach ($animals as $animal)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="animal{{ $animal->id }}" name="animals[]" value="{{ $animal->id }}">
                                    <label class="form-check-label" for="animal{{ $animal->id }}">
                                        {{ $animal->name }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <p>Nenhum animal encontrado.</p>
                        @endif
                    </div>
                </div>
                <button type="submit" class="submit-btn">Salvar</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>