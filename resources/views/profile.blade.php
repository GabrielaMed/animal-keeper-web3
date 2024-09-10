<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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

        .profile-image-container {
            position: relative;
            display: flex;
            justify-content: flex-start;
            margin-top: -50px;
            margin-left: 20px;
            width: fit-content;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #E7F2FF;
            position: relative;
        }

        .edit-icon {
            position: absolute;
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
        }

        .edit-icon.image-edit {
            bottom: 0;
            right: 0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            background-color: #F3FCFF !important;
        }

        form {
            background-color: #E7F2FF;
            padding: 20px;
            border-radius: 10px;
            position: relative;
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

    <div class="profile-image-container">
        <img src="{{ asset('imgs/' . Auth::user()->avatar_path) }}" alt="Profile Image" class="profile-image">
        <span class="edit-icon image-edit">
            <img src="{{ asset('imgs/edit-pencil.png') }}" alt="Edit Icon" style="width: 20px;">
        </span>
    </div>

    <div class="container mt-5">
        <form id="updateInfoForm" method="POST" action="{{ route('profile.updateInfo', ['id' => Auth::user()->id]) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dob">Data de Nascimento</label>
                        <input type="text" class="form-control" id="dob" name="birthdate"
                            value="{{ \Carbon\Carbon::parse(Auth::user()->birthdate)->format('d/m/Y') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf"
                            value="{{ Auth::user()->cpf }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="passport">Passaporte</label>
                        <input type="text" class="form-control" id="passport" name="passport"
                            value="{{ Auth::user()->passport }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ Auth::user()->phone }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editImageForm" method="POST" enctype="multipart/form-data"
                        action="{{ route('profile.updateImage') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editImageModalLabel">Alterar Foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelector('.edit-icon.image-edit').addEventListener('click', function() {
            $('#editImageModal').modal('show');
        });
    </script>
</body>

</html>
