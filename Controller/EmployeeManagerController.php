<?php
require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/EmployeeAccountInformation.php";
require_once __DIR__ . "/../Users/EmployeeEmploymentInformation.php";
require_once __DIR__ . "/../Users/EmployeePersonalInformation.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";
class EmployeeManagerController extends Controller {
    protected $conn;
    protected $database;
    protected string $messageReport;
    protected string $formValidation;


    protected function getMessageReport () {
        return $this->messageReport;
    }

    protected function getFormValidation () {
        return $this->formValidation;
    }

    protected function setMessageReport (string $messageReport) {
        $this->messageReport = $messageReport;
    }

    protected function setFormValidation (string $formValidation) {
        $this->formValidation = $formValidation;
    }

    public function userCurrentPage (string $currentPage) {
        $userSubscription = $this->fetchUserSubscription();
          $this->startSession();
          
        if (!isset($_SESSION['loginInfo'])) {
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
          
        if (!isset($_SESSION['loginInfo'])) {
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
             $userDatas = $this->userProfile();
            if (isset($_GET['page'])) {
                if ($_GET['page'] != 1) {
                    $startTable = ($_GET['page'] - 1) * 5;
                }
            }
            $endPage = $startTable;
          
            $countInventoriesQuery = "SELECT COUNT(*) FROM inventories WHERE itemCategory LIKE :itemCategory AND itemName LIKE :itemName AND userID = :userID ";
            $countInventorySTMT = $this->conn->prepare($countInventoriesQuery);
            $countInventorySTMT->bindValue(":itemCategory", "%$categoryChosen%");
            $countInventorySTMT->bindValue(":itemName", "%$inventoryItemSearch%");
            $countInventorySTMT->bindValue(":userID", $userDatas['userID']);
            $countInventorySTMT->execute();
            $totalInventories = $countInventorySTMT->fetchColumn();
            //  echo "<script>alert('$totalInventories')</script>";
            $paginationCount = $totalInventories / 5;
            $paginationCount = ceil($paginationCount);
           
            $sqlCategories = "SELECT * FROM categories";
            $inventoryCategories = $this->conn->query($sqlCategories);
            $sqlInventories = "SELECT inventoryID, itemName, itemCategory, itemQuantity, itemReorderLevel, itemSellingPrice, inventoryItemImage FROM inventories WHERE itemCategory LIKE :itemCategory AND itemName LIKE :itemName AND userID = :userID LIMIT :startTable, 5";
            $inventorySTMT = $this->conn->prepare($sqlInventories);
            $inventorySTMT->bindValue(":itemCategory", "%$categoryChosen%");
            $inventorySTMT->bindValue(':startTable', $startTable, PDO::PARAM_INT);
            $inventorySTMT->bindValue(":itemName", "%$inventoryItemSearch%");
            $inventorySTMT->bindValue(":userID", $userDatas['userID']);
            $inventorySTMT->execute();
            $productInventories = $inventorySTMT->fetchAll(PDO::FETCH_ASSOC);
                 if (!isset($_SESSION['loginInfo'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
           
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
            
                 if (!isset($_SESSION['loginInfo'])) {
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
            $inventoryCategories = $this->conn->query($sqlCategories);
             $userDatas = $this->userProfile();
        $this->setFormValidation("Not Validated");
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addInventory'])) {
            
            $this->startSession();
            $itemName = $_POST['itemName'];
            $itemCategory = $_POST['itemCategory'];
            $itemBarcode = $_POST['itemBarcode'];
            $itemQuantity = $_POST['itemQuantity'] ?? 0;
            $itemReorderLevel = $_POST['itemReorderLevel'];
            $itemExpirationDate = $_POST['itemExpirationDate'];
            $itemCostPrice = $_POST['itemCostPrice'];
            $itemSellingPrice = $_POST['itemSellingPrice'];

     
           if (empty($itemName) || empty($itemCategory) || empty($itemBarcode) ||  empty($itemReorderLevel) || empty($itemExpirationDate)
            || empty($itemCostPrice) || empty($itemSellingPrice)) {
                $this->setMessageReport("Please fill all the input fields");
           }
           else if ($itemQuantity < 0) {
                $this->setMessageReport("The Item quantity cannot be lower than zero");
           }
           else if ($itemReorderLevel <= 0) {
                $this->setMessageReport("The Item reorder level must not be empty or lower than zero ");
           }
           else if ($itemCostPrice >= $itemSellingPrice) {
                $this->setMessageReport("The item cost price must be higher than the selling price");
           }
           else {
                        	$img_name = $_FILES['inventoryItemPic']['name'];       //getting image name
			$img_typ = $_FILES['inventoryItemPic']['type'];            //getting image name
			$tmp_name = $_FILES['inventoryItemPic']['tmp_name'];   //set temporary name
			$img_explode = explode('.', $img_name);   // let's Explode Image
			$img_extension = end($img_explode);
			$extensions = ['png', 'jpeg', 'jpg'];       //these are some valid extensions
      $time = time();
      $inventoryPic = $time . $img_name;
      echo "<script>alert('$tmp_name')</script>";
             if (move_uploaded_file($tmp_name,__DIR__ . "/../InventoryPic/" . $inventoryPic)) {
                $inventorySaveProductSQL = "INSERT INTO inventories (itemName, itemCategory, itemBarcode, itemQuantity, itemReorderLevel, itemExpirationDate, itemCostPrice, itemSellingPrice, inventoryItemImage, userID) VALUES
                (:itemName, :itemCategory, :itemBarcode, :itemQuantity, :itemReorderLevel, :itemExpirationDate, :itemCostPrice, :itemSellingPrice, :inventoryItemImage, :userID)";
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
                $stmt->bindValue(":inventoryItemImage", $inventoryPic); 
                $stmt->bindValue(":userID", $userDatas['userID']);
                $stmt->execute();
                $this->setMessageReport("Product $itemName successfully added to inventory");
                $this->setFormValidation("Validated");
             }
             else {
                $this->setMessageReport("Image not Uploaded");
             }
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
           $data = [
                "userDatas" => $userDatas
            ];
        $this->view("/EmployeeManager/Employees/employeeAttendance", $data);
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
            $attendanceQuery = "INSERT INTO employeeAttendance (timein, timeout, attendanceStatus, userID) VALUES (:timeIn, :timeOut, :employeeAttendance)";
            echo "Employee ID $employeeID\n";
            echo "timein $timeIn\n";
            echo "timeOut $timeOut";
        }
    }

    public function addEmployeeData () {
             $this->startSession();
         $this->database = new Database();
        $this->conn = $this->database->connect();
             $userDatas = $this->userProfile();
        $this->setFormValidation("Not Validated");
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addEmployee'])) {
                //personal information
                $personalInformation = new EmployeePersonalInformation(
                   firstName: $_POST['firstName'],
                  middleName:  $_POST['middleName'],
                  lastName:  $_POST['lastName'],
                  birthDate:  $_POST['birthdate'],
                  civilStatus:  $_POST['civilStatus'],
                  gender:  $_POST['gender'],
                  phoneNumb:  $_POST['phoneNumb'],
                  email:  $_POST['email'],
                   address: $_POST['address']
                );
               

                //employment information
                $employmentInformation = new EmployeeEmploymentInformation(
                    employeePosition: $_POST['employmentPosition'],
                    workStatus: $_POST['workStatus'],
                    employmentType: $_POST['employmentType'],
                    sssNumber: $_POST['sssNumber'],
                    philHealthNumber: $_POST['philhealthNumber'],
                    pagIbigNumber: $_POST['pagIbigNumber'],
                    tinNumber: $_POST['tinNumber']
                );

                
                //account information
                $accountInformation = new EmployeeAccountInformation(
                    username: $_POST['username'],
                    password: $_POST['password']
                );
                $confirmPassword = $_POST['confirmPassword'];

                

                if (empty($_POST['firstName']) || empty($_POST['middleName']) || empty($_POST['lastName']) || empty($_POST['birthdate']) || 
                empty($_POST['civilStatus']) || empty($_POST['gender']) || empty($_POST['phoneNumb']) || empty($_POST['email']) || empty($_POST['address'])) {
                    // echo "<script>alert('personal')</script>";
                    
                    // echo "<p>fname " . $personalInformation->getFirstName() . "<p><break>";
                    // echo "<p>mname " . $personalInformation->getMiddleName() . "<p><break>";
                    // echo "<p>lname " . $personalInformation->getLastName() . "<p><break>";
                    // echo "<p>bday " . $personalInformation->getBirthDate() . "<p><break>";
                    // echo "<p>civilstatus " . $personalInformation->getCivilStatus() . "<p><break>";
                    // echo "<p>gender " . $personalInformation->getGender() . "<p><break>";
                    // echo "<p>phone " . $personalInformation->getPhoneNumb() . "<p><break>";
                    // echo "<p>email " . $personalInformation->getEmail() . "<p><break>";
                    // echo "<p>address " . $personalInformation->getAddress() . "<p><break>";
                    $this->setMessageReport("Please fill up the employee personal information");
                }
                else if (empty($_POST['employmentPosition']) || empty($_POST['workStatus']) || empty($_POST['employmentType']) || empty($_POST['sssNumber']) ||
                 empty($_POST['philhealthNumber']) || empty($_POST['pagIbigNumber']) || empty($_POST['tinNumber'])) {
                    //  $_POST['employmentPosition'],
                    // workStatus: $_POST['workStatus'],
                    // employmentType: $_POST['employmentType'],
                    // sssNumber: $_POST['sssNumber'],
                    // philHealthNumber: $_POST['philhealthNumber'],
                    // pagIbigNumber: $_POST['pagIbigNumber'],
                    // tinNumber: $_POST['tinNumber']
                    // echo "<script>alert('employment')</script>";
                    // echo "<p>position " . $employmentInformation->getEmployeePosition() . "<p><break>";
                    // echo "<p>workstatus " . $employmentInformation->getWorkStatus() . "<p><break>";
                    // echo "<p>employmenttype " . $employmentInformation->getEmploymentType() . "<p><break>";
                    // echo "<p>sssnumber " . $employmentInformation->getSSSNumber() . "<p><break>";
                    // echo "<p>philhealth " . $employmentInformation->getPhilHealthNumber() . "<p><break>";
                    // echo "<p>pagibig " . $employmentInformation->getPagIbigNumber() . "<p><break>";
                    // echo "<p>tin " . $employmentInformation->getTinNumber() . "<p><break>";
                    $this->setMessageReport("Please fill up the employee employment information");
                }
                else if (empty($_POST['username']) || empty($_POST['password'])) {
                    //   echo "<p>username " . $accountInformation->getUsername() . "<p><break>";
                    // echo "<p>password " . $accountInformation->getPassword() . "<p><break>";
                    $this->setMessageReport("Please fill up the employee account information");
                }
                else if ($_POST['password'] != $_POST['confirmPassword']) {
                    $this->setMessageReport("The password and confirm password does not match");
                }
                else {
                //save employee personal information
                $this->setMessageReport("Added Employee Successfully");
                $this->setFormValidation("Validated");
                $personalInformationSQL = "INSERT INTO employeepersonalinformation 
                (firstName, middleName, lastName, birthDate, civilStatus, gender, phoneNumb, email, address) VALUES
                (:firstName, :middleName, :lastName, :birthDate, :civilStatus, :gender, :phoneNumb, :email, :address)";
                $personalInformationSTMT = $this->conn->prepare($personalInformationSQL);
                $personalInformationSTMT->bindValue(":firstName", $personalInformation->getFirstName());
                $personalInformationSTMT->bindValue(":middleName", $personalInformation->getMiddleName());
                $personalInformationSTMT->bindValue(":lastName", $personalInformation->getLastName());
                $personalInformationSTMT->bindValue(":birthDate", $personalInformation->getBirthDate());
                $personalInformationSTMT->bindValue(":civilStatus", $personalInformation->getCivilStatus());
                $personalInformationSTMT->bindValue(":gender", $personalInformation->getGender());
                $personalInformationSTMT->bindValue(":phoneNumb", $personalInformation->getPhoneNumb());
                $personalInformationSTMT->bindValue(":email", $personalInformation->getEmail());
                $personalInformationSTMT->bindValue(":address", $personalInformation->getAddress());
                $personalInformationSTMT->execute();
               $personalInformationID = $this->conn->lastInsertID();
                // $personalInformationSTMT->last
                


                
                //save employee employment information
                $employmentInformationSQL = "INSERT INTO employeeemploymentinformation 
                (employeePosition, workStatus, employmentType, sssNumber, philHealthNumber, pagIbigNumber, tinNumber) VALUES
                (:employeePosition, :workStatus, :employmentType, :sssNumber, :philHealthNumber, :pagIbigNumber, :tinNumber)";
                $employmentInformationSTMT = $this->conn->prepare($employmentInformationSQL);
                $employmentInformationSTMT->bindValue(":employeePosition", $employmentInformation->getEmployeePosition());
                $employmentInformationSTMT->bindValue(":workStatus", $employmentInformation->getWorkStatus());
                $employmentInformationSTMT->bindValue(":employmentType", $employmentInformation->getEmploymentType());
                $employmentInformationSTMT->bindValue(":sssNumber", $employmentInformation->getSSSNumber());
                $employmentInformationSTMT->bindValue(":philHealthNumber", $employmentInformation->getPhilHealthNumber());
                $employmentInformationSTMT->bindValue(":pagIbigNumber", $employmentInformation->getPagIbigNumber());
                $employmentInformationSTMT->bindValue(":tinNumber", $employmentInformation->getTinNumber());
                $employmentInformationSTMT->execute();
               $employmentInformationID = $this->conn->lastInsertId();


                //save employee account information 
                $accountInformationSQL = "INSERT INTO employeeaccountinformation (username, password) VALUES (:username, :password);"; 
                $accountInformationSQL = $this->conn->prepare($accountInformationSQL);
                $accountInformationSQL->bindValue(":username", $accountInformation->getUsername());
                $accountInformationSQL->bindValue(":password", $accountInformation->getPassword());
                $accountInformationSQL->execute();               
                $accountInformationID = $this->conn->lastInsertId();



                //save employee information using the last ids of the newly created employee
                $employeeSQL = "INSERT INTO employee (personalInformationID, employmentInformationID, accountInformationID, userID) 
                VALUES (:personalInformationID, :employmentInformationID, :accountInformationID, :userID)";
                $employeeSTMT = $this->conn->prepare($employeeSQL);
                $employeeSTMT->bindValue(":personalInformationID", $personalInformationID);
                $employeeSTMT->bindValue(":employmentInformationID", $employmentInformationID);
                $employeeSTMT->bindValue(":accountInformationID", $accountInformationID);
                $employeeSTMT->bindValue(":userID", $userDatas['userID']);
                $employeeSTMT->execute();
                }
            }
            $this->view("/EmployeeManager/Employees/addEmployee", [
                "userDatas" => $userDatas,
                "messageReport" => $this->getMessageReport(),
                "userValidation" => $this->getFormValidation()
            ]);
    }

    protected function fetchUserSubscription () {
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



protected function userProfile()
{
    $this->startSession();

    if (!isset($_SESSION['loginInfo'])) {
        return null;
    }

    $userInfo = $_SESSION['loginInfo'];

    $email = $userInfo['email'];

    $this->database = new Database();
    $this->conn = $this->database->connect();

    $query = "SELECT * FROM userinfo WHERE Email = :email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        return null;
    }

    // NORMAL LOGIN
    if (
        isset($userInfo['password']) &&
        !empty($userData['Password']) &&
        password_verify($userInfo['password'], $userData['Password'])
    ) {
        return $this->buildUserProfile($userData);
    }

    // GOOGLE LOGIN
    if (
        isset($userData['google_id']) &&
        !empty($userData['google_id']) &&
        $userInfo['password'] == $userData['google_id']
    ) {
        return $this->buildUserProfile($userData);
    }

    return null;
}

public function logout () {
    $this->startSession();
    session_unset();
    session_destroy();
    $this->redirect("/login");
}

private function buildUserProfile($userData)
{
    return [
        "userID" => $userData['userID'],
        "email" => $userData['Email'],
        "google_id" => $userData['google_id'],
        "fname" => $userData['FirstName'],
        "mname" => $userData['MiddleName'],
        "lname" => $userData['LastName'],
        "profPic" => $userData['ProfPic'],
        "number" => $userData['Number'],
        "registerType" => $userData['registerType']
    ];
}




}
?>