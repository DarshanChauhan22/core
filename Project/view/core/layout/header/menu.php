
<head>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="skin/admin/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="skin/admin/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="skin/admin/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://localhost/core/core/Project/skin/admin/image/dp.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Dom Torreto</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','admin',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Admin</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','customer',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Customer</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','product',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Product</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','category',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Category</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','config',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Config</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','salesman',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Salesman</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','page',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Page</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','vendor',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Vendor</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','paymentMethod',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Payment Method</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','shippingMethod',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Shipping Method</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','order',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Order</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo $this->getUrl('logout','admin_login',null,true) ?>" class="nav-link">
                  <i class="fa fa-table nav-icon" ></i>
                  <p>Logout</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="skin/admin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="skin/admin/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="skin/admin/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="skin/admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="skin/admin/js/demo.js"></script>
</body>