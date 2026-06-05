<?php
namespace App\Core;

class Controller {
    // Render view file
    public function view($view, $data = []) {
        // Expose data array as variables
        extract($data);

        $viewFile = '../app/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View '$view' does not exist.");
        }
    }

    // Load model
    public function model($model) {
        $modelClass = '\\App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die("Model '$model' class not found.");
        }
    }

    // Redirect helper
    public function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
    }
}
