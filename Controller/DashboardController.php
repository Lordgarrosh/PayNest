<?php

require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/EmployeeAccountInformation.php";
require_once __DIR__ . "/../Users/EmployeeEmploymentInformation.php";
require_once __DIR__ . "/../Users/EmployeePersonalInformation.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";

class DashboardController extends EmployeeManagerController {
    
    public function salesBarGraph () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $currentYear = date("Y");
        $salesSQL = "SELECT * FROM sales WHERE userID = :userID AND salesDate LIKE :salesDate ORDER BY salesGrandAmount";
        $salesSTMT = $this->conn->prepare($salesSQL);
        $salesSTMT->bindValue(":userID", $userDatas['userID']);
        $salesSTMT->bindValue(":salesDate", "%$currentYear%");
        $salesSTMT->execute();
          $_SESSION['salesReportOverview'] = [
            "salesYear" => [],
            "salesGrandAmount" => []
        ];
        $_SESSION['averageDailySales'] = 0;
        $_SESSION['peakSale'] = [
            "peakSaleValue" => 0,
            "peakSaleYear" => ""
        ];
        $_SESSION['salesToday'] = 0;
        $totalSales = 0; 
        $dateToday = date("M/d/Y");
        $months = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];
$salesMonthValues = array_fill_keys($months, 0);
        while ($row = $salesSTMT->fetch(PDO::FETCH_ASSOC)) {
                 $date = DateTime::createFromFormat("M/d/Y", $row['salesDate']);

    if (!$date) continue; // skip invalid dates

    $monthIndex = (int)$date->format("n");
    $monthName = $months[$monthIndex - 1];
      $amount = (float)$row['salesGrandAmount'];
             if ($dateToday == $row['salesDate']) {
                $_SESSION['salesToday'] += $row['salesGrandAmount']; 
             }
             $salesMonthValues[$monthName] += $row['salesGrandAmount'];
              $_SESSION['averageDailySales'] += $row['salesGrandAmount'];
              $totalSales++;
              $_SESSION['peakSale']["peakSaleValue"] = $row['salesGrandAmount'];
              $_SESSION['peakSale']["peakSaleYear"] = $row['salesDate'];
        }
 $_SESSION['salesReportOverview'] = [
    "salesYear" => array_keys($salesMonthValues),
    "salesGrandAmount" => array_values($salesMonthValues)
];
        $_SESSION['averageDailySales'] /= $totalSales;
        echo json_encode([
                "salesOverView" => $_SESSION['salesReportOverview'],
                "averageDailySales" => $_SESSION['averageDailySales'],
                "peakSale" => $_SESSION['peakSale'],
                "salesToday" => $_SESSION['salesToday']
        ]);
    }

    public function salesPieGraph () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $productSQL = "SELECT 
    inventories.itemName,
    SUM(salesitem.salesTotalPrice) AS totalSales
FROM salesitem
INNER JOIN inventories 
    ON salesitem.inventoryID = inventories.inventoryID
    WHERE salesitem.userID = :userID
GROUP BY inventories.itemName
ORDER BY totalSales DESC
LIMIT 5;";
    $productSTMT = $this->conn->prepare($productSQL);
    $productSTMT->bindValue(":userID", $userDatas['userID']);
    $productSTMT->execute();
    $_SESSION['topProducts'] = $productSTMT->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($_SESSION['topProducts']);
    }


    public function revenueSalesItem () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->conn->connect();
        $revenueSalesItemSQL = "SELECT SUM(
        (salesitem.salesTotalPrice)
        -
        (salesitem.salesTotalPrice * (sales.salesDiscountPercent / 100))
        -
        (inventories.itemCostPrice * salesitem.salesQuantity)
        ) AS salesItemTotalRevenue
        , inventories.itemName FROM salesitem 
        INNER JOIN sales ON salesitem.salesID = sales.salesID
        INNER JOIN inventories ON salesitem.inventoryID = inventories.inventoryID
        WHERE userID = :userID
        GROUP BY salesitem.salesID, salesitem.inventoryID
        ORDER BY salesItemTotalRevenue DESC
        LIMIT 5;
        ";
        $revenueSalesItemSTMT = $this->conn->prepare($revenueSalesItemSQL);
        $revenueSalesItemSTMT->bindValue(":userID", $userDatas['userID']);
        $revenueSalesItemSTMT->execute();
        $_SESSION['revenueItem'] = $revenueSalesItem->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($_SESSION['revenueItem']);
    }


}

?>
