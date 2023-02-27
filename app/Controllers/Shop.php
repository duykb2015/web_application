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
        return view('Site/Shop/index', $datas);
    }
    public function detail()
    {
        $slug = $this->request->getUri()->getSegment(3);
        //$datas['category'] = $this->getSubCategory();
        $pruductModel = new ProductModel();
        $pruducImagetModel = new ProductImageModel();
        $productDescriptionModel = new ProductDescriptionModel();
        $productAttributeModel = new ProductAttributeModel();
        $categoryModel = new CategoryModel();
        $attributeModel = new AttributeModel();

        $product = $pruductModel->where('slug',$slug)->first();
        
        if (!$product) {
            return redirect()->to('cua-hang');
        }
        // $attribute=$attributeModel->find();
        $productImage=$pruducImagetModel->where('product_id',$product['id'])->find();

        $productDescription=$productDescriptionModel->where('product_id',$product['id'])->find();

        $productAttribute=$productAttributeModel->where('product_id',$product['id'])->find();

        $data['attributes'] = $attributeModel->findAll();
        $data['product'] = $product;
        $data['productImage']=$productImage;
        $data['productDescription']=$productDescription;
        $data['productAttribute']=$productAttribute;
        // pre($data);
        return view('Site/Shop/detail', $data);
    }
}
