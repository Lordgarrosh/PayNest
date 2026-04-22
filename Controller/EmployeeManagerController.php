<?php
require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Model/Database.php";
class EmployeeManagerController extends Controller {
    private $conn;
    private $database;
    public function dashboard () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/dashboard", $userDatas);
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
       $fname = $userData['FirstName'];
       $mname = $userData['MiddleName'];
       $lname = $userData['LastName'];
       $profPic = $userData['ProfPic'];
       $number = $userData['Number'];
       return [
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