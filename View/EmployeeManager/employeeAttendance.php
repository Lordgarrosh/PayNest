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
      <link rel="stylesheet" href="../css/EmployeeAttendance.css">
        <link rel="stylesheet" href="../css/sidenav.css">
        <title>PayNest</title>
    </head>
    <body>
        <div class="modalDark d-flex justify-content-center hide" id="addAttendanceModal">
            <div class="addEmployeeAttendanceForm p-5 mt-5">
                <form action="/EmployeeManager/addAttendance" method="post">
                <div class="d-flex justify-content-between mb-5 align-items-center">
                     <h3>Add Employee Attendance</h3>
                 <button onclick="toggleModal()" type="button" class="close-btn">X</button>
                </div>
               
                <div class="d-flex flex-column gap-5">
                <div>
                <label for="" class="form-label">Enter Employee ID: </label>
                <input type="text" name="employeeID" id="" class="form-control">
                </div>
                <div>
                <label for="" class="form-label">Enter Time In: </label>
                <input type="time" name="timeIn"  class="form-control">
                </div>
                <div>
                <label for="" class="form-label">Enter Time Out: </label>
                <input type="time" name="timeOut"  class="form-control">
                </div>
                </div>
                <select class="form-select mt-5" name="attendanceStatus" aria-label="Default select example">
  <option selected>Employee Attendance</option>
  <option value="Present">Present</option>
  <option value="Absent">Absent</option>
  <option value="Late">Late</option>
  <option value="On Leave">On Leave</option>
  <option value="Early Out">Early out</option>
</select>
                <button type="submit" name="addAttendance" class="btn btn-primary mt-5">Add Attendance</button>
                </form>
            </div>
        </div>
<?php require __DIR__ . "/../../View/Components/EmployeeSideNav.php" ?>
        <main class="container ">
            <div class="bg-white p-5" >
                <div>
                <h1 class="mb-5" >Employee Attendance Report</h1>
               
                <div class="d-flex justify-content-end gap-2" >
                    <input type="date" name="" id="">
                    <button class="btn btn-success">Show</button>
                    <button onclick="toggleModal()" class="btn btn-danger">Add Employee Attendance</button>
                </div>
                </div>
                <div>
                    <div class="mt-5 d-flex justify-content-center">
                        <h1>Currently No Available Data yet</h1>
                    </div>
                </div>
            </div>
        </main>
        <script>
            function toggleModal () {
                      let modalActive = document.getElementById("addAttendanceModal");
    const isHidden = modalActive.classList.contains("hide");

    modalActive.classList.toggle("hide", !isHidden);
    modalActive.classList.toggle("show", isHidden);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>


