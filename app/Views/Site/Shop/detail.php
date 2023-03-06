<?= $this->extend('Site/layout') ?>


<?= $this->section('content') ?>


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi Tiết Sản Phẩm</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= base_url('cua-hang') ?>">Cửa hàng</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Chi Tiết Sản Phẩm</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->


<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <?php if (isset($productImage)) : ?>
                        <?php foreach ($productImage as $key => $row) : ?>
                            <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                                <img class="w-75 h-75" src="<?= base_url() ?>\uploads\product\<?= $row['image'] ?>" alt="Image">
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= $product['name'] ?></h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <!-- <small class="pt-1">(50 Reviews)</small> -->
            </div>
            <div class="d-flex">
                <h3 class="font-weight-semi-bold mb-4"><?= number_format($product['price'] - ($product['price'] * ($product['discount'] / 100))); ?> VNĐ</h3>
                <h3 class="text-muted ml-2"><del><?= number_format($product['price']); ?> VNĐ</del> <?= $product['discount'] ?>%</h3>
            </div>
            <p class="mb-4"><?= $productDescription['information'] ?? '' ?></p>
            <form method="POST" action="<?= base_url('gio-hang/them') ?>">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <?php if (isset($productAttribute)) : ?>
                    <?php foreach ($productAttribute as $row) : ?>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="text-dark font-weight-medium mb-0 mr-3"><?= $row['name'] ?></p>
                            </div>
                            <div class="col-md-9">
                                <select name="attributes[] ?>" class="custom-select">
                                    <?php if (isset($row['value'])) : ?>
                                        <?php foreach ($row['value'] as $key => $item) : ?>
                                            <option value="<?= $key ?>"><?= $item ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" onclick="event.preventDefault()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="quantity" min=1 value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" onclick="event.preventDefault()">

                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row px-xl-5">
    <div class="col">
        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông tin</a>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-pane-1">
                <h4 class="mb-3">Mô tả thông tin sản phẩm</h4>
                <p class="mb-4"><?= $productDescription['description'] ?? '' ?></p>
            </div>
            <div class="tab-pane fade" id="tab-pane-2">
                <p class="mb-4"><?= $productDescription['information'] ?? '' ?></p>
            </div>
            <!-- <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                            <div class="media mb-4">
                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Your Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</div>
</div>

<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Bạn có thể thích</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php if (isset($relatedProduct)) : ?>
                    <?php foreach ($relatedProduct as $item) : ?>
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $item['slug'] ?>">
                                    <img class="img-thumbnail" src="<?= base_url() ?>\uploads\product\<?= $item['image'] ?>" alt="">
                                </a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?= $item['name'] ?></h6>
                                <div class="d-flex justify-content-center">
                                    <?php $price = $item['price'] ?>
                                    <?php $discount = $item['price'] - ($item['price'] * ($item['discount'] / 100)) ?>
                                    <h6><?= number_format($discount); ?> VNĐ</h6>
                                    <h6 class="text-muted ml-2"><del><?= number_format($price); ?> VNĐ</del> <?= $item['discount'] ?>%</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?= base_url('cua-hang/chi-tiet') . '/' . $item['slug'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm giỏ hàng</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>

        </div>
    </div>
</div>
<!-- Products End -->



<?= $this->endSection() ?>