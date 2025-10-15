<!DOCTYPE html> 
<html>
    <head>
        <title>Login Success</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-body"
                        <h5 class="card-title text-center mb-3">Login Berhasil!</h5>
                        <p class="small text-muted" mb-4>Selamat datang, <strong>{{ $username }}</strong></p>
                        <a href="{{ route('auth.index') }}" class="btn btn-primary btn-sm d-grid">kembali ke login</a>
                    </div>
                </div>
            </div>
        </div>  
</div>
 </body>
</html>