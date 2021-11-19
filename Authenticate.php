<?php
    include './Database.php';
    require_once './vendor/autoload.php';
    require_once './constants.php';

    class Authenticate
    {
        private $db;

        public function __construct()
        {
            $conn = new Database();
            $this->db = $conn->db();

        }
        
        public function login($email, $password)
        {
            
            $query = $this->db->query("SELECT count('id') AS total, users.id, users.username, users.email, users.password, role_users.role_id FROM users INNER JOIN role_users ON users.id = role_users.user_id WHERE (username = '$email' OR email = '$email') LIMIT 1");

            while($current_user = $query->fetch_assoc())
            {
                if($current_user['total'] == 1 && $this->verifyPassword($password, $current_user['password']) == TRUE)
                {
                    $_SESSION['id'] = $current_user['id'];
                    $_SESSION['username'] = $current_user['username'];
                    $_SESSION['role_id'] = $current_user['role_id'];
                    $_SESSION['is_logged'] = TRUE;

                    if($current_user['role_id'] == 1){
                        header("Location: /Admin/index.php");
                    }elseif($current_user['role_id'] == 2){
                        header("Location: /Receptionist/index.php");
                    }elseif($current_user['role_id'] == 3){
                        header("Location: /ReservationManager/index.php");
                    }elseif($current_user['role_id'] == 4){
                        header("Location: /Accountant/index.php");
                    }elseif($current_user['role_id'] == 5){
                        header("Location: /HR/index.php");
                    }elseif($current_user['role_id'] == 6){
                        header("Location: /Bartender/index.php");
                    }elseif($current_user['role_id'] == 7){
                        header("Location: /Manager/index.php");
                    }else{
                        header("Location: denied.php");
                        die;
                    }
                }
                else
                {
                    echo '<p class="d-flex justify-content-center links" style="color:red; text-align:center;">Invalid user credentials.</p>';
                }
            }
        }

        public function verifyPassword($password, $enc_password)
        {
            if(password_verify($password, $enc_password))
            {
                return TRUE;
            }
        }

        public function userEmailExists($email)
        {
            $query = $this->db->query("SELECT email FROM users WHERE email = '$email'");
            if($query->num_rows == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function sendPasswordResetLink($email)
        {
            //generate account verification key
            $key = md5(time().$email);

            //expiry date
            $date = new DateTime;
            $date = $date->format("Y-m-d H:i:s");
            $exp_date = date('Y-m-d H:i:s', strtotime('+1 hours', strtotime($date)));

            if($this->db->query("INSERT INTO `password_reset_temp`(`email`, `email_key`, `exp_date`) VALUES ('$email', '$key', '$exp_date')"))
            {
                try {
                    // Create the SMTP transport
                    $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                        ->setUsername(MAIL_USERNAME)
                        ->setPassword(MAIL_PASSWORD);
                
                    $mailer = new Swift_Mailer($transport);
                
                    // Create a message
                    $message = new Swift_Message();
                
                    $message->setSubject('Password Reset Link');
                    $message->setFrom(['noreply@lakderena.com' => 'Lakderena Hotel Chain']);
                    $message->addTo($email);
                    
                    // Set the plain-text part
                    $message->setBody('Please click the link to reset your password');
                     // Set the HTML part
                    $message->addPart('Please click the link to reset your password: <a href="http://lakderena.local/reset_password.php?token='. $key .'&email='.$email.'">Reset Password</a>', 'text/html');
                     // Send the message
                    $result = $mailer->send($message);
                } catch (Exception $e) {
                  echo $e->getMessage();
                }

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function validatePasswordRestLink($token, $email)
        {
            $query = $this->db->query("SELECT exp_date FROM password_reset_temp WHERE email_key = '$token' AND email = '$email'");
            if($query->num_rows == 1)
            {
                $date = new DateTime;
                $date = $date->format("Y-m-d H:i:s");
        
                while($current_user = $query->fetch_assoc())
                {
                    if($date < $current_user['exp_date'])
                    {
                        return TRUE;
                    }
                }
            }
            else
            {
                return FALSE;
            }
        }

        public function resetPassword($email, $password)
        {
            //hash password
            $enc_password = $this->ownHash($password);

            if($this->db->query("UPDATE users SET password = '$enc_password' WHERE email = '$email'"))
            {
                return TRUE;
            }
            else
            {
                echo $this->db->error;
            }
        }

        public function ownHash($password)
        {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            return $hash_pass;
        }
    }
?>