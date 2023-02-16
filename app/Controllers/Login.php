<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function login()
    {
        return view('Site/Login/login');
    }
    public function register()
    {
        return view('Site/Login/register');
    }
}
