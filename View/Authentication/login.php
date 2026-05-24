
<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$client = new Google\Client;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$client->setClientID($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope("openid");
$client->addScope("email");
$client->addScope("profile");
$url = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/login.css"">
    
    <title>Document</title>
</head>
<body>

   <main class=" py-5 d-flex justify-content-center align-items-center min-vh-100 text-white px-3" >
<div style="width: 100%;" class="d-flex justify-content-center" >
     <!-- Login part -->
<div class="login-box p-5 rounded-start ">
    <h2 class="text-center namdhinggo-regular m-0"  >Growmart</h2>
    <p class="text-success d-flex justify-content-center mb-4">Welcome back! Please sign in to your account.</p>
    <p class="d-flex justify-content-center mb-3">Sign up as</p>
    <div class="d-flex gap-4">
      <button style="background: none; border: none;" >
           <div class="d-flex containerShadow gap-5 justify-content-center align-items-center py-2 px-2">
        <img src="/assets/Vector.png" alt="d" width="35" >
        <h5>Admin</h5>
      </div>
      </button>
    <button style="background: none; border: none;" >
            <div class="d-flex containerShadow gap-5 justify-content-center align-items-center py-2 px-2">
        <img src="/assets/employeeGroup.png" alt="d" width="35" >
        <h5>Growmart</h5>
      </div>
    </button>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <hr style="width: 50%;" >
      <p class="m-0" >Or</p>
      <hr style="width: 50%;">
    </div>
   <form action="/login" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
          <label for="email" class="form-label">Email or Username</label>
          <input type="text" class="form-control login-field" id="email" name="email" >
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control login-field" id="password" name="password" >
        </div>
<div class="d-flex justify-content-center">
   <a href="<?= $url ?>" class="google-btn">
    <img src="https://developers.google.com/identity/images/g-logo.png" width="40" height="40" alt="Google Logo">
    Sign in with Google
</a>
</div>
        <div class="d-grid mb-3">
          <button type="submit" name="submitLogin" style="background-color: #2E7906; color: white;" class="btn fw-bold">Login</button>
        </div>
        <div class="d-flex gap-3 align-items-center justify-content-center">
          <a href="/register" style="margin: 0; color: black; " >Don't have an account?</a>
         
        </div>
   <div class="text-center">
          <!-- <a href="/forgotpass" class="text-info text-decoration-none">Forgot Password?</a> -->
        </div>
   </form>
 
</div>

</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitLogin']) ) {

  if (!empty($messageReport) && !empty($messageReport)) {

    if ($userValidation == "Not Validated") {
    ?>
    <script>
     
         Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '<?= $messageReport ?>'
            });
    </script>
    <?php
    }
    else {
      ?>
            <script>
  
         Swal.fire({
                icon: 'success',
                title: 'Registration Success',
                text: '<?= $messageReport ?>'
            }).then(() => {
              window.location.href = "/otpVerification";
            });
    </script>
      <?php
    }
  }
}

?>