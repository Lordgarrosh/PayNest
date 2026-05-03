    <?php


$categories = $data['categories'];
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/EmployeeManager.css">
          <link rel="stylesheet" href="../css/sidenav.css">
           <link rel="stylesheet" href="../css/addInventory.css">
        <title>PayNest</title>
             <style>
    .image-upload-container {
      width: 100%;
      max-width: 300px;
      height: 300px;
      border: 2px dashed #ccc;
      position: relative;
      cursor: pointer;
      overflow: hidden;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .image-upload-container img {
      width: 100%;
      height: 100%;
      object-fit: fill;
      display: none;
    }

    .image-upload-label {
      position: absolute;
      color: #666;
      text-align: center;
      padding: 10px;
      pointer-events: none;
    }

    input[type="file"] {
      display: none;
    }
  </style>
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
                <form action="/EmployeeManager/addInventory" method="post" enctype="multipart/form-data">
                    <div class="detailContainer mt-4">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/checklist.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Product Information</h3>
                        </div>
                        <div class="detailInputContainer d-flex gap-5 ms-3 mt-4" style="width: 80%;" >
                                <div class="prof-image-container d-flex justify-content-center align-items-center " style="width: 50%;" >
                                <label for="imageInput" class="image-upload-container">
                                    <span class="image-upload-label">Click to upload image</span>
                                    <img id="imagePreview" alt="Image Preview">
                                    <input type="file" id="imageInput" name="inventoryItemPic" accept="image/*">
                                    </label>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center gap-5" style="width: 50%;" >
                            <div class="inventoryDetailContainer" style="width: 100% !important;">
                                <div class="d-flex gap-2 ms-1 detailLabel">
                                    <p>Item Name</p>
                                    <p>*</p>
                                </div>
                                <input type="text" name="itemName" class="detailInputShadow ps-2">
                            </div>
                            <div class="inventoryDetailContainer" style="width: 100% !important;">
                                <div class="d-flex gap-2 detailLabel">
                                    <p>Category</p>
                                    <p>*</p>
                                </div>
                                <select name="itemCategory" id="" class="detailInputShadow ps-2">
                              <?php foreach ($categories as $cat): ?>
    <option value="<?= $cat['categoryName'] ?>">
        <?= $cat['categoryName'] ?>
    </option>
<?php endforeach; ?>
                                </select>
                            </div>
                            <div class="inventoryDetailContainer" style="width: 100% !important;">
                                <div class="d-flex gap-2 detailLabel">
                                    <p>Barcode</p>
                                    <p>*</p>
                                </div>
                                <input type="text" name="itemBarcode" class="detailInputShadow ps-2">
                            </div>
                            </div>
                        </div>
                    </div>

                        <div class="detailContainer mt-5">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/stocksIcon.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Stock Details</h3>
                        </div>
                         <div class="detailInputContainer d-flex gap-5 ms-3 mt-4" style="width: 100%;" >
                            <div class="inventoryDetailContainer" style="width: 25%;" >
                                 <div class="d-flex gap-2 ms-1 detailLabel">
                                    <p>Quantity</p>
                                    <p>*</p>
                                </div>
                                <input type="number" name="itemQuantity" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer" style="width: 25%;" >
                                <div class="d-flex gap-2 detailLabel">
                                    <p>Reorder Level</p>
                                    <p>*</p>
                                </div>
                                <input type="number" name="itemReorderLevel" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer" style="width: 25%;" >
                                <div class="d-flex gap-2 detailLabel">
                                    <p>Expiration Date</p>
                                    <p>*</p>
                                </div>
                                <input type="date" name="itemExpirationDate" class="detailInputShadow">
                            </div>
                        </div>
                    </div>

                        <div class="detailContainer mt-5">
                        <div class="detailTitle d-flex gap-3">
                           <div class="detailIcon d-flex align-items-center justify-content-center" ><img src="../assets/dollar.png" class="ps-1" width="40" height="40" alt="asd"></div> 
                            <h3>Pricing</h3>
                        </div>
                            <div class="detailInputContainer d-flex gap-5 ms-3 mt-4" style="width: 100%;" >
                            <div class="inventoryDetailContainer" style="width: 25%;" >
                                <div class="d-flex gap-2 ms-1 detailLabel">
                                    <p>Cost Price</p>
                                    <p>*</p>
                                </div>
                                <input type="number" step="0.01"  name="itemCostPrice" class="detailInputShadow">
                            </div>
                            <div class="inventoryDetailContainer" style="width: 25%;" >
                                <div class="d-flex gap-2 detailLabel">
                                    <p>Selling Price</p>
                                    <p>*</p>
                                </div>
                                <input type="number" step="0.01"  name="itemSellingPrice" class="detailInputShadow">
                            </div>
                        </div>
                    </div>
                    <div class="button-container d-flex gap-5 justify-content-end">
                        <button onclick="window.location.href='/EmployeeManager/inventory'" type="button" class="buttonCancel d-flex gap-3 justify-content-center align-items-center">
                            <img src="../assets/Exit.png" width="15" height="15" alt="">
                            <p class="m-0" >Exit</p>
                        </button>
                        <button type="submit" name="addInventory" class="btn btn-success d-flex gap-3 justify-content-center align-items-center">
                             <img src="../assets/downloadIcon.png" width="20" height="20" alt="">
                            <p class="m-0" >Save</p>
                        </button>
                    </div>
                </form>
            </div>
           
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
              const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');
  const labelText = document.querySelector('.image-upload-label');

  imageInput.addEventListener('change', function () {
    const file = this.files[0];
    console.log("asdasdasdasd");
    if (file) {
      const reader = new FileReader();
      
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        labelText.style.display = 'none';
         console.log("wut");
      }

      reader.readAsDataURL(file);
    } else {
      console.log("asd");
      imagePreview.style.display = 'none';
      labelText.style.display = 'block';
    }
  });

        </script>
    </body>
    </html>



<?php

if 
(!empty($messageReport) || !empty($formValidation)) {
    if ($formValidation == "Not Validated") {   
        echo "  <script>
 
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: '$messageReport'
            });
        </script>";
    }
    else  { 
        echo " <script>
            Swal.fire({
                icon: 'success',
                title: 'Registration success',
                text: '$messageReport'
            }).then(() => {
              window.location.href = '/EmployeeManager/dashboard';
            });
        </script>";
    }
}
?>