<?php 

function dd($arr)
{
    echo '<pre>'; 
    print_r($arr);
    echo '</pre>';
    die();
}

function old($key, $default = '') 
{
  return Core\Session::get('old')[$key] ?? $default;
}

function redirect($route)
{
  header('location: ' . $route);
  exit;
}

function abort($code = 404) 
{
  require_once BASE_PATH . "views/$code.php";
  die();
}