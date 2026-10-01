<?php

namespace App\Middleware;

use Core\Middleware;

class GuestMiddleware extends Middleware
{
    public function handle()
    {       
        if (!empty($_SESSION['user'])) {
            return redirect('/');
        }
    }
}
