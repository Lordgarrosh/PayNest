<?php

class EmployeeAccountInformation {
    private string $username;
    private string $password;
    
    public function __construct (string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    //setters
    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function setPassword(string $password) {
        $this->password = hash('sha256', $password);
    }

    //getters 
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
}

?>