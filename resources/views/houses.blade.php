<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de casas</title>
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

        .house-row {
            background-color: #E7F2FF;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .house-info {
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .house-info h5,
        .house-info p {
            margin: 0 10px;
        }

        .house-description {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
        }

        .edit-icon, .delete-icon {
            background-color: #fff;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-left: 10px;
        }

        .add-house-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .animal-image {
            width: 4rem;
            height: 4rem;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar header">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('imgs/left-arrow.png') }}" alt="Back">
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="main-div">
            @foreach ($houses as $house)
                <div class="house-row">
                    @foreach ($house->animals as $animal)
                        <img src="{{ asset('imgs/' . $animal->image_path) }}" alt="Pet Image" class="animal-image">
                    @endforeach
                    <div class="house-info">
                        <h5>{{ $house->rua }}, {{ $house->bairro }} - {{ $house->estado }}</h5>
                        <p>CEP: {{ $house->cep }}</p>
                    </div>
                    <span class="edit-icon" onclick="window.location.href='{{ route('houses.edit', $house->id) }}'">
                        <img src="{{ asset('imgs/edit-pencil.png') }}" alt="Edit Icon" style="width: 20px;">
                    </span>
                    <span class="delete-icon" data-toggle="modal" data-target="#deleteModal{{ $house->id }}">
                        <img src="{{ asset('imgs/delete.svg') }}" alt="Delete Icon" style="width: 20px;">
                    </span>
                </div>
                <div class="modal fade" id="deleteModal{{ $house->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel{{ $house->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $house->id }}">Confirmar Deleção</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja deletar essa casa?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button class="add-house-btn" onclick="window.location.href='{{ route('houses.create') }}'">+</button>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>