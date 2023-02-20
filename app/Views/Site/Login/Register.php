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
        <?php $error = session()->getFlashdata('error') ?>
                                    <?php if (!empty($error)) : ?>
                                        <div class="alert alert-danger">
                                            <div class="row">
                                                <div class="col-11">
                                                    <?= $error ?>
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
            <div  class="border border-danger p-3  col-md-7 rounded">
                <h5 class="font-weight-bold text-center text-dark mb-4 ">Đăng Ký</h5>
                <div class="alert alert-success success" role="alert" style="display: none;">
                    This is a success alert—check it out!
                </div>
                <div class="alert alert-danger error" role="alert" style="display: none;">
                    This is a success alert—check it out!
                </div>
                <form action="<?= base_url('dang-ky') ?>" method="POST">
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="text" class=" form-control border border-danger py-4 rounded" id="email" placeholder="Your Email" required />
                    </div>
                    <div class="form-group ">
                        <label>Tên tài khoản*</label>
                        <input type="text" class=" form-control border py-4 border-danger rounded" id="username" placeholder="Your UserName" required />
                    </div>
                    <div class="form-group">
                        <label>Họ*</label>
                        <input type="text" class=" form-control border border-danger py-4 rounded" id="firstname" placeholder="Your FirstName" required />
                    </div>
                    <div class="form-group">
                        <label>Tên*</label>
                        <input type="text" class=" form-control border border-danger py-4 rounded" id="lastname" placeholder="Your LastName" required />
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu*</label>
                        <input type="password" class="form-control border border-danger py-4 rounded" id="password" placeholder="Your PassWord" required />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control border border-danger py-4 rounded" id="address1" placeholder="Đia chỉ"  />
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" class="form-control border border-danger py-4 rounded" id="telephone" placeholder="Phone"  />
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
    <script type="text/javascript">
        $('#btnregister').on('click', function() {
            var $username = $('#username').val();
            var $email = $('#email').val();
            var $password = $('#password').val();
            var $firstname = $('#firstname').val();
            var $lastname = $('#lastname').val();
            var $address1 = $('#address1').val();
            var $telephone = $('#telephone').val();


            $.ajax({
                url: "<?php base_url("/dang-ky") ?>",
                type: "POST",
                data:{
                    username:$username,
                    email:$email,
                    password:$password,
                    firstname:$firstname,
                    lastname:$lastname,
                    address1:$address1,
                    telephone:$telephone
                },
                success: function(mess) {
                    var $obj = $.parseJSON(mess);
                    if ($obj.success == false) {
                        $('.success').hide();
                        $('.error').show();
                        $('.error').html($obj.error);
                    } else {
                        $('.error').hide();
                        $('.success').show();
                        $('.success').html($obj.success);
                    }
                }
            });
        });
    </script>
</body>

</html>