<?php

use Core\Session;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
require_once BASE_PATH . '/core/helpers.php';
require_once BASE_PATH . '/core/config.php';

Session::start();

use Core\App;

// Bootstrap
$app = new App();

// Load routes
require_once BASE_PATH . '/routes/web.php';

// Run
$app->run();
Session::unflash();