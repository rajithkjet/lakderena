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
              <a class="nav-link active" href="/Manager/">
                <i class="fas fa-tachometer-alt text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="hotelIncomeReport.php">
                <i class="fas fa-hotel text-green"></i>
                <span class="nav-link-text">Hotel Income Report</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="barIncomeReport.php">
                <i class="fas fa-cocktail text-pink"></i>
                <span class="nav-link-text">Bar Income Report</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="hotelExpenditureReport.php">
                <i class="fas fa-hotel text-orange"></i>
                <span class="nav-link-text">Hotel Expenditure Report</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="barExpenditureReport.php">
                <i class="fas fa-cocktail text-blue"></i>
                <span class="nav-link-text">Bar Expenditure Report</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-user-check text-green"></i>
                <span class="nav-link-text">Check Checked-in Adults And Children</span>
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