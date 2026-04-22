<?php

require_once 'Controller.php';
 class AuthController extends Controller {
    
public function loginForm () {
    $this->view('/Authentication/login');
}
public function registerForm () {
    $this->view('/Authentication/register');
}

public function registerData () {
  $role = isset($_GET['r']) ? $_GET['r'] : 'null';
   $authenticate =  $this->model("/Authentication");
    $userRegistration = $authenticate->registerValidation();
           $this->view('/Authentication/register', $userRegistration);
}

public function loginUser() {
$authenticate = $this->model('/Authentication');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitLogin'])) {
  
  $email = $_POST['email'];
  $password = $_POST['password'];
   $role = isset($_GET['r']) ? $_GET['r'] : 'null';
  $authenticate = $authenticate::userLogin($email, $password, $role);
    $userLoginValidation =  $authenticate->authLogin();
   $this->view("/Authentication/login", $userLoginValidation);
  
    }
}

}



?>  