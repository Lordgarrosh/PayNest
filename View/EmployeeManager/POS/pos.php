    <?php



    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="../js/jquery-4.0.0.min.js"></script>
        <link rel="stylesheet" href="../css/EmployeeManager.css">
              <link rel="stylesheet" href="../css/pos.css">
          <link rel="stylesheet" href="../css/sidenav.css">

        <title>PayNest</title>
    </head>
    <body>
    <?php require __DIR__ . "/../../../View/Components/EmployeeSideNav.php" ?>
        <div class="modalContainer hide" id="recentSaleModal" >
            <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100%;" >
                <div class="modalBoxContainer p-3">
                    <div class="d-flex justify-content-between">
                            <h1>Recent Sales</h1>
                            <button class="closeBtn" onclick="displayContainer('#recentSaleModal')" >X</button>
                          </div>
                </div>
            </div>
        </div>

            <div class="modalContainer hide" id="lowStockModal">
                <div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;" >
                    <div class="modalBoxContainer p-3"  >
                          <div class="d-flex justify-content-between">
                            <h1>Low Stock Containers</h1>
                            <button class="closeBtn" onclick="displayContainer('#lowStockModal')" >X</button>
                          </div>
                            <div class="row lowStockItems" style="border-bottom: 2pt solid gray; margin-bottom: 1cm; background-color: gray;">
                            <h5 class="col">Item Image</h5>
                            <h5 class="col">Item Name</h5>
                            <h5 class="col">Item Current Quantity</h5>
                            <h5 class="col">Item Reorder Level</h5>
                            <h5 class="col">Refill Stocks</h5>
                        </div>          
           <div class="row" id="lowStockContainer">

</div>
                    </div>
                   
                </div>
            </div>

        <main class="mainContainer p-5">
            <div class="d-flex gap-5">
            <div class="posChooseProduct">
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
                                
    <option value="<?=  $cat['categoryName']?>">
        <?= $cat['categoryName'] ?>
    </option>
<?php endforeach; ?>
<option value="">All Category</option>
        </select>
                </div>
                      <div class="d-flex flex-column gap-3" style="width: 100%; ">
                <div class="chooseItemContainer mt-5 mb-5" id="chooseItemContainer" >
            

                
                </div>
                    <button id="loadMoreItems" class="btn btn-primary">Load More </button>
                    <div class="d-flex gap-5 mt-5" style="width: 100%;" >
                        <div class="posActions py-3 px-4 d-flex flex-column" style="width: 50%;" >
                            <div class="d-flex gap-2 align-items-center">
                            <img src="/assets/notification.png" height="40" width="40" alt="">
                            <h5 class="m-0" >Auto Restock</h5>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <p id="stockWarning" style="width: 50%;" class="m-0" >x items are running low</p>
                                    <button style="background: none; border: none;" id="autoRestockBtn" ><h3 class="m-0 text-success">></h3></button>
                            </div>
                        </div>
                         <div class="posActions py-3 px-4 d-flex flex-column" style="width: 50%;" >
                            <div class="d-flex gap-2 align-items-center">
                            <img src="/assets/recentSales.png" height="40" width="40" alt="">
                            <h5 class="m-0" >Recent Sales</h5>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <p style="width: 50%;" class="m-0" >View Recent sales</p>
                                <button style="background: none; border: none;" id="recentSalesBtn" ><h3 class="m-0 text-success">></h3></button>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
            <div class="posSalesContainer" style="width: 50%;" >
                <div class="cartContainerTitle">
                    <div class="p-3 d-flex justify-content-between" >
                         <div class="d-flex justify-content-center align-items-center gap-2">
                        <div class="salesIconBG p-2">
                       <img src="/assets/cart.png" width="30" height="30" alt="">
                    </div>
                    <h3 class="m-0" >Current Sales</h3>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                       <button id="clearCartBtn" style="background: none; border: none;" ><img src="/assets/clear.png" height="30" width="30" alt=""></button> 
                        <h2 class="m-0" >Clear</h2>
                    </div>
                    </div>
                    <div class="d-flex flex-column" class="cartContainer" id="cartContainer">


 
                    </div>
                </div>
                <div class="mt-5 discountContainer"> 
                    <div class="p-4 d-flex justify-content-between" >
                                            <div class="d-flex gap-2">
                        <img src="/assets/discountTag.png" width="20" height="20" alt="">
                        <h5>Discount</h5>
                    </div>
                    <div class="discountInputContainer d-flex">
                        <input type="text" name="discountPercentage" id="discountPercentage" class="discountInput">
                        <p class="pesoContainer m-0 d-flex justify-content-center align-items-center">%</p>
                    </div>
                    </div>
                    <div class="d-flex justify-content-center" style="width: 100%;" >
                        <button class="btn btn-primary my-3" id="addDiscount" style="width: 90%;" >Add Discount</button>
                    </div>
                </div>

                <div class="totalSalesContainer mt-5 p-3">
                    <form action="/POS/finalizeSale" method="post">
                                            <div class="d-flex justify-content-between">
                        <p>Subtotal</p>
                        <p id="originalPrice">₱0.0</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Discount</p>
                        <p id="discountAmount" >₱0.0</p>
                    </div>
                    <div class="d-flex justify-content-between" style="border-bottom: 1px solid gray;" >
                        <p>Tax (%)</p>
                        <p id="taxAmount" >₱0.0</p>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p>Total</p>
                        <p id="grandAmount" >₱0.0</p>
                    </div>
                    
                    <button class="btn btn-primary mt-3" name="finalizeSalePOS" style="width: 100%;" >Submit</button>
                    </form>

                </div>
            </div>
        </div>
        </main>
<script>
$(document).ready(function () {
    let start = 0;
    const limit = 6;
    let loading = false;
    $("#autoRestockBtn").click(function () {
        console.log("asqweqd");
       displayContainer("#lowStockModal");
       $.ajax({
        url: "/POS/displayLowStock",
        type: "GET",
        dataType: "json",
        success: (event) => {
displayLowStocks(event);
        }
       });
    });
    $("#recentSalesBtn").click(function () {
        displayContainer("#recentSaleModal");
    });

  
    
    function loadItems() {
        if (loading) return;
        loading = true;

        $.ajax({
            url: '/POS/loadItem',
            type: 'GET', // ✅ FIXED
            data: {
                start: start,
                limit: limit
            },
            dataType: 'json', // ✅ important
            success: (data) => {
                console.log(data);

                if (data.length < limit) {
    $("#loadMoreItems").hide();
}
else {
    $("#loadMoreItems").show();
}

if (data.length === 0) {
    return;
}

                let html = "";

                $.each(data, (index, product) => {
                    html += `
                            <div class="itemContainer p-3" >
                    <div class="d-flex align-items-center justify-content-center">
                        <img width="50" height="50" src="/InventoryPic/${product['inventoryItemImage']}">
                    </div>
                    <h3 class="m-0" >${product['itemName']}</h3>
                    <p>${product['itemCategory']}</p>
                    <div class="d-flex justify-content-between" style="width: 100%;" >
                        <p class="m-0" >${product['itemSellingPrice']}</p>
                        <button class="addProductBtn d-flex justify-content-center align-items-center" data-id='${product['inventoryID']}'>+</button>
                    </div>
                    </div>`;
                });

                $("#chooseItemContainer").append(html); // ✅ append, not replace

                start += limit; // ✅ move here
                loading = false;
            }
        });
    }

    // initial load
    loadItems();

    // button load more
    $("#loadMoreItems").click(() => {
        loadItems();
    });
    $("#searchInventoryItem").on('keydown', function(e) {
          if (e.key === "Enter" ) {
               findItems ();
                }
    });
     $("#searchbarBtn").on('click', function() {
       
               findItems ();
                
    });
    $("#selectCategories").on('change', function() {
   findItems ();
    });

    function findItems () {
              if (loading) return;
        loading = true;
   let selectedItem = $("#selectCategories").val();
   let searchItem = $("#searchInventoryItem").val();
   
    start = 0;
    $("#chooseItemContainer").html(""); // clear old items
    $("#loadMoreItems").show();
   console.log("Test are " + searchItem);
//    console.log(selectedItem);
        $.ajax({
           url: "/POS/loadItem",
           type: "GET",
           data: {
            start: start,                // ✅ required
         limit: limit,
            category: selectedItem,
            findItem: searchItem
           },
           dataType: 'json',
           success: (data) => {
               

               if (data.length < limit) {
    $("#loadMoreItems").hide();
}
else {
    $("#loadMoreItems").show();
}

if (data.length === 0) {
    return;
}

                let html = "";

                $.each(data, (index, product) => {
                    html += `
                            <div class="itemContainer p-3" >
                    <div class="d-flex align-items-center justify-content-center">
                        <img width="50" height="50" src="/InventoryPic/${product['inventoryItemImage']}">
                    </div>
                    <h3 class="m-0" >${product['itemName']}</h3>
                    <p>${product['itemCategory']}</p>
                    <div class="d-flex justify-content-between" style="width: 100%;" >
                        <p class="m-0" >${product['itemSellingPrice']}</p>
                        <button class="addProductBtn d-flex justify-content-center align-items-center" data-id='${product['inventoryID']}'>+</button>
                    </div>
                    </div>`;
                });

                $("#chooseItemContainer").html(html); // ✅ append, not replace

                // start += limit; // ✅ move here
                loading = false;
            },
              complete: () => {
            loading = false; // safety
        }
        });
    }
    $.ajax({
        url: "/POS/getCart",
        type: "GET",
        dataType: "json",
        success: function(cart) {
        
            renderCart(cart);
            $("#stockWarning").text(cart.stockWarning + " items are running low");
        }
    });
$(document).on('click', '.addProductBtn', function () {
    let inventoryId = $(this).data('id');
    let quantity = 1;
    //   if (loading) return;
    //     loading = true;

        $.ajax({
            url: "/POS/addToCart",
            type: "POST",
            data: {
                productQuantity: quantity,
                productID: inventoryId
            },
            dataType: "json",
            success: function(result) {

                let html = "";
                 console.log("Cart:", result.cart);
                renderCart(result);
                
               
            }
        });
});

function renderTotalValue (totalValue) {
    
}


function renderCart(cart) {

    let html = "";
  
    $.each(cart.cart, (index, product) => {
        html += `
                   <div class="cartItemContainer p-2 py-4 d-flex justify-content-between">
                            <div class="d-flex">
                                <div>
                                    <img src="/InventoryPic/${product.itemImage}" height="100" width="100" alt="">
                                </div>
                                <div class="d-flex flex-column justify-content-center ms-3">
                                    <h3>${product.itemName}</h3>
                                    <div class="d-flex quantityContainer">
                                        <button class="quantityBtn addQuantityBtn " data-id='${product.inventoryID}'>+</button>
                                        <input type="number" value="${product.itemCurrentQuantity}" data-id='${product.inventoryID}' class="quantityField" style="width: 30%;" >
                                        <button class="quantityBtn subtractQuantityBtn" data-id='${product.inventoryID}' >-</button>
                                    </div>
                                </div>
                            </div> 
                            <div class="d-flex flex-column gap-3 justify-content-center me-4">
                                <h5>${product.itemCurrentQuantity} X ${product.itemSellingPrice}</h5>
                                <h5>${product.itemCurrentQuantity * product.itemSellingPrice}</h5>
                            </div>
                        </div>
        `;
    });
    $("#originalPrice").text(cart.priceList.sellingPrice);
    $("#discountAmount").text(cart.priceList.discountAmount);
    $("#taxAmount").text(cart.priceList.taxAmount);
    $("#grandAmount").text(cart.priceList.grandAmount);
    $("#cartContainer").html(html);
}


$(document).on("click", ".addQuantityBtn", function () {
    let itemID = $(this).data('id');

    $.ajax({
        url: "/POS/updateCart",
        type: "POST",
        data: {
            action: "addCartQuantity",
            productID: itemID
        },
        dataType: "json",
        success: function(result) {
            renderCart(result);
        }
    });
});
$(document).on("click", ".subtractQuantityBtn", function () {
    let itemID = $(this).data('id');
         $.ajax({
            url: "/POS/updateCart",
            type: "POST",
              data: {
            action: "subtractCartQuantity",
            productID: itemID
        },
        dataType: "json",
        success: function(result) {
            console.log(result);
            renderCart(result);
        }
        });
});
$(document).on("change", ".quantityField", function () {
    let itemID = $(this).data('id');
    let fieldValue = $(this).val();
         $.ajax({
            url: "/POS/updateCart",
            type: "POST",
              data: {
            action: "quantityField",
            productID: itemID,
            changeValue: fieldValue
        },
        dataType: "json",
        success: function(result) {
            console.log(result);    
            renderCart(result);
        }
        });
});

$(document).on("click", "#addDiscount", function () {
    let discountInputPercentage = $("#discountPercentage").val();
    if (discountInputPercentage > 100 || discountInputPercentage < 0) {
        Swal.fire({
                icon: 'error',
                title: 'Invalid Discount Percentage',
                text: 'Please input a proper discount percentage'
            });
    }
    else {
        $.ajax({
            url: "/POS/addDiscount",
            type: "POST",
            data: {
                discount: discountInputPercentage
            },
            dataType: "json",
            success: function(result) {
                renderCart(result);
            }
        });
    }
});
$(document).on("click", "#clearCartBtn", function () {
    let itemID = $(this).data('id');
         $.ajax({
            url: "/POS/updateCart",
            type: "POST",
              data: {
            action: "deleteCart",
            productID: itemID
        },
        dataType: "json",
        success: function(result) {
            renderCart(result);
        }
        });
});
});


  function displayContainer(activeContainer) {
         $(activeContainer).toggleClass("hide");
    };
      async function refillStock (inventoryID) {
        	
const inputValue = "";
const { value: refillStockValue } = await Swal.fire({
  title: "Enter your IP address",
  input: "text",
  inputLabel: "Your IP address",
  inputValue,
  showCancelButton: true,
  inputValidator: (value) => {
    if (!value) return "You need to write something!";
  }
});
if (refillStockValue) {
    $.ajax({
        url: "/POS/refillStock",
        type: "GET",
        dataType: "json",
        data: {
            stockRefillValue: refillStockValue,
            inventoryID: inventoryID
        },
        success: (event) => {
           displayLowStocks(event);
        }
    });
};
    }


    function displayLowStocks(event) {
                let html = "";
            $.each(event, (index, lowStockItems) => {
                html += `
                <div class="row lowStockContainer align-items-center text-center">
    <div class="col d-flex justify-content-center">
        <img 
            src="/InventoryPic/${lowStockItems.inventoryItemImage}" 
            class="lowStockImage"
            alt=""
        >
    </div>

    <h5 class="col m-0">${lowStockItems.itemName}</h5>
    <h5 class="col m-0">${lowStockItems.itemQuantity}</h5>
    <h5 class="col m-0">${lowStockItems.itemReorderLevel}</h5>
    <button class='col' style='border:none; background: none;' onclick='refillStock(${lowStockItems.inventoryID})'> <h5 class="m-0">></h5></button>
    </div>
`; 
            });
             $("#lowStockContainer").html(html);
}
</script>
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>



