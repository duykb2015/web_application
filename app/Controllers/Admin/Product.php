<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductDescriptionModel;
use App\Models\ProductImageModel;
use CodeIgniter\HTTP\Response;
use Exception;

class Product extends BaseController
{
    use ResponseTrait;
    /**
     * Used to view all products
     */
    function index()
    {
        $productModel = new ProductModel();
        if ($this->request->getMethod() == 'get') {
            $productName     = $this->request->getGet('name');
            $productCategory = $this->request->getGet('category');
            $productStatus   = $this->request->getGet('status');
            $filterData = [
                'name'     => $productName,
                'category_id' => $productCategory,
                'status'   => $productStatus
            ];
            $productModel->filter($filterData);
        }

        $data = [
            'products' => $productModel->findAll(),
            'pager'    => $productModel->pager,
            'category' => $this->getSubCategory()
        ];
        return view('Admin/Product/index', $data);
    }

    /**
     * Used to create and edit new product
     * 
     */
    function detail()
    {
        $productID = $this->request->getUri()->getSegment(5);
        $categoryModel = new CategoryModel();
        $category = $categoryModel->select('id, name')->findAll();
        if (!$category) {
            return redirectWithMessage('product-category/detail', 'Bạn cần có danh mục trước mới có thể thêm sản phẩm');
        }
        $data['category'] = $this->getSubCategory();

        $attributeModel = new AttributeModel();
        $data['attributes'] = $attributeModel->findAll();

        if (!$productID) {
            $data['title'] = 'Thêm mới sản phẩm';
            return view('Admin/Product/detail', $data);
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productID);
        if (!$product) {
            return redirect()->to('dashboard/product/manage');
        }

        $productImageModel = new ProductImageModel();
        $images = $productImageModel->where('product_id', $productID)->find();

        $productDescriptionModel = new ProductDescriptionModel();
        $productDescription = $productDescriptionModel->where('product_id', $productID)->first();

        $productAttributeModel = new ProductAttributeModel();
        $productAttribute = $productAttributeModel->where('product_id', $productID)->find();

        $data['product']            = $product;
        $data['images']             = $images;
        $data['productDescription'] = $productDescription;
        $data['productAttribute']   = $productAttribute;
        $data['title']              = 'Chỉnh sửa dòng sản phẩm';

        return view('Admin/Product/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated. 
     * 
     */
    function save()
    {

        //get product data
        $productID   = $this->request->getPost('product_id');
        $category    = $this->request->getPost('category');
        $name        = $this->request->getPost('name');
        $slug        = $this->request->getPost('slug');
        $price       = $this->request->getPost('price');
        $discount    = $this->request->getPost('discount');
        $quantity    = $this->request->getPost('quantity');
        $information = $this->request->getPost('information');
        $description = $this->request->getPost('description');
        $status      = $this->request->getPost('status');

        $attributes      = $this->request->getPost('attributes');
        $attributeValues = $this->request->getPost('attribute_values');

        $upload = new Upload();
        $images = $upload->multipleImages($this->request->getFiles(), PRODUCT_IMAGE_PATH);
        if (!$images) {
            return redirectWithMessage(base_url(), UNEXPECTED_ERROR_MESSAGE);
        }

        //prepare data
        $data = [
            'name'     => $name,
            'slug'     => $slug,
            'category' => $category,
            'price'    => intval(str_replace(',', '', $price)),
            'discount' => $discount,
            'quantity' => $quantity,
            'status'   => $status,
        ];
        $data['image']  = $images[0];


        $productModel = new ProductModel();
        $product = $productModel->where('name', $name)->first();
        if ($product) {
            if ($product['id'] != $productID) {
                return redirectWithMessage('dashboard/product/manage/detail/', 'Sản phẩm đã tồn tại!');
            }
        }

        //check if product_id is not empty then update product else insert new product
        if ($productID) {
            $isUpdate = $productModel->update($productID, $data);
            if (!$isUpdate) {
                return redirectWithMessage('dashboard/product/manage/detail/' . $productID, UNEXPECTED_ERROR_MESSAGE);
            }
        }

        $productModel->db->transStart();
        $isInsert = $productModel->insert($data);
        if (!$isInsert) {
            $productModel->db->transRollback();
            $upload->cleanImage($images, PRODUCT_IMAGE_PATH);
            return redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
        }
        $productModel->db->transComplete();
        //after save product, we need to save product attribute values, image
        //get product inserted id for insert attribute values
        $insertID = $productModel->getInsertID();

        //if it's an update. the insert id will be zero, so we will use the already have product id
        if ($productID) {
            $insertID = $productID;
        }

        $productDescriptionModel = new ProductDescriptionModel();
        $data = [
            'product_id' => $insertID,
            'information' => $information,
            'description' => $description
        ];

        $productDescriptionModel->db->transStart();
        $isInsert = $productDescriptionModel->insert($data);
        if (!$isInsert) {
            $productDescriptionModel->db->transRollback();
            $upload->cleanImage($images, PRODUCT_IMAGE_PATH);
            return redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
        }
        $productDescriptionModel->db->transComplete();

        $isSaveImage = $this->saveImage($insertID, $images);
        if (!$isSaveImage) {
            //...
        }

        $isSaveAttribute = $this->saveAttributeValue($insertID, $attributes, $attributeValues);
        if (!$isSaveAttribute) {
            redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/product/manage');
    }

    private function saveImage($productID, $images)
    {
        $productImageModel = new ProductImageModel();
        $datas = $this->mergeImageWithProductID($productID, $images);
        foreach ($datas as $data) {
            $isInsert = $productImageModel->insert($data);
            if (!$isInsert) {
                return false;
            }
        }
        return true;
        // return $productImageModel->insertBatch($data);
    }

    private function mergeImageWithProductID($productID, $images)
    {
        foreach ($images as $image) {
            $data[] = [
                'product_id' => $productID,
                'image' => $image
            ];
        }
        return $data;
    }

    private function saveAttributeValue($productID, $attributes, $attributeValues)
    {
        $productAttributeModel = new ProductAttributeModel();
        $datas = $this->mergeAttributeWithValue($productID, $attributes, $attributeValues);
        // return $productAttributeModel->insertBatch($data);
        foreach ($datas as $data) {
            $isInsert = $productAttributeModel->insert($data);
            if (!$isInsert) {
                return false;
            }
        }
        return true;
    }

    private function mergeAttributeWithValue($productID, $attributes, $attributeValues)
    {
        foreach ($attributes as $key => $attribute) {
            $data[] = [
                'product_id' => $productID,
                'attribute_id' => $attribute,
                'value' => $attributeValues[$key]
            ];
        }
        return $data;
    }

    /**
     * Used to delete a product
     * 
     */
    public function delete()
    {
        //get product id from post data
        $productID = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$productID) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }

        //Delete attribute
        $productAttributeModel = new ProductAttributeModel();
        $isDelete = $productAttributeModel->where('product_id', $productID)->delete();
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá thuộc tính sản phẩm'),  Response::HTTP_OK);
        }

        //Delete Description
        $productDescriptionModel = new ProductDescriptionModel();
        $isDelete = $productDescriptionModel->where('product_id', $productID)->delete();
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá mô tả sản phẩm'),  Response::HTTP_OK);
        }

        //Delete image
        $productImageModel = new ProductImageModel();
        $images = $productImageModel->select('image')->where('product_id', $productID)->find();
        $upload = new Upload();
        $upload->cleanImage($images, PRODUCT_IMAGE_PATH);
        $isDelete = $productImageModel->where('product_id', $productID)->delete();
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được hình ảnh'),  Response::HTTP_OK);
        }

        //Delete product
        $product_m = new ProductModel();
        $isDelete = $product_m->delete($productID);
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }

    public function deleteImage()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(responseFailed('Hình ảnh không tồn tại'),  Response::HTTP_OK);
        }
        //Delete image
        $productImageModel = new ProductImageModel();
        $images = $productImageModel->select('image')->find($id);
        $upload = new Upload();
        $upload->cleanImage($images, PRODUCT_IMAGE_PATH);
        $isDelete = $productImageModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }
}
