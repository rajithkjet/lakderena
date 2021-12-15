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
              <a class="nav-link active" href="/Receptionist/">
                <i class="fas fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="customer_registration.php">
                <i class="fas fa-user-plus text-green"></i>
                <span class="nav-link-text">Register New Customers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-file-alt text-pink"></i>
                <span class="nav-link-text">Add Room Inquiry</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-user-edit text-orange"></i>
                <span class="nav-link-text">Update Existing Customer</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-search text-blue"></i>
                <span class="nav-link-text">Search Existing Customers</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-print text-green"></i>
                <span class="nav-link-text">Print Invoice</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
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