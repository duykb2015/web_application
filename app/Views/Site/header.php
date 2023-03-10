    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Hỗ trợ</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="<?= base_url('') ?>" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
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
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="<?= base_url('giao-dich/lich-su-mua') ?>" class="btn border">
                    <i class="text-primary fa fa-truck" aria-hidden="true"></i>
                </a>
                <a href="<?= base_url('gio-hang') ?>" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"><?= $cartTotal ?? 0 ?></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">

                    <h6 class="m-0">Danh Mục Sản Phẩm</h6>

                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav <?= uri_string() != '/' ? 'style="width: calc(100% - 30px);"' : '' ?> class="<?= uri_string() == '/' ? 'collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 ' : 'collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light' ?>" id="navbar-vertical">

                    <div class="navbar-nav w-100 overflow-hidden">
                        <?php
                        if (isset($category)) :
                        ?>
                            <?php foreach ($category as $item) : ?>
                                <div class="nav-item dropdown">
                                    <a href="<?= base_url('cua-hang?danh-muc=') . $item['slug'] ?>" class="nav-link" data-toggle="dropdown"><?= $item['name'] ?><i class="fa fa-angle-down float-right mt-1"></i></a>
                                    <?php if (isset($item['subCategory']) && !empty($item['subCategory'])) : ?>

                                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                            <?php foreach ($item['subCategory'] as $row) : ?>
                                                <a href="<?= base_url('cua-hang?danh-muc=') . $row['slug'] ?>" class="dropdown-item"><?= $row['name'] ?></a>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>

                                </div>
                            <?php endforeach ?>
                        <?php endif ?>

                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= base_url('') ?>" class="nav-item nav-link <?= url_is('') ? 'active' : '' ?>">Trang chủ</a>
                            <a href="<?= base_url('cua-hang') ?>" class="nav-item nav-link <?= url_is('cua-hang*') ? 'active' : '' ?>">Cửa hàng</a>
                            <a href="<?= base_url('ve-chung-toi') ?>" class="nav-item nav-link <?= url_is('ve-chung-toi*') ? 'active' : '' ?>">Về chúng tôi</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php $user = session()->get() ?>
                            <?php if (isset($user['isLogin']) && $user['isLogin']) : ?>
                                <a href="<?= base_url('ca-nhan/chi-tiet') ?>" class="nav-item nav-link"><?= $user['name'] ?></a>
                                <a href="<?= base_url('dang-xuat') ?>" onclick="return confirm('Bạn có thật sự muốn thoát?')" class="nav-item nav-link">Thoát</a>
                            <?php else : ?>
                                <a href="<?= base_url('dang-nhap') ?>" class="nav-item nav-link">Đăng nhập</a>
                                <a href="<?= base_url('dang-ky') ?>" class="nav-item nav-link">Đăng ký</a>
                            <?php endif ?>
                        </div>
                    </div>
                </nav>
                <?= $this->renderSection('banner') ?>
            </div>
        </div>
    </div>
    <!-- Navbar End -->