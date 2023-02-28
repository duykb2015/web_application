<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cart extends BaseController
{
    public function index()
    {
        return view('Site/Cart/index');
    }
}
