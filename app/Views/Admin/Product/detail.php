<?= $this->extend('Admin/layout') ?>
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
                <!-- Page-header end -->
                <!-- Main-body start -->

                <!-- Page-header start -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product edit card start -->
                            <div class="card">
                                <div class="row">
                                    <div class="col-sm-12">
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
                                        <div class="product-edit">
                                            <form class="md-float-material card-block" id="j-forms" action="<?= base_url('dashboard/product/manage/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?= !empty($product['id']) ? $product['id'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên sản phẩm</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên dòng sản phẩm" value="<?= !empty($product['name']) ? $product['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="slug">Slug</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?= !empty($product['slug']) ? $product['slug'] : set_value('slug') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Giá</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave1" min="0" id="price" name="price" placeholder="Giá sản phẩm" value="<?= !empty($product['price']) ? $product['price'] : set_value('price') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="slug">Giảm giá (%)</label>
                                                        <div class="input-group">
                                                            <input type="number" max="100" min="0" class="form-control" name="discount" placeholder="Giảm giá" value="<?= !empty($product['discount']) ? $product['discount'] : set_value('discount') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Số lượng</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave2" min="0" name="quantity" id="quantity" placeholder="Số lượng" value="<?= !empty($product['quantity']) ? $product['quantity'] : set_value('quantity') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="menu_id">Danh mục</label>
                                                        <div class="input-group">
                                                            <select class="form-control" name="category" required>
                                                                <option value="">Danh mục</option>
                                                                <?php if (isset($category)) : ?>
                                                                    <?php foreach ($category as $item) : ?>
                                                                        <?php if (isset($item['subCategory'])) : ?>
                                                                            <optgroup label="<?= $item['name'] ?>">
                                                                                <?php foreach ($item['subCategory'] as $row) : ?>
                                                                                    <option value="<?= $row['id'] ?>" <?= !empty($product['category']) && $product['category'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                                <?php endforeach ?>
                                                                            </optgroup>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control" required>
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($product['status'])  && $product['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Ảnh đại diện sản phẩm</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót. Bức ảnh đầu tiêu sẽ được chọn làm ảnh đại diện!</h6>
                                                        <?php $uri = service('uri');  ?>
                                                        <input type="file" name="images[]" id="filer_input" <?= !empty($uri->getSegment(5)) ? '' : 'required' ?> multiple>
                                                        <?php if (isset($images)) : ?>
                                                            <ul id="product-image" class="jFiler-items-list jFiler-items-default">
                                                                <?php foreach ($images as $image) : ?>
                                                                    <li class="jFiler-item" data-jfiler-index="0" id="img-<?= $image['id'] ?>">
                                                                        <div class="jFiler-item-container">
                                                                            <div class="jFiler-item-inner">
                                                                                <div class="jFiler-item-icon pull-left"><i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i></div>
                                                                                <div class="jFiler-item-info pull-left">
                                                                                    <div class="jFiler-item-title" title="<?= $image['image'] ?>"><a href="<?= base_url('uploads/product/' . $image['image']) ?>" target="_blank" rel="noopener noreferrer"><?= $image['image'] ?></a></div>
                                                                                    <div class="jFiler-item-others"><span><?= get_file_size(PRODUCT_IMAGE_PATH . $image['image'], 2) ?> MB</span><span>type: <?= getimagesize(PRODUCT_IMAGE_PATH . $image['image'])['mime'] ?></span><span class="jFiler-item-status"></span></div>
                                                                                    <div class="jFiler-item-assets">
                                                                                        <ul class="list-inline">
                                                                                            <li><a onclick="delete_image(<?= $image['id'] ?>, '<?= $image['image'] ?>')" class="icon-jfi-trash jFiler-item-trash-action"></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thông tin sản phẩm</h5>
                                                        <small>Nhập các thông tin về sản phẩm, ví dụ như nhà sản xuất, branch ...</small>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="information" id="editor1" required><?= !empty($productDescription['information']) ? $productDescription['information'] : set_value('information') ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Mô tả về sản phẩm</h5>
                                                        <small>Mộ tả về sản phẩm, có thể sử dụng link hình ảnh trong mô tả.</small>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor2" required><?= !empty($productDescription['description']) ? $productDescription['description'] : set_value('description') ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thuộc tính sản phẩm</h5>
                                                        <small>Nhiều giá trị có thể cách nhau bằng dấu phẩy, ví dụ: 34,35,36... <b>Chú ý, không dùng khoảng trắng giữa các giá trị, viết liền sau giấu phẩy</b></small>
                                                    </div>
                                                </div>
                                                <div id="attributes" class="row">
                                                    <?php if (isset($productAttribute)) : ?>
                                                        <input type="hidden" name="product_attribute_id" value="<?= isset($productAttributeID) ? $productAttributeID : '' ?>">
                                                        <?php foreach ($productAttribute as $item) : ?>
                                                            <div class="col-sm-2 pb-2">
                                                                <input type="hidden" name="attributes[]" value="<?= $item['id'] ?>">
                                                                <div class="input-group">
                                                                    <span><?= $item['name'] ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-10 pb-2">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="attribute_values[]" placeholder="<?= $item['name'] ?>" value="<?= $item['value'] ?? '' ?>" required>
                                                                </div>
                                                            </div>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('dashboard/product/manage') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Select 2 js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\cleave\dist\cleave.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\select2\js\select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\jquery.quicksearch.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\advance-elements\select2-custom.js"></script>
<!-- Clone form -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\jquery-cloneya.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\custom\cloned-form.js"></script>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');


    var cleave = new Cleave('.cleave1', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    var cleave2 = new Cleave('.cleave2', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });


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

    $('#remove-alert').on('click', function() {
        $('.alert').remove();
    })

    function delete_image(id, imgName) {
        const is_confirm = confirm(`Bạn muốn xóa hình ảnh "${imgName}" không?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('dashboard/product/manage/delete/image') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`img-${id}`).remove()
                    return true
                }
                console.log(result)

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return false
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>

<?= $this->endSection() ?>