
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/login.css"">
      <link rel="stylesheet" href="../css/modal.css">
    <title>Document</title>
</head>
<body>
    <?php require __DIR__ . "/../Components/registerModal.php" ?>
   <main class=" py-5 d-flex justify-content-center align-items-center min-vh-100 text-white px-3" >
<div class="row w-100" style="max-width: 900px;">
     <!-- Login part -->
<div class="col-md-6 login-box p-5 rounded-start ">
    <h2 class="  text-center mb-4">Login</h2>
   <form action="/login" method="POST" enctype="multipart/form-data">
         <div class="mb-3">
          <label for="email" class="form-label">Email or Username</label>
          <input type="text" class="form-control login-field" id="email" name="email" >
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control login-field" id="password" name="password" >
        </div>

        <div class="d-grid mb-3">
          <button type="submit" name="submitLogin" class="btn btn-info fw-bold text-dark">Sign In</button>
        </div>
   <div class="text-center">
          <!-- <a href="/forgotpass" class="text-info text-decoration-none">Forgot Password?</a> -->
        </div>
   </form>
 
</div>
   <div class="col-md-6 bg-secondary bg-gradient text-center d-flex flex-column justify-content-center align-items-center p-5 rounded-end">
      <h4 class="mb-3 text-dark">Don't have an account?</h4>
      <button onclick="window.location.href='/register'" class="btn btn-outline-light">Sign Up Here</button>
    </div>
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
              window.location.href = "/EmployeeManager/dashboard";
            });
    </script>
      <?php
    }
  }
}

?>