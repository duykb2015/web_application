<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $customerID = session()->get('id');
        $customer = $customerModel->find($customerID);
        $data['customer'] = $customer;
        return view('Site/Customer/index', $data);
    }
}
