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
                                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                    <h3 class="mb-0">Edit User Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row icon-examples">
                                        <?php 
                                            if (isset($_GET['id'])){ 
                                                $userid = $_GET['id'];
                                                if ( is_numeric($userid) == true){
                                                    require_once '../Database.php';
                                                    try{
                                                        $connect = new Database();
                                                        $db = $connect->db();
                                                        $userid = mysqli_real_escape_string($db, $_GET['id']);
                                                        $query = " SELECT users.*, role_users.role_id AS role_id, roles.name AS role
                                                                    FROM users
                                                                    INNER JOIN role_users ON users.id = role_users.user_id
                                                                    INNER JOIN roles ON role_users.role_id = roles.id
                                                                    WHERE users.id = '".$userid."'
                                                                ";
                                                        $result = mysqli_query($db, $query);
                                                        if(mysqli_num_rows($result) > 0)
                                                        {
                                                            while($row = mysqli_fetch_array($result)){
                                                                $id = $row['id'];
                                                                $firstname=$row['first_name'];
                                                                $lastname=$row['last_name'];
                                                                $email=$row['email'];
                                                                $username = $row['username'];
                                                                $hotel_no = $row['hotel_no'];
                                                                $role_id = $row['role_id'];
                                                                $role = $row['role'];
                                                                $active_status = $row['is_active'];
                                                                echo'                        
                                                                    <div class="col-xl-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <div class="row align-items-center">
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form name="userUpdateForm" action="" method="post">
                                                                                    <div class="pl-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label">ID</label>
                                                                                                    <input name="id" type="text" class="form-control" value="'.$id.'" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-email">Email</label>
                                                                                                    <input name="email" type="email" id="input-email" class="form-control" value="'.$email.'" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-first-name">First Name</label>
                                                                                                    <input name="fname" type="text" id="input-first-name" class="form-control" value="'.$firstname.'" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-last-name">Last Name</label>
                                                                                                    <input name="lname" type="text" id="input-last-name" class="form-control" value="'.$lastname.'" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="pl-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-username">Username</label>
                                                                                                    <input name="username" id="input-username" class="form-control" value="'.$username.'" type="text" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label">Hotel No.</label>
                                                                                                    <select name="hotel" class="form-control" required>';?>
                                                                                                        <!--select hotel -->
                                                                                                        <?php
                                                                                                            $list = mysqli_query($db,"SELECT * FROM `hotel`");
                                                                                                            while ($row = mysqli_fetch_assoc($list)) {
                                                                                                                if($row['code'] == $hotel_no){
                                                                                                                    echo' <option value="'.$row['code'].'" selected="selected">'.$row['code'].'</option>';
                                                                                                                }else{
                                                                                                                    echo' <option value="'.$row['code'].'">'.$row['code'].'</option>';
                                                                                                                }
                                                                                                            } ?>    
                                                                                                        <?php echo'
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label" for="input-rolename">Role</label>
                                                                                                    <select name="role" class="form-control" required>';?>
                                                                                                        <!--select role -->
                                                                                                        <?php
                                                                                                            $list = mysqli_query($db,"SELECT * FROM `roles`");
                                                                                                            while ($row = mysqli_fetch_assoc($list)) {
                                                                                                                if($row['id'] == $role_id){
                                                                                                                    echo' <option value="'.$row['id'].'" selected="selected">'.$row['name'].'</option>';
                                                                                                                }else{
                                                                                                                    echo' <option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                                                                                }
                                                                                                            } ?>    
                                                                                                        <?php echo'
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>                  
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label">Active</label>
                                                                                                    <br/>
                                                                                                    <label class="custom-toggle">
                                                                                                        <input name="useractivestatus" type="checkbox"';?><?php echo ($active_status==1 ? 'checked' : '');?> <?php echo'>
                                                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <button type="submit" name="submit" class="btn btn-warning">Update</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                '; 
                                                                $db = null;
                                                            }
                                                        }else{
                                                            echo '<center>Sorry No User Found!!</center>';
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
            <!---------------------------- Registration process ------------------------------>
            <?php
                if (isset($_POST['submit'])){
                    include 'Admin.php';
                    //create new instance from User class
                    $admin = new Admin(); 
                    $user_id = $_POST['id'];
                    //check mail already exists
                    if ($admin->checkEmailExists($_POST['email'], $user_id)) {
                        //if exists, then redirect to index page with notification value
                        echo'<script>
                            location.replace("edit_user.php?id='.$user_id.'&emailexists=true");
                        </script>';
                    }elseif($admin->checkUsernameExists($_POST['username'], $user_id)){
                        //if exists, then redirect to index page with notification value
                        echo'<script>
                            location.replace("edit_user.php?id='.$user_id.'&usernameexists=true");
                        </script>';
                    }else{
                        $firstName = $_POST['fname'];
                        $firstName= ucwords(strtolower($firstName));

                        $lastName = $_POST['lname'];
                        $lastName= ucwords(strtolower($lastName));

                        $username = $_POST['username'];

                        $email = $_POST['email'];

                        $userhotelno = filter_input(INPUT_POST, 'hotel', FILTER_SANITIZE_STRING);

                        $userroleid = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

                        $firstName = stripslashes($firstName);
                        $firstName = addslashes($firstName);
                        $firstName = ucwords(strtolower($firstName));

                        $lastName = stripslashes($lastName);
                        $lastName = addslashes($lastName);
                        $lastName = ucwords(strtolower($lastName));

                        $email = stripslashes($email);
                        $email = addslashes($email);

                        $hotel = $userhotelno;

                        $role = $userroleid;

                        $is_active = $_POST['useractivestatus'];

                        if ($is_active == "on") {
                            $active_status = 1;
                        }else {
                            $active_status = 0;
                        }

                        $admin->updateUser($firstName, $lastName, $email, $username, $hotel, $role, $user_id, $active_status);
                    }
                }
            ?>
            <!--------------------- Registration process end ------------------------>

            <!-- Sweet Alert -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

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

            <!-- ---------------Notifications--------------------------- -->
            <?php 
                if(isset($_GET['success']))
                {
                    echo'<script>
                            swal("User Updated Success!", "User Details Updated!", "success");
                        </script>';
             
                }
                if(isset($_GET['failed']))
                {
                    echo'<script>
                            swal("User Update Failed!", "Something went wrong!", "error");
                        </script>'; 
                }
                if(isset($_GET['emailexists']))
                {
                    echo'<script>
                            swal("User Update Failed!", "User Email Already exists! Enter new email", "error");
                        </script>';
                }
                if(isset($_GET['usernameexists']))
                {
                    echo'<script>
                            swal("User Update Failed!", "Username Already exists! Enter new username", "error");
                        </script>';
                }
            ?>
        </body>
    </html>