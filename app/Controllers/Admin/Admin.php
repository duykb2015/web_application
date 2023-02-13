<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;
use CodeIgniter\HTTP\Response;

class Admin extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        helper('array');
    }

    /**
     * Used to view all user accounts (Only for users with admin level)
     * 
     */
    public function index()
    {
        $adminModel = new AdminModel();
        $accounts  = $adminModel->findAll();

        foreach ($accounts as $key => $account) {
            $account['last_login_at'] = get_time_ago(strtotime($account['last_login_at']));
            $accounts[$key]           = $account;
        }
        $data['accounts'] = $accounts;
        return view('Admin/Admin/index', $data);
    }

    /**
     * Used to view create and update account page
     * 
     */
    public function detail()
    {

        $id = $this->request->getUri()->getSegment(4);
        if (!$id) {
            if (session()->get('level') > 0) {
                return redirect()->to('dashboard/admin');
            }
            $data['title'] = "Thêm Mới Tài Khoản";
            return view('Admin/Admin/detail', $data);
        }
        $adminModel = new AdminModel();
        $account = $adminModel->find($id);
        if (empty($account)) {
            return redirect()->to('dashboard/admin');
        }
        $data['title'] = "Chỉnh Sửa Tài Khoản";
        $data['account'] = $account;
        return view('Admin/Admin/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated.
     *  
     */
    public function save()
    {
        $user_id  = $this->request->getPost('id');
        $username = $this->request->getPost('username') ? $this->request->getPost('username') : session()->get('name');
        $password = $this->request->getPost('password');
        $level    = $this->request->getPost('level') || 1;
        $status   = $this->request->getPost('status') || 1;

        $inputs = array(
            'username' => $username,
            'password' => $password
        );
        $rules['username'] = 'required';
        //if create new user or update password, then require password validation
        if (!$user_id || !empty($password)) {
            $rules['password'] = 'required|min_length[3]';
        }

        $validation = service('validation');
        $validation->setRules($rules, custom_validation_error_message());
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            if (!$user_id) {
                return redirect_with_message(site_url('dashboard/admin/detail'), $error_msg);
            }
            return redirect_with_message(site_url('dashboard/admin/detail/') . $user_id, $error_msg);
        }

        $adminModel = new AdminModel();
        $user = $adminModel->where('username', $username)->first();
        if ($user && !$user_id) {
            $error_msg = 'Tài khoản đã tồn tại!';
            return redirect_with_message(site_url('dashboard/admin/detail'), $error_msg);
        }
        $data = [
            'username' => $username,
            'level'    => $level,
            'status'   => $status
        ];
        if ($user_id) {
            $data['id'] = $user_id;
        }

        if ($password) {
            $data['password'] = $password;
        }

        //if create failed, notice and redirect to register page again
        $is_save = $adminModel->save($data);
        if (!$is_save) {
            return redirect_with_message(site_url('Admin/detail'), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/admin');
    }

    /**
     * Used to delete account (Only for users with admin level)
     * 
     */
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        //if account id is empty, return error response
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        //cannot delete exclusive admin account, of course
        if ($id == 1) {
            return $this->respond(responseFailed('Bạn không thể xoá tài khoản này!'), Response::HTTP_OK);
        }

        $adminModel = new AdminModel();
        if (!$adminModel->delete($id)) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);

    }
}
