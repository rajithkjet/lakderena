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
                  <li class="breadcrumb-item active" aria-current="page">Check Inquiries</li>
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
              <h3 class="mb-0">Check Inquiries</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
              <div class="col-xl-12 order-xl-1">
              <div class="card">
                <div class="card-header">
                  <div class="row align-items-center">
                  </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table id="table_id" class="display table align-items-center">
                  <thead class="thead-light">
                      <tr>
                          <th scope="col" class="sort">ID</th>
                      
                          <th scope="col" class="sort">Customer ID</th>
                     
                          <th scope="col" class="sort">Room Type ID</th>

                          <th scope="col" class="sort">Room Type</th>
                     
                          <th scope="col" class="sort">AC</th>
                     
                          <th scope="col" class="sort">Status</th>
                      
                          <th scope="col" class="sort">Recipient ID</th>

                          <th scope="col" class="sort">Check In</th>

                          <th scope="col" class="sort">Check Out</th>

                          <th scope="col" class="sort">Adults</th>

                          <th scope="col" class="sort">Children</th>

                          <th scope="col" class="sort">Action</th>

                          <th scope="col" class="sort">Action</th>
                      </tr>
                  </thead>
                  <tbody class="list">
                    <?php
                    require_once '../Database.php';
                    $connect = new Database();
                    $db = $connect->db();
                    $sql = "SELECT * FROM inquiry";
                    $result = mysqli_query($db, $sql);

                    $inquiries = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                     <?php foreach ($inquiries as $inquiry): ?>

                      <?php

                      $button = ''; 

                      if ($inquiry['status'] == 0) {
                        $in_status ='<span class="badge badge-dot mr-4">
                      <i class="bg-danger"></i>
                      <span class="status">Pending</span>
                    </span>';
                      $button = '<a href="edit_inquiry.php?inquiry='.$inquiry['id'].'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> UPDATE</a>'; 

                      }elseif ($inquiry['status'] == 1) {
                        $in_status ='<span class="badge badge-dot mr-4">
                      <i class="bg-primary"></i>
                      <span class="status">Transferred</span>
                    </span>';
                      $button = ''; 
                      }else{
                         $in_status ='<span class="badge badge-dot mr-4">
                      <i class="bg-success"></i>
                      <span class="status">Completed</span>
                    </span>';
                      $button = ''; 
                      }

                      if ($inquiry['is_ac'] == 1) {
                        $ac_type = '<i style="color:green" class="fas fa-check"></i>';
                      }else{
                        $ac_type = '<i style="color:red" class="fas fa-times"></i>';
                      }

                      $viewButton = '<a href="view_inquiry.php?inquiry='.$inquiry['id'].'" type="button" class="btn btn-success btn-sm"><i class="fas fa-file"></i> SHOW MORE INFO</a>';
                      ?>

                      <?php
                        $sql2 = "SELECT * FROM room_types WHERE id = '".$inquiry['room_type_id']."'";
                        $result2 = mysqli_query($db, $sql2);

                        $rooms = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                        foreach ($rooms as $room):

                        $roomType = $room['name'];



                        

                      ?>
                      <tr>
                          <td><?php echo $inquiry['id']; ?></td>
                      
                          <td><?php echo $inquiry['customer_id']; ?></td>
                      
                          <td><?php echo $inquiry['room_type_id']; ?></td>

                          <td><?php echo $roomType; ?></td>
                      
                          <td><?php echo $ac_type; ?></td>
                      
                          <td><?php echo $in_status; ?></td>
                      
                          <td><?php echo $inquiry['recipient_id']; ?></td>

                          <td><?php echo $inquiry['check_in']; ?></td>

                          <td><?php echo $inquiry['check_out']; ?></td>

                          <td><?php echo $inquiry['adults']; ?></td>

                          <td><?php echo $inquiry['children']; ?></td>

                          <td><?php echo $viewButton; ?></td>
                          <td><?php echo $button; ?></td>
                      </tr>
                      <?php endforeach;?>
                      <?php endforeach;?>
                  </tbody>
              </table>
              </div>

                </div>
              </div>
            </div>
          </div>
       
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
              $(document).ready( function () {
                          $('#table_id').DataTable();
                      } );
      </script>
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</body>

</html>