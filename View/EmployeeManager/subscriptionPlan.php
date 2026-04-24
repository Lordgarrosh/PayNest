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
         <link rel="stylesheet" href="../css/subscriptionPlan.css">
        <title>PayNest</title>
    </head>
    <body>
<?php require __DIR__ . "/../../View/Components/EmployeeNavbar.php" ?>

    <main class="container text-center">
        <h1>Subscription Plan</h1>
        <div class="subscriptionToggle mt-5" >
                   <span class="switch">
        <input type="checkbox" name="" id="subscriptionToggleBtn">
        <label for="" class="slider"></label>
       </span>
        </div>
        <div style="width: 100%;" class="d-flex justify-content-center" >
        <div class="d-flex gap-5 my-5 subscriptions">
            <div class="subscriptionContainer px-5 pt-4 pb-5" style=" box-shadow: 
    0 -1em 0 0 green,  
    1em 1em 1em rgb(0, 0, 0, 0.5);
    ;">
                <h1>Basic Plan</h1>
                <h3 id="basicPlanPrice" >₱12/Month</h3>
                <ul class="d-flex flex-column feature-list justify-content-center align-items gap-3">
                    <li>Monitor Employee Attendance</li>
                    <li>Manage Inventories & Track</li>
                    <li>Add Employee (Limited of 2)</li>
                </ul>
                <button class="btn btn-outline-secondary namdhinggo-regular mt-3 mb-5" id="basicPriceBtn" style="font-size: 2em;" >Try for free</button>
            </div>
            <div class="subscriptionContainer px-5 pt-4 pb-5" style=" box-shadow: 
    0 -1em 0 0 orange,  
    1em 1em 1em rgb(0, 0, 0, 0.5);
    ;">
                <h1>Premium Plan</h1>   
                <h3 id="premiumPlanPrice" >₱12345/Month </h3>
                    <ul class="class d-flex flex-column feature-list gap-3">
                        <li>Monitor Attendance</li>
                        <li>Manage Inventories & Track Sales</li>
                        <li>Unlimited add Employee</li>
                        <li>Access to generated government mandated contributions (Generated pay roll and pay slip)</li>
                    </ul>
               <button class="btn btn-outline-secondary namdhinggo-regular mt-3" id="premiumPriceBtn" style="font-size: 2em;">Try for free</button>
            </div>
        </div>
        </div>

    </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
             document.getElementById("subscriptionToggleBtn").addEventListener('change', (event) => {
               
                  document.getElementById("basicPlanPrice").innerHTML =  (event.target.checked) ? "₱98/Month" : "₱12/Month";
                  document.getElementById("premiumPlanPrice").innerHTML =  (event.target.checked) ? "₱98765/Year" : "₱12345/Month";
                
             });
             document.getElementById("basicPriceBtn").addEventListener('click', () => {
                // let price = (event.target.checked) ? 98 : 12;
                         Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
        if (result.isConfirmed) {
            fetch('/EmployeeManager/subscriptionPlan', {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                body: 'subscriptionPlan=Basic Plan'
            })
            .then(res => res.json())
            .then(() => {
                window.location.href = "/EmployeeManager/test";
            });
        }
});
             });
             document.getElementById("premiumPriceBtn").addEventListener('click', () => {
                // let price = (event.target.checked) ? 98765 : 12345;
                         Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
        if (result.isConfirmed) {
            fetch('/EmployeeManager/subscriptionPlan', {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                body: 'subscriptionPlan=Premium Plan'
            })
            .then(res => res.json())
            .then(() => {
                window.location.href = "/EmployeeManager/test";
            });
        }
});
             });
        </script>
    </body>
    </html>