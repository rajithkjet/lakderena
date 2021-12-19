<?php

    require_once '../vendor/autoload.php';
    require_once '../constants.php';

    class Admin
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

        //user account update function
        public function updateUser($firstName, $lastName, $email, $username, $hotel, $role, $user_id, $active_status)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();

            //update users table
            $stmt = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, hotel_no = ?, is_active = ? WHERE id='".$user_id."'");
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $username, $hotel, $active_status);
        
            if($stmt->execute())
            {
                $stmt->close();

                //update role
                $stmt = $db->prepare("UPDATE role_users SET role_id = ? WHERE user_id='".$user_id."'");
                $stmt->bind_param("s", $role);

                if($stmt->execute()){
                    $stmt->close();
                }

                echo'<script>
                        location.replace("edit_user.php?id='.$user_id.'&success=true");
                    </script>';
            }else{
                echo'<script>
                        location.replace("edit_user.php?id='.$user_id.'&failed=true");
                    </script>';
            }
        }

        //create user
        public function createUser($firstName, $lastName, $email, $username, $hotel, $role)
        {
            require_once '../Database.php';
            $conn = new Database();
            $db = $conn->db();

            //generate random password
            $password = $this->random_strings(8);

            //prepare and bind
            $hashPass = $this->ownHash($password);

            $current_date_time = date("Y-m-d H:i:s");

            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, username, password, hotel_no, created_at) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $username, $hashPass, $hotel, $current_date_time);
            
            if($stmt->execute())
            {
                $role_userid = $stmt->insert_id;

                //update role
                $stmt1 = $db->prepare("INSERT INTO role_users (role_id, user_id) VALUES (?,?)");
                $stmt1->bind_param("ss", $role, $role_userid);

                if($stmt1->execute()){
                    $stmt1->close();
                    $stmt->close();
                }

                //send account created email to user

                // Create the SMTP transport
                $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                ->setUsername(MAIL_USERNAME)
                ->setPassword(MAIL_PASSWORD);
        
                $mailer = new Swift_Mailer($transport);
            
                // Create a message
                $message = new Swift_Message();
            
                $message->setSubject('New User Account Created');
                $message->setFrom(['noreply@lakderena.com' => 'Lakderena Hotel Chain']);
                $message->addTo($email);
                
                // Set the HTML part
                $message->addPart('Your account credentials as below: <br /><br />Please visit: <a href="http://lakderena.local/">http://lakderena.local/</a><br />Username: ' . $username . '<br />Email: ' . $email . '<br />Temp Password: ' . $password .'<br /><br />Thanks,<br />Lakderena Hotel Chain', 'text/html');
                
                // Send the message
                $result = $mailer->send($message);

                echo'<script>
                        location.replace("new_user.php?success=true");
                    </script>';
            }else{
                echo'<script>
                        location.replace("new_user.php?failed=true");
                    </script>';
            }
        }

        public function random_strings($length_of_string)
        {
            // String of all alphanumeric character
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
         
            // Shuffle the $str_result and returns substring
            // of specified length
            return substr(str_shuffle($str_result), 0, $length_of_string);
        }
    }
?>