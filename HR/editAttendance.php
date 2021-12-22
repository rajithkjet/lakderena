<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 5) {
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
                  <li class="breadcrumb-item active" aria-current="page">Update Attendance</li>
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
                            <h3 class="mb-0">Update Attendance</h3>
                        </div>
                    <div class="card-body">
                        <div class="row icon-examples">
                <?php 
                if (isset($_GET['id'])){
                  
                   $attendanceid = $_GET['id'];

                    if ( is_numeric($attendanceid) == true){
                       require_once '../Database.php';
                    try{

                       $connect = new Database();
                       $db = $connect->db();
                       
                        $attendanceid = mysqli_real_escape_string($db, $_GET['id']);
                        $query = "
                        SELECT * FROM attendance 
                        WHERE id = '".$attendanceid."'
                        ";

                        $result = mysqli_query($db, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                    

                        while($row = mysqli_fetch_array($result)){

                              $id = $row['id'];
                              $employee=$row['employee'];
                              $date=$row['date'];
                              $is_present=$row['is_present'];
                              $duration = $row['duration'];
                              $updated_by = $row['updated_by'];

                               $query2 = "
                                SELECT * FROM employees 
                                WHERE id = '".$employee."'
                                ";

                                $result2 = mysqli_query($db, $query2);
                                if(mysqli_num_rows($result2) > 0)
                                { 
                                    while($row = mysqli_fetch_array($result2)){
                                    $empid = $row['id'];
                                    $firstname=$row['first_name'];
                                    $lastname=$row['last_name'];
                                    $email=$row['email'];
                                    $address = $row['address'];
                                    $mobile = $row['mobile'];
                                    $job_role_id = $row['job_role_id'];
                                    $hotel_no = $row['hotel_no'];
                                    }
                                }

                             echo'
                            <div class="col-xl-12 order-xl-1">
                                    <div class="card">
                                            <div class="card-header">
                                            <div class="row align-items-center">
                                            </div>
                                                <div class="card-body">
                                                        <form name="employeeRegForm" action="" method="post" onsubmit="return validateForm()">
                                                                <h6 class="heading-small text-muted mb-4">Employee information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-email">Email address</label>
                                                                                <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                                                <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                                                <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                <!-- Contact Info -->
                                                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="input-address">Address</label>
                                                                            <input name="address" id="input-address" class="form-control" value="'.$address.'" type="text" readonly>
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label">Mobile</label>
                                                                                <input name="mobile" type="text" id="phone" class="phone form-control" value="'.$mobile.'" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                <!-- Job info -->
                                                                <h6 class="heading-small text-muted mb-4">Job information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-address">Job Role</label>
                                                                                    <select name="job_roles" class="form-control" readonly>';?>
                                                                                    <!--select job type -->
                                                                                        <?php
                                                                                            require_once '../Database.php';
                                                                                            $connect = new Database();
                                                                                            $db = $connect->db();
                                                                                            $list = mysqli_query($db,"SELECT * FROM `job_roles`");
                                                                                            while ($row = mysqli_fetch_assoc($list)) 
                                                                                            {
                                                                                                if ($job_role_id == $row['id'] )
                                                                                                    {
                                                                                                        echo' <option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                                                                                                    }
                                                                                            }
                                                                                            $db = null;
                                                                                        ?>
                                                                                   <?php echo'</select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-address">Hotel</label>
                                                                                    <select name="hotel" class="form-control" readonly>';?>
                                                                                    <!--select hotel -->
                                                                                        <?php
                                                                                            require_once '../Database.php';
                                                                                            $connect = new Database();
                                                                                            $db = $connect->db();
                                                                                            $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                                                            while ($row = mysqli_fetch_assoc($list)) 
                                                                                            {
                                                                                               if ($hotel_no == $row['code'] )
                                                                                                    {
                                                                                                        echo' <option value="'.$row['code'].'" selected>'.$row['name'].'</option>';
                                                                                                    }
                                                                                            } 
                                                                                        ?>
                                                                                   <?php echo' </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4" />
                                                                <!-- Attendance info -->
                                                                <h6 class="heading-small text-muted mb-4">Attendance Information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">';?>
                                                                        <?php
                                                                            $attend_date = new DateTime($date, new DateTimeZone('Asia/Colombo'));
                                                                            $attend_date = $attend_date->format("Y-m-d");
                                                                            echo' <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                    <label for="example-datetime-local-input" class="form-control-label">Date</label>
                                                                                    <input name="attendDate" class="form-control" type="date" value="'.$attend_date.'" id="example-datetime-local-input">
                                                                                    </div> 
                                                                                </div> 

                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="input-address">Is Present?</label>
                                                                                        <select name="isPresent" class="form-control">';?>
                                                                                        <!--select hotel -->
                                                                                            <?php
                                                                                                
                                                                                                if ($is_present == 1 )
                                                                                                        {
                                                                                                            echo' <option value="1" selected>Yes</option>';
                                                                                                            echo' <option value="0">No</option>';
                                                                                                        }elseif($is_present == 0){
                                                                                                            echo' <option value="0" selected>No</option>';
                                                                                                            echo' <option value="1">Yes</option>';
                                                                                                        }
                                                                                                
                                                                                            ?>
                                                                                    <?php echo' </select>
                                                                                </div>
                                                                            </div>     
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="adults" class="form-control-label">Enter Total Working Hours</label>
                                                                                <input name="duration" value="'.$duration.'" class="form-control" type="text" id="adults" min="0">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                    
                                                            </div>
                                                        </form>
                                                </div>
                            </div>
                        </div>
                    </div>';
                     $db = null;
                     }
                  }else{

                              echo '<center>Sorry No Attendance Record Found!!</center>';
                          }

                           //Close the connection to the database.
                              $db = null;
                 }
                 catch(Exception $e){
                      http_response_code(500);
                      die('Error establishing connection with database');
                    }
                   }else{
                
                    http_response_code(400);
                    die('Error processing bad or malformed request');
                   }
                }
            
                ?>
                
                </div>
            </div>
        </div>
    </div>
      </div>
      <!-- Footer -->
      <?php include "../dashboard_footer.php" ?>
    </div>
  </div>

<!---------------------------- Update process ------------------------------>

<?php

if (isset($_POST['submit']))
{
    include 'Employee.php';

    //create new instance from Employee class
    $employee = new Employee(); 

    $attendDate = $_POST['attendDate'];    

    $isPresent = filter_input(INPUT_POST, 'isPresent', FILTER_SANITIZE_STRING);
    $is_present_status = $isPresent;

    $duration = $_POST['duration'];
    
    if($duration == ""){
        $duration = 0;
    }

    $hrid = $_SESSION['id'];

    $employee->updateAttendance($attendDate, $is_present_status, $duration, $hrid, $attendanceid);

        

}

?>

<!--------------------- Update process end ------------------------>

      <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>




<script>

  $('input[name="duration"]').mask('0000000000');
</script>




  <!-- ---------------Notifications--------------------------- -->
  <?php 

if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Attendance Updated Success!", "Attendance Details updated!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal("Attendance Update Failed!", "Something went wrong!", "error");
                </script>';
             
          }


 ?>

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