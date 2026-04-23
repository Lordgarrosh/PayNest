
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
    <h2 class="text-center mb-4 namdhinggo-regular"  >PayNest</h2>
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
          <button type="submit" name="submitLogin" class="btn btn-info fw-bold text-dark">Login</button>
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
              window.location.href = "/EmployeeManager/dashboard";
            });
    </script>
      <?php
    }
  }
}

?>