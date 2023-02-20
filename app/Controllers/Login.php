<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Encryption\Encryption;
use CodeIgniter\I18n\Time;

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
