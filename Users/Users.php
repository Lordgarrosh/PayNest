<?php
// namespace App;
class Users {
    private int $userID;
    private String $email;
    private String $password;
    private String $fname;
    private String $mname;
    private String $lname;
    private String $profPic;
    // private String $verification_status;
    // private String $otp;
    private String $number;
protected $conn;
protected Database $database;

    public function __construct(
        $email = '',
        $password = '',
        $fname = '',
        $mname = '',
        $lname = '',
        $profPic = '',
        $number = '',
        // $verification_status = ''
    ) {
$this->email = $email;
$this->password = $password;
$this->fname = $fname;
$this->mname = $mname;
$this->lname = $lname;
$this->profPic = $profPic;
$this->number = $number;

// $this->verification_status = $verification_status;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
       return $this->password;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getMname() {
        return $this->mname;
    }

    public function getLname() {
        return $this->lname;
    }


    public function getProfPic() {
        return $this->profPic;
    }

    public function getNumber() {
        return $this->number;
    }

    // public function getVerificationStatus () {
    //     return $this->verification_status;
    // }

    // public function getOTP() {
    //     return $this->otp;
    // }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = hash('sha256', $password);
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function setMname($mname) {
        $this->mname = $mname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function setProfPic($profPic) {
        $this->profPic = $profPic;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    // private String $number;

    // public function setVerificationStatus($verification_status) {
    //     $this->verification_status = $verification_status;
    // }

    // public function setOTP ($otp) {
    //     $this->otp = $otp;
    // }

    protected function setConn() {
    $this->database = new Database();
$this->conn =  $this->database->connect();
}

public function getConn() {
    return $this->conn;
}

}

    ?>