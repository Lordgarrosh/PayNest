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
            

                    
                    RouteHandler::get('/dashboard', function () {
                         (new EmployeeManagerController())->userCurrentPage("Dashboard/dashboard");
                    });
                  RouteHandler::get('/inventory', function () {
                         (new EmployeeManagerController())->inventoryForm();
                    });
                    RouteHandler::get('/addInventory', function () {
                         (new EmployeeManagerController())->addInventoryForm();
                    });
                    //  RouteHandler::get('/employee', function () {
                    //      (new EmployeeManagerController())->userCurrentPage("employee");
                    // });
                    RouteHandler::get('/payroll', function () {
                         (new EmployeeManagerController())->userCurrentPage("Payroll/payroll");
                    });
                    // RouteHandler::get('/sales', function () {
                    //      (new EmployeeManagerController())->userCurrentPage("sales");
                    // });
                    RouteHandler::get('/addEmployee', function () {
                         (new EmployeeManagerController())->userCurrentPage("Employees/addEmployee");
                    });
                    RouteHandler::get('/employeeList', function () {
                         (new EmployeeManagerController())->userCurrentPage("Employees/employeeList");
                    });
                      RouteHandler::get('/employeeRoleManage', function () {
                         (new EmployeeManagerController())->userCurrentPage("Employees/employeeRoles");
                    });
                      RouteHandler::get('/leaveRequest', function () {
                         (new EmployeeManagerController())->userCurrentPage("Employees/employeeLeaveRequest");
                    });
                      RouteHandler::get('/employee', function () {
                         (new EmployeeManagerController())->userCurrentPage("Employees/employee");
                    });
                     RouteHandler::get('/pos', function () {
                         (new EmployeeManagerController())->userCurrentPage("POS/pos");
                    });
                     RouteHandler::get('/reportDashboard', function () {
                         (new EmployeeManagerController())->userCurrentPage("Reports/reportDashboard");
                    });
                     RouteHandler::get('/subscriptionPlan', function () {
                         (new EmployeeManagerController())->subscriptionPlan();
                    });
                    RouteHandler::post('/addEmployee', function () {
                         (new EmployeeManagerController())->addEmployeeData();
                    });
                    RouteHandler::get('/employeeAttendance', [new EmployeeManagerController(), 'employeeAttendancePage']);
                    RouteHandler::post('/subscriptionPlan', [new EmployeeManagerController(), 'chooseSubscriptionPlan']);
                    RouteHandler::post('/addInventory', [new EmployeeManagerController(), 'addInventory']);
                 
                   
                    //  RouteHandler::get('/inventory', [new EmployeeManagerController(), 'inventoryForm']);
                    //   RouteHandler::get('/employee', [new EmployeeManagerController(), 'employeeForm']);
                    //    RouteHandler::get('/payroll', [new EmployeeManagerController(), 'payrollForm']);
                    //     RouteHandler::get('/salesForm', [new EmployeeManagerController(), 'salesForm']);
                         
                
                    // RouteHandler::get('/test', function () {
                    //     if (session_status() === PHP_SESSION_NONE) {
                    //         session_start();
                    //     }
                    //     $subscriptionPlan = $_SESSION['subscriptionPlan'];
                    //     echo $subscriptionPlan;
                    // });
                //    RouteHandler::get('/profileSettings', [new SellerController(), 'userSettings']); 
                //     RouteHandler::get('/addproduct', [new SellerController(), 'addNewProductForm']); 
                //      RouteHandler::post('/addproduct', [new SellerController(), 'addProductData']); 
          //  RouteHandler::get('/dashboard', [new UserController(), 'userDashBoard']);
              });   

    // RouteHandler::set('/authOTP',)
    // RouteHandler::set("/login", )
   $router->dispatch($_GET['url'] ?? trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/'));
?>