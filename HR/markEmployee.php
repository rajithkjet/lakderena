<?php  
   require_once '../Database.php';
   $connect = new Database();
   $db = $connect->db(); 
 if(isset($_POST["action"]))  
 {  
 	$output = '';

      if($_POST["action"] == "Present")  
      {  
         
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d");

            $query = $db->query("SELECT * FROM employees WHERE id = '".$_POST["id"]."' ");
                                           
            if($query->num_rows == 1)
                {
                    // prepare and bind
                    $stmt = $db->prepare("INSERT INTO attendance (employee, date, is_present, duration, updated_by) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $_POST["id"], $current_date, 1, 0, $_SESSION["id"]);
                    
                    if($stmt->execute())
                    { 
                        $stmt->close();
                        echo 'Data Updated';  
                          //  echo'<script>
                          //  location.replace("manageAttendance.php?success=true");
                          //  </script>';
                                
                    }else
                    {
                        echo'<script>
                        location.replace("manageAttendance.php?failed=true");
                        </script>';
                    } 
                 }
      } 


      if($_POST["action"] == "Absent")  
      {  
           
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d");

            $query1 = $db->query("SELECT * FROM employees WHERE id = '".$_POST["id"]."' ");
             if($query1->num_rows == 1)
                {
                    $procedure = "  
                            CREATE PROCEDURE markAttendance(IN empid int(11), IN currentDate date, IN userid int(11) )  
                            BEGIN   
                            INSERT INTO attendance (employee, date, is_present, duration, updated_by)
                            VALUES (empid, currentDate, 0, 0, userid) 
                            END;   
                    ";  
                    if(mysqli_query($db, "DROP PROCEDURE IF EXISTS markAttendance"))  
                    {  
                            if(mysqli_query($db, $procedure))  
                            {  
                                $query = "CALL markAttendance('".$_POST["id"]."', '".$current_date."', '".$_SESSION["id"]."')";  
                                mysqli_query($db, $query);  
                                echo 'Data Updated';  
                            }  
                    } 
                }
      }

 

 }

 ?>