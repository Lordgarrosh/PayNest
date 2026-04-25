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
        $this->view("/EmployeeManager/dashboard", $userDatas);
        }
        else {
            $this->redirect("/subscriptionPlan");
        }
    }

    public function employeeAttendancePage() {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/employeeAttendance", $userDatas);
    }

    public function addEmployeeForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/addEmployee", $userDatas);
    }

    public function inventoryForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/inventory", $userDatas);
    }

    public function employeeForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/employee", $userDatas);
    }

    public function payrollForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/payroll", $userDatas);
    }

    public function salesForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/sales", $userDatas);
    }

    public function subscriptionPlan () {
        $userDatas = $this->userProfile();
        $this->view("EmployeeManager/subscriptionPlan", $userDatas);
    }

    public function addAttendance () {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAttendance'])) {
            $employeeID = $_POST['employeeID'];
            $timeIn = $_POST['timeIn'];
            $timeOut = $_POST['timeOut'];
            $this->startSession();
            $this->database = new Database();
            $this->conn = $this->database->connect();
            $attendanceQuery = "INSERT INTO ";
            echo "Employee ID $employeeID\n";
            echo "timein $timeIn\n";
            echo "timeOut $timeOut";
        }
    }

    public function addEmployeeData () {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitBtn'])) {
            
            $employeeName = $_POST['employeeName'];
            $tin = $_POST['tin'];
            $sss = $_POST['sss'];
            $philHealth = $_POST['philHealth'];
            $pagIbig = $_POST['pagIbig'];
            $salaryType = $_POST['salaryType'] ?? null;
            $salaryAmount = $_POST['salaryAmount'];
            if (empty($employeeName) || empty($tin) || empty($sss) || empty($philHealth) || empty($pagIbig) || empty($salaryType) || empty($salaryAmount)) {
              $this->view("/EmployeeManager/addEmployee", [
                "userValidation" => "Not Validated",
                    "messageReport" => "Please input all the input fields"
              ]);
        
            }
            else {
                 $this->startSession();
            $userSubscription = $this->fetchUserSubscription();
            $this->database = new Database();
            $this->conn = $this->database->connect();
            $employeeQuery = "INSERT INTO employee (employeeName, tin, sss, philHealth, pagIbig, salaryType, salaryAmount,  userSubscriptionID) VALUES 
            (:employeeName, :tin, :sss, :philHealth, :pagIbig, :salaryType, :salaryAmount, :userSubscriptionID)";
            $stmt = $this->conn->prepare($employeeQuery);
            $stmt->bindValue(":employeeName", $employeeName);
            $stmt->bindValue(":tin", $tin);
            $stmt->bindValue(":sss", $sss);
            $stmt->bindValue(":philHealth", $philHealth);
            $stmt->bindValue(":pagIbig", $pagIbig);
            $stmt->bindValue(":salaryType", $salaryType);
            $stmt->bindValue(":salaryAmount", $salaryAmount);
            $stmt->bindValue(":userSubscriptionID", $userSubscription['userSubscriptionID']);
            $stmt->execute();   
             $this->view("/EmployeeManager/addEmployee", [
                    "userValidation" => "Validated",
                    "messageReport" => "Employee Added Successfully"
              ]);
            }

            
        }
   
    }

    private function fetchUserSubscription () {
        $userData = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $userQuery = "SELECT userSubscriptionID, userID, subscriptionPlan FROM userSubscription WHERE userID = :userID";
        $stmt = $this->conn->prepare($userQuery);
        $stmt->bindValue(":userID", $userData['userID']);
        $stmt->execute();
        $userSubscriptionData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userSubscriptionData) 
            return [
                "userSubscriptionID" => $userSubscriptionData['userSubscriptionID'],
                "subscriptionPlan" =>  $userSubscriptionData['subscriptionPlan'],
                "userID" => $userSubscriptionData['userID'],
            ];
        else return null;
    }

    public function chooseSubscriptionPlan () {
      
                       if (isset($_POST['subscriptionPlan'])) {
                        $this->startSession();
  $subscriptionPlan =  $_SESSION['subscriptionPlan'] = $_POST['subscriptionPlan'];
  $subscriptionPeriod = $_SESSION['subscriptionPeriod'] = $_POST['subscriptionPeriod'];
    $this->database = new Database();
$this->conn =  $this->database->connect();
$userData = $this->userProfile();

$subscriptionQuery = "INSERT INTO usersubscription (subscriptionPlan, subscriptionPeriod, userID) VALUES (:subscriptionPlan, :subscriptionPeriod, :userID)";
$stmt = $this->conn->prepare($subscriptionQuery);
$stmt->bindValue(":subscriptionPlan", $subscriptionPlan);
$stmt->bindValue(":subscriptionPeriod", $subscriptionPeriod);
$stmt->bindValue(":userID", $userData['userID']);
$stmt->execute();
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