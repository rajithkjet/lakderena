<?php
    include '../Database.php';
    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Customer
    {
        private $db;

        public function __construct()
        {
            $conn = new Database();
            $this->db = $conn->db();

        }
        

      //customer registration function
        public function registerCustomer($firstName, $lastName, $email, $address, $mobile)
        {
            // prepare and bind
            $stmt = $this->db->prepare("INSERT INTO customers (first_name, last_name, email, address, mobile) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $address, $mobile);
            
            if($stmt->execute())
            {
                 
                $stmt->close();

                 $checkCustomers = $this->db->query("SELECT count('id') AS total FROM customers ");

                   while($allCustomers = $checkCustomers->fetch_assoc())
                    {
                        if($allCustomers['total'] >= 1)
                        {
                             $getLastCustomer = $this->db->query("SELECT * FROM customers ORDER BY id DESC LIMIT 1");
                             while($customerDetails = $getLastCustomer->fetch_assoc())
                            {
                            $cus_id= $customerDetails['id'];
                            $cus_mobile = $customerDetails['mobile'];

                            // prepare and bind
                            $stmt2 = $this->db->prepare("INSERT INTO customer_mobile (customer_id, normalized_phone) VALUES (?, ?)");
                            $stmt2->bind_param("ss", $cus_id, $cus_mobile);

                            if($stmt2->execute())
                               {
                                 $stmt2->close();

                                echo'<script>
                                location.replace("customer_registration.php?registration=success");
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
            $query = $this->db->query("SELECT email FROM customers WHERE email = '$email'");
            if($query->num_rows == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

    }
?>