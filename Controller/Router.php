<?php   
require __DIR__ . "/../Controller/RouteHandler.php";
require __DIR__ . "/../Controller/AuthController.php";
require __DIR__ . "/../Controller/EmployeeManagerController.php";
        $router = new RouteHandler();
        

    RouteHandler::get('/', [new AuthController(), 'loginForm'] );
    RouteHandler::get('/login', [new AuthController(), 'loginForm']);
    RouteHandler::get('/register', [new AuthController(), 'registerForm']);
    RouteHandler::post('/register', [new AuthController(), 'registerData']);
    RouteHandler::post('/login', [new AuthController(), 'loginUser']);
        RouteHandler::group(['prefix' => '/EmployeeManager'], function() {
                    RouteHandler::get('/dashboard', [new EmployeeManagerController(), 'dashboard']);
                //    RouteHandler::get('/profileSettings', [new SellerController(), 'userSettings']); 
                //     RouteHandler::get('/addproduct', [new SellerController(), 'addNewProductForm']); 
                //      RouteHandler::post('/addproduct', [new SellerController(), 'addProductData']); 
          //  RouteHandler::get('/dashboard', [new UserController(), 'userDashBoard']);
              });   

    // RouteHandler::set('/authOTP',)
    // RouteHandler::set("/login", )
   $router->dispatch($_GET['url'] ?? trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/'));
?>