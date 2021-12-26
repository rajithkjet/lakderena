<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 6) {
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
                  <li class="breadcrumb-item active" aria-current="page">Update Item</li>
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
                            <h3 class="mb-0">Update Item</h3>
                        </div>
                    <div class="card-body">
                        <div class="row icon-examples">
                <?php 
                if (isset($_GET['id'])){
                  
                   $itemid = $_GET['id'];

                    if ( is_numeric($itemid) == true){
                       require_once '../Database.php';
                    try{

                       $connect = new Database();
                       $db = $connect->db();
                       
                        $itemid = mysqli_real_escape_string($db, $_GET['id']);
                        $query = "
                        SELECT * FROM liquor_items 
                        WHERE id = '".$itemid."'
                        ";

                        $result = mysqli_query($db, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                    

                        while($row = mysqli_fetch_array($result)){

                              $id = $row['id'];
                              $name=$row['name'];
                              $price=$row['price'];
                              $size=$row['size'];
                              $stock = $row['stock'];

                             echo'
                            <div class="col-xl-8 order-xl-1">
                                    <div class="card">
                                            <div class="card-header">
                                            <div class="row align-items-center">
                                            </div>
                                                <div class="card-body">
                                                         <form name="editItemForm" action="" method="post" onsubmit="return validateForm()">
                                                                <h6 class="heading-small text-muted mb-4">Liquor information</h6>
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-name">Item Name</label>
                                                                                <input name="name" type="text" id="input-name" class="form-control" value="'.$name.'" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-price">Price</label>
                                                                             
                                                                                <input type="text" name="price" value="'.$price.'" class="form-control"  required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label" for="input-size">Size</label>
                                                                                <input name="size" type="text" id="input-size" value="'.$size.'" class="form-control" required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                    
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label">Stock</label>
                                                                                <input name="stock" type="text" value="'.$stock.'" id="stock" class="phone form-control" required="" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                         <div class="col-lg-12">
                                                                            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
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

                              echo '<center>Sorry No Item Found!!</center>';
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
    include 'Bartender.php';

   
    //create new instance from Bartender class
    $bartender = new Bartender(); 


            $name = $_POST['name'];
            $name= ucwords(strtolower($name));

            $price = $_POST['price'];

            $size = $_POST['size'];
            $stock = $_POST['stock'];

            $name = stripslashes($name);
            $name = addslashes($name);
            $name = ucwords(strtolower($name));

            $price = stripslashes($price);
            $price = addslashes($price);
            $price = ucwords(strtolower($price));

            $size = stripslashes($size);
            $size = addslashes($size);

            $stock = stripslashes($stock);
            $stock = addslashes($stock);

            $bartender->updateItem($name, $price, $size, $stock, $itemid);

}

?>

<!--------------------- Update process end ------------------------>

      <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<!---------------------------Form Validation ---------------------------->
  <script>
   
function validateForm() {
    
    let Name = document.forms["editItemForm"]["name"].value;
    if (Name == "") {
        swal("Item Adding Failed!", "Item Name Must be filled!", "error");
        return false;
    }
    let Size = document.forms["editItemForm"]["size"].value;
    if (Size == "") {
        swal("Item Adding Failed!", "Size Must be filled!", "error");
        return false;
    }

    let Stock = document.forms["editItemForm"]["stock"].value;
    if (Stock == "") {
        swal("Item Adding Failed!", "Stock Must be filled!", "error");
        return false;
    }
    
  
}

  </script>



<script>

  $('input[name="stock"]').mask('0000000000');
     function isNumberDot(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)&& charCode != 46 && charCode != 127) {
            return false;
        }
        return true;
    }
</script>




  <!-- ---------------Notifications--------------------------- -->
  <?php 

if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Success!", "Item Details updated!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal("Failed!", "Something went wrong!", "error");
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