<?php  

// require_once __DIR__ . "/../Model/Users.php";
// require_once __DIR__ . "/../Model/Database.php";
class Controller {
    //redirect the user if the user 
    protected function view(string $viewPath, array $data = []) {
        extract($data);
        // echo "<script>alert('dd')</script>";
        require __DIR__ . '/../View/' . $viewPath  . '.php';
    }

    protected function model(string $modelName) 
    {
        $modelName = trim($modelName, '/');
        require_once __DIR__ . '/../Model/' . $modelName . '.php'; 
        return new $modelName;  
    }

 protected function redirect($url, array $params = []) {
    extract($params);

    $base = "/"; // change if your project is in subfolder like "/your-project/"

    $url = $base . ltrim($url, '/');

    header("Location: $url");
    exit;
}


    public function FetchUserDatas () {
        $this->startSession();
        
        $fname = $_SESSION['FirstName'];
        $lname = $_SESSION['LastName'];
        $mname = $_SESSION['MiddleName'];
        $email = $_SESSION['Email'];
        $number = $_SESSION['Number'];
        $role = $_SESSION['Role'];
        session_unset();
        session_destroy();
        return [
            "fname" => $fname,
            "lname" => $lname,
            "mname" => $mname,
            "email" => $email,
            "Number" => $number,
            "Role" => $role 
        ];
    }


    public function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    }


}

?>