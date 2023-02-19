<?= $this->extend('Site/layout') ?>


<?= $this->section('content') ?>
   
    
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên hệ với chúng tôi</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="<?= base_url('') ?>">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Liên hệ</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Liên hệ với bất kỳ câu hỏi nào</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Họ tên"
                                required="required" data-validation-required-message="Vui lòng nhập tên của bạn" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Email"
                                required="required" data-validation-required-message="Vui lòng nhập email của bạn" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Nội dung"
                                required="required" data-validation-required-message="Vui lòng nhập nội dung" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Tin nhắn"
                                required="required"
                                data-validation-required-message="Vui lòng nhập tin nhắn"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Liên lạc</h5>
                <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Chi nhánh 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>180 Cao Lỗ, phường 4, quận 8, TP.HCM</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>duychicken@ga.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>012 345 6789</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Chi nhánh 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>69 Nguyễn Huệ, Bến Nghé, quận 1, TP.HCM</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>luanbird@ga.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>090 090 9090</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?= $this->endSection() ?>