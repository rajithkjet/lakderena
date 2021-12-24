<?php

    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Employee
    {
        private $db;

        
        //employee registration function
        public function registerEmployee($firstName, $lastName, $email, $address, $mobile, $hotel_code, $job_role_id)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
            $current_date = $current_date->format("Y-m-d H:i:s");
            // prepare and bind
            $stmt = $db->prepare("INSERT INTO employees (first_name, last_name, email, address, mobile, hotel_no, job_role_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $address, $mobile, $hotel_code, $job_role_id, $current_date);
            
            if($stmt->execute())
            { 
                $stmt->close();

                     echo'<script>
                     location.replace("addEmployee.php?registration=success");
                     </script>';
                         
            }else
            {
                echo'<script>
                location.replace("addEmployee.php?failed=true");
                 </script>';
            }
        }

          //add employee Leave function
        public function addLeave($employeeid, $fromDate, $toDate, $total_days, $reason, $hrid)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            // prepare and bind
            $stmt = $db->prepare("INSERT INTO leaves (employee, date_from, date_to, total_days, reason, updated_by) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $employeeid, $fromDate, $toDate, $total_days, $reason, $hrid);
            
            if($stmt->execute())
            { 
                $stmt->close();

                     echo'<script>
                     location.replace("addLeave.php?id='.$employeeid.'&success=true");
                     </script>';
                         
            }else
            {
                echo'<script>
                location.replace("addLeave.php?id='.$employeeid.'&failed=true");
                 </script>';
            }
        }




        //check employee email exists
        public function employeeEmailExists($email)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM employees WHERE email = '$email'");
            if($query->num_rows == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

       //check already created employee email exists function - use for update account
        public function checkEmailExists($email, $emp_id)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM employees WHERE email = '$email'");
            if($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT email FROM employees WHERE email ='$email' AND id = '".$emp_id."'");
               if($query2->num_rows == 1)
               {
                   return FALSE;

               }else{
                    return TRUE;
               }

            }else{

                return FALSE;
            }
        }
        //end check employee email exists function

         //employee update function
        public function updateEmployee($firstName, $lastName, $email, $address, $mobile, $hotel_no, $job_role_id, $empid)
        {
             require_once '../Database.php';
             $conn = new Database();
             $db = $conn->db();
            // prepare and bind
           
            $stmt = $db->prepare("UPDATE employees SET first_name = ?, last_name = ?, email = ?, address = ?, mobile = ?, hotel_no = ?, job_role_id = ? WHERE id='".$empid."'");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $address, $mobile, $hotel_no, $job_role_id);
            
            if($stmt->execute())
            {
                $stmt->close();


                  echo'<script>
                        location.replace("editEmployee.php?id='.$empid.'&success=true");
                       </script>';
              
             }else{
                    echo'<script>
                        location.replace("editEmployee.php?id='.$empid.'&failed=true");
                        </script>';

                  }
        

        }

        //update attendance function
        public function updateAttendance($attendDate, $is_present_status, $duration, $hrid, $attendanceid)
        {
             require_once '../Database.php';
             $conn = new Database();
             $db = $conn->db();
            // prepare and bind
           
            $stmt = $db->prepare("UPDATE attendance SET date = ?, is_present = ?, duration = ?, updated_by = ? WHERE id='".$attendanceid."'");
            $stmt->bind_param("ssss", $attendDate, $is_present_status, $duration, $hrid);
            
            if($stmt->execute())
            {
                $stmt->close();


                  echo'<script>
                        location.replace("editAttendance.php?id='.$attendanceid.'&success=true");
                       </script>';
              
             }else{
                    echo'<script>
                        location.replace("editAttendance.php?id='.$attendanceid.'&failed=true");
                        </script>';

                  }
        

        }


     
       
    

    }
?>