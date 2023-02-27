<?= $this->extend('Site/layout') ?>

<?= $this->section('content') ?>

<div class="container ">
    <div class=" col-md-12 mb-5 d-flex justify-content-center">

        <div class="border border-primary p-3  col-md-7 rounded">
            <h4 class="font-weight-bold text-center text-dark mb-5 ">Thông Tin Cá Nhân</h4>
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
            <?php if (isset($customer)) : ?>
                <form action="<?= base_url('ca-nhan/chi-tiet') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bold">Email<span class="text-danger">*</span></label>
                        <input type="email" class=" form-control border border-primary py-4 rounded" name="email" value="<?= $customer['email'] ?>" required>

                    </div>
                    <div class="form-group ">
                        <label class="font-weight-bold">Tên tài khoản<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border py-4 border-primary rounded" value="<?= $customer['username'] ?>" disabled required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Họ<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border border-primary py-4 rounded" name="firstname" value="<?= $customer['firstname'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Tên<span class="text-danger">*</span></label>
                        <input type="text" class=" form-control border border-primary py-4 rounded" name="lastname" value="<?= $customer['lastname'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Mật khẩu<span class="text-danger">*</span></label>
                        <input type="password" class="form-control border border-primary py-4 rounded" name="password" placeholder="Để trống nếu không thay đổi mật khẩu."  />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Số điện thoại<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control border border-primary py-4 rounded" name="telephone" value="<?= $customer['telephone'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Địa chỉ 1</label>
                        <input type="text" class="form-control border border-primary py-4 rounded" name="address1" value="<?= $customer['address1'] ?>" placeholder="Trống." required />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Địa chỉ 2</label>
                        <input type="text" class="form-control border border-primary py-4 rounded" name="address2" value="<?= $customer['address2'] ?>" placeholder="Trống." />
                    </div>
                    <div class="p-2 ">
                        <button class="btn btn-primary btn-block border-0 py-3 rounded"  type="submit" id="btnUpdate">Chỉnh sửa</button>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>