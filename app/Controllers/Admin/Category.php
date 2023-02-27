<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductToCategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class Category extends BaseController
{
    use ResponseTrait;


    /**
     * Used to view all categorys
     * 
     */
    public function index()
    {
        $categoryModel = new CategoryModel();
        //The method is not deprecated, the optional [$upper] parameter is deprecated.
        if ($this->request->getMethod() == 'get') {
            $categoryName   = $this->request->getGet('category_name');
            $categoryParent = $this->request->getGet('category_parent');
            $categoryStatus = $this->request->getGet('category_status');
            $filterData = [
                'name'      => $categoryName,
                'parent_id' => $categoryParent,
                'status'    => $categoryStatus,
            ];
            $categoryModel->filter($filterData);
        }

        $data = $categoryModel->customFindAll();
        $parentCategory = $categoryModel->where(['parent_id' => 0, 'status' => 1])->findAll();
        $data['parentCategory'] = $parentCategory;
        return view('Admin/Category/index', $data);
    }

    /**
     * Used to view category infomation 
     * 
     */
    public function detail()
    {
        $category_id = $this->request->getUri()->getSegment(4);
        $categoryModel = new CategoryModel();
        $data['parent_category'] = $categoryModel->where(['parent_id' => 0, 'status' => 1])->findAll();

        if (!$category_id) {
            $data['title'] = "Thêm Mới Category";
            return view('Admin/Category/detail', $data);
        }

        $category = $categoryModel->find($category_id);
        //just in case if category not found
        if (!$category) {
            return redirect()->to('dashboard/category/index');
        }

        $data['title'] = "Chỉnh Sửa Category";
        $data['category'] = $category;
        
        return view('Admin/Category/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated.
     * 
     */
    public function save()
    {
        //get post data
        $category_id        = $this->request->getPost('category_id');
        $category_name      = $this->request->getPost('name');
        $category_slug      = $this->request->getPost('slug');
        $category_parent_id = $this->request->getPost('parent_id');
        $category_status    = $this->request->getPost('status');

        $data = [
            'name'      => $category_name,
            'slug'      => $category_slug,
            'parent_id' => $category_parent_id,
            'status'    => $category_status
        ];

        $categoryModel = new CategoryModel();
        $category = $categoryModel->where(['slug' => $category_slug])->first();
        if ($category) {
            if ($category['id'] != $category_id) {
                return redirectWithMessage(base_url('dashboard/category/detail') . '/' . $category_id, 'Category đã tồn tại');
            }
        }
        if ($category_id) {
            $data['id'] = $category_id;
        }

        if (!$categoryModel->save($data)) {
            return redirectWithMessage(site_url('dashboard/category/detail/' . $category_id ? $category_id : ''), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/category');
    }

    /**
     * Used to change status of a category
     * 
     */
    public function changeStatus()
    {
        //get category id from post data
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $categoryModel = new CategoryModel();
        $is_update = $categoryModel->update($id, $data);
        if (!$is_update) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }


    /**
     * Used to delete a category
     * 
     */
    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        //check if have product use or not
        $productToCategoryModel = new ProductToCategoryModel();
        $haveProductUse = $productToCategoryModel->where('category_id', $id)->first();
        if ($haveProductUse) {
            return $this->respond(responseFailed('Xoá thất bại, danh mục có chứa sản phẩm!'), Response::HTTP_OK);
        }

        $categoryModel = new CategoryModel();
        //check if category have child or not
        $haveChild = $categoryModel->where('parent_id', $id)->first();
        if ($haveChild) {
            return $this->respond(responseFailed('Xoá thất bại, danh mục có chứa danh mục con!'), Response::HTTP_OK);
        }

        //delete category
        $isDelete = $categoryModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }
}
