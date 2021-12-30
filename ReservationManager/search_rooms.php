<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 3) {
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
                  <li class="breadcrumb-item active" aria-current="page">Search Room Availability</li>
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
              <h3 class="mb-0">Available Rooms</h3>
            </div>
            <div class="card-body">
                <div class="row icon-examples">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                </div>
                                <div class="card-body">
                                    <?php
                                        require_once '../Database.php';
                                        $connect = new Database();
                                        $db = $connect->db();
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Hotel</label>
                                                <select name="hotel" id="hotel" class="form-control" required>';?>
                                                    <!--select hotel -->
                                                    <option value="">Please Select</option>
                                                    <?php
                                                        $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                        while ($row = mysqli_fetch_assoc($list)) {
                                                             echo' <option value="'.$row['code'].'">'.$row['name'].'</option>';
                                                        } 
                                                    ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-roomtype">Room Type</label>
                                                <select name="room_type" id ="room_type" class="form-control" required>';?>
                                                    <!--room type -->
                                                    <option value="">Please Select</option>
                                                    <?php
                                                        $list = mysqli_query($db,"SELECT * FROM `room_types`");
                                                        while ($row = mysqli_fetch_assoc($list)) {
                                                            echo' <option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                        } 
                                                    ?>    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" id="search" name="submit" class="btn btn-warning">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <!---------------------show results ---------------->
                    <div class="col-xl-12 order-xl-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                </div>
                                <div class="card-body">
                                    <div id="result"></div>
                                    </div>
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

  <script>
    $(document).ready(function(){
        function search_rooms(hotel,room_type)
        {
            $.ajax({
                url:"get_available_rooms.php",
                method:"post",
                data:{hotel:hotel,room_type:room_type},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
    
        $('#search').on('click', function(){
            hotel = $('#hotel :selected').val();
            room_type = $('#room_type :selected').val();
              search_rooms(hotel,room_type);
        });
    });
</script>
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