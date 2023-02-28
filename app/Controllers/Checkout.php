<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    public function index()
    {
        $data['cartTotal'] = $this->cartTotal;
        return view('site/checkout/index', $data);
    }
}
