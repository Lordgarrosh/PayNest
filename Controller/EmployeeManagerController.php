<?php
require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";
class EmployeeManagerController extends Controller {
    private $conn;
    private $database;
    private string $messageReport;
    private string $formValidation;


    public function getMessageReport () {
        return $this->messageReport;
    }

    public function getFormValidation () {
        return $this->formValidation;
    }

    public function setMessageReport (string $messageReport) {
        $this->messageReport = $messageReport;
    }

    public function setFormValidation (string $formValidation) {
        $this->formValidation = $formValidation;
    }

    public function userCurrentPage ($currentPage) {
        $userSubscription = $this->fetchUserSubscription();
          $this->startSession();
          
        if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
            $data = [
                "userDatas" => $userDatas
            ];
        $this->view("/EmployeeManager/$currentPage", $data);
        }
        else {
            $this->redirect("/EmployeeManager/subscriptionPlan");
        }
    }



    public function subscriptionPlan () {
              $userSubscription = $this->fetchUserSubscription();
          $this->startSession();
          
        if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
            $data = [
                "userDatas" => $userDatas
            ];
        $this->view("/EmployeeManager/Dashboard/dashboard", $data);
        }
        else {
        $this->view("/EmployeeManager/Dashboard/subscriptionPlan");
        }
    }

    public function inventoryForm () {
    $userSubscription = $this->fetchUserSubscription();
          $this->startSession();
         $this->database = new Database();
        $this->conn = $this->database->connect();
            $categoryChosen = $_GET['category'] ?? '';
            $inventoryItemSearch = $_GET['search'] ?? '';
            $startTable = 0;
            $startPage = isset($_GET['page']) ? (int)$_GET['page']: 1;
            if (isset($_GET['page'])) {
                if ($_GET['page'] != 1) {
                    $startTable = ($_GET['page'] - 1) * 5;
                }
            }
            $endPage = $startTable;
          
            $countInventoriesQuery = "SELECT COUNT(*) FROM inventories WHERE itemCategory LIKE :itemCategory AND itemName LIKE :itemName ";
            $countInventorySTMT = $this->conn->prepare($countInventoriesQuery);
            $countInventorySTMT->bindValue(":itemCategory", "%$categoryChosen%");
            $countInventorySTMT->bindValue(":itemName", "%$inventoryItemSearch%");
            $countInventorySTMT->execute();
            $totalInventories = $countInventorySTMT->fetchColumn();
            //  echo "<script>alert('$totalInventories')</script>";
            $paginationCount = $totalInventories / 5;
            $paginationCount = ceil($paginationCount);
           
            $sqlCategories = "SELECT * FROM categories";
            $inventoryCategories = $this->conn->query($sqlCategories);
            $sqlInventories = "SELECT inventoryID, itemName, itemCategory, itemQuantity, itemSellingPrice FROM inventories WHERE itemCategory LIKE :itemCategory AND itemName LIKE :itemName LIMIT :startTable, 5";
            $inventorySTMT = $this->conn->prepare($sqlInventories);
            $inventorySTMT->bindValue(":itemCategory", "%$categoryChosen%");
            $inventorySTMT->bindValue(':startTable', $startTable, PDO::PARAM_INT);
            $inventorySTMT->bindValue(":itemName", "%$inventoryItemSearch%");
            $inventorySTMT->execute();
            $productInventories = $inventorySTMT->fetchAll(PDO::FETCH_ASSOC);
                 if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
            $data = [
                "userDatas" => $userDatas,
                "categories" => $inventoryCategories,
                "inventoryCategories" => $productInventories,
                "paginationCount" => $paginationCount,
                "totalInventories" => $totalInventories,
                "currentPage" => $startTable + 1,
                "endPage" => $endPage,
                "categoryChosen" => $categoryChosen,
                "inventoryItemSearch" => $inventoryItemSearch
            ];
        $this->view("/EmployeeManager/inventories/inventory", $data);
        }
        else {
            $this->redirect("/EmployeeManager/subscriptionPlan");
        }
    }

    public function addInventoryForm () {
        $userSubscription = $this->fetchUserSubscription();
          $this->startSession();
         $this->database = new Database();
        $this->conn = $this->database->connect();

            $sqlCategories = "SELECT * FROM categories";
            $inventoryCategories = $this->conn->query($sqlCategories);
            
                 if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
            $data = [
                "userDatas" => $userDatas,
                "categories" => $inventoryCategories
            ];
        $this->view("/EmployeeManager/inventories/addInventory", $data);
        }
        else {
            $this->redirect("/EmployeeManager/subscriptionPlan");
        }

    }

    public function addInventory () {
          $this->startSession();
         $this->database = new Database();
        $this->conn = $this->database->connect();
            $sqlCategories = "SELECT * FROM categories";
            $inventoryCategories = $this->conn->prepare($sqlCategories);
             $userDatas = $this->userProfile();
        $this->setFormValidation("Not Validated");
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addInventory'])) {
            
            $this->startSession();
            $itemName = $_POST['itemName'];
            $itemCategory = $_POST['itemCategory'];
            $itemBarcode = $_POST['itemBarcode'];
            $itemQuantity = $_POST['itemQuantity'];
            $itemReorderLevel = $_POST['itemReorderLevel'];
            $itemExpirationDate = $_POST['itemExpirationDate'];
            $itemCostPrice = $_POST['itemCostPrice'];
            $itemSellingPrice = $_POST['itemSellingPrice'];
           if (empty($itemName) || empty($itemCategory) || empty($itemBarcode) || empty($itemQuantity) || empty($itemReorderLevel) || empty($itemExpirationDate)
            || empty($itemCostPrice) || empty($itemSellingPrice)) {
                $this->setMessageReport("Please fill all the input fields");
           }
           else if ($itemQuantity <= $itemReorderLevel) {
                $this->setMessageReport("The Item quantity is lower than the item reorder level");
           }
           else if ($itemCostPrice >= $itemSellingPrice) {
                $this->setMessageReport("The item cost price must be higher than the selling price");
           }
           else {
                $inventorySaveProductSQL = "INSERT INTO inventories (itemName, itemCategory, itemBarcode, itemQuantity, itemReorderLevel, itemExpirationDate, itemCostPrice, itemSellingPrice) VALUES
                (:itemName, :itemCategory, :itemBarcode, :itemQuantity, :itemReorderLevel, :itemExpirationDate, :itemCostPrice, :itemSellingPrice)";
                $this->database = new Database();
                $this->conn = $this->database->connect();
                $stmt = $this->conn->prepare($inventorySaveProductSQL);
                $stmt->bindValue(":itemName", $itemName);
                $stmt->bindValue(":itemCategory", $itemCategory);
                $stmt->bindValue(":itemBarcode", $itemBarcode);
                $stmt->bindValue(":itemQuantity", $itemQuantity);
                $stmt->bindValue(":itemReorderLevel", $itemReorderLevel);
                $stmt->bindValue(":itemExpirationDate", $itemExpirationDate);
                $stmt->bindValue(":itemCostPrice", $itemCostPrice);
                $stmt->bindValue(":itemSellingPrice", $itemSellingPrice);
                $stmt->execute();
                $this->setMessageReport("Product $itemName successfully added to inventory");
                $this->setFormValidation("Validated");
           }
        }
        $this->view("/EmployeeManager/Inventories/addInventory", [
            "messageReport" => $this->getMessageReport(),
            "userDatas" => $userDatas,
            "categories" => $inventoryCategories,
            "formValidation" => $this->getFormValidation()
        ]);
    }

    public function employeeAttendancePage() {
        
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/employeeAttendance", $userDatas);
    }

    public function addEmployeeForm () {
        $userDatas = $this->userProfile();
        $this->view("/EmployeeManager/addEmployee", $userDatas);
    }


 
    
    public function addAttendance () {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAttendance'])) {
            $employeeID = $_POST['employeeID'];
            $timeIn = $_POST['timeIn'];
            $timeOut = $_POST['timeOut'];
            $employeeAttendance = $_POST['attendanceStatus'];
            $this->startSession();
            $this->database = new Database();
            $this->conn = $this->database->connect();
            $attendanceQuery = "INSERT INTO employeeAttendance (timein, timeout, attendanceStatus, userSubscriptionID) VALUES (:timeIn, :timeOut, :employeeAttendance)";
            echo "Employee ID $employeeID\n";
            echo "timein $timeIn\n";
            echo "timeOut $timeOut";
        }
    }

    public function addEmployeeData () {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitBtn'])) {
            
            $employeeName = $_POST['employeeName'];
            $tin = $_POST['tin'];
            $sss = $_POST['sss'];
            $philHealth = $_POST['philHealth'];
            $pagIbig = $_POST['pagIbig'];
            $salaryType = $_POST['salaryType'] ?? null;
            $salaryAmount = $_POST['salaryAmount'];
            if (empty($employeeName) || empty($tin) || empty($sss) || empty($philHealth) || empty($pagIbig) || empty($salaryType) || empty($salaryAmount)) {
              $this->view("/EmployeeManager/addEmployee", [
                "userValidation" => "Not Validated",
                    "messageReport" => "Please input all the input fields"
              ]);
        
            }
            else {
                 $this->startSession();
            $userSubscription = $this->fetchUserSubscription();
            $this->database = new Database();
            $this->conn = $this->database->connect();
            $employeeQuery = "INSERT INTO employee (employeeName, tin, sss, philHealth, pagIbig, salaryType, salaryAmount,  userSubscriptionID) VALUES 
            (:employeeName, :tin, :sss, :philHealth, :pagIbig, :salaryType, :salaryAmount, :userSubscriptionID)";
            $stmt = $this->conn->prepare($employeeQuery);
            $stmt->bindValue(":employeeName", $employeeName);
            $stmt->bindValue(":tin", $tin);
            $stmt->bindValue(":sss", $sss);
            $stmt->bindValue(":philHealth", $philHealth);
            $stmt->bindValue(":pagIbig", $pagIbig);
            $stmt->bindValue(":salaryType", $salaryType);
            $stmt->bindValue(":salaryAmount", $salaryAmount);
            $stmt->bindValue(":userSubscriptionID", $userSubscription['userSubscriptionID']);
            $stmt->execute();   
             $this->view("/EmployeeManager/addEmployee", [
                    "userValidation" => "Validated",
                    "messageReport" => "Employee Added Successfully"
              ]);
            }

            
        }
   
    }

    private function fetchUserSubscription () {
        $userData = $this->userProfile();
        $this->database = new Database();
        $this->conn = $this->database->connect();
        $userQuery = "SELECT userSubscriptionID, userID, subscriptionPlan FROM userSubscription WHERE userID = :userID";
        $stmt = $this->conn->prepare($userQuery);
        $stmt->bindValue(":userID", $userData['userID']);
        $stmt->execute();
        $userSubscriptionData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userSubscriptionData) 
            return [
                "userSubscriptionID" => $userSubscriptionData['userSubscriptionID'],
                "subscriptionPlan" =>  $userSubscriptionData['subscriptionPlan'],
                "userID" => $userSubscriptionData['userID'],
            ];
        else return null;
    }

    public function chooseSubscriptionPlan () {
      
                       if (isset($_POST['subscriptionPlan'])) {
                        $this->startSession();
  $subscriptionPlan =  $_SESSION['subscriptionPlan'] = $_POST['subscriptionPlan'];
  $subscriptionPeriod = $_SESSION['subscriptionPeriod'] = $_POST['subscriptionPeriod'];
    $this->database = new Database();
$this->conn =  $this->database->connect();
$userData = $this->userProfile();

$subscriptionQuery = "INSERT INTO usersubscription (subscriptionPlan, subscriptionPeriod, userID) VALUES (:subscriptionPlan, :subscriptionPeriod, :userID)";
$stmt = $this->conn->prepare($subscriptionQuery);
$stmt->bindValue(":subscriptionPlan", $subscriptionPlan);
$stmt->bindValue(":subscriptionPeriod", $subscriptionPeriod);
$stmt->bindValue(":userID", $userData['userID']);
$stmt->execute();
    echo json_encode(["status" => "success"]);
}
    }


private function userProfile () {
        $users = new Users();
         $this->startSession();
           $email = $_SESSION['email'];
        $password = $_SESSION['password'];
          $this->database = new Database();
$this->conn =  $this->database->connect();
$userQuery = "SELECT * FROM userinfo WHERE email = :email AND password = :password";
$stmt = $this->conn->prepare($userQuery);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":password", $password);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
if ($userData) {
       $userID = $userData['userID'];
       $fname = $userData['FirstName'];
       $mname = $userData['MiddleName'];
       $lname = $userData['LastName'];
       $profPic = $userData['ProfPic'];
       $number = $userData['Number'];
       return [
        "userID" => $userID,
        "email" => $email,
        "fname" => $fname,
        "mname" => $mname,
        "lname" => $lname,
        "profPic" => $profPic,
        "number" => $number
       ];
}
else {
    return null;
}

}

}
?>