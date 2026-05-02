<?php

class EmployeePersonalInformation {
    private string $firstName;
    private string $middleName;
    private string $lastName;
    private string $birthDate;
    private string $civilStatus;
    private string $gender;
    private string $phoneNumb;
    private string $email;
    private string $address;

    public function __construct(string $firstName, string $middleName, string $lastName, string $birthDate, string $civilStatus, string $gender,
    string $phoneNumb, string $email, string $address)
    {
       $this->firstName = $firstName;
       $this->middleName = $middleName;
       $this->lastName = $lastName;
       $this->birthDate = $birthDate;
       $this->civilStatus = $civilStatus;
       $this->gender = $gender;
       $this->phoneNumb = $phoneNumb;
       $this->email = $email;
       $this->address = $address;
    }

    // public function __construct()
    // {
    // }

    //setters
    public function setFirstName (string $firstName) {
        $this->firstName = $firstName;
    }

    public function setMiddleName (string $middleName) {
        $this->middleName = $middleName;
    }

    public function setLastName (string $lastName) {
        $this->lastName = $lastName;
    }

    public function setBirthDate (string $birthDate) {
        $this->birthDate = $birthDate;
    }

    public function setCivilStatus (string $civilStatus) {
        $this->civilStatus = $civilStatus;
    }

    public function setGender (string $gender) {
        $this->gender = $gender;
    }

    public function setPhoneNumb (string $phoneNumb) {
        $this->phoneNumb = $phoneNumb;
    }

    public function setEmail (string $email) {
        $this->email = $email;
    }

    public function setAddress(string $address) {
        $this->address = $address;
    }


    //getters
    public function getFirstName () {
        return $this->firstName;
    }

    public function getMiddleName () {
        return $this->middleName;
    }

    public function getLastName () {
        return $this->lastName;
    }

    public function getBirthDate () {
        return $this->birthDate;
    }

    public function getCivilStatus () {
        return $this->civilStatus;
    }

    public function getGender () {
        return $this->gender;
    }

    public function getPhoneNumb () {
        return $this->phoneNumb;
    }

    public function getEmail () {
        return $this->email;
    }

    public function getAddress () {
        return $this->address;
    }

    
}

?>