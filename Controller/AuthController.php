<?php

require_once 'Controller.php';
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Create instance

require_once 'Controller.php';
 class AuthController extends Controller {
    

 public function otpForm () {
    $this->view('/Authentication/otp');
 }
public function loginForm () {
    $this->view('/Authentication/login');
}
public function registerForm () {
    $this->view('/Authentication/register');
}

public function otpVerification() {
$authentication = $this->model('/Authentication');
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitOTP'])) {
      $otpVerification = $authentication->verifyOTP();
      $this->view("/Authentication/otp", $otpVerification);
  }
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

public function googleRegistration() {
if (!isset($_GET['code'])) {
    exit("Login Failed");
}

$client = new Google\Client;
$client->setClientID($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token['access_token']);
$oauth = new Google\Service\OAuth2($client);
$userinfo = $oauth->userinfo->get();
var_dump(
$userinfo->getEmail(),
$userinfo->getFamilyName(),
$userinfo->getGivenName(),
$userinfo->getId(),
$userinfo->getPicture(),
);
}

}



?>  
