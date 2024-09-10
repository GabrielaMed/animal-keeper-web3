<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F3FCFF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #E7F2FF;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
        }
        .form-control {
            background-color: #F3FCFF;
            border-radius: 5px;
        }
    </style>
    <script>
        function toggleDocumentInput() {
            var documentType = document.getElementById('document_type').value;
            if (documentType === 'cpf') {
                document.getElementById('cpf_input').style.display = 'block';
                document.getElementById('passport_input').style.display = 'none';
            } else {
                document.getElementById('cpf_input').style.display = 'none';
                document.getElementById('passport_input').style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="text-center">Cadastre-se</h2>
                    <form action="{{ route('signup') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="birthdate">Data Aniversário</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document_type">Documento</label>
                            <select class="form-control" id="document_type" name="document_type" onchange="toggleDocumentInput()">
                                <option value="cpf">CPF</option>
                                <option value="passport">Passaporte</option>
                            </select>
                        </div>
                        <div class="form-group" id="cpf_input">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') }}">
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" id="passport_input" style="display: none;">
                            <label for="passport">Passaporte</label>
                            <input type="text" class="form-control @error('passport') is-invalid @enderror" id="passport" name="passport" value="{{ old('passport') }}">
                            @error('passport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Confirmar Senha</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile_name">Perfil</label>
                            <select class="form-control @error('profile_name') is-invalid @enderror" id="profile_name" name="profile_name" required>
                                <option value="guest">Hóspede</option>
                                <option value="host">Anfitrião</option>
                            </select>
                            @error('profile_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cadastre-se</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">Já possui uma conta? Faça login aqui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
