<?php

    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Bartender
    {
        private $db;

    


        //account update function
        public function updateAccount($firstName, $lastName, $email, $username, $password, $userid)
        {
             require_once '../Database.php';
             $conn = new Database();
             $db = $conn->db();

            if ($password =="") {
                     // prepare and bind
           
            $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id='".$userid."'");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $username);
            
            if($stmt->execute())
            {
                 
                $stmt->close();

                echo'<script>
                        location.replace("settings.php?success=true");
                       </script>';
                

             }else{
                    echo'<script>
                        location.replace("settings.php?failed=true");
                        </script>';

                     }
            }else{

            // prepare and bind
            $hashPass = $this->ownHash($password);
            $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, password = ? WHERE id='".$userid."'");
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $hashPass);
            
            if($stmt->execute())
            {
                 
                $stmt->close();

                echo'<script>
                        location.replace("settings.php?success=true");
                       </script>';
                

             }else{
                    echo'<script>
                        location.replace("settings.php?failed=true");
                        </script>';

                     }
            }
            
       
        

            }
            //end update account function


       //check user email exists function
        public function checkEmailExists($email, $user_id)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT email FROM users WHERE email = '$email'");
            if($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT email FROM users WHERE email ='$email' AND id = '".$user_id."'");
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
        //end check user email exists function

        //check user email exists funtion
        public function checkUsernameExists($username, $user_id)
        {   
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            $query = $db->query("SELECT username FROM users WHERE username = '$username'");
            if($query->num_rows == 1)
            {
               $query2 = $db->query("SELECT username FROM users WHERE username ='$username' AND id = '".$user_id."'");
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
        //end check user email exists


        //hashing password function
        public function ownHash($password)
        {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            return $hash_pass;
        }

        //end hashing password

        //add item function
        public function addItem($name, $price, $size, $stock)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();
            // prepare and bind
            $stmt = $db->prepare("INSERT INTO liquor_items (name, price, size, stock) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $price, $size, $stock);
            
            if($stmt->execute())
            { 
                $stmt->close();

                     echo'<script>
                     location.replace("addItem.php?success=true");
                     </script>';
                         
            }else
            {
                echo'<script>
                location.replace("addLeave.php?failed=true");
                 </script>';
            }
        }

        //Item update function
        public function updateItem($name, $price, $size, $stock, $itemid)
        {
             require_once '../Database.php';
             $conn = new Database();
             $db = $conn->db();
            // prepare and bind
           
            $stmt = $db->prepare("UPDATE liquor_items SET name = ?, price = ?, size = ?, stock = ? WHERE id='".$itemid."'");
            $stmt->bind_param("ssss", $name, $price, $size, $stock);
            
            if($stmt->execute())
            {
                $stmt->close();


                  echo'<script>
                        location.replace("editItem.php?id='.$itemid.'&success=true");
                       </script>';
              
             }else{
                    echo'<script>
                        location.replace("editItem.php?id='.$itemid.'&failed=true");
                        </script>';

                  }
        

        }
     
       
    

    }
?>