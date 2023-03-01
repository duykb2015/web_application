<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductCartOptionModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class Cart extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $customerID = session()->get('id');
        $cartModel = new CartModel();
        $cartItems = $cartModel->where('customer_id', $customerID)->findAll();

        $productModel = new ProductModel();
        $productCartOptionModel = new ProductCartOptionModel();
        $productAttributeModel = new ProductAttributeModel();
        if ($cartItems) {
            foreach ($cartItems as $key => $item) {
                $product = $productModel->where('id', $item['product_id'])->first();
                $cart[$key]['id']       = $item['id'];
                $cart[$key]['name']     = $product['name'];
                $cart[$key]['price']    = $product['price'];
                $cart[$key]['discount'] = $product['discount'];
                $cart[$key]['quantity'] = $item['quantity'];

                $cartOption = $productCartOptionModel->where('cart_id', $item['id'])->find();
                foreach ($cartOption as $option) {
                    $productAttribute = $productAttributeModel->where('id', $option['product_attribute_id'])->first();
                    $cart[$key]['option'][] = $productAttribute['value'];
                }
                $cart[$key]['option'] = implode('/', $cart[$key]['option']);
            }
            $data['cart'] = $cart;
        }
        $data['cartTotal'] = $this->cartTotal;
        return view('Site/Cart/index', $data);
    }

    public function add()
    {
        $customerID = session()->get('id');

        $productID = $this->request->getPost('product_id');
        $attributes = $this->request->getPost('attributes');
        $quantity = $this->request->getPost('quantity');

        $data = [
            'customer_id' => $customerID,
            'product_id' => $productID,
            'quantity' => $quantity ?? 1
        ];

        $cartModel = new CartModel();
        $isExist = $cartModel->orWhere('product_id', $productID)->first();
        if ($isExist) {
            //
            return redirect()->to('gio-hang');
        }

        $isSave = $cartModel->insert($data);
        if (!$isSave) {
            return redirect()->to('gio-hang');
        }

        $insertedID = $cartModel->getInsertID();
        $cartOptionModel = new ProductCartOptionModel();

        foreach ($attributes as $attribute) {
            $data = [
                'cart_id' => $insertedID,
                'product_attribute_id' => $attribute
            ];
            $cartOptionModel->insert($data);
        }
        return redirect()->to('gio-hang');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        return $this->respond(responseSuccessed($id),  Response::HTTP_OK);
    }
}
