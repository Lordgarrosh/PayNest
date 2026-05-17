

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/otp.css">
    <!-- <link rel="stylesheet" href="../css/landingheader.css"> -->

    <title>PayNest</title>

</head>

<body>


<main class="px-5 d-flex justify-content-center align-items-center" style="height: 100%; width: 100%; position: absolute;" >
<div class="otpContainer p-2 d-flex flex-column align-items-center" >
    <h1>Verify your account</h1>
    <p>The verification code has been sent to your email</p>
    <p>example@gmail.com</p>
    <div class="my-3 mb-5 errorField d-flex justify-content-center align-items-center">
        <p class="m-0" >Error Test</p>
    </div>
    <form action="" method="post">
            <div class="d-flex gap-4 justify-content-center mb-5" style="width: 100%;" >
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp1" class="otp-field" required>
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp2" class="otp-field" required>
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp3" class="otp-field" required>
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp4" class="otp-field" required>
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp5" class="otp-field" required>
<input type="text" inputmode="numeric" placeholder="0" pattern="[0-9]*" maxlength="1" name="otp6" class="otp-field" required>
    </div>
    <div class="mb-5 d-flex justify-content-center" >
        <button class="btn btn-primary">Submit</button>
    </div>
    </form>

</div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../js/jquery-4.0.0.min.js"></script>
    <script src="../js/otp.js"></script>
</body>
</html>


