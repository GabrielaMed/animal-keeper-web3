<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
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
            <a class="navbar-brand" href="{{ route('animals') }}">
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
            <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter animal name" value="{{ old('name', $animal->name) }}">
                </div>
                <div class="form-group">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter date of birth" value="{{ old('birthdate', $animal->birthdate) }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description', $animal->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Imagem</label>
                    <input type="file" class="form-control-file" id="image" name="image">
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