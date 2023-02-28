<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductDescriptionModel;
use App\Models\ProductImageModel;
use CodeIgniter\HTTP\Response;

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
        $attributes = $attributeModel->orderBy('id', 'ASC')->findAll();

        if (!$productID) {
            $data['productAttribute'] = $attributes;
            $data['title']            = 'Thêm mới sản phẩm';
            return view('Admin/Product/detail', $data);
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productID);
        if (!$product) {
            return redirect()->to('dashboard/product/manage');
        }

        $productImageModel = new ProductImageModel();
        $images = $productImageModel->where('product_id', $productID)->orderBy('id', 'ASC')->find();

        $productDescriptionModel = new ProductDescriptionModel();
        $productDescription = $productDescriptionModel->where('product_id', $productID)->first();


        $attributeModel = new AttributeModel();
        $attributes = $attributeModel->orderBy('id', 'ASC')->findAll();
        $productAttributeModel = new ProductAttributeModel();
        $productAttributes = $productAttributeModel->where('product_id', $productID)->orderBy('attribute_id', 'ASC')->find();

        foreach ($attributes as $key => $item) {
            $attribute[$key]['id'] = $item['id'];
            $attribute[$key]['name'] = $item['name'];
            foreach ($productAttributes as $row) {
                if ($row['attribute_id'] == $item['id']) {
                    $value[$key][] = $row['value'];
                }
            }
            $attribute[$key]['value'] = implode(',', $value[$key]);
        }
        foreach ($productAttributes as $row) {
            $productAttributeID[] = $row['id'];
        }
        $data['product']            = $product;
        $data['images']             = $images;
        $data['productDescription'] = $productDescription;
        $data['productAttribute']   = $attribute;
        $data['productAttributeID'] = implode(',', $productAttributeID);
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
        $attributeValuesID = $this->request->getPost('product_attribute_id');


        $fileError = $this->request->getFiles()['images'][0]->getError();
        if ($fileError != 4) {
            $upload = new Upload();
            $images = $upload->multipleImages($this->request->getFiles(), PRODUCT_IMAGE_PATH);
            if (!$images) {
                return redirectWithMessage('dashboard/product/manage/detail/' . $productID, 'Hình ảnh lỗi');
            }
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
        $data['image']  = $images[0] ?? '';


        $productModel = new ProductModel();
        $product = $productModel->where('name', $name)->first();
        if ($product) {
            if ($product['id'] != $productID) {
                return redirectWithMessage('dashboard/product/manage/detail/', 'Sản phẩm đã tồn tại!');
            }
        }

        //check if product_id is not empty then update product else insert new product
        if ($productID) {
            $data['id'] = $productID;
        }

        $productModel->db->transStart();
        $isInsert = $productModel->save($data);
        if (!$isInsert) {
            $productModel->db->transRollback();
            $upload->cleanImages($images);
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

        $productDescription = $productDescriptionModel->where('product_id', $insertID)->orderBy('id', 'DESC')->first();
        if ($productDescription) {
            $data['id'] = $productDescription['id'];
        }

        $productDescriptionModel->db->transStart();
        $isSave = $productDescriptionModel->save($data);
        if (!$isSave) {
            $productDescriptionModel->db->transRollback();
            $upload->cleanImages($images);
            return redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
        }
        $productDescriptionModel->db->transComplete();

        if (isset($images)) {
            $isSaveImage = $this->saveImage($insertID, $images);
            if (!$isSaveImage) {
                redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
            }
        }

        $isSaveAttribute = $this->saveAttributeValue($insertID, $attributes, $attributeValues, $attributeValuesID);
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

    private function saveAttributeValue($productID, $attributes, $attributeValues, $attributeValuesID)
    {
        $arrAttributeValuesID = explode(',',  $attributeValuesID);

        $productAttributeModel = new ProductAttributeModel();
        $productAttributeModel->delete($arrAttributeValuesID);
        $datas = $this->mergeAttributeWithValue($productID, $attributes, $attributeValues, $attributeValuesID);
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
            $values = explode(',', $attributeValues[$key]);
            foreach ($values as $value) {
                $data[] = [
                    'product_id' => $productID,
                    'attribute_id' => $attribute,
                    'value' => $value
                ];
            }
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
        $upload->cleanImages($images);
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

    public function deleteImage($id = null)
    {
        if ($this->request->getPost('id')) {
            $id = $this->request->getPost('id');
        }
        if (!$id) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }
        //Delete image
        $productImageModel = new ProductImageModel();
        $image = $productImageModel->select('image')->first($id);
        if (!$image) {
            return $this->respond(responseFailed('Không có hình ảnh này'),  Response::HTTP_OK);
        }
        $file = PRODUCT_IMAGE_PATH . $image['image'];
        if (!file_exists($file)) {
            return $this->respond(responseFailed('Hình ảnh không tồn tại'),  Response::HTTP_OK);
        }

        @unlink($file);

        $isDelete = $productImageModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }
}
