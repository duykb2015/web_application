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
        $datas['cartTotal'] = $this->cartTotal;
        return view('Site/Shop/index', $datas);
        
    }
    public function product()
    {
        $pruductModel = new ProductModel();
        $product = $pruductModel->where('status >= 1')->findAll();
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
        $productDescription = $productDescriptionModel->where('product_id', $product['id'])->first();

        $attributeModel = new AttributeModel();
        $attributes = $attributeModel->orderBy('id', 'ASC')->findAll();
        $productAttributes = $productAttributeModel->where('product_id', $product['id'])->find();
        foreach ($attributes as $key => $item) {
            $attribute[$key]['id'] = $item['id'];
            $attribute[$key]['name'] = $item['name'];
            foreach ($productAttributes as $row) {
                if ($row['attribute_id'] == $item['id']) {
                    $value[$key][$row['id']] = $row['value'];
                }
            }
            $attribute[$key]['value'] =  $value[$key];
        }

        $data['product'] = $product;
        $data['relatedProduct'] = $relatedProduct;
        $data['productImage'] = $productImage;
        $data['productDescription'] = $productDescription;
        $data['productAttribute'] = $attribute;
        $data['cartTotal'] = $this->cartTotal;

        return view('Site/Shop/detail', $data);
    }


}
