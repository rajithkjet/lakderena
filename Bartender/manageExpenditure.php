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
                  <li class="breadcrumb-item active" aria-current="page">Manage Expenditure</li>
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
              <h3 class="mb-0">Manage Expenditure</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <div class="col-xl-4 order-xl-1">
                    <div class="card">
                        <a href="addExpenditure.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-user-plus"></i> Add Expenditure</a>
                    </div>
                </div>
                <div class="col-xl-12 order-xl-1">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">ID</th>
                                        
                                            <th scope="col" class="sort">Bar ID</th>

                                            <th scope="col" class="sort">Date</th>
                                        
                                            <th scope="col" class="sort">Amount</th>
                                        
                                            <th scope="col" class="sort">Item</th>

                                            <th scope="col" class="sort">QTY</th>

                                            <th scope="col" class="sort">Total</th>

                                            <th scope="col" class="sort">Updated By</th>

                                            <th scope="col" class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php
                                        require_once '../Database.php';
                                        $connect = new Database();
                                        $db = $connect->db();
                                        $sql = "SELECT * FROM bar_expenditure";
                                        $result = mysqli_query($db, $sql);

                                        $expenditures= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        ?>
                                        <?php foreach ($expenditures as $expenditure): ?>

                                        <?php  $button = '<a href="editExpenditure.php?id='.$expenditure['id'].'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> UPDATE</a>'; ?>

                                            <?php $sql2 = "SELECT * FROM users WHERE id = '".$expenditure['updated_by']."'";
                                            $result2 = mysqli_query($db, $sql2);

                                            $bartenders= mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                            ?>

                                            <?php foreach ($bartenders as $bartender): ?>
                                

                                            <tr>
                                                <td><?php echo $expenditure['id']; ?></td>
                                            
                                                <td><?php echo $expenditure['bar_id']; ?></td>

                                                <td><?php echo $expenditure['date'];; ?></td>
                                            
                                                <td><?php echo $expenditure['amount']; ?></td>
                                            
                                                <td><?php echo $expenditure['item']; ?></td>

                                                <td><?php echo $expenditure['qty']; ?></td>

                                                <td><?php echo $expenditure['total']; ?></td>

                                                <td><?php echo $bartender['username']; ?></td>

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
      <!-- Footer -->
      <?php include "../dashboard_footer.php" ?>
    </div>
  </div>

    <!-- Data Table -->
    <script>
              $(document).ready( function () {
                          $('#table_id').DataTable();
                      } );
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
 <!-- Data Tables -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</body>

</html>