<?php

    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Receptionist
    {
        private $db;

    
        

      //add Inquiry function
        public function addInquiry($customer_id, $room_type_id, $is_ac, $status, $receptionist_id)
        {
             $conn = new Database();
             $db = $conn->db();
            // prepare and bind
            $stmt = $db->prepare("INSERT INTO inquiry (customer_id, room_type_id, is_ac, status, recipient_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $customer_id, $room_type_id, $is_ac, $status, $receptionist_id);
            
            if($stmt->execute())
            {
                 
                $stmt->close();
                echo'<script>
                location.replace("add_inquiry.php?success=true");
                 </script>';

                
            }

            else
            {
                echo'<script>
                location.replace("add_inquiry.php?failed=true");
                 </script>';
            }
        }
     
       
    

    }
?>