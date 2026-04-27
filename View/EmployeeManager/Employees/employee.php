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
          <link rel="stylesheet" href="../css/employee.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <main class="mainContainer p-5">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Employee Management</h1>
                    <p>Welcome back! Manage your employee today</p>
                </div>
                <div>
                 <a href="">  <img style="width: 2cm" src="<?php echo "/ProfilePic/". $profPic ?>"  alt="" class="userProfile"></a> 
                </div>
            </div>
            <div class="mt-5 employeeActionsContainer">
                <div class="row gap-5">
                    <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/calendarClock.png" width="40" alt="asd" class="employeeIcon">
                            <h3>Attendance</h3>
                        </div>
                      <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">Track and manage employee attendance records</p></div>
                            <a href="/EmployeeManager/employeeAttendance" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>View Attendance</p>
                                <p>></p>
                            </a>
                    </div>
                    
                        <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/userGroups.png" width="40" alt="asd" class="employeeIcon">
                            <h3>Employee List</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">View and manage all employee records</p></div>
                            <a href="/EmployeeManager/employeeList" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>View Employee</p>
                                <p>></p>
                            </a>
                    </div>

                        <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/addEmployee.png" width="40" alt="asd" class="employeeIcon">
                            <h3>Add Employee</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">Add new employee and set up their profile</p></div>
                            <a href="/EmployeeManager/addEmployee" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>Add Employee</p>
                                <p>></p>
                            </a>
                    </div>

                </div>

                <div class="row gap-5">
                    <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/roles.png" width="50" height="50" alt="asd" class="employeeIcon">
                            <h3>Roles</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">Manage User roles and permissions</p></div>
                            <a href="/EmployeeManager/employeeRoleManage" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>Manage Roles</p>
                                <p>></p>
                            </a>
                    </div>

                     <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/payroll.png" width="40" alt="asd" class="employeeIcon">
                            <h3>Payroll</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">Process and manage employee salaries and payments</p></div>
                            <a href="/EmployeeManager/payroll" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>Go to Payroll</p>
                                <p>></p>
                            </a>
                    </div>

                     <div class="col employeeActions g-5 px-0">
                        <div class="d-flex align-items-center gap-3 employeeTitle py-2 ps-3">
                            <img src="../assets/leaveRequest.png" width="40" alt="asd" class="employeeIcon">
                            <h3>Leave Request</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-3"><p style="width: 80%;">Review and manage leave request</p></div>
                            <a href="/EmployeeManager/leaveRequest" class="d-flex justify-content-center gap-5 redirectEmployee" >
                                <p>View Request</p>
                                <p>></p>
                            </a>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



