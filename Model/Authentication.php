<?php
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Model/UsersManager.php";
require_once __DIR__ . '/../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Authentication extends Users {
    private $uservalidation = "Not Validated";
    private $messageReport = "";

    public function getUserValidation () {
        return $this->uservalidation;
    }
    public function getMessageReport () {
        return $this->messageReport;
    }


    
    public function setUserValidation ($uservalidation) {
        $this->uservalidation = $uservalidation;
    }
    public function setMessageReport ($messageReport) {
        $this->messageReport = $messageReport;
    }


    public static function UserLogin($email, $password) {
        $instance = new self();
        $instance->setConn();
        $instance->setEmail($email);
        $instance->setPassword($password);
        return $instance;
    }


 public function authLogin() {
           
    $queryValue =  "email = :email AND password = :password";
    $loginQuery = "SELECT * FROM userinfo WHERE $queryValue";
    $stmt = $this->conn->prepare($loginQuery);
    $stmt->bindValue(":email", $this->getEmail());
    $stmt->bindValue(":password", $this->getPassword());
    $stmt->execute();

    // Fetch the full row only once
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData) {
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $this->setUserValidation("Validated");
    
                if (session_status() === PHP_SESSION_NONE) {    
    session_start();
}

        $_SESSION['email'] = $userData['Email'];
        $_SESSION['password'] = $userData['Password'];
     

        // echo "<script>alert('Username: " . $userData['username'] . "')</script>";
        // echo "<script>alert('Role: " . $userData['role'] . "')</script>";
 return [
            "userValidation" => $this->getUserValidation(),
            "messageReport" => "Sucess",
        ];
        // success
    } else {
        
        return [
            "userValidation" => $this->getUserValidation(),
            "messageReport" => "Email or Password is Incorrect",
        ];
    }
}




public function extractUserData () {

}


        public function registerValidation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            
            if (empty($_POST['fname']) || empty($_POST) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password'])) {
            
            $this->setMessageReport("PLease fill up all the data");
          
            }
            else {
                if (isset($_POST['fname']) || isset($_POST) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['password']))  {
                   
                         $fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
      $otp =  mt_rand(111111,999999);
$userRegistration = UsersManager::userRegister($email, $password, $fname, $lname);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $this->setMessageReport("Please enter a proper email format");
          
    }
        else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
              $this->setMessageReport("Password must contains 1 upper and lowercase with 1 digit and special character");
          
        }
        else if ($userRegistration->searchUser()) {
             $this->setMessageReport("Email already exist");
          
        }
        else {
         
$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'akirahinata498@gmail.com';                     //SMTP username
    $mail->Password   = 'ezac ikkz kayw json';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('akirahinata498@gmail.com', 'paynest');
    $mail->addAddress($email, $fname . " " . $lname);     //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP Verification';
    $mail->Body    = 'Here is your otp verification <b>' . $otp . '</b>';

    $mail->send();
     $isRegistered =   $userRegistration->createUser();
          $this->setUserValidation(($isRegistered) ? "Validated" : "Not Validated");
            $this->setMessageReport("Registration success");
                    if (session_status() === PHP_SESSION_NONE) {
                   
    session_start();
}
} catch (Exception $e) {
     $this->setMessageReport("Email dont exist");
}
        $_SESSION['email'] = $userRegistration->getEmail();    
        $_SESSION['password'] = $userRegistration->getPassword();
        }
                }
            }
        }
        return ['userValidation' => $this->getUserValidation(), 'messageReport' => $this->getMessageReport()];
    }


    public function verifyOTP () {
         if (session_status() === PHP_SESSION_NONE) {    
    session_start();
}
            $this->userValidation("Not Verified");
            $email = $_SESSION['email'];
            $otpSaved = $_SESSION['otp'];
            $otp1 = $_POST['otp1'];
            $otp2 = $_POST['otp2'];
            $otp3 = $_POST['otp3'];
            $otp4 = $_POST['otp4'];
            $otp5 = $_POST['otp5'];
            $otp6 = $_POST['otp6'];
            $otpInput = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
            if ($userInput == $otpSaved) {
                    $this->messageReport("OTP Verified");
                    $this->setUserValidation("Verified");
            }
            else {
                    
            }
    }

}

?>
