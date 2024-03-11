

<style>
  @media (max-width: 991px) {
    .navbar-nav {
      margin-left: 75%;
      justify-content: flex-end !important;
      text-align: right !important;
    }
  } 
  </style>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="nav_button" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('employee.logout') }}" class="nav-link text-danger text-bold">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        
      </li>
      
      
    </ul>
  </nav>
  <!-- /.navbar -->