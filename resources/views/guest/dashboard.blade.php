<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guest Dashboard</title>

  <!-- Plugins: CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">

  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo me-5" href="#">
          <img src="{{ asset('assets/images/logo.svg') }}" class="me-2" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="#">
          <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('assets/images/faces/face28.jpg') }}" alt="profile" />
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="#">
              <span class="menu-icon"><i class="icon-speedometer"></i></span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="#">
              <span class="menu-icon"><i class="icon-grid"></i></span>
              <span class="menu-title">UI Elements</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="#">
              <span class="menu-icon"><i class="icon-layout"></i></span>
              <span class="menu-title">Forms</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="#">
              <span class="menu-icon"><i class="icon-bar-chart"></i></span>
              <span class="menu-title">Charts</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main Panel -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Welcome John</h4>
                  <p class="text-muted">All systems are running smoothly! You have 3 unread alerts!</p>
                </div>
                <div>
                  <button type="button" class="btn btn-primary btn-icon-text">
                    <i class="ti-calendar btn-icon-prepend"></i>Today (10 Jan 2021)
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Weather Card -->
            <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{ asset('assets/images/dashboard/people.svg') }}" alt="people" />
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal">
                          <i class="icon-sun me-2"></i>31<sup>C</sup>
                        </h2>
                      </div>
                      <div class="ms-2">
                        <h4 class="location font-weight-normal">Chicago</h4>
                        <h6 class="font-weight-normal">Illinois</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Stats Cards -->
            <div class="col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Today’s Bookings</h4>
                  <h2 class="mb-2">4006</h2>
                  <p>10.00% (30 days)</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Bookings</h4>
                  <h2 class="mb-2">61344</h2>
                  <p>22.00% (30 days)</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Number of Meetings</h4>
                  <h2 class="mb-2">34040</h2>
                  <p>2.00% (30 days)</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Number of Clients</h4>
                  <h2 class="mb-2">47033</h2>
                  <p>0.22% (30 days)</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              © 2025 Guest Dashboard (Assets Template)
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- JS: Vendors -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom JS -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>
</html>


