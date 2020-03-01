@inject('users','App\User')
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blood Bank</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--select2-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{asset('adminlte/img/admin-pic.png')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{auth()->user()->name}} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      {!! Form::open(['url'=>route('logout')]) !!}
                      <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                      {!! Form::close() !!}
                    </div>
                  </li>
                </ul>
            </li>
        </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light ">Blood Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/img/admin-pic.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{auth()->user()->name}}
           </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url(route('user.index'))}}" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url(route('role.index'))}}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url(route('governorate.index'))}}" class="nav-link">
              <i class="nav-icon fas fa-map-marker"></i>
              <p>Governorates</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url(route('city.index'))}}" class="nav-link">
              <i class="nav-icon fas fa-flag"></i>
              <p>Cities</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url(route('category.index'))}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Categories</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="{{url(route('post.index'))}}" class="nav-link">
                <i class="nav-icon fas fa-clone"></i>
                <p>Posts</p>
              </a>
          </li>
          <li class="nav-item">
                <a href="{{url(route('client.index'))}}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Clients</p>
                </a>
             </li>
              <li class="nav-item">
                    <a href="{{url(route('contactus.index'))}}" class="nav-link">
                      <i class="nav-icon fas fa-phone"></i>
                      <p>ContactUs</p>
                    </a>
              </li>
              <li class="nav-item">
                    <a href="{{url(route('donation.index'))}}" class="nav-link">
                      <i class="nav-icon fas fa-heart"></i>
                      <p>Donation Requests</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                      Settings
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{url(route('setting.index'))}}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url(route('user.change-password'))}}" class="nav-link">
                        <i class="nav-icon fas fa-unlock"></i>
                        <p>Change Password</p>
                      </a>
                    </li>

                  </ul>
                </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy;2019 <a href="#">Blood Bank Admin</a>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>
<!--select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

@stack('scripts')
</body>
</html>
