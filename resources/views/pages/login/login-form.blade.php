<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #28a745; /* Background hijau */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Container untuk form login */
        .login-section {
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        /* Area logo di atas form */
        .logo-container {
            padding-top: 30px;
            margin-bottom: 20px;
        }

        .logo-fullscreen {
            max-width: 200px;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .logo-fullscreen:hover {
            transform: scale(1.05);
        }

        /* Form Styling */
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            box-shadow: none;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(72, 180, 97, 0.6);
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .card-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .alert {
            border-radius: 8px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .login-section {
                margin-top: 20px;
            }

            .card {
                padding: 20px;
            }

            .logo-fullscreen {
                max-width: 180px;
            }
        }
    </style>
</head>

<body>
    <!-- FORM LOGIN -->
    <div class="container login-section">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Logo di atas form -->
                        <div class="logo-container text-center">
                            <img src="{{ asset('assets/img/logo3.png') }}" alt="Logo DesaSface" class="logo-fullscreen">
                        </div>

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
                                <label class="form-label small">Email</label>
                                <input type="text" class="form-control form-control-sm" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                            </div>

                            <div class="mb-3 text-left">
                                <label class="form-label small">Password</label>
                                <input type="password" name="password" class="form-control form-control-sm" placeholder="Masukkan password">
                            </div>

                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Login</button>
                            </div>
                        </form>

                        <!-- Link to Dashboard if already logged in or after successful login -->
                        <div class="mt-3">
                            <a href="{{ route('about') }}" class="btn btn-secondary btn-sm btn-block">
                                Masuk sebagai Guest 
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
