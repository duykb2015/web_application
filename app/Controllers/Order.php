<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CustomerModel;
use App\Models\OrdersModel;
use App\Models\OrdersProductModel;
use App\Models\ProductAttributeModel;
use App\Models\ProductCartOptionModel;
use App\Models\ProductModel;

class Order extends BaseController
{
    public function index()
    {
        $customerID = session()->get('user_id');
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->where('customer_id', $customerID)->findAll();
        $data['orders'] = $orders;
        return view('Site/Checkout/index', $data);
    }
    public function detail()
    {
        $orderID = $this->request->getUri()->getSegment(4);
        $ordersModel = new OrdersModel();
        $order = $ordersModel->getOrderDetail($orderID);

        // pre($order);
        $data['order'] = $order;
        return  view('Site/Checkout/detail', $data);
    }
    public function checkout()
    {
        $customerModel          = new CustomerModel();
        $cartModel              = new CartModel();
        $productModel           = new ProductModel();
        $productCartOptionModel = new ProductCartOptionModel();
        $productAttributeModel  = new ProductAttributeModel();
        $cartProducts = [];
        $checkoutTotal = [
            'price' => 0,
            'discount' => 0,
            'total' => 0
        ];

        $customerID   = session()->get('user_id');
        $customer     = $customerModel->where('id', $customerID)->first();
        $cartItems    = $cartModel->where('customer_id', $customerID)->findAll();
        if (!$cartItems) {
            return redirect()->to('gio-hang');
        }

        foreach ($cartItems as $key => $item) {
            //Get product
            $product = $productModel->where('id', $item['product_id'])->first();
            $price = $product['price'];
            $discount = ($product['price'] * ($product['discount'] / 100));
            //Transform data
            $cartProducts[$key] = $item;
            $cartProducts[$key]['productName'] = $product['name'];
            $cartProducts[$key]['productPrice'] = number_format($price);
            $cartProducts[$key]['productDiscount'] = number_format($discount);

            //Get cart product option
            $cartOption = $productCartOptionModel->where('cart_id', $item['id'])->find();
            foreach ($cartOption as $option) {
                $productAttribute = $productAttributeModel->where('id', $option['product_attribute_id'])->first();
                $cartProducts[$key]['option'][] = $productAttribute['value'];
            }
            $cartProducts[$key]['option'] = implode('/', $cartProducts[$key]['option']);

            //Caculate checkout total
            $checkoutTotal['price'] += $price * $item['quantity'];
            $checkoutTotal['discount'] += $discount * $item['quantity'];
        }

        $checkoutTotal['total'] = number_format($checkoutTotal['price'] - $checkoutTotal['discount'] + 10000);
        $checkoutTotal['price'] = number_format($checkoutTotal['price']);
        $checkoutTotal['discount'] = number_format($checkoutTotal['discount']);

        $data['customer']  = $customer;
        $data['cartTotal'] = $this->cartTotal;
        $data['cartProducts']  = $cartProducts;
        $data['checkoutTotal']  = $checkoutTotal;
        return view('Site/Checkout/checkout', $data);
    }

    public function processCheckout()
    {
        $customerID = $this->request->getPost('customer_id');
        $firstname  = $this->request->getPost('firstname');
        $lastname   = $this->request->getPost('lastname');
        $name       = $firstname . ' ' . $lastname;
        $email      = $this->request->getPost('email');
        $telephone  = $this->request->getPost('telephone');
        $address1   = $this->request->getPost('address1');
        $address2   = $this->request->getPost('address2') ?? '';
        $payment    = $this->request->getPost('payment');
        $total      = $this->request->getPost('total');

        $productID  = $this->request->getPost('product_id');
        $quantity   = $this->request->getPost('quantity');
        $option     = $this->request->getPost('option');

        $shippingTo = "<b>Tên khách hàng:</b> $name<br><b>Email:</b> $email <br><b>Số điện thoại:</b> $telephone<br><b>Địa chỉ giao hàng:</b> $address1<br><b>Địa chỉ phụ:</b> $address2";

        $data = [
            'customer_id'    => $customerID,
            'customer_name'  => $name,
            'payment_method' => $payment,
            'shipping_to'    => $shippingTo,
            'total'          => $total,
            'status'         => 0
        ];

        $odersModel = new OrdersModel();
        $isInserted = $odersModel->insert($data);
        if (!$isInserted) {
            return redirect()->to('giao-dich/thanh-toan');
        }

        $insertedID = $odersModel->getInsertID();
        unset($data);
        $ordersProductModel = new OrdersProductModel();
        foreach ($productID as $key => $item) {
            $data = [
                'orders_id'  => $insertedID,
                'product_id' => $item,
                'quantity'   => $quantity[$key],
                'option'     => $option[$key]
            ];
            $isInserted = $ordersProductModel->insert($data);
            if (!$isInserted) {
                return redirect()->to('giao-dich/thanh-toan');
            }
        }

        $cartModel = new CartModel();

        $carts = $cartModel->where('customer_id', $customerID)->findAll();
        $productCartOptionModel = new ProductCartOptionModel();
        foreach ($carts as $item) {
            $productCartOptionModel->where('cart_id', $item['id'])->delete();
        }

        $cartModel->where('customer_id', $customerID)->delete();
        return redirect()->to('giao-dich/lich-su-mua');
    }
}
