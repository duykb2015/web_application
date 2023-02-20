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
        $valida = \Config\Services::validation();
        $data = [
            'username' => [
                'label' => 'Tên tài khoản*',
                'rules' => 'required',
                'error' => [
                    'required' => 'truong bat buoc'

                ]
            ],
            'email' => [
                'label' => 'Email*',
                'rules' => 'required|valid_email',
                'error' => [
                    'required' => 'truong bat buoc',

                    'valid_email' => 'Email khong hop le'
                ]
            ],
            'password' => [
                'label' => 'Mật khẩu*',
                'rules' => 'required|min_length[6]',
                'error' => [
                    'required' => 'truong bat buoc',
                    'min_length' => 'do dai it nhat 6 ky tu'
                ]
            ],
            'firstname' => [
                'label' => 'Họ*',
                'rules' => 'required',
                'error' => [
                    'required' => 'truong bat buoc'
                ]
            ],
            'lastname' => [
                'label' => 'Tên*',
                'rules' => 'required',
                'error' => [
                    'required' => 'truong bat buoc'
                ]
            ]
            // 'address1' => [
            //     'label' => 'Địa chỉ',
            //     'rules' => 'required',
            //     'error' => [
            //         'required' => 'truong bat buoc'
            //     ]

            // ],
            // 'telephone' => [
            //     'label' => 'Số điện thoại',
            //     'rules' => 'required',
            //     'error' => [
            //         'required' => 'truong bat buoc'
            //     ]

            // ]

        ];

        $valida->setRules($data);
        if ($valida->withRequest($this->request)->run()) {
            $customer_id = $this->request->getPost('customer_id');
            $username = $this->request->getPost('username');
            $firstname = $this->request->getPost('firstname');
            $lastname = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $password = password_hash($password, PASSWORD_DEFAULT);
            $address1 = $this->request->getPost('address1');
            $telephone = $this->request->getPost('telephone');

            $datas = [
                'username' => $username,
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => $password,
                'address1' => $address1,
                'telephone' => $telephone


            ];

            $customerModel = new CustomerModel();
            $customer = $customerModel->where(['email' => $email])->first();
            if ($customer) {
                if ($customer['id'] != $customer_id) {
                    // return redirect_with_message(base_url('/dang-ky'), 'Email đã đăng ký');
                    //return redirect()->back()->with('error', 'You must select a fruit!');
                }
            } elseif (!$customerModel->save($datas)) {

                // $mess['success'] = "Dang ky thanh cong!";
                // $mess['error'] = true;
                // return redirect_with_message(site_url('/dang-ky' . $customer_id ? $customer_id : ''), UNEXPECTED_ERROR_MESSAGE);
            }
        } // } else {
        //     $mess['success'] = false;
        //     $mess['error'] = $valida->listErrors();
        // }
        return redirect()->back()->with('error', 'You must select a fruit!');
        // return redirect()->to('/dang-ky');
        // return json_encode($mess);




    }
}
