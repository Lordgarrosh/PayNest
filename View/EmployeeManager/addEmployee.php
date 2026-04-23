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
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../View/Components/EmployeeNavbar.php" ?>
    <main class="mainContainer d-flex justify-content-center mt-3 gap-5 ms-auto align-items-center ">
        <div class="addEmployeeContainer py-5 d-flex gap-5">
            <div class="d-flex flex-column gap-5 employeeFields ms-5" >
                  <div class="d-flex gap-5 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill addEmployeeIcon" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
<h1>Add Employee</h1>
            </div>
      <div class="d-flex flex-column gap-3">
                <input type="text" class="userEmployeeFields" name="fname"  placeholder="Full Name">
                <input type="text" class="userEmployeeFields" name="tin"  placeholder="TIN">
                <input type="text" class="userEmployeeFields" name="sss"  placeholder="SSS Number">
                <input type="text" class="userEmployeeFields" name="philHealth"  placeholder="PhilHealth Number">
                <input type="text" class="userEmployeeFields" name="pagIbig"  placeholder="Pag-ibig Number">
            </div>
            </div>
            <div class="d-flex justify-content-center flex-column salary-container gap-3">
                <p>Salary Type</p>
                <div class="d-flex gap-3">
                    <button class="btn" style="background-color: #c2a56d; width: 1in;">Daily</button>
                    <button class="btn btn-outline-secondary" style="width: 1in;">Weekly</button>
                     <button class="btn btn-outline-secondary" style="width: 1in;">Monthly</button>
                </div>
                <p>Basic Salary</p>
                <div class="d-flex gap-1">
                <button class="btn btn-outline-secondary btn-salary">₱</button>
                <input type="text" placeholder="Enter your Salary" class="salaryField" name="" id="">
                </div>
                <button class="btn" style="background-color: #c2a56d; width: 2in;">Save Employee</button>
                
            </div>
        </div>
    </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>