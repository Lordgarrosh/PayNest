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
           <link rel="stylesheet" href="../css/addInventory.css">
        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <main class="mainContainer p-5">
                  <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <h1>Inventories</h1>
                    <div class="d-flex gap-5">
                        <h5>Inventories</h5>
                        <h5>></h5>
                        <p>Add Item</p>
                    </div>
                </div>
               
            </div>
             <div class="d-flex gap-3 containerShadow px-4 py-2 align-items-center">
              <div class="addInventoryIconContainer d-flex align-items-center justify-content-center" > <img src="../assets/addInventoryPerson.png" class="addInventoryIcon ps-1" alt=""></div> 
                <div class="d-flex flex-column">
                    <h3 class="m-0" >Add inventory item</h3>
                    <p class="m-0" >fill in the details below to add a new inventory item to the system</p>
                </div>
             </div>

            <div class="InventoryFormContainer mt-5 containerShadow px-4 py-5">
                <form action="/EmployeeManager/addInventory" method="post">
                    <div class="detailContainer mt-4">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/checklist.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Product Information</h3>
                        </div>
                        <div class="detailInputContainer d-flex gap-5">
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Item Name</p>
                                    <p>*</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Category</p>
                                    <p>*</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Barcode</p>
                                    <p>*</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                        </div>
                    </div>

                        <div class="detailContainer mt-5">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/stocksIcon.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Stock Details</h3>
                        </div>
                        <div class="detailInputContainer d-flex gap-5">
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                        </div>
                    </div>

                        <div class="detailContainer mt-5">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/dollar.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Pricing</h3>
                        </div>
                        <div class="detailInputContainer d-flex gap-5">
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer">
                                <div class="d-flex gap-2">
                                    <p>Quantity</p>
                                    <p>A</p>
                                </div>
                                <input type="text" class="detailInputShadow">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
           
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



