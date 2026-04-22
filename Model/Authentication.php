<?php
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Model/UsersManager.php";
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
       echo "<script>alert('Password: " . $this->getPassword() . "');</script>";
echo "<script>alert('Email: " . $this->getEmail() . "');</script>";
        $this->setUserValidation("Validated");
    
echo "<script>alert('asd');</script>";
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
            
            if (empty($_POST['fname']) || empty($_POST['mname']) || empty($_POST) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['number']) || empty($_FILES['profPic'])) {
            
            $this->setMessageReport("PLease fill up all the data");
          
            }
            else {
                if (isset($_POST['fname']) || isset($_POST['mname']) || isset($_POST) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['password']) ||isset($_POST['number']) || isset($_FILES['profPic']))  {
                   
                         $fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
	$img_name = $_FILES['profPic']['name'];       //getting image name
			$img_typ = $_FILES['profPic']['type'];            //getting image name
			$tmp_name = $_FILES['profPic']['tmp_name'];   //set temporary name
			$img_explode = explode('.', $img_name);   // let's Explode Image
			$img_extension = end($img_explode);
			$extensions = ['png', 'jpeg', 'jpg'];       //these are some valid extensions
      $time = time();
      $profPic = $time . $img_name;

$number = $_POST['number'];
if (move_uploaded_file($tmp_name,__DIR__ . "/../ProfilePic/" . $profPic)) {
      $otp =  mt_rand(111111,999999);
$userRegistration = UsersManager::userRegister($email, $password, $fname, $mname, $lname, $profPic, $number);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $this->setMessageReport("Please enter a proper email format");
          
    }
        else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
              $this->setMessageReport("Password must contains 1 upper and lowercase with 1 digit and special character");
          
        }
        else if ($userRegistration->searchUser()) {
             $this->setMessageReport("Email already exist");
          
        }
        else if(!in_array($img_extension, $extensions)) {
            $this->setMessageReport("Wrong image extension please try again");
        }
        else {
          $isRegistered =   $userRegistration->createUser();
          $this->setUserValidation(($isRegistered) ? "Validated" : "Not Validated");
            $this->setMessageReport("Registration success");
                    if (session_status() === PHP_SESSION_NONE) {
                   
    session_start();
}
        $_SESSION['email'] = $userRegistration->getEmail();    
        $_SESSION['password'] = $userRegistration->getPassword();
        }
}
else {
      $this->setMessageReport("Registration Failed Successfully");
}
                }
            }
        }
        return ['userValidation' => $this->getUserValidation(), 'messageReport' => $this->getMessageReport()];
    }

}

?>