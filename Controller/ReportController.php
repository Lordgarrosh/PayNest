<?php


require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/EmployeeAccountInformation.php";
require_once __DIR__ . "/../Users/EmployeeEmploymentInformation.php";
require_once __DIR__ . "/../Users/EmployeePersonalInformation.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";


class ReportController extends EmployeeManagerController {

    public function lineGraph () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
       $currentYear = date("Y");
        $revenueSQL = "SELECT * FROM sales WHERE userID = :userID AND salesDate LIKE :salesDate";
        $revenueSTMT = $this->conn->prepare($revenueSQL);
        $revenueSTMT->bindValue(":userID", $userDatas['userID']);
        $revenueSTMT->bindValue(":salesDate", "%$currentYear%");
        $revenueSTMT->execute();
        $months = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];
   $_SESSION['revenueSaleOverview'] = [
            "revenueValue" => [],
            "revenueYear" => [],
            "totalSellingPrice" => [],
            "salesOriginalPrice" => [],
            "salesTaxAmount" => [],
            "salesGrandAmount" => []
        ];
$revenueMonthValues = array_fill_keys($months, 0);

        while ($row = $revenueSTMT->fetch()) {
               $date = DateTime::createFromFormat("M/d/Y", $row['salesDate']);

    if (!$date) continue;
             $monthIndex = (int)$date->format("n");
    $monthName = $months[$monthIndex - 1];
    $revenueMonthValues[$monthName] += $row['salesGrandAmount'] - ($row['salesOriginalPrice'] + $row['salesTaxAmount']);
        }
              $_SESSION['revenueSaleOverview'] = [
            "revenueYear" => array_keys($revenueMonthValues),
            "revenueValue" => array_values($revenueMonthValues)
        ];
        echo json_encode($_SESSION['revenueSaleOverview']);
    }

    public function revenueSummary() {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $minMaxValuesSQL = "SELECT SUM(salesGrandAmount - (salesOriginalPrice + salesTaxAmount)) AS totalRevenue,
         MAX(salesGrandAmount - (salesOriginalPrice + salesTaxAmount)) AS maxRevenue,
MIN(salesGrandAmount - (salesOriginalPrice + salesTaxAmount)) AS minRevenue
FROM sales WHERE userID = :userID";
        $minMaxValuesSTMT = $this->conn->prepare($minMaxValuesSQL);
        $minMaxValuesSTMT->bindValue(":userID", $userDatas['userID']);
        $minMaxValuesSTMT->execute();
        $_SESSION['revenueSummary'] = $minMaxValuesSTMT->fetch(PDO::FETCH_ASSOC);
        echo json_encode($_SESSION['revenueSummary']);
        
    }

        public function revenueSalesItem () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $revenueSalesItemSQL = "SELECT SUM(
        (salesitem.salesTotalPrice)
        -
        (salesitem.salesTotalPrice * (sales.salesDiscountPercent / 100))
        -
        (inventories.itemCostPrice * salesitem.salesQuantity)
        ) AS salesItemTotalRevenue,
        SUM(salesitem.salesQuantity) AS totalQuantity
        , inventories.itemName, inventories.itemCategory FROM salesitem 
        INNER JOIN sales ON salesitem.salesID = sales.salesID
        INNER JOIN inventories ON salesitem.inventoryID = inventories.inventoryID
        WHERE salesitem.userID = :userID
        GROUP BY salesitem.inventoryID
        ORDER BY totalQuantity DESC
        LIMIT 5;
        ";
        $revenueSalesItemSTMT = $this->conn->prepare($revenueSalesItemSQL);
        $revenueSalesItemSTMT->bindValue(":userID", $userDatas['userID']);
        $revenueSalesItemSTMT->execute();
        $_SESSION['revenueItem'] = $revenueSalesItemSTMT->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($_SESSION['revenueItem']);
    }


    public function revenueSalesCategory () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $revenueSalesCategorySQL = "SELECT SUM(
        (salesitem.salesTotalPrice)
        -
        (salesitem.salesTotalPrice * (sales.salesDiscountPercent / 100))
        -
        (inventories.itemCostPrice * salesitem.salesQuantity)
        ) AS salesCategoryTotalRevenue,
        SUM(salesitem.salesQuantity) AS totalQuantity
        ,  inventories.itemCategory FROM salesitem 
        INNER JOIN sales ON salesitem.salesID = sales.salesID
        INNER JOIN inventories ON salesitem.inventoryID = inventories.inventoryID
        WHERE inventories.userID = :userID
        GROUP BY inventories.itemCategory
        ORDER BY salesCategoryTotalRevenue DESC
        ";
        $revenueSalesCategorySTMT = $this->conn->prepare($revenueSalesCategorySQL);
        $revenueSalesCategorySTMT->bindValue(":userID", $userDatas['userID']);
        $revenueSalesCategorySTMT->execute();
        $_SESSION['revenueSalesCategory'] = $revenueSalesCategorySTMT->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($_SESSION['revenueSalesCategory']);
    }

    public function timelineRevenue () {
        $this->startSession();
        $userDatas = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $date = new DateTime();
        $date->sub(new DateInterval('P1M')); // Subtract 1 day
        $yesterday = $date->format('M/d/Y');
        $today = date("M/d/Y");
                // $timelineSQL = "SELECT SUM(sales.salesGrandAmount - (sales.salesDiscountAmount + sales.salesOriginalPrice)) AS totalSales, AVG(sales.salesGrandAmount - (sales.salesDiscountAmount + sales.salesOriginalPrice)) AS avgsales, sales.salesDate, AVG(salesitem.salesQuantity) FROM sales INNER JOIN salesitem ON sales.salesID = salesitem.salesID WHERE sales.userID = :userID GROUP BY sales.salesDate;";
        $timelineSQL = "SELECT SUM(sales.salesGrandAmount - (sales.salesDiscountAmount + sales.salesOriginalPrice)) AS totalSales, sales.salesDate, AVG(salesitem.salesQuantity) FROM sales INNER JOIN salesitem ON sales.salesID = salesitem.salesID WHERE sales.userID = :userID GROUP BY sales.salesDate;";
        $timelineSTMT = $this->conn->prepare($timelineSQL);
        $timelineSTMT->bindValue(":userID", $userDatas['userID']);
        $timelineSTMT->execute();
        $_SESSION['revenueTimeline'] = [
            "todayTotalRevenue" => 0,
            "todayTotalOrders" => 0,
            "todayAverageOrder" => 0,
            "yesterdayTotalRevenue" => 0,
            "yesterdayTotalOrder" => 0,
            "yesterdayAverageOrders" => 0
        ];
        while ($row = $timelineSTMT->fetch(PDO::FETCH_ASSOC)) {
                if ($row['salesDate'] == $today) {
                    $_SESSION['revenueTimeline']['todayTotalRevenue'] = $row['totalSales'];
                    $_SESSION['revenueTimeline']['todayTotalOrders'] = $row['salesDate'];
                    $_SESSION['revenueTimeline']['todayAverageOrder'] = $row['salesDate'];
                }
                else if ($row['salesDate'] == $yesterday) {
                    $_SESSION['revenueTimeline']['yesterdayTotalRevenue'] = $row['salesDate'];
                    $_SESSION['revenueTimeline']['yesterdayTotalOrder'] = $row['totalSales'];
                    $_SESSION['revenueTimeline']['yesterdayTotalRevenue'] = $row['salesDate'];
                    $_SESSION['revenueTimeline']['yesterdayTotalOrder'] = $row['totalSales'];
                }
        }
        echo json_encode($_SESSION['revenueTimeline']);
    }

}

?>
