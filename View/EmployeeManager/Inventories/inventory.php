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
          <link rel="stylesheet" href="../css/sidenav.css">
           <link rel="stylesheet" href="../css/inventory.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <main class="mainContainer p-5">
                 <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Inventories</h1>
                    <p>Manage Inventories and stocks</p>
                </div>
                <div>
                 <a href="">  <img style="width: 2cm" src="<?php echo "/ProfilePic/". $profPic ?>"  alt="" class="userProfile"></a> 
                </div>
            </div>
           <div class="d-flex gap-3 align-items-stretch w-100">
    
    <!-- LEFT SIDE -->
    <div class="d-flex justify-content-between  " style=" width: 100%;" >
        <div class="d-flex gap-3" style="width: 70%" >

        <div class="searchbar d-flex align-items-center ">
            <label>
                <button style="border: none;" id="searchbarBtn">
                     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                </button>
               
            </label>
            <input class="search flex" name="searchInventoryItem" id="searchInventoryItem" placeholder="Search Inventory...">
        </div>

        <select name="categoryChosen" class="inventoryCategoryField" onchange="location = this.value">
            
                           <?php foreach ($categories as $cat): ?>
                                
    <option value="?page=1&category=<?= urlencode($cat['categoryName']) ?>&search=<?= urlencode($inventoryItemSearch) ?>">
        <?= $cat['categoryName'] ?>
    </option>
<?php endforeach; ?>
<option value="?page=1&category=">All Category</option>
        </select>

        </div>
        <div class="button">
            <button onclick="window.location.href='/EmployeeManager/addInventory'" class="btn btn-success px-4">+ Add Items</button>
        </div>
    </div>


</div>
    <table class="mt-5 productTable">
                          
   <tr>
    <th>Item Image</th>
    <th>Item Name</th>
    <th>Category</th>
    <th>Stock</th>
    <th>Price</th>
    <th>Status</th>
    <th>Action</th>
   </tr>
<?php foreach ($inventoryCategories as $cat): ?>
       <tr>
        <?php
            $stocks = $cat['itemReorderLevel'];
            $stockStatus = $stocks / 2;
            // echo "<script>alert('$stockStatus')</script>";
        ?>
        <td><img src="<?php echo "/InventoryPic/".  $cat['inventoryItemImage'] ?>" width="40" height="40" alt="d"></td>
        <td><?= $cat['itemName'] ?></td>
     <td><?= $cat['itemCategory'] ?></td>
      <td><?= $cat['itemQuantity'] ?></td>
       <td><?= $cat['itemSellingPrice'] ?></td>
       <?php 
       if ($cat['itemQuantity'] > $stockStatus) {
        echo " <td><button class='test'>inStock</button></td>";
       }
       else if ($cat['itemQuantity'] == 0) {
        echo " <td><button class='test'>Out of Stock</button></td>";
       }
       else if ($cat['itemQuantity'] <= $stockStatus) {
        echo " <td><button class='test'>Low Stock</button></td>";
       }
       ?>
        <td><button class="test">View</button></td>
       </tr>
       <?php
    $endPage++;
    endforeach; ?>
    </option>
    </table>

    <div class="d-flex justify-content-between mt-5">
        <p>Showing <?= $currentPage ?> to <?= $endPage ?> items out of <?= $totalInventories ?> items</p>
        <div class="paginationLinks d-flex gap-5">
            <?php 
            for ($i = 1; $i <= $paginationCount; $i++ ) {
                echo "<a href='?page=$i&category=". urlencode($categoryChosen) ."&search=". urlencode($inventoryItemSearch) ."'>$i</a>";   
            }
            ?>
        </div>
    </div>
        </main>
        <script>
          const inventorySearch =  document.getElementById("searchInventoryItem");
          inventorySearch.addEventListener("keydown", (e) => {
                if (e.key === "Enter" ) {
                const search = inventorySearch.value;
                window.location.href = '?page=1&category=<?= urlencode($categoryChosen) ?>&search=' + encodeURIComponent(search);
                }
            });
            document.getElementById("searchbarBtn").addEventListener("click", () => {
                const search = inventorySearch.value;
                window.location.href = '?page=1&category=<?= urlencode($categoryChosen) ?>&search=' + encodeURIComponent(search);
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



