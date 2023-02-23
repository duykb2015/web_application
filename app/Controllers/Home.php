<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\BannerModel;

class Home extends BaseController
{
    public function index()
    {
        $datas['title'] = 'Home';
        $datas['category'] = $this->getSubCategory();
        $datas['banner']=$this->banner();
        return view('site/home/index', $datas);
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
    public function banner(){
        $bannerModel = new BannerModel();
        //The method is not deprecated, the optional [$upper] parameter is deprecated.
        $banner=$bannerModel->findAll();
        
        return $banner;
    }
}
