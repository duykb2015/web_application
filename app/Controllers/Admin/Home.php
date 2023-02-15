<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\CategoryModel;
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
        $admin_m = new AdminModel();
        $category_m = new CategoryModel();
        // $product_m = new ProductModel();
        // $product_item_m = new ProductItemsModel();

        $total_users = count($admin_m->select('id')->findAll());
        $total_category = count($category_m->select('id')->findAll());
        // $total_product = count($product_m->select('id')->findAll());
        // $total_product_items = count($product_item_m->select('id')->findAll());

        //get total data in table from db
        $datas['total_users'] = $total_users;
        $datas['total_category'] = $total_category;
        // $datas['total_product'] = $total_product;
        // $datas['total_product_items'] = $total_product_items;
        return view('Admin/Home/index',$datas);
    }
}
