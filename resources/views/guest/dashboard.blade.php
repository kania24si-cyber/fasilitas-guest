<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volt Dashboard</title>

  <!-- CSS Volt -->
  <link rel="stylesheet" href="{{ asset('assets-guest/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-guest/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-guest/css/volt.css') }}">
</head>

<body>

  <!-- Sidebar -->
  <nav id="sidebarMenu" class="sidebar d-lg-block bg-dark text-white position-fixed h-100">
    <div class="sidebar-inner px-4 pt-3">
      <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item mb-3">
          <a href="#" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <img src="{{ asset('assets-guest/img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">Volt Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-chart-line"></i></span>
            <span class="sidebar-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-table"></i></span>
            <span class="sidebar-text">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-cog"></i></span>
            <span class="sidebar-text">Settings</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main content -->
  <main class="content">
    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
      <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
          <div class="d-flex align-items-center">
            <h1 class="h4 mb-0 text-white">Dashboard Overview</h1>
          </div>
          <div class="navbar-user d-flex align-items-center">
            <a href="#" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
              <i class="fas fa-sign-out-alt me-1"></i>
              Logout
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="py-4">
      <div class="card shadow border-0 mb-4">
        <div class="card-body">
          <h2 class="h5 mb-3">Welcome to Volt Dashboard</h2>
          <p>This is the full Volt Admin Template loaded inside one Blade file.</p>
        </div>
      </div>
    </div>
  </main>

  <!-- JS Volt -->
  <script src="{{ asset('assets-guest/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets-guest/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('assets-guest/js/volt.js') }}"></script>
</body>
</html>
