<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\BannerModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $datas['title'] = 'Home';
        $datas['category'] = $this->getSubCategory();
        $datas['banner'] = $this->banner();
        $datas['product'] = $this->product();
        $datas['cartTotal'] = $this->cartTotal;
        return view('Site/Home/index', $datas);
    }

    public function getSubCategory()
    {
        $categoryModel = new CategoryModel();

        $category = $categoryModel->where('parent_id = 0 AND status = 1')->findAll();
        $subCategory = $categoryModel->where('parent_id > 0 AND status = 1')->findAll();
        foreach ($category as $key => $item) {
            foreach ($subCategory as $row) {
                if ($row['parent_id'] == $item['id'])
                    $item['subCategory'][]  = $row;
            }
            $category[$key] = $item;
        }

        return $category;
    }

    public function banner()
    {
        $bannerModel = new BannerModel();
        $banner = $bannerModel->findAll();

        return $banner;
    }

    public function product()
    {
        $pruductModel = new ProductModel();
        $product = $pruductModel->where('status >= 1')->findAll();
        return $product;
    }

    public function about()
    {
        return view('Site/About/index');
    }
}
