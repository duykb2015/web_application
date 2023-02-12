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
                                    <h4>Thêm Danh mục</h4>
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
                                    <form id="form-category" action="<?= base_url('dashboard/category/save') ?>" method="POST">
                                        <input type="hidden" name="category_id" value="<?= !empty($category['id']) ? $category['id'] : '' ?>">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="name">Tên danh mục</label>
                                                <div class="input-group">
                                                    <input id="name" type="text" name="name" class="form-control" value="<?= !empty($category['name']) ? $category['name'] : set_value('name') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="slug">Slug</label>
                                                <div class="input-group">
                                                    <input id="slug" type="text" name="slug" class="form-control" value="<?= !empty($category['slug']) ? $category['slug'] : set_value('slug') ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="parent_id">Menu Cha</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="parent_id">
                                                        <option value="0">Không</option>
                                                        <?php if (isset($parent_category)) : ?>
                                                            <?php foreach ($parent_category as $val) : ?>
                                                                <option <?= !empty($category['parent_id']) && $category['parent_id'] == $val['id'] ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="status">Trạng thái</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="status">
                                                        <?php foreach (STATUS as $key => $val) : ?>
                                                            <option <?= !empty($category['status']) && $category['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Lưu</button>
                                                <a href="<?= base_url('dashboard/category') ?>" class="btn btn-default waves-effect">Huỷ</a>
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

<?= $this->section('js') ?>
<script>
    // function slug() {}
    function slug(str) {

        str = str.replace(/^\s+|\s+$/g, "");
        str = str.toLowerCase();

        var from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
        var to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
        for (var i = 0; i < from.length; i++) {
            str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, "-")
            .replace(/-+/g, "-")

        return str
    }

    $('#name').on('input', function() {
        $('#slug').val(slug($(this).val()))
    })
</script>



<?= $this->endSection() ?>