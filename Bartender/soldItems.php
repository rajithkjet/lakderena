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
                  <li class="breadcrumb-item active" aria-current="page">Manage Sold Items</li>
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
              <h3 class="mb-0">Manage Sold Items</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                <div class="col-xl-4 order-xl-1">
                    <div class="card">
                        <a href="checkItems.php" style="color: white" type="button" class="btn btn-success"><i class="fas fa-file"></i> Check Sold Items</a>
                    </div>
                </div>
                <div class="col-xl-12 order-xl-1">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">ID</th>
                                        
                                            <th scope="col" class="sort">Name</th>

                                            <th scope="col" class="sort">Price</th>
                                        
                                            <th scope="col" class="sort">Size</th>
                                        
                                            <th scope="col" class="sort">Stock</th>

                                            <th scope="col" class="sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php
                                        require_once '../Database.php';
                                        $connect = new Database();
                                        $db = $connect->db();
                                        $sql = "SELECT * FROM liquor_items";
                                        $result = mysqli_query($db, $sql);

                                        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        ?>
                                        <?php foreach ($items as $item): ?>
                                        <?php
                                            if($item['stock'] == 0){
                                                $button = '<button  class="btn btn-warning btn-sm" disabled><i class="fas fa-plus"></i> Add</button>';
                                            }else{
                                                $button = '<a href="#" data-role="sold" data-id="'.$item['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Add</a>';
                                            }
                                        ?>
                                           
                                        <tr id="<?php echo $item['id']; ?>">

                                            <td><?php echo $item['id']; ?></td>
                                        
                                            <td data-target="name"><?php echo $item['name']; ?></td>

                                            <td data-target="price"><?php echo $item['price'];; ?></td>
                                        
                                            <td><?php echo $item['size']; ?></td>
                                        
                                            <td><?php echo $item['stock']; ?></td>

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
        </div>
      </div>
      <!-- Footer -->
      <?php include "../dashboard_footer.php" ?>
    </div>
  </div>

   <!-- Modal -->
            <div id="itemModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add to Sold Items</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="form-group">
                                                    <label class="form-control-label">Item ID:</label>
                                                    <input id="itemid" type="text" class="form-control" readonly="">

                                                    <label class="form-control-label">Item Name:</label>
                                                    <input id="name" type="text" class="form-control" readonly="">

                                                    <label class="form-control-label">Item Price:</label>
                                                    <input id="price" type="text" class="form-control" readonly="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Select Bar</label>
                                                                                    <select id="bar" name="hotel" class="form-control">
                                                                                    <!--select bar -->
                                                                                        <?php
                                                                                            require_once '../Database.php';
                                                                                            $connect = new Database();
                                                                                            $db = $connect->db();
                                                                                            $list = mysqli_query($db,"SELECT * FROM `bar`");
                                                                                            while ($row = mysqli_fetch_assoc($list)) 
                                                                                            {
                                                                                            echo' <option value="'.$row['id'].'">'.$row['hotel_no'].'</option>';
                                                                                            } 
                                                                                        ?>
                                                                                    </select>
                                                    <label class="form-control-label">Enter QTY:</label>
                                                    <input id="qty" name="qty" type="text" class="form-control" min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" id="send" class="btn btn-primary pull-right">Submit</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                </div>
                    </div>
            </div>

  <!-- Sweet Alert 2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Data Table -->
    <script>
              $(document).ready( function () {
                          $('#table_id').DataTable();
                      } );
    </script>
      <script>
      $(document).ready(function(){
            $(document).on('click','a[data-role=sold]', function(){
               var id = $(this).data('id');
               var name = $('#'+id).children('td[data-target=name]').text();
               var price = $('#'+id).children('td[data-target=price]').text();
               
          

               $('#name').val(name);
              $('#itemid').val(id);
              $('#price').val(price);
                $('#itemModal').modal('toggle');
            });

            $('#send').click(function(){
                     var id = $('#itemid').val();
                     var price = $('#price').val();
                     var qty= $('#qty').val();
                     var bartenderid = <?php echo $_SESSION['id']; ?>;
                     var bar = $('#bar').val();
                   

                    $.ajax({  
                     url:"sold_process.php",  
                     method:"POST",  
                     data:{id:id, price:price, qty:qty, bartenderid:bartenderid, bar:bar},  
                     success:function(data)  
                     {  
                        $('#itemModal').modal('toggle');
                        Swal.fire({
                          title: 'Success!',
                          text: 'Item was successfully added to Sold items!',
                          icon: 'success',
                          showDenyButton: false,
                          showCancelButton: false,
                          confirmButtonText: 'Ok',
                        }).then((result) => {
                     
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        })


                           
                           
                     }  
                });

            });
      });
  </script>

   <script>

     $('input[name="qty"]').mask('0000000000');
    
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