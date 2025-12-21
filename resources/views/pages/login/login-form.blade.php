<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | DesaSface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #28a745;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* ===============================
           LOGIN WRAPPER
           =============================== */
        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding-top: 90px;
            padding-bottom: 40px;
        }

        /* ===============================
           CARD
           =============================== */
        .login-card {
            width: 300px;
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .login-card .card-body {
            padding: 16px;
        }

        /* ===============================
           LOGO
           =============================== */
        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-container img {
            max-width: 110px;
        }

        /* ===============================
           TEXT
           =============================== */
        .card-title {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 4px;
        }

        .card-subtitle {
            font-size: 12px;
            text-align: center;
            margin-bottom: 12px;
            color: #6c757d;
        }

        /* ===============================
           FORM
           =============================== */
        .form-label {
            font-size: 11px;
            margin-bottom: 3px;
        }

        .form-control {
            font-size: 12px;
            padding: 6px 8px;
            border-radius: 6px;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 4px rgba(72, 180, 97, 0.5);
        }

        /* ===============================
           BUTTON
           =============================== */
        .btn-primary {
            background-color: #4CAF50;
            border: none;
            font-size: 12px;
            padding: 6px;
            border-radius: 6px;
        }

        .btn-secondary {
            font-size: 12px;
            padding: 6px;
            border-radius: 6px;
        }

        /* ===============================
           ALERT
           =============================== */
        .alert {
            font-size: 11px;
            padding: 6px 8px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="card-body">

            <div class="logo-container">
                <img src="{{ asset('assets/img/logo3.png') }}" alt="Logo DesaSface">
            </div>

            <h5 class="card-title">Form Login</h5>
            <p class="card-subtitle">
                Silahkan masukkan username dan password
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf

                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="text"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Masukkan Email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan Password">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">
                    Login
                </button>
            </form>

            <a href="{{ route('about') }}" class="btn btn-secondary w-100">
                Masuk sebagai Guest
            </a>

        </div>
    </div>
</div>

</body>
</html>
