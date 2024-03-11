@php
  $emp = App\Models\Employee::findOrFail(session('key'));
@endphp

<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="text-decoration: none">
      
      <h5 class="brand-text  font-weight-light">Employee- Bengal Software</h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-theme-dark">
      <!-- Sidebar user (optional) -->
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/admin/images/employees/'.$emp->photo)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <h5 class="brand-text text-light">{{ $emp->name }}</h5>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('employee.dashboard',session('key'))}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employee.profile',session('key'))}}" class="nav-link">
                <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employee.profile.reward',session('key'))}}" class="nav-link">
                <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>
                Reward Points
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employee.profile.attendance',session('key'))}}" class="nav-link">
                <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>
                Attendance
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employee.holiday',session('key'))}}" class="nav-link">
                <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>
                Holidays
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employee.salary',session('key'))}}" class="nav-link">
                <i class="nav-icon fa-solid fa-clipboard-user"></i>
              <p>
                Salaries
              </p>
            </a>
          </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                  {{-- <i class="nav-icon fas fa-tasks"></i> --}}
                  <i class="nav-icon fa-solid fa-clipboard-user"></i>
                  <p>
                      Application
                      <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('employee.application',session('key'))}}" class="nav-link">
                          <i class="fas fa-plus nav-icon"></i>
                          <p>Do Application</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{route('employee.application.list',session('key'))}}" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Application List</p>
                      </a>
                  </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{route('employee.profile.loan',session('key'))}}" class="nav-link">
                  <i class="nav-icon fa-solid fa-clipboard-user"></i>
                <p>
                  Loans
                </p>
              </a>
            </li>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>