<?php

namespace App\Controllers;

class Controller
{
    public function view(string $view, array $params = [])
    {
        extract($params);
        ob_start();
        require BASE_PATH . "/views/{$view}.php";
        return ob_get_clean();
    }
}
