<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 2) {
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
                  <li class="breadcrumb-item active" aria-current="page">Add Inquiry</li>
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
              <h3 class="mb-0">Add Inquiry</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <?php 
                if (isset($_GET['customer'])){
                  
                   $customerid = $_GET['customer'];

                    if ( is_numeric($customerid) == true){
                       require_once '../Database.php';
                    try{

                       $connect = new Database();
                       $db = $connect->db();
                       
                        $customerid = mysqli_real_escape_string($db, $_GET['customer']);
                        $query = "
                        SELECT * FROM customers 
                        WHERE id = '".$customerid."'
                        ";

                        $result = mysqli_query($db, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                          //create current date
                          $c_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                          $c_date = $c_date->format("Y-m-d");

                          //create current time
                          $c_time = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                          $c_time = $c_time->format("H:i");
                        while($row = mysqli_fetch_array($result)){

                              $id = $row['id'];
                              $firstname=$row['first_name'];
                              $lastname=$row['last_name'];
                              $email=$row['email'];
                              $address = $row['address'];
                              $mobile = $row['mobile'];



      echo'     <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
            </div>
            <div class="card-body">
              <form name="addInquiryForm" action="" method="post"">
                <h6 class="heading-small text-muted mb-4">Customer Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                      <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Customer ID</label>
                        <input name="id" type="text" class="form-control" value="'.$id.'" readonly>
                      </div>
                    </div>
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
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input name="address" id="input-address" class="form-control" value="'.$address.'" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   
                  
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile</label>
                        <input name="mobile" type="text" id="phone" class="phone form-control" value="'.$mobile.'" readonly>
                      </div>
                    </div>

                  </div>
                </div>
                   <hr class="my-4" />
                <!-- Room Details -->
                <h6 class="heading-small text-muted mb-4">Enter Room Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label class="form-control-label" for="input-address">Select Room Type</label>

                        <select name="room_types" class="form-control">';?>
                        <!--select room type -->
                      <?php
                      $list = mysqli_query($db,"SELECT * FROM `room_types`");
                      while ($row = mysqli_fetch_assoc($list)) {
                      
                     echo' <option value="'.$row['id'].'">'.$row['name'].'</option>';
                       } ?>
                        
              <?php echo'
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  
                  <div class="col-lg-12">

                  <div class="form-group">
                  <label for="adults" class="form-control-label">Enter Total Adults</label>
                  <input name="adults" class="form-control" type="text" id="adults" min="0">
                  </div>

                   
                  <div class="form-group">
                    <label for="children" class="form-control-label">Enter Total Children</label>
                    <input name="children" class="form-control" type="text" id="children" min="0">
                  </div>

                  </div>
                </div>

                  <div class="row">
                  
                    <div class="col-lg-12">

                      <div class="form-group">
                        <label class="form-control-label">AC ?</label>
                        
                        <br/>
                        <label class="custom-toggle">
                            <input name="ac_type" type="checkbox" checked>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                      </div>

                      <div class="form-group">
                      <label for="example-datetime-local-input" class="form-control-label">Check In</label>
                      <input name="checkin" class="form-control" type="datetime-local" value="'.$c_date.'T'.$c_time.':00" id="example-datetime-local-input">
                      </div>

                       <div class="form-group">
                      <label for="example-datetime-local-input" class="form-control-label">Check Out</label>
                      <input name="checkout" class="form-control" type="datetime-local" value="'.$c_date.'T'.$c_time.':00" id="example-datetime-local-input">
                      </div>

                    </div>
                    <div class="col-lg-12">
                     <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                   </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
              </div>' ;
$db = null;
                     }
                  }else{

                              echo '<center>Sorry No Customer Found!!</center>';
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
             
<?php if(isset($_GET['success']))
          {
            echo'<a href="inquiry.php" type="button" style="color:white" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Inquiry</a>';
             
          }
          ?>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!---------------------------- Registration process ------------------------------>

<?php

if (isset($_POST['submit'])){
include 'Receptionist.php';

//create new instance from Receptionist class
$receptionist = new Receptionist(); 



$customer_id = $customerid;
$adults = $_POST['adults'];
$children = $_POST['children'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];

if ($adults == "") {
  $adults = 0;
}

if ($children == "") {
  $children = 0;
}

$rm_type = filter_input(INPUT_POST, 'room_types', FILTER_SANITIZE_STRING);
$room_type_id = $rm_type;

$is_ac = $_POST['ac_type'];

if ($is_ac == "on") {
  $ac_value = 1;
}else {
  $ac_value = 0;
}

$status = 0;
$receptionist_id = $_SESSION['id'];



$receptionist->addInquiry($customer_id, $room_type_id, $ac_value, $status, $receptionist_id, $checkin, $checkout, $adults, $children);



}

?>

<!--------------------- add inquiry process end ------------------------>



<script>

  $('input[name="adults"]').mask('0000000000');
  $('input[name="children"]').mask('0000000000');
</script>

      <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- ---------------Notifications--------------------------- -->
  <?php 

if(isset($_GET['registration']))
          {
            echo'<script>
                 swal("Customer Registration Success!", "New Customer Details added!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal("Customer Registration Failed!", "Something went wrong!", "error");
                </script>';
             
          }
if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Success!", "Inquiry Added Successfully!", "success");
                </script>';
             
          }

 ?>
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