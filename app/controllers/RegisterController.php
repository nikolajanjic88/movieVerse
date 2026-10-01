<?php

namespace App\Controllers;

use Core\Session;
use Core\Validator;
use App\Models\User;
use App\Controllers\Controller;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return $this->view('register');
    }

    public function register()
    {
        $data = [
            'username' => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password_confirmation'] ?? '',
        ];

        $validator = Validator::make($data, [
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', [
                'email' => $data['email'],
                'username' => $data['username']
            ]);

            return $this->view('register', [
                'errors' => $validator->errors()
            ]);
        }
        
        unset($data['password_confirmation']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $user = new User($data);
        $user->save();

        Session::flash('success', 'Registration successful! You can now log in.');
        return redirect('/login');
    }


}