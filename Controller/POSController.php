<?php
require_once 'Controller.php';
require_once __DIR__ . "/../Users/Users.php";
require_once __DIR__ . "/../Users/EmployeeAccountInformation.php";
require_once __DIR__ . "/../Users/EmployeeEmploymentInformation.php";
require_once __DIR__ . "/../Users/EmployeePersonalInformation.php";
require_once __DIR__ . "/../Users/Employee.php";
require_once __DIR__ . "/../Users/UserSubscription.php";
require_once __DIR__ . "/../Model/Database.php";
class POSController extends EmployeeManagerController {
    public function posSystem () {
                $userSubscription = $this->fetchUserSubscription();
                 $userDatas = $this->userProfile();
          $this->startSession();
           $this->database = new Database();
        $this->conn = $this->database->connect();
          $sqlCategories = "SELECT * FROM categories";
            $inventoryCategories = $this->conn->query($sqlCategories);
            $itemName = $_GET['itemName'] ?? '';
            $itemCategory = $_GET['itemCategory'] ?? '';
            $sqlProducts = "SELECT * FROM inventories WHERE itemName LIKE :itemName AND itemCategory LIKE :itemCategory AND itemQuantity > 0 AND userID = :userID";
            $productSTMT = $this->conn->prepare($sqlProducts);
            $productSTMT->bindValue(":itemName", "%$itemName%");
            $productSTMT->bindValue(":itemCategory", "%$itemCategory%");
            $productSTMT->bindValue(":userID", $userDatas['userID']);
            $productSTMT->execute();
            $productItems = $productSTMT->fetchAll(PDO::FETCH_ASSOC);
 
        if (!isset($_SESSION['loginInfo'])) {
           $this->redirect("/login");
        }
        else if ($userSubscription !== null) {
            $userDatas = $this->userProfile();
            $data = [
                "userDatas" => $userDatas,
                "categories" => $inventoryCategories,
                "productItems" => $productItems
            ];
        $this->view("/EmployeeManager/POS/pos", $data);
        }
        else {
            $this->redirect("/EmployeeManager/subscriptionPlan");
        }
    }


    public function loadMoreItem () {
    if (isset($_GET['limit']) && isset($_GET['start'])) {

        $limit = (int) $_GET['limit'];
        $start = (int) $_GET['start'];
        $userDatas = $this->userProfile();
        $categoryChosen = $_GET['category'] ?? '';
        $searchItem = $_GET['findItem'] ?? '';
        $this->database = new Database();
        $this->conn = $this->database->connect();
        
        $sqlLoadItem = "SELECT * FROM inventories WHERE itemCategory LIKE :itemCategory AND itemName LIKE :itemName AND itemQuantity > 0 AND userID = :userID LIMIT :start, :limit";
        $stmt = $this->conn->prepare($sqlLoadItem);

        // ✅ VERY IMPORTANT
        $stmt->bindValue(":start", $start, PDO::PARAM_INT);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":itemCategory", "%$categoryChosen%");
        $stmt->bindValue(":itemName", "%$searchItem%");
        $stmt->bindValue(":userID", $userDatas['userID']);
        $stmt->execute();
        $productItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($productItems);
    }
}

public function getCart () {
    $this->startSession();
    $userDatas = $this->userProfile();
    $discountPrice = $_SESSION['discountPercentage'] ?? 0.0;
               $lowStockCountSQL = "SELECT COUNT(CASE WHEN itemQuantity <= itemReorderLevel THEN 1 END) AS lowStocks FROM inventories WHERE userID = :userID";
            $lowStockCountSTMT = $this->conn->prepare($lowStockCountSQL);
            $lowStockCountSTMT->bindValue(":userID", $userDatas['userID']);
            $lowStockCountSTMT->execute();
           $_SESSION['stockWarning'] = $lowStockCountSTMT->fetch(PDO::FETCH_ASSOC)['lowStocks'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $calculatePrice = $this->calculatePOS($discountPrice);
    echo json_encode([
        "cart" => $_SESSION['cart'],
        "priceList" => $calculatePrice,
        "stockWarning" => $_SESSION['stockWarning']
    ]);
}



public function updateCart() {
     $this->startSession();
    $inventoryID = $_POST['productID'] ?? null;
    $userAction = $_POST['action'];
$changeValue = $_POST['changeValue'] ?? 0;
$discountprice = $_SESSION['discountPercentage'] ?? 0;
   
 $productFound = $this->findInventoryItemByID($inventoryID);

if (!$productFound) {
    echo json_encode([
        "error" => "Product not found"
    ]);
    return;
}
$maxStock = $productFound['itemQuantity'];
$currentQty = $_SESSION['cart'][$inventoryID]['itemCurrentQuantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // CLEAR CART
     if ($userAction === "deleteCart") {
        $_SESSION['cart'] = [];
        $calculatePrice = $this->calculatePOS($discountprice);
        echo json_encode([
            "cart" => $_SESSION['cart'],
            "priceList" => $calculatePrice
        ]);
        return;
    }

    if (!isset($_SESSION['cart'][$inventoryID])) {
        $calculatePrice = $this->calculatePOS($discountprice);
        echo json_encode([
            "cart" => $_SESSION['cart'],
            "priceList" => $calculatePrice
        ]);
        return;
    }

    if ($userAction == "addCartQuantity") {
            if ($currentQty < $maxStock) {
        $_SESSION['cart'][$inventoryID]['itemCurrentQuantity']++;
    }
    }
    else if ($userAction == "subtractCartQuantity") {
        $_SESSION['cart'][$inventoryID]['itemCurrentQuantity']--;

        // remove if 0
        if ($_SESSION['cart'][$inventoryID]['itemCurrentQuantity'] <= 0) {
            unset($_SESSION['cart'][$inventoryID]);
        }
    }
   else if ($userAction == "quantityField") {

    // prevent below 1
    if ($changeValue < 1) {
        $changeValue = 1;
    }

    // prevent exceeding stock
    if ($changeValue > $maxStock) {
        $changeValue = $maxStock;
    }

    $_SESSION['cart'][$inventoryID]['itemCurrentQuantity'] = $changeValue;
}
    else {
         $_SESSION['cart'][$inventoryID]['itemCurrentQuantity']++;
    }
   $calculatePrice = $this->calculatePOS($discountprice);
  
    echo json_encode([
        "cart" => $_SESSION['cart'],
        "priceList" => $calculatePrice
    ]);
}   

public function addDiscount () {
    $this->startSession();
    $discountprice = $_SESSION['discountPercentage'] = $_POST['discount'];
        if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
     $calculatePrice = $this->calculatePOS($discountprice);
     echo json_encode([
        "cart" => $_SESSION['cart'],
        "priceList" => $calculatePrice
     ]);
}

public function finalizeSales () {
    $this->startSession();
     $this->database = new Database();
        $this->conn = $this->database->connect();
    $discountPrice = $_SESSION['discountPercentage'] ?? 0;
    $date = date("M/d/Y");
   $userDatas = $this->userProfile();
   $calculatePrice = $this->calculatePOS($discountPrice);
   $salesSQL = "INSERT INTO sales (salesOriginalPrice, salesDiscountAmount, salesTaxAmount, salesGrandAmount, salesDate, userID, salesSellingPrice, salesDiscountPercent) VALUES
   (:salesOriginalPrice, :salesDiscountAmount, :salesTaxAmount, :salesGrandAmount, :salesDate, :userID, :salesSellingPrice, :salesDiscountPercentage)";
   $salesSTMT = $this->conn->prepare($salesSQL);
   $salesSTMT->bindValue(":salesOriginalPrice", $calculatePrice['originalPrice']);
   $salesSTMT->bindValue(":salesDiscountAmount", $calculatePrice['discountAmount']);
   $salesSTMT->bindValue(":salesTaxAmount", $calculatePrice['taxAmount']);
   $salesSTMT->bindValue(":salesGrandAmount", $calculatePrice['grandAmount']);
   $salesSTMT->bindValue(":salesDate", $date);
   $salesSTMT->bindValue(":userID", $userDatas['userID']);
   $salesSTMT->bindValue(":salesSellingPrice", $calculatePrice['sellingPrice']);
   $salesSTMT->bindValue(":salesDiscountPercentage", $calculatePrice['discountPercentage']);
   $salesSTMT->execute();
   $salesID = $this->conn->lastInsertId();
    foreach($_SESSION['cart'] as $product) {
         $updateStockQuantitySQL = "UPDATE inventories SET itemQuantity = itemQuantity - :itemQuantity  WHERE inventoryID = :inventoryID AND userID = :userID";
         $updateStockQuantitySTMT = $this->conn->prepare($updateStockQuantitySQL);
         $updateStockQuantitySTMT->bindValue(":itemQuantity", $product['itemCurrentQuantity']);
         $updateStockQuantitySTMT->bindValue(":userID", $userDatas['userID']);
         $updateStockQuantitySTMT->bindValue(":inventoryID", $product['inventoryID']);
         $updateStockQuantitySTMT->execute();
         $salesProductSQL = "INSERT INTO salesitem (salesQuantity, salesTotalPrice, salesID, inventoryID, userID) VALUES
         (:salesQuantity, :salesTotalPrice, :salesID, :inventoryID, :userID)";
         $salesProductSTMT = $this->conn->prepare($salesProductSQL);
         $salesProductSTMT->bindValue(":salesQuantity", $product['itemCurrentQuantity']);
         $salesProductSTMT->bindValue(":salesTotalPrice", ($product['itemSellingPrice'] * $product['itemCurrentQuantity']));
         $salesProductSTMT->bindValue(":salesID", $salesID);
         $salesProductSTMT->bindValue(":inventoryID", $product['inventoryID']);
         $salesProductSTMT->bindValue(":userID", $userDatas['userID']);
         $salesProductSTMT->execute(); 
    }      
    unset($_SESSION['cart']);
    unset($_SESSION['discountPercentage']);
    $this->redirect("/EmployeeManager/pos");
}

public function addToCart () {
    $this->startSession();
    $inventoryID = $_POST['productID'];
    $productQuantity = $_POST['productQuantity'];
    $discountPrice = $_SESSION['discountPercentage'] ?? 0.0;
    
    $productFound = $this->findInventoryItemByID($inventoryID);
    if (!$productFound) {   
        echo json_encode([]);
        return;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$inventoryID])) {
        $_SESSION['cart'][$inventoryID]['itemCurrentQuantity']++;
    }
    else {
            $_SESSION['cart'][$inventoryID] = [
                "inventoryID" => $inventoryID,
                "itemName" => $productFound['itemName'],
                "itemImage" => $productFound['inventoryItemImage'],
                "itemSellingPrice" => $productFound['itemSellingPrice'],
                "itemCostPrice" => $productFound['itemCostPrice'],
                "itemCurrentQuantity" => $productQuantity
            ];
    }

        $calculatePrice = $this->calculatePOS($discountPrice);
    echo json_encode([
        "cart" => $_SESSION['cart'],
        "priceList" => $calculatePrice
    ]);
}


public function findInventoryItemByID ($inventoryID) {
           $this->database = new Database();
        $this->conn = $this->database->connect();
        $sqlSearchInventory = "SELECT * FROM inventories WHERE inventoryID = :inventoryID AND userID = :userID";
        $userDatas = $this->userProfile();
        $searchInventorySTMT = $this->conn->prepare($sqlSearchInventory);
        $searchInventorySTMT->bindValue(":inventoryID", $inventoryID);
        $searchInventorySTMT->bindValue(":userID", $userDatas['userID']);
        $searchInventorySTMT->execute();    
        $inventoryFound = $searchInventorySTMT->fetch(PDO::FETCH_ASSOC);
        return $inventoryFound;
}

public function calculatePOS ($discountPercentage) {
    $originalPrice =  0;
    $sellingPrice = 0;
     $discountPercentage = (float) $discountPercentage;
    foreach ($_SESSION['cart'] as $product) {
        $originalPrice += $product['itemCostPrice'] * $product['itemCurrentQuantity'];
        $sellingPrice += $product['itemSellingPrice'] * $product['itemCurrentQuantity'];
    }
        $discountAmount = $sellingPrice * ($discountPercentage / 100);
        $taxAmount = $sellingPrice * (12 / 100);
    $grandAmount = ($sellingPrice + $taxAmount) - $discountAmount;
    return [
        "originalPrice" => $originalPrice,
        "sellingPrice" => $sellingPrice,
        "discountAmount" => $discountAmount,
        "taxAmount" => $taxAmount,
        "grandAmount" => $grandAmount,
        "discountPercentage" => $discountPercentage
    ];
}

public function displayLowStock () {
    $userDatas = $this->userProfile();
    $this->database = new Database();
    $this->conn = $this->database->connect();
    $lowStockSQL = "SELECT inventoryID, itemName, itemQuantity, itemReorderLevel, inventoryItemImage FROM inventories WHERE itemQuantity <= itemReorderLevel AND userID = :userID"; 
    $lowStockSTMT = $this->conn->prepare($lowStockSQL);
    $lowStockSTMT->bindValue(":userID", $userDatas['userID']);
    $lowStockSTMT->execute();
    $lowStockDisplay = $lowStockSTMT->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lowStockDisplay);
}

public function refillStock () {
    $userDatas = $this->userProfile();
    $inventoryID = $_GET['inventoryID'];
    $itemQuantity = $_GET['stockRefillValue'];
    $this->database = new Database();
    $this->conn = $this->database->connect();
    $refillStockSQL = "UPDATE inventories SET itemQuantity = itemQuantity + :itemQuantity WHERE inventoryID = :inventoryID AND userID = :userID";
    $refillStockSTMT = $this->conn->prepare($refillStockSQL);
    $refillStockSTMT->bindValue(":itemQuantity", $itemQuantity);
    $refillStockSTMT->bindValue(":userID", $userDatas['userID']);
    $refillStockSTMT->bindValue(":inventoryID", $inventoryID);
    $refillStockSTMT->execute();
    $this->displayLowStock();
}




}

?>