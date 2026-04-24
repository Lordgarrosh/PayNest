<?php
require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";
class EmployeeManagerController extends Controller {
    private $conn;
    private $database;
    public function dashboard () {
        $userSubscription = $this->fetchUserSubscription();
        
        if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/addEmployee", $userDatas);
        }
        else {
            $this->redirect("/subscriptionPlan");
        }
    }

    public function addEmployee () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/addEmployee", $userDatas);
    }

    public function subscriptionPlan () {
        $userDatas = $this->userProfile();
        $this->view("EmployeeManager/subscriptionPlan", $userDatas);
    }

    private function fetchUserSubscription () {
        $userData = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $userQuery = "SELECT subscriptionPlan FROM userSubscription WHERE userID = :userID";
        $stmt = $this->conn->prepare($userQuery);
        $stmt->bindValue(":userID", $userData['userID']);
        $stmt->execute();
        $userSubscriptionData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userSubscriptionData) 
            return [
                "userSubsciptionID" => $userSubscriptionData['userSubscriptionID'],
                "subscriptionP" =>  $userSubscriptionData['subscriptionPlan'],
                "userID" => $userSubscriptionData['userID'],
            ];
        else return null;
    }

    public function chooseSubscriptionPlan () {
      
                       if (isset($_POST['subscriptionPlan'])) {
                          if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
    $_SESSION['subscriptionPlan'] = $_POST['subscriptionPlan'];
    echo json_encode(["status" => "success"]);
}
    }


private function userProfile () {
        $users = new Users();
          $this->startSession();
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
          $this->database = new Database();
$this->conn =  $this->database->connect();
$userQuery = "SELECT * FROM userinfo WHERE email = :email AND password = :password";
$stmt = $this->conn->prepare($userQuery);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":password", $password);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
if ($userData) {
       $userID = $userData['userID'];
       $fname = $userData['FirstName'];
       $mname = $userData['MiddleName'];
       $lname = $userData['LastName'];
       $profPic = $userData['ProfPic'];
       $number = $userData['Number'];
       return [
        "userID" => $userID,
        "email" => $email,
        "fname" => $fname,
        "mname" => $mname,
        "lname" => $lname,
        "profPic" => $profPic,
        "number" => $number
       ];
}
else {
    return null;
}

}

}
?>