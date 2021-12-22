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
                  <li class="breadcrumb-item active" aria-current="page">Manage Attendance</li>
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
              <h3 class="mb-0">Manage Attendance</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <div class="col-xl-4 order-xl-1">
                    <div class="card">
                        <a href="checkAttendance.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-briefcase"></i> Check Attendance</a>
                    </div>
                </div>
                <div class="col-xl-12 order-xl-1">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">Emp ID</th>
                                        
                                            <th scope="col" class="sort">First Name</th>

                                            <th scope="col" class="sort">Last Name</th>
                                        
                                            <th scope="col" class="sort">Email</th>

                                            <th scope="col" class="sort">Hotel</th>

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
                                        //get all employees
                                        $sql = "SELECT * FROM employees";
                                        $result = mysqli_query($db, $sql);

                                        $employees= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                      
                                        ?>
                                        <?php foreach ($employees as $employee): ?>


                                            <?php
                                            //check attendance of the employee by current date
                                            $query = $db->query("SELECT * FROM attendance WHERE (`employee` = '".$employee['id']."') AND (`date` = '".$current_date."') ");
                                           
                                            //if record not found, then display employee record to the table
                                            if($query->num_rows != 1)
                                            {
                                            
                                                $presentButton = '<button type="button" name="present" id="'.$employee['id'].'" class="present btn btn-primary btn-sm"><i class="fas fa-check"></i> Mark as Present</button>';
                                                $absentButton = '<button type="button" name="absent" id="'.$employee['id'].'" class="absent btn btn-danger btn-sm"><i class="fas fa-times"></i> Mark as Absent</button>';
                                            ?>

                                                <tr>
                                                    <td><?php echo $employee['id']; ?></td>
                                                
                                                    <td><?php echo $employee['first_name']; ?></td>

                                                    <td><?php echo $employee['last_name'];; ?></td>
                                                
                                                    <td><?php echo $employee['email']; ?></td>

                                                    <td><?php echo $employee['hotel_no']; ?></td>

                                                    <td><?php echo $presentButton; echo $absentButton; ?></td>

                                                    
                                                </tr>
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

                            //present process
                            $(document).on('click', '.present', function(){  
                            var id = $(this).attr("id");
                            var hrID = <?php echo $_SESSION['id']; ?>;
                                
                                swal({
                                    title: "Are you sure you want to mark as present this employee?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                            if (willDelete) {

                                            var action = "Present";  
                                            $.ajax({  
                                                url:"markEmployee.php",  
                                                method:"POST",  
                                                data:{id:id, action:action, hrID:hrID},  
                                                success:function(data)  
                                                    {   
                                                    location.replace("manageAttendance.php?success=true");
                                                        
                                                    } 
                                            });

                                    } 
                                        
                                }); 
                            });

                            //absent process
                            $(document).on('click', '.absent', function(){  
                            var id = $(this).attr("id");
                            var hrID = <?php echo $_SESSION['id']; ?>;
                                
                                swal({
                                    title: "Are you sure you want to mark as absent this employee?",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                            if (willDelete) {

                                            var action = "Absent";  
                                            $.ajax({  
                                                url:"markEmployee.php",  
                                                method:"POST",  
                                                data:{id:id, action:action, hrID:hrID},  
                                                success:function(data)  
                                                {   
                                                   location.replace("manageAttendance.php?success=true");
                                                    
                                                }  
                                            });

                                    } 
                                        
                                }); 
                            });

                      });
    </script>


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