<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Login extends BaseController
{


    //Login
    public function login()
    {
        //if user already login, redirect to dashboard
        $isLogin = session()->get('isLogin');
        if (!empty($isLogin) && $isLogin == true) {
            return redirect()->to(site_url('/dashboard'));
        }
        return view('Site/Login/login');
    }

    public function authLogin()
    {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $inputs = array(
            'username' => $username,
            'password' => $password
        );

        //load validation service
        $validation = service('validation');
        $validation->setRules(
            [
                'username' => 'required',
                'password' => 'required|min_length[3]'
            ],
            //Custom error message
            customValidationErrorMessage()
        );

        //if something wrong, redirect to login page and show error message
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            return redirectWithMessage(base_url('dang-nhap'), $error_msg);
        }

        //Get info user
        $customerModel = new CustomerModel();
        $customer = $customerModel->where('username', $username)->first();
        if (!$customer) {
            return redirectWithMessage(base_url('dang-nhap'), WRONG_LOGIN_INFO_MESSAGE);
        }

        $customerPassword = md5($password) === $customer['password'];
        if (!$customerPassword) {
            return redirectWithMessage(base_url('dang-nhap'), WRONG_LOGIN_INFO_MESSAGE);
        }

        $sessionData = [
            'user_id' => $customer['id'],
            'name'    => $customer['firstname'] . ' ' . $customer['lastname'],
            'isLogin' => true
        ];

        //create new session and start to work
        session()->set($sessionData);
        return redirect()->to('');
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
        $password   = md5($this->request->getPost('password'));
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
                'password' => 'required|min_length[3]',
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
        if (!empty($address1)) {
            $datas['address1'] = $address1;
        }
        if (!empty($address1)) {
            $datas['address2'] = $address2;
        }

        $isSave = $customerModel->insert($datas);
        if (!$isSave) {
            return redirectWithMessage(base_url('dang-ky'), UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('dang-nhap');
    }


    /**
     * Used to logout the user.
     * 
     */
    function logout()
    {
        session()->destroy();
        return redirect()->to('');
    }
}
