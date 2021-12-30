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
              <a class="nav-link active" href="/ReservationManager/">
                <i class="fas fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="search_rooms.php">
                <i class="fas fa-search text-green"></i>
                <span class="nav-link-text">Search Room Availability</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-user-plus text-pink"></i>
                <span class="nav-link-text">Register Customers to Rooms</span>
              </a>
            </li> -->
             <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-pencil-alt text-orange"></i>
                <span class="nav-link-text">Update Room Status</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-paper-plane text-blue"></i>
                <span class="nav-link-text">Transfer Inquires</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-file-alt text-green"></i>
                <span class="nav-link-text">Daily Reservations Report</span>
              </a>
            </li>
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