<?= $this->extend('Site/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $cartTotal = 0; ?>
                    <?php $cartDiscount = 0; ?>
                    <?php $quantity = 0; ?>
                    <?php $cartFinal = 0; ?>
                    <?php if (isset($cart) && !empty($cart)) : ?>
                        <?php foreach ($cart as $item) : ?>
                            <?php $price = $item['price'] ?>
                            <?php $quantity += $item['quantity'] ?>
                            <?php $cartTotal += ($price * $item['quantity']); ?>
                            <?php $discount = $item['price'] * ($item['discount'] / 100) ?>
                            <?php $cartDiscount += $discount * $quantity; ?>
                            <?php $cartFinal += (($price - $discount) * $item['quantity']); ?>

                            <tr id="cart-<?= $item['id'] ?>">
                                <td class="align-middle">
                                    <span class="font-weight-bold"><?= $item['name'] ?></span><br>
                                    <small><?= $item['option'] ?></small>
                                </td>
                                <td class="align-middle">
                                    <?= number_format($price - $discount) ?>Đ <span style="text-decoration-line: line-through"><?= number_format($price) ?>Đ</span>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <!-- <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div> -->
                                        <input type="text" id="quantity<?= $item['id'] ?>" oninput="update_product(<?= $item['id'] ?>)" min="1" max="100" class="form-control form-control-sm bg-secondary text-center" value="<?= $item['quantity'] ?>">
                                        <!-- <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div> -->
                                    </div>
                                </td>
                                <td class="align-middle"><?= number_format(($price - $discount) * $item['quantity']) ?>Đ</td>
                                <td class="align-middle"><button class="btn btn-sm btn-primary" onclick="delete_product(<?= $item['id'] ?>, '<?= $item['name'] ?>')"><i class="fa fa-times"></i></button></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
                    <?php endif ?>
                </tbody>

            </table>
        </div>

        <div class="col-lg-4">
            <!-- <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Áp dụng</button>
                    </div>
                </div>
            </form> -->
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Giỏ hàng</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Tiền hàng</h6>
                        <h6 class="font-weight-medium"><?= number_format($cartTotal) ?>Đ</h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Giảm giá</h6>
                        <h6 class="font-weight-medium"><?= number_format($cartDiscount) ?>Đ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Vận chuyển</h6>
                        <h6 class="font-weight-medium">10,000Đ</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng tiền</h5>
                        <h5 class="font-weight-bold"><?= number_format($cartFinal + 10000) ?>Đ</h5>
                    </div>
                    <a href="<?= base_url('giao-dich/thanh-toan') ?>"><button class="btn btn-block btn-primary my-3 py-3">Thanh toán </button></a>
                </div>
            </div>
            <a href="<?= base_url('cua-hang') ?>"><button class="btn btn-block btn-success my-3 py-3">Tiếp tục mua hàng</button></a>
        </div>

    </div>
</div>
<!-- Cart End -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- notification js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\bootstrap-growl.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.js"></script>

<script>
    function update_product(id) {
        const quantity = document.getElementById(`quantity${id}`).value;
        const data = new FormData();
        data.append('id', id);
        data.append(`quantity${id}`, quantity)
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('gio-hang/sua') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1500);

                    return true
                }
                console.log(result)

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return false
                }

            })
            .catch(error => msgbox_error(error));
    }

    function delete_product(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa sản phẩm "${name}" ?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('gio-hang/xoa') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                    return true
                }
                console.log(result)

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return false
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>
<?= $this->endSection() ?>