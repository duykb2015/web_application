<?= $this->extend('Site/layout') ?>

<?= $this->section('content') ?>

<?= $this->section('banner') ?>

<?php if (isset($banner) && !empty($banner)) : ?>
    <div id="header-carousel" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <?php foreach ($banner as $key => $row) : ?>
                <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>" style="height: 410px;">
                    <img class="img-fluid" src="<?= base_url() ?>\uploads\banner\<?= $row['image'] ?>" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h4 class="text-light text-uppercase font-weight-medium mb-3"><?= $row['name'] ?></h4>
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?= $row['description'] ?></h3>
                            <a href="" class="btn btn-light py-2 px-3">Cửa hàng</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
<?php endif ?>

<?= $this->endSection() ?>

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>

                <h5 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h5>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>

                <h5 class="font-weight-semi-bold m-0">Hoàn trả trong 14 ngày</h5>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>


                <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7 </h5>

            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Sản Phẩm</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="<?= base_url() ?>\eshopper\img\cat-1.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Trang phục nam</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Sản Phẩm</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="<?= base_url() ?>\eshopper\img\cat-2.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Trang phục nam</h5>
            </div>
        </div>

    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="<?= base_url() ?>\eshopper\img\offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">GIẢM GIÁ 20% TẤT CẢ ĐƠN HÀNG</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ sưu tập mùa xuân</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="<?= base_url() ?>\eshopper\img\offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">GIẢM GIÁ 20% TẤT CẢ ĐƠN HÀNG</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ sưu tập mùa đông</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Nổi Bật</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php if (isset($product)) : ?>
            <?php foreach ($product as $key => $row) : ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-2">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $row['slug'] ?>"><img class="img-thumbnail" src="<?= base_url() ?>\uploads\product\<?= $row['image'] ?>" alt=""></a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?= $row['name'] ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6><?= number_format($row['price'], 0, '', ','); ?> VNĐ</h6>
                                <h6 class="text-muted ml-2"><del><?= $row['discount'] ?>%</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $row['slug'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<!-- Products End -->



<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">

        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Mới</span></h2>

    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="<?= base_url() ?>\eshopper\img\product-1.jpg" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                    <div class="d-flex justify-content-center">
                        <h6>$123.00</h6>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<!-- <div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="img/vendor-1.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-2.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-3.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-4.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-5.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-6.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-7.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Vendor End -->

<?= $this->endSection() ?>