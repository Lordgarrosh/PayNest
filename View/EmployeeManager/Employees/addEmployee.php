    <?php



    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/EmployeeManager.css">
        <link rel="stylesheet" href="../css/AddEmployee.css">
          <link rel="stylesheet" href="../css/sidenav.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
    <main class="mainContainer d-flex justify-content-center mt-3 gap-5 ms-auto align-items-center ">
       
        <div class="addEmployeeContainer py-5 ">
             <form action="/EmployeeManager/addEmployee" class="d-flex gap-5" method="post">
            <div class="d-flex flex-column gap-5 employeeFields ms-5" >
                  <div class="d-flex gap-5 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill addEmployeeIcon" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
<h1>Add Employee</h1>
            </div>
      <div class="d-flex flex-column gap-3">
                <input type="text" class="userEmployeeFields" name="employeeName"  placeholder="Full Name">
                <input type="text" class="userEmployeeFields" name="tin"  placeholder="TIN">
                <input type="text" class="userEmployeeFields" name="sss"  placeholder="SSS Number">
                <input type="text" class="userEmployeeFields" name="philHealth"  placeholder="PhilHealth Number">
                <input type="text" class="userEmployeeFields" name="pagIbig"  placeholder="Pag-ibig Number">
            </div>
            </div>
            <div class="d-flex justify-content-center flex-column salary-container gap-3">
                <p>Salary Type</p>
                <div class="d-flex gap-3">
<input type="radio" id="btn-check" class="btn-check" name="salaryType" value="Daily">
<label class="btn btn-outline-secondary testBtn" for="btn-check">Daily</label>

<input type="radio" id="btn-check-2" class="btn-check" name="salaryType" value="Weekly">
<label class="btn btn-outline-secondary testBtn" for="btn-check-2">Weekly</label>

<input type="radio" id="btn-check-3" class="btn-check" name="salaryType" value="Monthly">
<label class="btn btn-outline-secondary testBtn" for="btn-check-3">Monthly</label>
                </div>
                <p>Basic Salary</p>
                <div class="d-flex gap-1">
                <p class="pesoSign">₱</p>
                <input type="text" placeholder="Enter your Salary" class="salaryField" name="salaryAmount" id="">
                </div>
                <button class="btn" name="submitBtn" style="background-color: #c2a56d; width: 2in;">Save Employee</button>
                
            </div>
             </form>
        </div>
    </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



<?php
if (!empty($userValidation) && !empty($messageReport)) {
if ($userValidation == "Not Validated" || empty($messageReport)) {
    echo "<script>Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: ' $messageReport '
            });</script>";
}
else if ($userValidation == "Validated") {
    echo "<script>
  
         Swal.fire({
                icon: 'success',
                title: 'Registration Success',
                text: '$messageReport'
            }).then(() => {
              window.location.href = '/EmployeeManager/dashboard';
            });
    </script>";
}
}

?>