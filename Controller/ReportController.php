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

}

?>