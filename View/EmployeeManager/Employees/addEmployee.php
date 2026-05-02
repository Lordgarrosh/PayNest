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

             <div class="addEmployeeContainer mt-5 containerShadow " style="width: 100%;" >
                <form action="/EmployeeManager/addEmployee" method="post">
                    <div class="p-5 d-flex gap-5" >
                <div class="fullEmployeeInfo" style="width: 65%;" >
                <div class="personalInformationContainer" style="width: 100%;" >
                    <div class="addEmployeeTitle d-flex gap-3 align-items-center">
                       <div class="d-flex p-3" style="background-color: #D4F1C5; border-radius: 50%;" >
                        <img src="../assets/employee.png" alt="" class="addEmployeeIcon">
                       </div> 
                        <h4>Personal Information</h4>
                    </div>
                    <div class="d-flex gap-4 mt-5"  >
                        <div class="d-flex gap-2 flex-column" style="width: 100%;" >
                            <p class="m-0" >First Name</p>
                            <input type="text" class="addEmployeeInput ps-2" name="firstName" placeholder="Enter first name" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Middle Name</p>
                            <input type="text" class="addEmployeeInput ps-2" name="middleName" placeholder="Enter first name" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Last Name</p>
                            <input type="text" class="addEmployeeInput ps-2" name="lastName" placeholder="Enter first name" >
                        </div>
                    </div>
                    
                        <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Birthdate</p>
                            <input type="date" class="addEmployeeInput ps-2" name="birthdate" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Civil Status</p>
                           <select name="civilStatus" id="" class="addEmployeeInput ps-2">
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widow">Widow</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Gender</p>
                            <select name="gender" id="" class="addEmployeeInput ps-2">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                           <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Phone Number</p>
                            <input type="number" name="phoneNumb" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Email Address</p>
                            <input type="text" name="email" class="addEmployeeInput ps-2" placeholder="Enter email address" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Address</p>
                            <input type="text" name="address" class="addEmployeeInput ps-2" placeholder="Enter address" >
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
                        <div class="d-flex gap-2 flex-column" style="width: 100%;" >
                            <p class="m-0" >Employment Position</p>
                            <select name="employmentPosition" id="" class="addEmployeeInput ps-2">
                                <option value="Cashier">Cashier</option>
                                <option value="Manager">Manager</option>
                                <option value="Janitor">Janitor</option>
                                <option value="Bagger">Bagger</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Work Status</p>
                            <select name="workStatus" id="" class="addEmployeeInput ps-2">
                                <option value="Active">Active</option>
                                <option value="Status">Status</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Resigned">Resigned</option>
                                <option value="Blacklisted">Blacklisted</option>
                                <option value="Terminated">Terminated</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Employment Type</p>
                            <select name="employmentType" id="" class="addEmployeeInput ps-2">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Contractual">Contractual</option>
                            </select>
                        </div>
                    </div>
                    
                        <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >SSS Number</p>
                            <input type="text" name="sssNumber" class="addEmployeeInput ps-2" placeholder="Enter your SSS Number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Philhealth Number</p>
                            <input type="text" name="philhealthNumber" class="addEmployeeInput ps-2" placeholder="Enter civil status" >
                        </div>
                        <div class="d-flex gap-2 flex-column" style="width: 100%;">
                            <p class="m-0" >Pag-Ibig Number</p>
                            <input type="text" name="pagIbigNumber" class="addEmployeeInput ps-2" placeholder="Enter your gender" >
                        </div>
                    </div>

                           <div class="d-flex gap-4 mt-5">
                        <div class="d-flex gap-2 flex-column" style="width: 30%;">
                            <p class="m-0" >TIN</p>
                            <input type="text" name="tinNumber" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                    </div>  
                </div>
                </div>
                    <div class="authInfo ps-5" style="border-left: solid 2px black;" >
                        <div class="addEmployeeTitle d-flex gap-3 align-items-center">
                       <div class="d-flex p-3" style="background-color: #D4F1C5; border-radius: 50%;" >
                        <img src="../assets/employee.png" alt="" class="addEmployeeIcon">
                       </div> 
                        <h5>Account Information</h5>
                    </div>
                    <div class="d-flex gap-2 flex-column mt-5" style="width: 100%;">
                            <p class="m-0" >Username</p>
                            <input type="text" name="username" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column mt-5" style="width: 100%;">
                            <p class="m-0" >Password</p>
                            <input type="text" name="password" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                        <div class="d-flex gap-2 flex-column mt-5" style="width: 100%;">
                            <p class="m-0" >Confirm Password</p>
                            <input type="text" name="confirmPassword" class="addEmployeeInput ps-2" placeholder="Enter your number"  >
                        </div>
                    </div>
                    </div>
                           <div class="button-container d-flex gap-5 justify-content-end pe-5 pb-5">
                        <button onclick="window.location.href='/EmployeeManager/employee'" type="button" style="width: 15%;" class="buttonCancel d-flex gap-3 justify-content-center align-items-center">
                            <img src="../assets/Exit.png" width="20" height="20" alt="">
                            <p class="m-0" >Exit</p>
                        </button>
                        <button type="submit" style="width: 15%;" name="addEmployee" class="btn btn-success d-flex gap-3 justify-content-center align-items-center">
                             <img src="../assets/downloadIcon.png" width="20" height="20" alt="">
                            <p class="m-0" >Save</p>
                        </button>
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
if ($userValidation == "Not Validated" && !empty($messageReport)) {
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