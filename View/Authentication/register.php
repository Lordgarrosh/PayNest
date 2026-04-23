

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


<main class="px-5 mt-5 d-flex justify-content-center" >
  <div class="registerContainer px-5 py-5" >
        <div class="title pb-5">
<h1 class="text-center namdhinggo-regular" >PayNest<h1>
</div>
<form action="/register" method="POST" enctype="multipart/form-data">


<!-- <div class="d-flex"> -->
  <div class="d-flex gap-5">
    <div style="width: 30%;">
<div class="prof-image-container d-flex pb-5">
 <label for="imageInput" class="image-upload-container">
      <span class="image-upload-label">Click to upload image</span>
      <img id="imagePreview" alt="Image Preview">
      <input type="file" id="imageInput" name="profPic" accept="image/*">
    </label>
</div>
   </div>
   <div style="width: 70%;">
<div class="row mb-1">
    
    <div class="col-md-4">
        <label for="fname"   >First Name</label>
        <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter your First Name">
    </div>

    <div class="col-md-4">
        <label for="mname" >Middle Name</label>
        <input type="text" name="mname" id="mname" class="form-control" placeholder="Enter your Middle Name">
    </div>

    <div class="col-md-4">
        <label for="lname" >Last Name</label>
        <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter your Last Name">
    </div>
</div>
<div class="col">
  
         <div class="col py-2">
       <label for="number" >Number</label>
        <input type="number" name="number" id="number" class="form-control" placeholder="Enter your Number  ">
        </div>
    <div class="col py-2">
       <label for="email" >Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email">
        </div>
      <div class="col pb-4">
  <label for="password" >Password</label>
  <div class="input-group">
    <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password">
    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
      <i class="fas fa-eye-slash"></i>
    </span>
  </div>
</div>
</div>
<div class="d-flex flex-column align-items-center gap-3" >
  <input type="submit" name="submit" value="Register" style="background-color: #ffa02e; width:  20%; height: 1cm;" class="btn register">

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
              window.location.href = "/EmployeeManager/dashboard";
            });
        </script>

        <?php
        endif;
endif; ?>