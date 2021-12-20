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
                  <li class="breadcrumb-item active" aria-current="page">View Inquiry</li>
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
              <h3 class="mb-0">View Inquiry</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <?php 
                if (isset($_GET['inquiry'])){
                  
                   $inquiryid = $_GET['inquiry'];

                    if ( is_numeric($inquiryid) == true){
                       require_once '../Database.php';
                    try{

                       $connect = new Database();
                       $db = $connect->db();
                       
                        $inquiryid = mysqli_real_escape_string($db, $_GET['inquiry']);
                        $query = "
                        SELECT * FROM inquiry 
                        WHERE id = '".$inquiryid."'
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
                              $customer_id=$row['customer_id'];
                              $room_type_id=$row['room_type_id'];
                              $is_ac=$row['is_ac'];
                              $status = $row['status'];
                              $recipient_id = $row['recipient_id'];
                              $check_in = $row['check_in'];
                              $check_out = $row['check_out'];
                              $adults = $row['adults'];
                              $children = $row['children'];


                              if ($is_ac == 1) {
                                $ac = "1";
                              }else{
                                $ac = "0";
                              }

                              $check_in_date = new DateTime($check_in, new DateTimeZone('Asia/Colombo'));
                              $check_in_date = $check_in_date->format("Y-m-d");
                              $check_in_time = new DateTime($check_in, new DateTimeZone('Asia/Colombo'));
                              $check_in_time = $check_in_time->format("H:i");

                              $check_out_date = new DateTime($check_out, new DateTimeZone('Asia/Colombo'));
                              $check_out_date = $check_out_date->format("Y-m-d");
                              $check_out_time = new DateTime($check_out, new DateTimeZone('Asia/Colombo'));
                              $check_out_time = $check_out_time->format("H:i");
                         

                                $query2 = "
                        SELECT * FROM customers 
                        WHERE id = '".$customer_id."'
                        ";
                           $result2 = mysqli_query($db, $query2);
                      


                        
                          if(mysqli_num_rows($result2) > 0)
                          {
                            
                          while($row2 = mysqli_fetch_array($result2)){

                                $id = $row2['id'];
                                $firstname=$row2['first_name'];
                                $lastname=$row2['last_name'];
                                $email=$row2['email'];
                                $address = $row2['address'];
                                $mobile = $row2['mobile'];

                              }
                          


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
                <h6 class="heading-small text-muted mb-4">Room Information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">

                     
                        <!--room type -->
                    <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Room ID</label>
                        <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$room_type_id.'" readonly>
                      </div>';
                  ?>
                  <?php

                      $list = mysqli_query($db,"SELECT * FROM `room_types` WHERE id =".$room_type_id." ");
                      while ($row = mysqli_fetch_assoc($list)) {
                      $roomname = $row['name'];
                       } ?>
<?php
                echo'    <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Room Type</label>
                        <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$roomname.'" readonly>
                      </div>
                      
                    </div>
                  </div>
                  <div class="row">
                  
                  <div class="col-lg-12">

                  <div class="form-group">
                  <label for="adults" class="form-control-label">Total Adults</label>
                  <input name="adults" value="'.$adults.'" class="form-control" type="text" id="adults" min="0" readonly>
                  </div>

                   
                  <div class="form-group">
                    <label for="children" class="form-control-label">Total Children</label>
                    <input name="children" value="'.$children.'" class="form-control" type="text" id="children" min="0" readonly>
                  </div>

                  </div>
                </div>

                  <div class="row">
                  
                    <div class="col-lg-12">

                      '; ?>
                        <?php 
                        if ($is_ac == 1) {
                          echo ' <div class="form-group">
                        <label class="form-control-label" for="input-first-name">AC</label>
                        <input name="fname" type="text" id="input-first-name" class="form-control" value="YES" readonly>
                      </div>';
                        }else{
                          echo ' <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Room ID</label>
                        <input name="fname" type="text" id="input-first-name" class="form-control" value="NO" readonly>
                      </div>';
                        }
                          echo'
                           
                      </div>
                      </div>
                        <div class="row">
                  
                    <div class="col-lg-12">
                      <div class="form-group">
                      <label for="example-datetime-local-input" class="form-control-label">Check In</label>
                      <input name="checkin" class="form-control" type="datetime-local" value="'.$check_in_date.'T'.$check_in_time.':00" id="example-datetime-local-input" readonly>
                      </div>

                       <div class="form-group">
                      <label for="example-datetime-local-input" class="form-control-label">Check Out</label>
                      <input name="checkout" class="form-control" type="datetime-local" value="'.$check_out_date.'T'.$check_out_time.':00" id="example-datetime-local-input" readonly>
                      </div>

                    </div>
                    <div class="col-lg-12">
                     <a href="check_inquiries.php" type="submit" name="submit" class="btn btn-warning">Back to Inquiries</a>
                   </div>

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


                   }

                  }else{

                              echo '<center>Sorry No Inquiry Found!!</center>';
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