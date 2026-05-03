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
              <link rel="stylesheet" href="../css/pos.css">
          <link rel="stylesheet" href="../css/sidenav.css">

        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>


        <main class="mainContainer p-5">
            <div class="posChooseProduct" style="width: 50%;">
                <h1>POS System</h1>
                <div class="seaerchProducts d-flex gap-3">
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
        <select name="selectCategories" class="selectCategories" id="selectCategories">
               <?php foreach ($categories as $cat): ?>
                                
    <option value="?page=1&category=<?= urlencode($cat['categoryName']) ?>&search=<?= urlencode($inventoryItemSearch) ?>">
        <?= $cat['categoryName'] ?>
    </option>
<?php endforeach; ?>
<option value="?page=1&category=">All Category</option>
        </select>
                </div>
            </div>

            <div class="chooseItemContainer" style="width: 50%;" >
                <?php foreach ($productItems as $product): ?>
                    <div class="itemContainer p-3" >
                    <div class="d-flex align-items-center justify-content-center">
                        <img width="50" height="50" src="<?php echo "/InventoryPic/".  $product['inventoryItemImage'] ?>">
                    </div>
                    <h3 class="m-0" ><?= $product['itemName'] ?></h3>
                    <p><?= $product['itemCategory'] ?></p>
                    <div class="d-flex-justifty-content-between"></div>
                    </div>
                    <?php endforeach; ?>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



