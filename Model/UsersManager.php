<?php 
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ ."/../Model/Database.php";
class UsersManager extends Users{
public static function userRegister($email, $password, $fname, $lname, $otp) {
    $instance = new self();
        $instance->setConn();
    $instance->setEmail($email);
    $instance->setPassword($password);
    $instance->setFname($fname);
    $instance->setLname($lname);
    $instance->setOTP($otp);
    // $instance->setVerificationStatus($verification_status);
    // $instance->setOTP($otp);
    return $instance;
}


public function createUser() {
 
    try {
        // $this->database = new Database();
        // $this->conn = $this->database->connect();
        $stmt = $this->conn->prepare("INSERT INTO userinfo (Email, Password, FirstName, LastName) VALUES (:email, :password, :fname, :lname)");
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', password_hash($this->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue('fname', $this->getFname());
        $stmt->bindValue(':lname', $this->getLname());
        // $stmt->bindValue(':verification_status', $this->getVerificationStatus());
        // $stmt->bindValue(':otp', value: $this->getOTP());
        return $stmt->execute();
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


public function searchUser () {

 $stmt = $this->conn->prepare("SELECT COUNT(*) FROM userinfo WHERE email = :email");   
 $stmt->bindValue(":email", $this->getEmail());
 $stmt->execute();
     $count = $stmt->fetchColumn();
    return $count > 0; 
}


//for generating a token for for user login or register or remembering and etc 
public function generateToken () {
    
}

public function editProfile() {
    
}


}

?>