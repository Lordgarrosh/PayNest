<?php

class Employee {
    private int $employeeID;
    private string $employeeName;
    private string $tin;
    private string $sss;
    private string $philHealth;
    private string $pagIbig;
    private string $salaryType;
    private string $salaryCurrencyType;
    private float $salaryAmount;
    private int $userID;
    private int $userSubscriptionID;
    protected $conn;
protected Database $database;


    public function __construct(int $employeeID, string $tin, string $sss, string $philHealth, string $pagIbig, string $salaryType, string $salaryCurrencyType,
    float $salaryAmount, int $userID, int $userSubscriptionID
    ) {
        $this->employeeID = $employeeID;
        $this->tin = $tin;
        $this->sss = $sss;
        $this->philHealth = $philHealth;
        $this->pagIbig = $pagIbig;
        $this->salaryType = $salaryType;
        $this->salaryCurrencyType = $salaryCurrencyType;
        $this->salaryAmount = $salaryAmount;
        $this->userID = $userID;
        $this->userSubscriptionID = $userID;
    }

    //getters

    public function getEmployeeID() {
        return $this->employeeID;
    }

    public function getTin() {
        return $this->tin;
    }

    public function getSSS () {
        return $this->sss;
    }

    public function getPhilHealth () {
        return $this->philHealth;
    }

    public function getPagIbig() {
        return $this->pagIbig;
    }

    public function getSalaryType () {
        return $this->salaryType;
    }

    public function getCurrencyType () {
        return $this->salaryCurrencyType;
    }

    public function getSalaryAmount() {
        return $this->salaryAmount;
    }

    public function getUserID () {
        return $this->userID;
    }

    public function getUserSubscriptionID() {
        return $this->userSubscriptionID;
    }

    //setters
    public function setEmplyoyeeID(int $employeeID) {
        $this->employeeID = $employeeID;
    } 

    public function setTin(string $tin) {
        $this->tin = $tin;
    }

    public function setSSS(string $sss) {
        $this->sss = $sss;
    }

    public function setPhilHealth(string $philHealth) {
        $this->philHealth = $philHealth;
    }

    public function setPagIbig(string $pagIbig) {
        $this->pagIbig = $pagIbig;
    }

    public function setSalaryType(string $salaryType) {
        $this->salaryType = $salaryType;
    }

    public function setSalaryCurrencyType(string $salaryCurrencyType) {
        $this->salaryCurrencyType = $salaryCurrencyType;
    }

    public function setSalaryAmount(string $salaryAmount) {
        $this->salaryAmount = $salaryAmount;
    }

    public function setUserID(string $userID) {
        $this->userID = $userID;
    }

    public function setUserSubscriptionID(string $userSubscriptionID) {
        $this->userSubscriptionID = $userSubscriptionID;
    }



        protected function setConn() {
    $this->database = new Database();
$this->conn =  $this->database->connect();
}

public function getConn() {
    return $this->conn;
}

}

?>