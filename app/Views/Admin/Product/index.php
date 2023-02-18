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
                                    <h4>Danh sách Sản Phẩm</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product list card start -->
                            <div class="card">
                                <div class="table-responsive">
                                    <div class="table-content">
                                        <div class="project-table">
                                            <table class="table  dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <td class="align-middle border-0" colspan="7">
                                                            <form action="<?= base_url('dashboard/product/') ?>" method="get">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm ...">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control" name="category">
                                                                                <option value="">Danh mục</option>
                                                                                <?php if (isset($category)) : ?>
                                                                                    <?php foreach ($category as $item) : ?>
                                                                                        <optgroup label="<?= $item['name'] ?>">
                                                                                            <?php if (isset($item['subCategory'])) : ?>
                                                                                                <?php foreach ($item['subCategory'] as $row) : ?>
                                                                                                    <option value="<?= $row['id'] ?>" <?= !empty($_GET['category']) && $_GET['category'] != '' && $_GET['category'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                                                <?php endforeach ?>
                                                                                        </optgroup>
                                                                                    <?php endif ?>
                                                                                <?php endforeach ?>
                                                                            <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control" name="status">
                                                                                <option value="">Trạng thái</option>
                                                                                <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                                    <option value="<?= $key ?>" <?= !empty($_GET['status']) && $_GET['status'] != '' && $_GET['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1 text-center">
                                                                        <button type="submit" class="btn btn-success">Lọc</button>
                                                                    </div>
                                                                    <div class="col-sm-1 text-center">
                                                                        <a href="<?= base_url('dashboard/category') ?>" class="btn btn-danger">Xoá</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th width="30%" class="text-center">Tên sản phẩm</th>
                                                        <th width="10%" class="text-center">Trạng thái</th>
                                                        <th width="10%" class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($products)) : ?>
                                                        <?php foreach ($products as $product) : ?>
                                                            <tr id="product-<?= $product['id'] ?>">
                                                                <td class="font-weight-bold"><?= $product['name'] ?></th>
                                                                <td width="10%" class="text-center"><?= PRODUCT_STATUS[$product['status']] ?></td>
                                                                <td class="text-center"> <?= $product['created_at'] ?></td>
                                                                <td class="text-center"> <?= $product['updated_at'] ?></td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-sm">
                                                                        <a href="<?= base_url('product-line/detail/' . $product['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                            <span class="icofont icofont-ui-edit"></span>
                                                                        </a>
                                                                        <a href="javascript:void(0)" onclick="delete_product('<?= $product['id'] ?>', '<?= $product['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                            <span class="icofont icofont-ui-delete"></span>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center">Hiện không có sản phẩm nào</td>
                                                        </tr>
                                                    <?php endif ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product list card end -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <?php if (!empty($pager)) : ?>
                                    <?= $pager->links('default', 'default_full') ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?= $this->endSection() ?>

    <?= $this->section('js') ?>

    <script>
        function delete_product(id, name) {
            const is_confirm = confirm(`Bạn muốn xóa dòng sản phẩm "${name}" ?`);
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

            fetch('<?= base_url('product-line/delete') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        document.getElementById(`product-${id}`).remove()
                        return true
                    }

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