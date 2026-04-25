<?php 

class EmployeeAttendance extends Employee {
    private string $timein;
    private string $timeout;
    private string $attendanceStatus;

    public function __construct(string $timein, string $timeout, string $attendanceStatus) {
        $this->timein = $timein;
        $this->timeout = $timeout;
        $attendanceStatus = $attendanceStatus;
    }

    //getters 

    public function getTimeout () {
        return $this->timeout;
    }

    public function getTimein () {
        return $this->timein;
    }

    public function getAttendanceStatus() {
        return $this->attendanceStatus;
    }

    //setters
    public function setTimeout(string $timeout) {
        $this->timeout = $timeout;
    }

    public function setTimein(string $timein) {
        $this->timein = $timein;
    }

    public function setAttendanceStatus(string $attendanceStatus) {
        $this->attendanceStatus = $attendanceStatus;
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