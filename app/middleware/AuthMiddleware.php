<?php

namespace App\Middleware;

use Core\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle()
    {       
        if (empty($_SESSION['user'])) {
            return redirect('/login');
        }
    }
}
