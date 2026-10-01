<?php

namespace App\Middleware;

use Core\Middleware;

class AdminMiddleware extends Middleware
{
    public function handle()
    {

        if (empty($_SESSION['user'])) {
            return redirect('/login');
        }

        if ($_SESSION['is_admin'] != 1) {
            return redirect('/home');
        }
    }
}