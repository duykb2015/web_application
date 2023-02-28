<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductDescriptionModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;

class Shop extends BaseController
{
    public function index()
    {
        $datas['category'] = $this->getSubCategory();
        $datas['product'] = $this->product();
        return view('Site/Shop/index', $datas);
    }
    public function product()
    {
        $pruductModel = new ProductModel();
        $product = $pruductModel->where('status = 1')->findAll();

        return $product;
    }
    public function detail()
    {
        $slug = $this->request->getUri()->getSegment(3);
        $productModel = new ProductModel();
        $producImagetModel = new ProductImageModel();
        $productDescriptionModel = new ProductDescriptionModel();
        $productAttributeModel = new ProductAttributeModel();

        $product = $productModel->where('slug', $slug)->first();
        if (!$product) {
            return redirect()->to('cua-hang');
        }

        $relatedProduct = $productModel->where(['id <>' => $product['id'], 'category' => $product['category']])->limit(4, 0)->findAll();

        $productImage = $producImagetModel->where('product_id', $product['id'])->find();


        $productDescription = $productDescriptionModel->where('product_id', $product['id'])->find();

        $productAttribute = $productAttributeModel->where('product_id', $product['id'])->find();

        $data['product'] = $product;
        $data['relatedProduct'] = $relatedProduct;
        $data['productImage'] = $productImage;
        $data['productDescription'] = $productDescription;
        $data['productAttribute'] = $productAttribute;
        return view('Site/Shop/detail', $data);
    }
}
