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
                  <li class="breadcrumb-item active" aria-current="page">Check Employee Leaves</li>
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
              <h3 class="mb-0">Check Employee Leaves</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <div class="col-xl-4 order-xl-1">
                    <div class="card">
                        <a href="manageLeaves.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-angle-double-left"></i> Back to Manage Leaves</a>
                    </div>
                </div>
                <div class="col-xl-12 order-xl-1">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">Leave ID</th>

                                             <th scope="col" class="sort">Emp ID</th>
                                        
                                            <th scope="col" class="sort">First Name</th>

                                            <th scope="col" class="sort">Last Name</th>
                                        
                                            <th scope="col" class="sort">Email</th>

                                            <th scope="col" class="sort">Hotel</th>

                                            <th scope="col" class="sort">Date From</th>

                                            <th scope="col" class="sort">Date To</th>

                                            <th scope="col" class="sort">Total Days</th>

                                            <th scope="col" class="sort">Reason</th>

                                            <th scope="col" class="sort">Updated By</th>

                                            <th scope="col" class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php
                                        require_once '../Database.php';
                                        $connect = new Database();
                                        $db = $connect->db();
                                        $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                                        $current_date = $current_date->format("Y-m-d");
                                        //get all attendance
                                        $sql = "SELECT * FROM leaves";
                                        $result = mysqli_query($db, $sql);

                                        $leaves= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                      
                                        ?>
                                        <?php foreach ($leaves as $leave): ?>

                                          
                                            <?php
                                            //get  employee
                                            $sql2 = "SELECT * FROM employees WHERE id = '".$leave['employee']."'";
                                            $result2 = mysqli_query($db, $sql2);
                                            $employees = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                            //check employee found
                                            if($result2->num_rows == 1)
                                            {
                                                foreach ($employees as $employee): 
                                                    $updateButton = '<a href="editLeave.php?id='.$leave['id'].'" type="button" class="present btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> Update</a>';
                                                    
                                                ?>
                                                    <?php
                                                    //check updated HR from users table
                                                    $sql3 = "SELECT * FROM users WHERE id = '".$leave['updated_by']."'";
                                                    $result3 = mysqli_query($db, $sql3);
                                                    $hrManagers = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                                    //check HR record found
                                                    if($result3->num_rows == 1)
                                                    {
                                                        foreach ($hrManagers as $hrManager): 
                                                            $hrName= $hrManager['username'];
                                                            
                                                        ?>

                                                                <tr>
                                                                    <td><?php echo $leave['id']; ?></td>

                                                                    <td><?php echo $leave['employee']; ?></td>
                                                                
                                                                    <td><?php echo $employee['first_name']; ?></td>

                                                                    <td><?php echo $employee['last_name'];; ?></td>
                                                                
                                                                    <td><?php echo $employee['email']; ?></td>

                                                                    <td><?php echo $employee['hotel_no']; ?></td>

                                                                    <td><?php echo $leave['date_from']; ?></td>

                                                                    <td><?php echo $leave['date_to']; ?></td>

                                                                    <td><?php echo $leave['total_days']; ?></td>

                                                                    <td><?php echo $leave['reason']; ?></td>

                                                                    <td><?php echo $hrName; ?></td>

                                                                    <td><?php echo $updateButton;?></td>
                                                                </tr>
                                                                <?php endforeach;?>
                                                    <?php } ?>
                                                <?php endforeach;?>
                                        <?php } ?>
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
      <!-- Footer -->
      <?php include "../dashboard_footer.php" ?>
    </div>
  </div>

    <!-- JS Process -->

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




    <script>
        $(document).ready( function () {
          //data table
           $('#table_id').DataTable();
          });

    </script>

  <!-- ---------------Notifications--------------------------- -->
  <?php 

if(isset($_GET['success']))
          {
            echo'<script>
                 swal("Success", "Attendance Marked Success!", "success");
                </script>';
             
          }
if(isset($_GET['failed']))
          {
            echo'<script>
                 swal("Failed", "Attendance Marked Failed!", "error");
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
 <!-- Data Tables -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</body>

</html>