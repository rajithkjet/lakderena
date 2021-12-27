<?php
    session_start();
    if(!(isset($_SESSION['role_id'])) && !(isset($_SESSION['username']))){
        header("location:../index.php");
    }
    if ($_SESSION['role_id'] != 1) {
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
        
            <div class="header bg-gradient-orange pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Hotels</li>
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
                                <h3 class="mb-0">New Hotel</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <a href="new_hotel.php" type="button" class="btn btn-warning"><i class="fas fa-plus"></i> Add New Hotel</a>
                                </div><br>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="hotels_table" class="display table align-items-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort">ID</th>
                                                    <th scope="col" class="sort">Name</th>
                                                    <th scope="col" class="sort">Code</th>
                                                    <th scope="col" class="sort">Address</th>
                                                    <th scope="col" class="sort">Phone</th>
                                                    <th scope="col" class="sort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php
                                                    require_once '../Database.php';
                                                    $connect = new Database();
                                                    $db = $connect->db();
                                                    $sql = "SELECT * FROM hotel";
                                                    $result = mysqli_query($db, $sql);
                                                    $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                ?>
                                                <?php foreach ($hotels as $hotel): ?>
                                                <?php
                                                    $hotelid = $hotel['id'];
                                                    $button = '<a href="edit_hotel.php?id='.$hotelid.'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-marker"></i> UPDATE</a>';
                                                    $button .= '<a href="edit_hotel.php?id='.$hotelid.'" type="button" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>';

                                                ?>
                                                <tr>
                                                    <td><?php echo $hotel['id']; ?></td>
                                                    <td><?php echo $hotel['name']; ?></td>
                                                    <td><?php echo $hotel['code']; ?></td>
                                                    <td><?php echo $hotel['address']; ?></td>
                                                    <td><?php echo $hotel['phone']; ?></td>
                                                    <td><?php echo $button; ?></td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready( function () {
                        $('#hotels_table').DataTable();
                    });
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