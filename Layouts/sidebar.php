<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Parkir Kampus</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image d-flex align-items-center justify-content-left" style="width:40px; height: 35px; background-color: #6c757d; border-radius: 50%;">
          <i class="fas fa-user text-white" style="font-size: 20px"></i>
        </div>
        <div class="info" style="max-width: 100%; overflow: hidden;">
          <a href="#" class="d-block text-wrap white-space: normal; word-break: break-word" style="max-width: 100%; font-size: 1rem;" 
            title="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>">
            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-car"></i>
                <p>
                  Kendaraan
                  <span class="right badge badge-danger">New</span>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./Pages/Kendaraan/list.php" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Data Kendaraan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./Pages/Jenis/list_jenis.php" class="nav-link">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>Jenis Kendaraan</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="./Pages/Area_Parkir/list_area.php" class="nav-link">
                <i class="nav-icon fas fa-parking"></i>
                <p>
                  Area Parkir
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./Pages/Transaksi/list.php" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>Transaksi Parkir</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./Pages/Kampus/list.php" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>Data Kampus</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu --> 
    </div>
    <!-- /.sidebar -->
  </aside>