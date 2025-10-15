<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            text-align: center;
        }

        /* Area logo di atas form */
        .logo-container {
            padding-top: 50px;
            margin-bottom: 20px;
        }

        .logo-fullscreen {
            max-width: 250px;
            height: auto;
        }

        /* Container form login */
        .login-section {
            margin-top: 10px;
        }

        .card {
            border-radius: 12px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>

<body>
    <!-- LOGO -->
    <div class="logo-container">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo-fullscreen">
    </div>

    <!-- FORM LOGIN -->
    <div class="container login-section">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Form Login</h5>
                        <p class="card-subtitle text-muted mb-3 text-center">Silahkan masukkan username dan password</p>

                        {{-- Error Validation --}}
                        @if ($errors->any())
                            <div class="alert alert-danger small py-2">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Pesan Error Custom --}}
                        @if (session('error'))
                            <div class="alert alert-warning small py-2">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <div class="mb-3 text-left">
                                <label class="form-label small">Username</label>
                                <input type="text" class="form-control form-control-sm"
                                       name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                            </div>

                            <div class="mb-3 text-left">
                                <label class="form-label small">Password</label>
                                <input type="password" name="password" class="form-control form-control-sm"
                                       placeholder="Masukkan password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Login</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
