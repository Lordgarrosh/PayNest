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
         <link rel="stylesheet" href="../css/dashboard.css">
        <title>Growmart</title>
    </head>
    <body>
<?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>


    <main class="mainContainer gap-5 ms-auto p-5">
               <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Inventories</h1>
                    <p>Manage Inventories and stocks</p>
                </div>
                <div>
                 <a href="">    <img src="<?php 
        if (empty($userDatas['profPic']) || $userDatas['profPic'] !== "No Prof Pic") {
          
            echo ($userDatas['google_id'] != null) ? $userDatas['profPic'] : "/ProfilePic/". $userDatas['profPic'] ;
        }
        else {
        echo "/assets/noProfile.png";
        } 
        ?>
        
        " alt="ad" id="userProfPic" class="userProfile"></a> 
                </div>
            </div>
            <div class="d-flex gap-5">
                <div class="containerShadow align-items-center p-3 d-flex gap-3" style="width: 50%;" >
                    <div class="p-4 imageIcon ">
                        <img src="/assets/cart.png" width="40" height="40" alt="asd">
                    </div>
                    
                    <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                        <p class="m-0" >Today's Sales</p>
                        <h3 class="m-0" id="todaySalesTop" style="color: #2E7906;" >P0.00</h3>
                    </div>
                </div>
                <!-- <div class="containerShadow align-items-center p-3 d-flex gap-3" style="width: 50%;" >
                    <div class="p-4 imageIcon ">
                        <img src="/assets/employeeGroup.png" width="40" height="40" alt="asd">
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                        <p class="m-0" >Today's Sales</p>
                        <h3 class="m-0" style="color: #2E7906;" >P0.00</h3>
                    </div>
                </div> -->
                <!-- <div class="containerShadow align-items-center p-3 d-flex gap-3" style="width: 50%;" >
                    <div class="p-4 imageIcon ">
                        <img src="/assets/burgerIcon.png" width="40" height="40" alt="asd">
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                        <p class="m-0" >Today's Sales</p>
                        <h3 class="m-0" style="color: #2E7906;" >P0.00</h3>
                    </div>
                </div> -->
            </div>

            <div class="d-flex gap-5 mt-5" style="width: 100%;" >
                <div class="d-flex gap-5 containerShadow" style="width: 66%;" >
                <div class="salesOverviewContainer d-flex flex-column gap-2" style="width: 60%;" >
                    <h1>Sales Overview</h1>
                     <div class="mt-5" id="chartContainer" >
  <!-- <canvas style="height: 100%;" id="chartTest"></canvas> -->
</div>
                </div>
                <div class="p-3 ps-5" style="border-left: solid black 1px;"> 
                    <div class="todaySales">
                        <p>Today Sales</p>
                        <h5 id="salesToday" style="color: #2E7906;" >P0.0</h5>
                        
                    </div>
                    <div class="averageDailySales">
                        <p>Average Daily Sales</p>
                        <h5 id="averageDailySales" style="color: #2E7906;" >P0.0</h5>
                        
                    </div>
                    <div class="todaySales">
                        <p>Peak Sales</p>
                        <h5 id="peakSaleYear" style="color: #2E7906;" >P0.0</h5>
                        <h5 id="peakSaleValue" style="color: #2E7906;" >P0.0</h5>
                    </div>
                </div>
                </div>
                <div class="containerShadow p-3"  style="width: 30%;">
                    <h5 style="color: #2E7906;" >Top Products Sale</h5>
 <div style="height: 3in;" id="pieContainer" >
  <!-- <canvas id="pieGraph"></canvas> -->
</div> 
                </div>
            </div>


       <!-- <div style="height: 3in;" >
  <canvas id="chartTest"></canvas>
</div> -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script>



  $(document).ready(function () {
   $.ajax({
        url: "/Dashboard/pieGraph",
        type: "GET",
        dataType: "json",
        success: (result) => {
            const labels = result.map(item => item.itemName);
     const data = result.map(item => Number(item.totalSales));
      console.log(data.length);
           const pieContainer = document.getElementById("pieContainer");
             if (data.length == 0) {
                pieContainer.innerHTML = "<h1>No current item sales</h1>";
             }
             else {
                  pieContainer.innerHTML = "<canvas id='pieGraph'></canvas> ";
                    const pieGraph = document.getElementById('pieGraph');
                   new Chart(pieGraph, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Top Product Sale for year ' + new Date().getFullYear(),
        data: data,
        borderWidth: 1
      }]
    },
    options: {
        scales: {
        },
        plugins: {
            tooltip: {
                // enabled: false
            },
            datalabels: {
                formatter: (value, context) => {
                    const datapoints = context.chart.data.datasets[0].data;
                    function totalSum(total, dataPoint) {
                        return total + dataPoint;
                    }

                    const percentage = datapoints.reduce(totalSum, 0);
                    const percentageValue = (value / percentage * 100);
                   
                   return percentageValue.toFixed(2) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
  });
             }

        }
   });
    $.ajax({
        url: "/Dashboard/barGraph",
        type: "GET",
        dataType: "json",
        success: (result) => {
           const overview = result.salesOverView.salesGrandAmount;

const allZero = Object.values(overview).every(value => value == 0);

console.log(!allZero);
           const chartContainer = document.getElementById('chartContainer');   
if (!allZero) {
       chartContainer.innerHTML = `<canvas style="height: 100%;" id="chartTest"></canvas>`;
      const ctx = document.getElementById('chartTest');   
  new Chart(ctx, {    type: 'bar',
    data: {
      labels: result.salesOverView.salesYear,
      datasets: [{
        label: 'Sales Overview for year ' + new Date().getFullYear(),
        data: result.salesOverView.salesGrandAmount,
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
else {
      chartContainer.innerHTML= `<h1> No Sales on the whole Year</h1>`;
}

  $("#averageDailySales").text("₱" + result.averageDailySales.toFixed(2));
  $("#peakSaleValue").text("₱" + result.peakSale.peakSaleValue);
    $("#peakSaleYear").text(result.peakSale.peakSaleYear);
    $("#salesToday").text("₱" + result.salesToday);
     $("#todaySalesTop").text("₱" + result.salesToday);
        }
    });
  });
</script>
 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>