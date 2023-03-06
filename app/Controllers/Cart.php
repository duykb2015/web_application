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
        $customerID = session()->get('user_id');
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

    public function addProductToCart()
    {
        $customerID = session()->get('user_id');

        $productID = $this->request->getPost('product_id');
        $attributes = $this->request->getPost('attributes');
        $quantity = $this->request->getPost('quantity');

        $data = [
            'customer_id' => $customerID,
            'product_id' => $productID,
            'quantity' => $quantity ?? 1
        ];

        $cartModel = new CartModel();
        $isExist = $cartModel->where(['product_id' => $productID, 'customer_id' => $customerID])->first();
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

    public function updateProductCart()
    {
        $cartID = $this->request->getPost('id');
        if (!$cartID) {
            return $this->respond(responseFailed('Không có sản phẩm này trong giỏ hàng'),  Response::HTTP_OK);
        }
        $quantity = $this->request->getPost('quantity' . $cartID);

        if ($quantity <= 0) {
            $quantity = 1;
        }

        if ($quantity > 100) {
            $quantity = 100;
        }
        $cartModel = new CartModel();
        $isUpdated = $cartModel->update($cartID, ['quantity' => $quantity]);
        if (!$isUpdated) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }

        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }

    public function delete()
    {
        $cartID = $this->request->getPost('id');
        if (!$cartID) {
            return $this->respond(responseFailed('Không có sản phẩm này trong giỏ hàng'),  Response::HTTP_OK);
        }
        $productCartOptionModel = new ProductCartOptionModel();
        $isDeleted = $productCartOptionModel->where('cart_id', $cartID)->delete();
        if (!$isDeleted) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }

        $cartModel = new CartModel();
        $isDeleted = $cartModel->delete($cartID);
        if (!$isDeleted) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }
}
