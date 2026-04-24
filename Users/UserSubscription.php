<?php

class UserSubscription {
    private int $userSubscriptionID;
    private string $subscriptionPlan;
    private int $userID;
    protected $conn;
protected Database $database;


    public function __construct ($subscriptionPlan, $userID) {
        $this->subscriptionPlan = $subscriptionPlan;

        $this->userID = $userID;
    }

    //getters
    public function getUserSubscriptionID () {
        return $this->userSubscriptionID;
    }

    public function getSubscriptionPlan () {
        return $this->subscriptionPlan;
    }

    public function getUserID () {
        return $this->userID;
    }

    //setters


    public function setUserSubscriptionPlan ($subscriptionPlan) {
        $this->subscriptionPlan = $subscriptionPlan;
    }

    public function setSubscriptionPlan (int $subscriptionPlan) {
        $this->subscriptionPlan = $subscriptionPlan;
    }

        public function setUserID (int $userID) {
        $this->userID = $userID;
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