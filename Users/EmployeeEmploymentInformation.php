<?php

class EmployeeEmploymentInformation {
    private string $employeePosition;
    private string $workStatus;
    private string $employmentType;
    private string $sssNumber;
    private string $philHealthNumber;
    private string $pagIbigNumber;
    private string $tinNumber;

    public function __construct(string $employeePosition, string $workStatus, string $employmentType, string $sssNumber, string $philHealthNumber,
    string $pagIbigNumber, string $tinNumber) 
    {
       $this->employeePosition = $employeePosition;
       $this->workStatus = $workStatus;
       $this->employmentType = $employmentType;
       $this->sssNumber = $sssNumber;
       $this->philHealthNumber = $philHealthNumber;
       $this->pagIbigNumber = $pagIbigNumber;
       $this->tinNumber = $tinNumber;
    }

    // public function __construct()
    // {
    // }

    //setters
    public function setEmployeePosition (string $employeePosition) {
        $this->employeePosition = $employeePosition;
    }

    public function setWorkStatus (string $workStatus) {
        $this->workStatus = $workStatus;
    }

    public function setEmploymentType (string $employmentType) {
        $this->employmentType = $employmentType;
    }

    public function setSSSNumber (string $sssNumber) {
        $this->sssNumber = $sssNumber;
    }

    public function setPhilHealthNumber (string $philHealthNumber) {
        $this->philHealthNumber = $philHealthNumber;
    }

    public function setPagIbigNumber (string $pagIbigNumber) {
        $this->pagIbigNumber = $pagIbigNumber;
    }

    public function setTinNumber (string $tinNumber) {
        $this->tinNumber = $tinNumber;
    }

    //getter
    public function getEmployeePosition () {
        return $this->employeePosition ;
    }

    public function getWorkStatus () {
        return $this->workStatus;
    }

    public function getEmploymentType () {
        return $this->employmentType;
    }
    
    public function getSSSNumber () {
        return $this->sssNumber;
    }

    public function getPhilHealthNumber () {
        return $this->philHealthNumber;
    }

    public function getPagIbigNumber () {
        return $this->pagIbigNumber;
    }

    public function getTinNumber () {
        return $this->tinNumber;
    }
}

?>