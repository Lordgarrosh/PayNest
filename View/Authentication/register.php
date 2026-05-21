
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
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="stylesheet" href="../css/register.css">
    <!-- <link rel="stylesheet" href="../css/landingheader.css"> -->

    <title>PayNest</title>
     <style>
    .image-upload-container {
      width: 100%;
      max-width: 300px;
      height: 300px;
      border: 2px dashed #ccc;
      position: relative;
      cursor: pointer;
      overflow: hidden;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .image-upload-container img {
      width: 100%;
      height: 100%;
      object-fit: fill;
      display: none;
    }

    .image-upload-label {
      position: absolute;
      color: #666;
      text-align: center;
      padding: 10px;
      pointer-events: none;
    }

    input[type="file"] {
      display: none;
    }
  </style>
</head>

<body>


<main class="px-5 d-flex justify-content-center align-items-center" style="height: 100%; position: absolute;" >
  <div class="registerContainer px-5 py-5" style="width: 40%;" >
        <div class="title pb-5">
<h1 class="text-center namdhinggo-regular" >PayNest<h1>
  <p class="text-success text-center" style="font-size: 50%;" >Create your admin account</p>
</div>
<div class="d-flex align-items-center justify-content-center mb-5">

    <div class="text-center" style="width: 50%;" >
        <div class="circleContainer">
            <p class="m-0 registrationStep">1</p>
        </div>
        <p>Account Information</p>
    </div>

    <hr class="stepLine" style="width: 50%;" >

    <div class="text-center" style="width: 50%;" >
        <div class="circleContainer">
            <p class="m-0 registrationStep">2</p>
        </div>
        <p>Verification</p>
    </div>

</div>
<form action="/register" method="POST" enctype="multipart/form-data">


<!-- <div class="d-flex"> -->
  <div class="d-flex gap-5">
   <div style="width: 100%;">
<div class="d-flex gap-2 mb-4"  >
    
    <div style="width: 50%;" class="d-flex flex-column" >
        <label for="fname"   >First Name</label>
        <input type="text" name="fname" id="fname" class="userInput" placeholder="Enter your First Name">
    </div>

    <div style="width: 50%;" class="d-flex flex-column"  class="">
        <label for="lname" >Last Name</label>
        <input type="text" name="lname" id="lname" class="userInput" placeholder="Enter your Last Name">
    </div>
</div>
<div class="">
  
    <div class="py-2 d-flex flex-column mb-4">
       <label for="email" >Email</label>
        <input type="text" name="email" id="email" class="userInput" placeholder="Enter your Email">
        </div>
      <div class="d-flex flex-column pb-4 mb-4"  >
  <label for="password" >Password</label>
  <div class="input-group">
    <input style="width: 90%;" type="password" id="password" class="userInput" name="password" placeholder="Enter Password">
    <span class="input-group-text userInput" id="togglePassword" style="cursor: pointer; width: 10%;">
      <i class="fas fa-eye-slash"></i>
    </span>
  </div>
</div>
</div>
<div class="d-flex flex-column align-items-center gap-3" >
 <a href="<?= $url ?>" class="google-btn">
    <img src="https://developers.google.com/identity/images/g-logo.png" width="40" height="40" alt="Google Logo">
    Sign in with Google
</a>
  <input type="submit" name="submit" value="Continue" style="background-color: #2E7906; color: white; width:  100%; height: 1cm;" class="btn register">

<a href="/login" style="color: black;" >Already have an account?</a>
        </div>
</div>

</form>
  </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');
  const labelText = document.querySelector('.image-upload-label');

  imageInput.addEventListener('change', function () {
    const file = this.files[0];
    console.log("asdasdasdasd");
    if (file) {
      const reader = new FileReader();
      
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        labelText.style.display = 'none';
         console.log("wut");
      }

      reader.readAsDataURL(file);
    } else {
      console.log("asd");
      imagePreview.style.display = 'none';
      labelText.style.display = 'block';
    }
  });

  

     const togglePassword = document.querySelector('#togglePassword');
  const passwordInput = document.querySelector('#password');
  const icon = togglePassword.querySelector('i');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;

    // Toggle icon class
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>


<?php  if (!empty($messageReport) && !empty($userValidation) ) :
  if ($userValidation == 'Not Validated') :
  ?>
  <script>
 
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: '<?= $messageReport    ?>'
            });
        </script>
<?php
   endif;
   if ($userValidation == 'Validated') : ?>

     <script>

        Swal.fire({
                icon: 'success',
                title: 'Registration success',
                text: '<?= $messageReport ?>'
            }).then(() => {
              window.location.href = "/otpVerification";
            });
        </script>

        <?php
        endif;
endif; ?>