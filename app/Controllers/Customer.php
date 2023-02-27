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



    public function updateInfo()
    {
        //pre($this->request->getPost());
        // $username   = $this->request->getPost('username');
        $firstname  = $this->request->getPost('firstname');
        $lastname   = $this->request->getPost('lastname');
        $email      = $this->request->getPost('email');
        $password   = md5($this->request->getPost('password'));
        $address1   = $this->request->getPost('address1');
        $address2   = $this->request->getPost('address2');
        $telephone  = $this->request->getPost('telephone');


        $inputs = [

            'email'     => $email,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'telephone' => $telephone,
            'address1'  => $address1

        ];
        $validation = service('validation');
        $validation->setRules(
            [
                'email'    => 'required',
                'firstname' => 'required',
                'lastname'  => 'required',
                'telephone' => 'required|min_length[9]|max_length[10]',
                'address1'  => 'required'
            ],
            //Custom error message
            customValidationErrorMessage()
        );

        //if something wrong, redirect to login page and show error message
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            return redirectWithMessage(base_url('ca-nhan/chi-tiet'), $error_msg);
        }



        $customerModel = new CustomerModel();
        // $customer = $customerModel->orWhere(['email' => $email, 'username' => $username])->first();
        // if ($customer) {
        //     return redirectWithMessage(base_url('ca-nhan/chi-tiet'), ACCOUNT_ALREADY_EXISTS);
        // }

        $datas = [

            'email'     => $email,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'address1'  => $address1,
            'telephone' => $telephone
        ];
        if (!empty($password)) {
            
            $datas['password'] = $password;
        }
        if (!empty($address1)) {
            $datas['address2'] = $address2;
        }

        $isSave = $customerModel->update($datas);
        if (!$isSave) {
            return redirectWithMessage(base_url('ca-nhan/chi-tiet'), UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('');
    }

}
