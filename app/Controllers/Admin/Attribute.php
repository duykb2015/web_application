<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AttributeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class Attribute extends BaseController
{
    use ResponseTrait;

    /**
     * Used to view all product attribute
     * 
     */
    public function index()
    {
        $productAttributeModel = new AttributeModel();
        if ($this->request->getMethod() == 'get') {
            $productAttributeName   = $this->request->getGet('attribute_name'); 
            $productAttributeStatus = $this->request->getGet('attribute_status');
            $filterData = [
                'name'       => $productAttributeName,
                'status'     => $productAttributeStatus
            ];
            $productAttributeModel->filter($filterData);
        }
        $data = [
            'attributes' => $productAttributeModel->paginate(10),
            'pager'              => $productAttributeModel->pager
        ];
        return view('Admin/Product/Attribute/index', $data);
    }

    /**
     * Used to view product attribute infomation 
     * 
     */
    public function detail()
    {
        $attributeId = $this->request->getUri()->getSegment(5);
        if (!$attributeId) {
            $data['title'] = 'Thêm mới thuộc tính';
            return view('Admin/Product/Attribute/detail', $data);
        }
        $attributeModel = new AttributeModel();
        $attribute = $attributeModel->find($attributeId);
        if (!$attribute) {
            return redirect()->to('dashboard/product/attribute');
        }
        $data['product_attribute'] = $attribute;
        $data['title'] = 'Chỉnh sửa thuộc tính';
        return view('Admin/Product/Attribute/detail', $data);
    }

    /**
     * Used to save product attribute
     * 
     */

    public function save()
    {
        $attributeId     = $this->request->getPost('product_attribute_id');
        $attributeName   = $this->request->getPost('name');
        $attributeStatus = $this->request->getPost('status');

        $data = [
            'name'   => $attributeName,
            'status' => $attributeStatus,
        ];

        //Check if product attribute is exist
        $attributeModel = new AttributeModel();
        $attributeValue = $attributeModel->where('name', $attributeName)->first();
        if ($attributeValue) {
            if ($attributeValue['id'] != $attributeId) {
                return redirect_with_message('product-attribute/detail', 'Thuộc tính đã tồn tại');
            }
        }

        if ($attributeId) {
            $data['id'] = $attributeId;
        }
        $isSave = $attributeModel->save($data);
        if (!$isSave) {
            return redirect_with_message('dashboard/product/attribute/detail', UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to(base_url('dashboard/product/attribute'));
    }

    /**
     * Used to change status of an product attribute
     * 
     */
    public function changeStatus()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $attributeModel = new AttributeModel();
        $isUpdate = $attributeModel->update($id, $data);
        if (!$isUpdate) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }

    /**
     * Used to delete an attribute
     * 
     */
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        //delete attribute
        $attributeModel = new AttributeModel();
        $isDelete = $attributeModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }
}
