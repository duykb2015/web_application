<?= $this->extend('Site/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi tiết đơn hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Chi tiết đơn hàng</p>
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
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (isset($order) && !empty($order)) : ?>
                        <?php foreach ($order as $item) : ?>
                            <tr>
                                <td class="align-middle">
                                    <span class="font-weight-bold"><a href="<?= base_url('cua-hang/chi-tiet') . '/' . $item['slug'] ?>"><?= $item['name'] ?></a></span><br>
                                    <small><?= $item['option'] ?></small>
                                </td>
                                <td class="align-middle">
                                    <?php $price = $item['price'] - ($item['price'] * ($item['discount'] / 100)) ?>
                                    <?= number_format($price) ?>Đ
                                    <span style="text-decoration: line-through;"><?= number_format($item['price']) ?>Đ</span>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <?= $item['quantity'] ?>
                                    </div>
                                </td>
                                <td class="align-middle"><?= number_format($item['quantity'] * $price) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
                    <?php endif ?>
                </tbody>

            </table>
        </div>

        <div class="col-lg-4">

            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium"><?= $order[0]['shipping_to'] ?></h6>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('giao-dich/lich-su-mua') ?>"><button class="btn btn-block btn-primary my-3 py-3">Quay lại</button></a>

        </div>

    </div>
</div>
<!-- Cart End -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- notification js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\bootstrap-growl.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.js"></script>

<?= $this->endSection() ?>