<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
        $product = $pruductModel->where('slug',$slug)->first();
        
        if (!$product) {
            return redirect()->to('cua-hang');
        }
        $productImage=$pruducImagetModel->where('product_id',$product['id'])->find();
        $data['product'] = $product;
        $data['productImage']=$productImage;
        pre($data);
        return view('Site/Shop/detail', $data);
    }
}
