    <?php



    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="../js/jquery-4.0.0.min.js"></script>
        <link rel="stylesheet" href="../css/EmployeeManager.css">
        <link rel="stylesheet" href="../css/settings.css">

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
                      <div class="searchbar d-flex align-items-center" style="width: 80%;" >
            <label>
                <button style="border: none;" id="searchbarBtn">
                     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                </button>
               
            </label>
            <input class="search flex" name="searchInventoryItem" id="searchInventoryItem" placeholder="Search Inventory...">
        </div>
                </div>
            </div>

          <div class="d-flex justify-content-center align-items-center">
          <div class="d-flex gap-5 mt-5">
              <div class="containerShadow" style="width: 50%">
                <div class="titleContainer">
                  <div class="d-flex justify-content-center align-items-center" style="background-color>
                      <img src="/assets/calendar.png" width="40" height="40">
                  </div>
                      <h1>Attendance<h1>
                </div>
            </div>
          </div>
          </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>
