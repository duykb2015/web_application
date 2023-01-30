<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Example as ModelsExample;

class Example extends BaseController
{
    public function index()
    {
        $exampleModel = new ModelsExample();
        $data['value'] = $exampleModel->text;
        return view('admin/home/index', $data);
    }
}
