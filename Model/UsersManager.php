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


public function createUser($otpPurpose) {
 
    try {
        // $this->database = new Database();
        // $this->conn = $this->database->connect();
        $stmt = $this->conn->prepare("INSERT INTO userinfo (Email, Password, FirstName, LastName, registerType) VALUES (:email, :password, :fname, :lname, :registerType)");
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', password_hash($this->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue('fname', $this->getFname());
        $stmt->bindValue(':lname', $this->getLname());
          $stmt->bindValue(':registerType', $otpPurpose);
        // $stmt->bindValue(':verification_status', $this->getVerificationStatus());
        // $stmt->bindValue(':otp', value: $this->getOTP());
        return $stmt->execute();
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function createGoogleUser($otpPurpose) {
       try {
        // $this->database = new Database();
        // $this->conn = $this->database->connect();
        $stmt = $this->conn->prepare("INSERT INTO userinfo (Email, google_id, FirstName, LastName, ProfPic, registerType) VALUES (:email, :google_id, :fname, :lname, :profPic, :registerType)");
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':google_id', $this->getPassword());
        $stmt->bindValue('fname', $this->getFname());
        $stmt->bindValue(':lname', $this->getLname());
        $stmt->bindValue(':profPic', $this->getProfPic());
         $stmt->bindValue(':registerType', $otpPurpose);
        // $stmt->bindValue(':verification_status', $this->getVerificationStatus());
        // $stmt->bindValue(':otp', value: $this->getOTP());
        return $stmt->execute();
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


public function searchUser () {

 $stmt = $this->conn->prepare("SELECT COUNT(*) FROM userinfo WHERE Email = :email");   
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