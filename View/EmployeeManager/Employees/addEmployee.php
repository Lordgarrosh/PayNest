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
    <main class="mainContainer p-5">
               <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Employee</h1>
                    <div class="d-flex gap-5">
                        <h5>Employee</h5>
                        <h5>></h5>
                        <p>Add employee </p>
                    </div>
                </div>
            </div>  
                        <div class="d-flex gap-3 containerShadow px-4 py-2 align-items-center">
              <div class="addEmployeeIconContainer d-flex align-items-center justify-content-center" > <img src="../assets/addInventoryPerson.png" class="addEmployeeIconTitle ps-1" alt=""></div> 
                <div class="d-flex flex-column">
                    <h3 class="m-0" >Add inventory item</h3>
                    <p class="m-0" >fill in the details below to add a new inventory item to the system</p>
                </div>
             </div>

             <div class="addEmployeeContainer mt-5 containerShadow p-5 d-flex gap-5" style="width: 100%;" >
                <div class="fullEmployeeInfo" style="width: 65%;" >
                <div class="personalInformationContainer" style="width: 100%;" >
                    <div class="addEmployeeTitle d-flex gap-3 align-items-center">
                       <div class="d-flex p-3" style="background-color: #D4F1C5; border-radius: 50%;" >
                        <img src="../assets/employee.png" alt="" class="addEmployeeIcon">
                       </div> 
                        <h4>Personal Information</h4>
                    </div>
                    <div class="d-flex gap-4 mt-5"  >
                        <div class="d-flex gap-2 flex-column" style="width: 20%;" >
                            <p class="m-0" >First Name</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter first name" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >First Name</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter first name" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >First Name</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter first name" >
                        </div>
                    </div>
                    
                        <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Birthdate</p>
                            <input type="date" class="addEmployeeInput ps-2"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Civil Status</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter civil status" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Gender</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter your gender" >
                        </div>
                    </div>

                           <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Phone Number</p>
                            <input type="number" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Email Address</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter email address" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Address</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter address" >
                        </div>
                    </div>  
                </div>


                  <div class="personalInformationContainer mt-5" style="width: 100%;" >
                    <div class="addEmployeeTitle d-flex gap-3 align-items-center">
                       <div class="d-flex p-3" style="background-color: #D4F1C5; border-radius: 50%;" >
                        <img src="../assets/employee.png" alt="" class="addEmployeeIcon">
                       </div> 
                        <h4>Employment Information</h4>
                    </div>
                    <div class="d-flex gap-4 mt-5"  >
                        <div class="d-flex gap-2 flex-column" style="width: 20%;" >
                            <p class="m-0" >Employment Position</p>
                            <select name="" id="" class="addEmployeeInput ps-2">
                                <option value="">asd</option>
                                <option value="">asd</option>
                                <option value="">asd</option>
                                <option value="">asd</option>
                                <option value="">asd</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Work Status</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter first name" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Employment Type</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter first name" >
                        </div>
                    </div>
                    
                        <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >SSS Number</p>
                            <input type="date" class="addEmployeeInput ps-2"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Philhealth Number</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter civil status" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >Pag-Ibig Number</p>
                            <input type="text" class="addEmployeeInput ps-2" placeholder="Enter your gender" >
                        </div>
                    </div>

                           <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 20%;">
                            <p class="m-0" >TIN</p>
                            <input type="number" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                    </div>  
                </div>
                </div>
                    <div class="authInfo">
                        <div class="addEmployeeTitle d-flex gap-3 align-items-center">
                       <div class="d-flex p-3" style="background-color: #D4F1C5; border-radius: 50%;" >
                        <img src="../assets/employee.png" alt="" class="addEmployeeIcon">
                       </div> 
                        <h5>Account Information</h5>
                    </div>
                    <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >TIN</p>
                            <input type="number" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >TIN</p>
                            <input type="number" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >TIN</p>
                            <input type="number" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                    </div>
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