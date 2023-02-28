<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Category extends BaseController
{
    public function index()
    {
        $datas['category'] = $this->getSubCategory();
        return view('Site/Shop/index', $datas);
    }
}
