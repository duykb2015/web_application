<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <?php $error = session()->getFlashdata('error_msg') ?>
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
                                    <form id="form-menu" action="<?= base_url('dashboard/product/attribute/save') ?>" method="POST">
                                        <input type="hidden" name="product_attribute_id" value="<?= isset($product_attribute['id']) ? $product_attribute['id'] : '' ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên;</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" value="<?= isset($product_attribute['name']) ? $product_attribute['name'] : set_value('name') ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                    <?php foreach (STATUS as $key => $val) : ?>
                                                        <option <?= isset($product_attribute['status']) && $product_attribute['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0">Lưu</button>
                                                <a href="<?= base_url('dashboard/product/attribute') ?>" class="btn btn-default waves-effect">Huỷ</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>