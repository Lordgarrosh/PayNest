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
          <link rel="stylesheet" href="../css/sidenav.css">
          <link rel="stylesheet" href="../css/reportDashboard.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <main class="mainContainer p-5">
            <div class="reportIntro d-flex justify-content-between">
                <div>
                   <?php echo "<h1>Welcome " . $userDatas['fname'] . " " . $userDatas['lname'] . "</h1>"?>
                    <h5>Here is your sales report today</h3>
                </div>
                <div>
                     <img style="width: 2cm; height: 2cm;" src="<?php echo "/ProfilePic/". $userDatas['profPic'] ?>" alt="ad" height="40" width="20" class="userProfile">
                </div>
            </div>
        <div class="ReportActions d-flex gap-5 mt-5">
            <div class="reportContainer p-4" >
                <div class="reportTitle d-flex flex-column justify-content-center align-items-center">
                  <div class="reportImgIcon" >
                    <img src="../assets/barGraph.png"  height="40" width="40" alt="">
                  </div>
                    <h3>Sales Report</h3>
                </div>
                <p style="width: 2in; " class="mt-4" >View sales summary and transaction details</p>
                <div class="d-flex gap-4 justify-content-center userLinks">
                    <a href="">View Report</a>
                    <a href="">></a>
                </div>
            </div>

              <div class="reportContainer p-4" >
                <div class="reportTitle d-flex flex-column justify-content-center align-items-center">
                  <div class="reportImgIcon" >
                    <img src="../assets/container.png"  height="40" width="40" alt="">
                  </div>
                    <h3>Inventory Report</h3>
                </div>
                <p style="width: 2in; " class="mt-4" >View inventory stocks and sales movement</p>
                <div class="d-flex gap-4 justify-content-center userLinks">
                    <a href="">View Report</a>
                    <a href="">></a>
                </div>
            </div>

              <div class="reportContainer p-4" >
                <div class="reportTitle d-flex flex-column justify-content-center align-items-center">
                  <div class="reportImgIcon" >
                    <img src="../assets/employeeGroup.png"  height="40" width="40" alt="">
                  </div>
                    <h3>Employee Report</h3>
                </div>
                <p style="width: 2in; " class="mt-4" >View employee list and details</p>
                <div class="d-flex gap-4 justify-content-center userLinks">
                    <a href="">View Report</a>
                    <a href="">></a>
                </div>
            </div>

             <div class="reportContainer p-4" >
                <div class="reportTitle d-flex flex-column justify-content-center align-items-center">
                  <div class="reportImgIcon" >
                    <img src="../assets/calendar.png"  height="40" width="40" alt="">
                  </div>
                    <h3>Attendance Report</h3>
                </div>
                <p style="width: 2in; " class="mt-4" >View attendance summary and logs</p>
                <div class="d-flex gap-4 justify-content-center userLinks">
                    <a href="">View Report</a>
                    <a href="">></a>
                </div>
            </div>
        </div>

        <div class="reportSummaryContainer mt-5 " >
          <div>
            <h3>Report Summary</h3>
          </div>
          <div class="reportFields d-flex gap-5 mt-4"  style="width: 100%">
             <div class="d-flex gap-4" style="width: 35%">
              <div class="d-flex flex-column gap-3" style="width: 100%;" >
                <label for="">From</label>
              <input type="date" class="boxContainerDesign" name="" id="">
            </div>
            </div>
            
             <div class="d-flex gap-4" style="width: 35%">
              <div class="d-flex flex-column gap-3" style="width: 100%;" >
                <label for="">From</label>
              <input type="date" class="boxContainerDesign" name="" id="">
            </div>
            </div>
            <div style="width: 30%; height: 2cm;" class="d-flex align-items-end" >
              <button class="btn btn-success" style="width: 100%;" >Generate</button>
            </div>
          </div>
        </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



