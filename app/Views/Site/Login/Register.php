<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\eshopper\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\eshopper\css\style.min.css">
    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>/eshopper/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>/eshopper/css/style.css" rel="stylesheet">

</head>

<body>




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
                    <a class="text-dark px-2" href="">
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
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?= base_url('') ?>" class="nav-item nav-link active">Trang chủ</a>
                        <a href="<?= base_url('shop') ?>" class="nav-item nav-link">Cửa hàng</a>
                        <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="<?= base_url('cart') ?>" class="dropdown-item">Shopping Cart</a>
                                    <a href="<?= base_url('checkout') ?>" class="dropdown-item">Checkout</a>
                                </div>
                            </div> -->
                        <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Liên hệ</a>
                    </div>
                </nav>
                <?= $this->renderSection('banner') ?>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <div class="container ">

        <div class=" col-md-12 mb-5 d-flex justify-content-center">

            <div class="border border-primary p-3  col-md-7 rounded">
                <h4 class="font-weight-bold text-center text-dark mb-5 ">Đăng Ký</h4>
                <div class="col-12 mb-3">
                    <?php $errors = session()->getFlashdata('error_msg') ?>
                    <?php if (!empty($errors)) :  ?>
                        <?php if (!is_array($errors)) : ?>
                            <div class="alert alert-danger mb-1">
                                <?= $errors ?>
                            </div>
                        <?php else : ?>
                            <?php foreach ($errors as $error) : ?>
                                <div class="alert alert-danger mb-1">
                                    <?= $error ?>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                <form action="<?= base_url('dang-ky') ?>" method="POST">
                    <div class="form-group">
                        <label class="font-weight-bold">Email<span class="text-danger">*</span></label>
                        <input type="email" class=" form-control border border-primary py-4 rounded" name="email" value="<?= set_value('email') ?>" placeholder="Nhập Email" required />
                    </div>
                    <div class="form-group ">
                        <label class="font-weight-bold">Tên tài khoản<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border py-4 border-primary rounded" name="username" placeholder="Nhập tên tài khoản" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Họ<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border border-primary py-4 rounded" name="firstname" placeholder="Nhập họ" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Tên<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border border-primary py-4 rounded" name="lastname" placeholder="Nhập tên" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Mật khẩu<span class="text-danger">*</span></label>
                        <input type="password" class="form-control border border-primary py-4 rounded" name="password" placeholder="Nhập mật khẩu" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Địa chỉ 1</label>
                        <input type="text" class="form-control border border-primary py-4 rounded" name="address1" placeholder="Nhập Đia chỉ 1" />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Địa chỉ 2</label>
                        <input type="text" class="form-control border border-primary py-4 rounded" name="address2" placeholder="Nhập Đia chỉ 2" />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Số điện thoại<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control border border-primary py-4 rounded" name="telephone" placeholder="Số điện thoại, ít nhất 9 kí tự" required />
                    </div>
                    <div class="p-2 ">
                        <button class="btn btn-primary btn-block border-0 py-3 rounded" type="submit" id="btnregister">Đăng Ký</button>
                    </div>
                    <div class="p-1">
                        <a href="<?= base_url('dang-nhap') ?>" class="btn btn-outline-secondary btn-block border-0 py-3 text-dark rounded" type="submit">Đăng Nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?= $this->include("Site/footer") ?>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>\eshopper\lib\easing\easing.min.js"></script>
    <script src="<?= base_url() ?>\eshopper\lib\owlcarousel\owl.carousel.min.js"></script>


    <!-- Contact Javascript File -->

    <script src="<?= base_url() ?>\eshopper\mail\jqBootstrapValidation.min.js"></script>
    <script src="<?= base_url() ?>\eshopper\mail\contact.js"></script>


    <!-- Template Javascript -->
    <script src="<?= base_url() ?>\eshopper\js\main.js"></script>
</body>

</html>