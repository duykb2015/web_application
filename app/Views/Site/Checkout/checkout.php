<?= $this->extend('Site/layout') ?>
<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh toán</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thanh toán</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form action="<?= base_url('giao-dich/thanh-toan') ?>" method="post">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <input type="hidden" name="customer_id" value="<?= $customer['id'] ?>">
                    <h4 class="font-weight-semi-bold mb-4">Địa chỉ thanh toán</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ</label>
                            <input class="form-control" type="text" name="firstname" placeholder="FirstName" value="<?= $customer['firstname'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tên</label>
                            <input class="form-control" type="text" name="lastname" placeholder="LastName" value="<?= $customer['lastname'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" placeholder="example@email.com" value="<?= $customer['email'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="telephone" placeholder="Phone" value="<?= $customer['telephone'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ nhận hàng</label>
                            <input class="form-control" type="text" name="address1" placeholder="Address" value="<?= $customer['address1'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ nhận hàng phụ</label>
                            <input class="form-control" type="text" name="address2" placeholder="Address" value="<?= $customer['address2'] ?? '' ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng số đặt hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                        <?php $cartTotal = 0; ?>
                        <?php $cartDiscount = 0; ?>
                        <?php $quantity = 0; ?>
                        <?php foreach ($cartProducts as $item) : ?>
                            <input type="hidden" name="product_id[]" value="<?= $item['product_id'] ?>">
                            <input type="hidden" name="quantity[]" value="<?= $item['quantity'] ?>">
                            <input type="hidden" name="option[]" value="<?= $item['option'] ?>">
                            <div class="d-flex justify-content-between">
                                <p>
                                    <?= $item['productName'] ?>
                                    <br>
                                    <b>Số lượng:</b> <?= $item['quantity'] ?>
                                    <br>
                                    <b>Tuỳ chọn:</b> <?= $item['option'] ?>
                                </p>
                                <p class="text-muted ml-2"><?= $item['productPrice'] ?>Đ</p>
                            </div>
                        <?php endforeach ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tiền hàng(Tạm tính)</h6>
                            <h6 class="font-weight-medium"><?= $checkoutTotal['price'] ?>Đ</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Giảm giá</h6>
                            <h6 class="font-weight-medium"><?= $checkoutTotal['discount'] ?>Đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">10,000Đ</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng tiền</h5>
                            <input type="hidden" name="total" value="<?= $checkoutTotal['discount'] ?>">
                            <h5 class="font-weight-bold"><?= $checkoutTotal['total'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="0" id="paypal">
                                <label class="custom-control-label" for="paypal">Ví MoMo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="1" id="directcheck" checked>
                                <label class="custom-control-label" for="directcheck">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="2" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Thẻ tín dụng/Thẻ ghi nợ</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->
<?= $this->endSection() ?>