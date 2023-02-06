<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function index()
    {
        return view('site/checkout/index');
    }
}
