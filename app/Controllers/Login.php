<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Login extends BaseController
{


    //Login
    public function login()
    {
        return view('Site/Login/login');
    }

    // Register  

    public function register()
    {
        return view('Site/Login/register');
    }

    public function authRegister()
    {
        $username   = $this->request->getPost('username');
        $firstname  = $this->request->getPost('firstname');
        $lastname   = $this->request->getPost('lastname');
        $email      = $this->request->getPost('email');
        $password   = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $address1   = $this->request->getPost('address1');
        $address2   = $this->request->getPost('address2');
        $telephone  = $this->request->getPost('telephone');


        $inputs = [
            'username'  => $username,
            'email'     => $email,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'password'  => $password,
            'telephone' => $telephone

        ];
        $validation = service('validation');
        $validation->setRules(
            [
                'email'    => 'required',
                'username' => 'required',
                'firstname' => 'required',
                'lastname'  => 'required',
                'password' => 'required|min_length[6]',
                'telephone' => 'required|min_length[9]|max_length[10]'
            ],
            //Custom error message
            customValidationErrorMessage()
        );

        //if something wrong, redirect to login page and show error message
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            return redirectWithMessage(base_url('dang-ky'), $error_msg);
        }



        $customerModel = new CustomerModel();
        $customer = $customerModel->orWhere(['email' => $email, 'username' => $username])->first();
        if ($customer) {
            return redirectWithMessage(base_url('dang-ky'), ACCOUNT_ALREADY_EXISTS);
        }

        $datas = [
            'username'  => $username,
            'email'     => $email,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'password'  => $password,
            'telephone' => $telephone

        ];

        $isSave = $customerModel->insert($datas);
        if (!$isSave) {
            return redirectWithMessage(base_url('dang-ky'), UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('dang-nhap');
    }
}
