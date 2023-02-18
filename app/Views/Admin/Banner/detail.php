<?= $this->extend('admin/layout') ?>
<?= $this->section('css') ?>
<!-- Select 2 css -->
<link rel="stylesheet" href="<?= base_url() ?>\templates\libraries\bower_components\select2\css\select2.min.css">

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        background-color: white !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #01a9ac !important;
    }

    .hexcode {
        padding-top: 22px;
        padding-bottom: 21px;
    }
</style>
<?= $this->endSection() ?>
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
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="product-edit">

                                            <div class="row">
                                                <div class="col-sm-12">
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
                                                    <?php $success = session()->getFlashdata('success_msg') ?>
                                                    <?php if (!empty($success)) : ?>
                                                        <div class="alert alert-primary">
                                                            <div class="row">
                                                                <div class="col-11">
                                                                    <?= $success ?>
                                                                </div>
                                                                <div class="col-1 text-right">
                                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>

                                            <form class="md-float-material card-block " action="<?= base_url('dashboard/banner/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="banner_id" value="<?= !empty($banner['id']) ? $banner['id'] : '' ?>">
                                                <div class="d-inline ">
                                                    <h5 class="mb-3">Thông tin banner</h5>
                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <label for="name">Tên banner</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên của banner" value="<?= !empty($banner['name']) ? $banner['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="color">Mô tả Banner</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="description" placeholder="Mô tả hiển thị trên trang chủ" value="<?= !empty($banner['description']) ? $banner['description'] : set_value('description') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="price">Banner Link</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="link" placeholder="Đường dẫn của banner tới trang nào đó" value="<?= !empty($banner['link']) ? $banner['link'] : set_value('link') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control">
                                                            <?php foreach (STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($banner['link']) && $banner['link'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Tải lên hình ảnh banner</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót</h6>
                                                        <?php $uri = service('uri');  ?>
                                                        <input type="file" name="image" id="filer_input" <?= !empty($uri->getSegment(4)) ? '' : 'required' ?>>
                                                        <?php if (isset($banner)) : ?>
                                                            <ul id="banner-image" class="jFiler-items-list jFiler-items-default">
                                                                <li class="jFiler-item" data-jfiler-index="0">
                                                                    <div class="jFiler-item-container">
                                                                        <div class="jFiler-item-inner">
                                                                            <div class="jFiler-item-icon pull-left"><i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i></div>
                                                                            <div class="jFiler-item-info pull-left">
                                                                                <div class="jFiler-item-title" title="<?= $banner['image'] ?>"><a href="<?= base_url('uploads/banner/' . $banner['image']) ?>" target="_blank" rel="noopener noreferrer"><?= $banner['image'] ?></a></div>
                                                                                <div class="jFiler-item-others"><span><?= get_file_size(BANNER_IMAGE_PATH . $banner['image'], 2) ?> MB</span><span>type: <?= getimagesize(BANNER_IMAGE_PATH . $banner['image'])['mime'] ?></span><span class="jFiler-item-status"></span></div>
                                                                                <div class="jFiler-item-assets">
                                                                                    <ul class="list-inline">
                                                                                        <li><a onclick="delete_image()" class="icon-jfi-trash jFiler-item-trash-action"></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('dashboard/banner') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Product edit card end -->

                                    </div>

                                    <!-- Main-body end -->

                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->
                    </div>

                    <!-- Page body start -->
                    <!-- Page body end -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\select2\js\select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\advance-elements\select2-custom.js"></script>
<!-- Clone form -->
<script>
    function delete_image() {
        const is_confirm = confirm(`Bạn có chắc muốn xóa ảnh này ?`);
        if (!is_confirm) {
            return
        }

        document.getElementById(`banner-image`).remove()
        return true

    }
</script>
<?= $this->endSection() ?>