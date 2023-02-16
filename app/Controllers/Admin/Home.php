<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\categoryModel;
use App\Models\ProductItems;
use App\Models\ProductItemsModel;
use App\Models\ProductModel;

class Home extends BaseController
{

    /**
     * Used to view dashboard page
     * 
     */
    public function index()
    {
        $adminModel = new AdminModel();
        // $category_m = new categoryModel();
        // $product_m = new ProductModel();
        // $product_item_m = new ProductItemsModel();

        $totalUsers = count($adminModel->select('id')->findAll());
        // $total_category = count($category_m->select('id')->findAll());
        // $total_product = count($product_m->select('id')->findAll());
        // $total_product_items = count($product_item_m->select('id')->findAll());

        //get total data in table from db
        $datas['totalUsers'] = $totalUsers;
        // $datas['total_category'] = $total_category;
        // $datas['total_product'] = $total_product;
        // $datas['total_product_items'] = $total_product_items;
        return view('Admin/Home/index', $datas);
    }
}
