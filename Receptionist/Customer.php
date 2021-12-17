<?php
    
    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Customer
    {
        private $db;

      
        

      //customer registration function
        public function registerCustomer($firstName, $lastName, $email, $address, $mobile)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            // prepare and bind
            $stmt = $db->prepare("INSERT INTO customers (first_name, last_name, email, address, mobile) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $address, $mobile);
            
            if($stmt->execute())
            {
                 
                $stmt->close();

                 $checkCustomers = $db->query("SELECT count('id') AS total FROM customers ");

                   while($allCustomers = $checkCustomers->fetch_assoc())
                    {
                        if($allCustomers['total'] >= 1)
                        {
                             $getLastCustomer = $db->query("SELECT * FROM customers ORDER BY id DESC LIMIT 1");
                             while($customerDetails = $getLastCustomer->fetch_assoc())
                            {
                            $cus_id= $customerDetails['id'];
                            $cus_mobile = $customerDetails['mobile'];

                            // prepare and bind
                            $stmt2 = $db->prepare("INSERT INTO customer_mobile (customer_id, normalized_phone) VALUES (?, ?)");
                            $stmt2->bind_param("ss", $cus_id, $cus_mobile);

                            if($stmt2->execute())
                               {
                                 $stmt2->close();

                                echo'<script>
                                location.replace("add_inquiry.php?customer='.$cus_id.'&registration=success");
                                </script>';
                               }else{
                                    echo'<script>
                                    location.replace("customer_registration.php?failed=true");
                                    </script>';

                               }
                           }


                        }
                    }
                         
                 }

            else
            {
                echo'<script>
                location.replace("customer_registration.php?failed=true");
                 </script>';
            }
        }
     
       
       //check customer email exists
        public function customerEmailExists($email)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM customers WHERE email = '$email'");
            if($query->num_rows == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

               //check registered customer email exists
        public function regCustomerEmailExists($email, $cus_id)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM customers WHERE email = '$email'");
            if($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT email FROM customers WHERE email ='$email' AND id = '".$cus_id."'");
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


         //customer update function
        public function updateCustomer($firstName, $lastName, $email, $address, $mobile, $cusid)
        {
             require_once '../Database.php';
             $conn = new Database();
             $db = $conn->db();
            // prepare and bind
           
            $stmt = $db->prepare("UPDATE customers SET first_name = ?, last_name = ?, email = ?, address = ?, mobile = ? WHERE id='".$cusid."'");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $address, $mobile);
            
            if($stmt->execute())
            {
                 
                $stmt->close();


                  echo'<script>
                        location.replace("edit_customer.php?id='.$cusid.'&success=true");
                       </script>';

             }else{
                    echo'<script>
                        location.replace("edit_customer.php?id='.$cusid.'&failed=true");
                        </script>';

                     }
        

            }
        }
?>