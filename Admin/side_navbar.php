<!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../images/lakderana7.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="nav-link-text">Hello <?php echo $user; ?> !</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/admin/">
                <i class="fas fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                <i class="fas fa-user-plus text-green"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="hotels.php">
                <i class="fas fa-hotel text-orange"></i>
                <span class="nav-link-text">Hotels</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rooms.php">
                <i class="fas fa-warehouse text-primary"></i>
                <span class="nav-link-text">Rooms</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="ni ni-single-copy-04 text-blue"></i>
                <span class="nav-link-text">Generate Reports</span>
              </a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="settings.php">
                <i class="ni ni-settings text-orange"></i>
                <span class="nav-link-text">Account Settings</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <i class="ni ni-button-power text-dark"></i>
                <span class="nav-link-text">Logout</span>
              </a>
            </li>
          </ul>
         
      
        </div>
      </div>
    </div>
  </nav>