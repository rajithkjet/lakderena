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
                  <li class="breadcrumb-item active" aria-current="page">Edit Customer Details</li>
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
              <h3 class="mb-0">Edit Customer Details</h3>
            </div>
            <div class="card-body">
                            <div class="row icon-examples">
             
              <?php 
                if (isset($_GET['id'])){
                  
                   $customerid = $_GET['id'];

                    if ( is_numeric($customerid) == true){
                       require_once '../Database.php';
                    try{

                       $connect = new Database();
                       $db = $connect->db();
                       
                        $customerid = mysqli_real_escape_string($db, $_GET['id']);
                        $query = "
                        SELECT * FROM customers 
                        WHERE id = '".$customerid."'
                        ";

                        $result = mysqli_query($db, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                    

                        while($row = mysqli_fetch_array($result)){

                              $id = $row['id'];
                              $firstname=$row['first_name'];
                              $lastname=$row['last_name'];
                              $email=$row['email'];
                              $address = $row['address'];
                              $mobile = $row['mobile'];

      echo'                        
                  <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
            </div>
            <div class="card-body">
              <form name="customerUpdateForm" action="" method="post" onsubmit="return validateForm()">
                <h6 class="heading-small text-muted mb-4">Customer information</h6>
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
                        <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" required="">
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
                        <input name="address" id="input-address" class="form-control" value="'.$address.'" type="text" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   
                  
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile</label>
                        <input name="mobile" type="text" id="phone" class="phone form-control" value="'.$mobile.'" required="" >
                      </div>
                    </div>
                    <div class="col-lg-12">
                     <button type="submit" name="submit" class="btn btn-warning">Update</button>
                   </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>'; 

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

<!---------------------------- Registration process ------------------------------>

<?php

if (isset($_POST['submit'])){
include 'Customer.php';

//create new instance from Customer class
$customer = new Customer(); 

$cus_id = $_POST['id'];
//check mail already exists
if ($customer->regCustomerEmailExists($_POST['email'], $cus_id)) {
  
  //if exists, then redirect to index page with notification value
  echo'<script>
  location.replace("edit_customer.php?id='.$cus_id.'&emailexists=true");
   </script>';

}else{

$firstName = $_POST['fname'];
$firstName= ucwords(strtolower($firstName));

$lastName = $_POST['lname'];
$lastName= ucwords(strtolower($lastName));

$address = $_POST['address'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$firstName = stripslashes($firstName);
$firstName = addslashes($firstName);
$firstName = ucwords(strtolower($firstName));

$lastName = stripslashes($lastName);
$lastName = addslashes($lastName);
$lastName = ucwords(strtolower($lastName));

$email = stripslashes($email);
$email = addslashes($email);

$address = stripslashes($address);
$address = addslashes($address);

$mobile = stripslashes($mobile);
$mobile = addslashes($mobile);


$customer->updateCustomer($firstName, $lastName, $email, $address, $mobile, $cus_id);

  }

}

?>

<!--------------------- Registration process end ------------------------>

      <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<!---------------------------Form Validation ---------------------------->
  <script>
   
function validateForm() {
  let FirstName = document.forms["customerUpdateForm"]["fname"].value;
  if (FirstName == "") {
    swal("Registration Failed!", "First Name Must be filled!", "error");
    return false;
  }
  let LastName = document.forms["customerUpdateForm"]["lname"].value;
  if (LastName == "") {
     swal("Registration Failed!", "Last Name Must be filled!", "error");
    return false;
  }
  var num =document.forms["customerUpdateForm"]["mobile"].value;
  if (num == null || num.length != "10") { 
    swal("Registration Failed!", "Enter Correct number!", "error");
    return false;
  }
  var x = document.forms["customerUpdateForm"]["email"].value;//get form email value
  var atpos = x.indexOf("@");
  var dotpos = x.lastIndexOf(".");
  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
    swal("Registration Failed!","Not a valid e-mail address.", "error");
   return false;

  
  }
}

  </script>


<script>

  $('input[name="mobile"]').mask('0000000000');
</script>




  <!-- ---------------Notifications--------------------------- -->
  <?php 

if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Customer Updated Success!", "Customer Details Updated!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal("Customer Update Failed!", "Something went wrong!", "error");
                </script>';
             
          }
if(isset($_GET['emailexists']))
          {
            echo'<script>
                 swal("Customer Update Failed!", "Customer Email Already exists! Enter new email", "error");
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