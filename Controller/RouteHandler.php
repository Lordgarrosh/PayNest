<?php

class RouteHandler {

     public static $routes = array();
     public static $prefix = '';
//set the parameters for router, its purpose and its method request
     public static function set(string $route, callable|string $handler, string $method = 'GET') {
      $fullroute = trim(self::$prefix . '/' . trim($route, '/'), '/');
        self::$routes[] = [
            'route' => $fullroute,
            'handler' => $handler,
            'method' => strtoupper($method),
        ];
     }

    //  public function addRoute(String $path, Closure $handler) {
    //     $this->routes[$path] = $handler;
    //  }
    public static function get($route, $handler) {
self::set($route, $handler, 'GET');
        }


        public static function post($route, callable|string $handler) {
         self::set($route, $handler, 'POST');
        }

        public static function delete($route, callable|string $handler) {
         self::set($route, $handler, 'DELETE');
        }

        public static function group(array $options, callable $callback) {
          $oldPrefix = self::$prefix;
        self::$prefix .= $options['prefix'] ?? '';
        call_user_func($callback);
        self::$prefix = $oldPrefix;
        }


      public function dispatch(string $uri) {
             
        $uri = trim($uri, '/'); 
        $method = $_SERVER['REQUEST_METHOD'];
        foreach (self::$routes as $route) {
          //check if the route and the method request is the same for model and view purpose controlling
      if ($uri === $route['route'] && $method === $route['method']) {
          
            $handler = $route['handler'];
            if (is_callable($handler)) {
                
            call_user_func($handler);    
             }
             else {
                if (file_exists($handler)) {
                    
                require $handler;
                }
                else {
                         http_response_code(404);
                }
             }
             return;
            }
        }
        //generate http error code if there is uncanny behavior
       if ($_SERVER["REQUEST_URI"] != 'index.php') {
      
        http_response_code(404);
       }
       else {
          echo "Test";
        http_response_code(200);
       }
       
    if (http_response_code() == 404) {
        echo "404 not found";
        }
      }

//i want to put the request

        public static function httpRequestErrorHandle () {
           if (http_response_code() == 404) {
        echo "404 not found";
        }
        }
       
        
    }
    //     $router = new RouteHandler();
    // RouteHandler::set('contact-us', function() {
    //     echo "test";
    // });
    // RouteHandler::set('/', __DIR__ . '/../View/landingpage.php');
    // RouteHandler::set('/alexa', function() {
    //     echo "<a href='/'>test</a>";
    // });
    // RouteHandler::set("/")
    // $router->get( uri: $_GET['url'] ?? trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/'));
         // self::$routes[] = $route;
        // // print_r(self::$validRoutes);
        // // if (array_key_exists($path, $this->routes   ))
        // if ($_GET['url'] == $route) {
        // call_user_func($function);
?>


