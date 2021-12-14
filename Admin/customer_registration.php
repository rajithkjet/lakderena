<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 1) {
        header("location:../index.php");
    }  

    $user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>

<!-- Header -->
<?php include "../dashboard_header.php" ?>

<body>
  <!-- Sidenav --> 
<?php include "side_navbar.php" ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
 
  <!-- Topnav -->
  <?php include "top_navbar.php" ?>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-gradient-orange pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Register Customer</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Register Customer</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
             
                  <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Customer information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control" placeholder="jesse@example.com">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   
                  
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Mobile</label>
                        <input type="number" id="input-postal-code" class="form-control" placeholder="Enter Number">
                      </div>
                    </div>
                    <div class="col-lg-12">
                     <button type="submit" class="btn btn-warning">Register</button>
                   </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php include "../dashboard_footer.php" ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/clipboard/dist/clipboard.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>