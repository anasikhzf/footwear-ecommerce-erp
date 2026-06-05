<?php
namespace App\Core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Determine Controller
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                http_response_code(404);
                // Standard 404
                echo "<h3>404 Page Not Found</h3>";
                exit;
            }
        }

        // Import and instantiate
        $classPath = '\\App\\Controllers\\' . $this->controller;
        if (!class_exists($classPath)) {
            // Require manual load if autoloader has issues
            require_once '../app/controllers/' . $this->controller . '.php';
        }
        $this->controller = new $classPath;

        // Determine Method
        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                http_response_code(404);
                echo "<h3>404 Method Not Found</h3>";
                exit;
            }
        }

        // Get Parameters
        $this->params = $url ? array_values($url) : [];

        // Call the controller method with arguments
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
