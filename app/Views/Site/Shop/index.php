<?= $this->extend('Site/layout') ?>


<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">

        <h1 class="font-weight-semi-bold text-uppercase mb-3">Cửa hàng</h1>

        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= base_url() ?>">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Cửa hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">

                <h5 class="font-weight-semi-bold mb-4">Lọc theo giá bán</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">Tất cả giá bán</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>

                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">

                <h5 class="font-weight-semi-bold mb-4">Lọc theo màu sắc</h5>

                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">Tất cả màu sắc</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>

                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <div class="mb-5">

                <h5 class="font-weight-semi-bold mb-4">Lọc theo kích cỡ</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">Tất cả Size</label>

                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                </form>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">

                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sắp xếp theo
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Mới nhất</a>
                                <a class="dropdown-item" href="#">Phổ biến</a>
                                <a class="dropdown-item" href="#">Thịnh hành</a>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($product)) : ?>
                    <?php foreach ($product as $key => $row) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $row['slug'] ?>">
                                        <img class="img-fluid w-100" src="<?= base_url('uploads/product') . '/' . $row['image'] ?>" alt=""></a>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?= $row['name'] ?></h6>

                                    <div class="d-flex justify-content-center">
                                        <h6><?= number_format($row['price'] - ($row['price'] * ($row['discount'] / 100))); ?> VNĐ</h6>
                                        <h6 class="text-muted ml-2"><del><?= number_format($row['price']); ?> VNĐ</del> <?= $row['discount'] ?>%</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center bg-light border">
                                    <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $row['slug'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Trước</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Sau</span>

                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
<?= $this->endSection() ?>