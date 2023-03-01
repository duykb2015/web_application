<?= $this->extend('Site/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Đơn đặt hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đơn đặt hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Mã đơn đặt hàng</th>
                        <th>Tên người mua</th>
                        <th>Loại thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (isset($orders) && !empty($orders)) : ?>
                        <?php foreach ($orders as $item) : ?>
                            <tr>
                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    <span class="font-weight-bold"><?= $item['id'] ?></span>
                                </td>
                                <td>
                                    <span class="font-weight-bold">
                                        <?= $item['customer_name'] ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <?= PAYMENT_METHOD[$item['payment_method']] ?>
                                </td>
                                <td class="align-middle">
                                    <?= CHECKOUT_STATUS[$item['status']] ?>
                                </td>
                                <td class="align-middle"><a href="<?= base_url('giao-dich/lich-su-mua/chi-tiet') . '/' . $item['id'] ?>" class="btn btn-sm btn-primary">Xem</button></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <td colspan="5">Không có lịch sử giao dịch.</td>
                    <?php endif ?>
                </tbody>
            </table>
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

</script>
<?= $this->endSection() ?>