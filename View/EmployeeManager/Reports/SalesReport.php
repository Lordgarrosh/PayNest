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
          <link rel="stylesheet" href="../css/sidenav.css">
            <link rel="stylesheet" href="../css/salesReport.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <main class="mainContainer p-5">
                  <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Sales Report</h1>
                         <div class="d-flex gap-5">
                        <h5>Employee</h5>
                        <h5>></h5>
                        <p>Add employee </p>
                    </div>
                </div>
                <div>
                 <a href="">  <img style="width: 2cm" src="<?php echo "/ProfilePic/". $userDatas['profPic'] ?>"  alt="" class="userProfile"></a> 
                </div>
            </div>
            <div class="timeSelector">

    <input type="radio" id="daily" name="time" value="Daily" checked>
    <label for="daily">
        <img src="/assets/calendar.png" width="20" height="20">
        Daily
    </label>

    <input type="radio" id="weekly" name="time" value="Weekly">
    <label for="weekly">
        <img src="/assets/calendar.png" width="20" height="20">
        Weekly
    </label>

    <input type="radio" id="yearly" name="time" value="Yearly">
    <label for="yearly">
        <img src="/assets/calendar.png" width="20" height="20">
        Yearly
    </label>

</div>

<div class="d-flex gap-3    " style="width: 70%;" >
    <div class="containerShadow d-flex gap-2 mt-5 py-1 align-items-center" style="width: 60%;">
        <div class="d-flex mx-3 justify-content-center iconBG align-items-center"  >
             <img src="/assets/dollar.png" width="30" height="30" alt="">
        </div>
      <div class="d-flex flex-column" style="width: 60%;">
        <p>Total Revenue</p>
        <p>12,250</p>
        <p>21% vs yesterday</p>
      </div>
    </div>

    <div class="containerShadow d-flex gap-2 mt-5 py-1 align-items-center" style="width: 60%;">
        <div class="d-flex mx-3 justify-content-center iconBG align-items-center"  >
             <img src="/assets/dollar.png" width="30" height="30" alt="">
        </div>
      <div class="d-flex flex-column" style="width: 60%;">
        <p>Total Revenue</p>
        <p>12,250</p>
        <p>21% vs yesterday</p>
      </div>
    </div>

    <div class="containerShadow d-flex gap-2 mt-5 py-1 align-items-center" style="width: 60%;">
        <div class="d-flex mx-3 justify-content-center iconBG align-items-center"  >
             <img src="/assets/dollar.png" width="30" height="30" alt="">
        </div>
      <div class="d-flex flex-column" style="width: 60%;">
        <p>Total Revenue</p>
        <p>12,250</p>
        <p>21% vs yesterday</p>
      </div>
    </div>
</div>

<div class="revenueOverview mt-5 p-3 d-flex gap-3" style="width: 100%;" >
    <div class="containerShadow p-3" style="width: 70%;" >
<h1>Revenue Overview for this month</h1>
<div style="width: 100%;" >
    <canvas id="revenueOverview"></canvas>
</div>
    </div>
    <div class="containerShadow p-4" style="width: 30%;" >
        <h5 style=" border-bottom: 2px solid gray;" class="pb-2" >Revenue Summary</h5>
        <div class="d-flex justify-content-between py-2 mb-3" style=" border-bottom: 2px solid gray;" >
            <div class="d-flex gap-2 flex-column"  >
                <p class="m-0" > Highest Day</p>
                <p class="m-0"  id="revenueHighestDate">AprilTest</p>
            </div>
            <h5 id="revenueHighestAmount">amountTest</h5>
        </div>
                <div class="d-flex justify-content-between py-2 mb-3" style=" border-bottom: 2px solid gray;" >
            <div class="d-flex gap-2 flex-column"  >
                <p class="m-0" > Lowest Day</p>
                <p class="m-0"  id="revenueLowestDate">AprilTest</p>
            </div>
            <h5 id="revenueLowestAmount">amountTest</h5>
        </div>
              <div class="d-flex justify-content-between py-2">
                <h5 class="m-0" id="revenueHighestDate">Net Revenue</h5>
            <h5 id="netRevenue">amountTest</h5>
        </div>
    </div>
</div>
<div class="containerShadow mt-5">
    <h1 style="border-bottom: 2px solid black" >Top Selling Item Revenue</h1>
    <div id="topSellingItemContainer"></div>
</div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>
    $(document).ready(function () {
    $.ajax({
       url: "/Report/computeItemRevenue",
       type: "GET",
       dataType: "json"
       success: (result) => {
        let html = "";
        $.each(result, (index, itemRevenueSummary) => {
            html+= `<div class="d-flex justify-content-between" style="border-bottom: 2px solid black">
        <h5>${result.itemName}</h5>
        <h5>${result.salesItemTotalRevenue}</h5>
    </div>`;
        }
        $("#topSellingItemContainer").html(html);
    }
    });
        
    $.ajax({
        url: "/Report/revenueSummary",
        type: "GET",
        dataType: "json",
        success: (result) => {
            $("#revenueHighestAmount").text("₱" + result.maxRevenue);
            $("#revenueLowestAmount").text("₱" + result.minRevenue);
            $("#netRevenue").text("₱" + result.totalRevenue);
            console.log(result);
        }
    });
        $.ajax({
            url: "/Report/lineGraph",
            type: "GET",
            dataType: "json",
            success: (result) => {
                console.log(result);
                              const ctx = document.getElementById('revenueOverview');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: result.revenueYear,
      datasets: [{
        label: 'Sales Report for the nazis',
        data: result.revenueValue,
        borderWidth: 1
      }]
    },
    options: {
        
      scales: {

            x: {
                ticks: {
                    minRotation: 45,
                    maxRotation: 45
                }
            },
        y: {
        beginAtZero: true
        }
      }
    }
  });
            }
        });
    });
</script>
    </body>
    </html>



