<?php

namespace App\Controllers;

use Core\Session;
use Core\Validator;
use App\Models\User;
use App\Controllers\Controller;

class LoginController extends Controller
{
    public function loginForm()
    {
        return $this->view('login');
    }

    public function login()
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $validator = Validator::make(compact('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', ['email' => $email]);
            return $this->view('login', [
                'errors' => $validator->errors()
            ]);
        }

        $userData = User::where('email', '=', $email)->first();
        $user = $userData ? new User((array)$userData) : null;
        
        if (!$user || !password_verify($password, $user->password)) {
            Session::flash('errors', [
                'email' => ['The credentials you entered are incorrect']
            ]);
            Session::flash('old', ['email' => $email]);

            return $this->view('login', [
                'errors' => Session::get('errors')
            ]);
        }

        $_SESSION['user'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['is_admin'] = $user->is_admin;

        Session::flash('success', 'Welcome back, ' . $user->username . '!');
        return redirect('/');
    }

    public function logout()
    {
        unset($_SESSION['user'], $_SESSION['username'], $_SESSION['is_admin']);

        session_destroy();

        return redirect('/login');
    }

}
