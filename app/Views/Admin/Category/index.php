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
                                    <h4>Danh sách Danh mục</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <!-- table-responsive -->
                        <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td class="align-middle" colspan="7">
                                            <form action="<?= base_url('dashboard/category') ?>" method="get">
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control " value="<?= isset($_GET['category_name']) ? $_GET['category_name'] : '' ?>" name="category_name" placeholder="Nhập tên danh mục để tìm">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="category_parent">
                                                                <option value="0">Danh mục cha</option>
                                                                <?php if (isset($parentCategory)) : ?>
                                                                    <?php foreach ($parentCategory as $item) : ?>
                                                                        <option value="<?= $item['id'] ?>" <?= isset($_GET['category_parent']) && ($_GET['category_parent'] == $item['id']) ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="category_status">
                                                                <option value="">Trạng thái</option>
                                                                <?php foreach (STATUS as $key => $val) : ?>
                                                                    <option value="<?= $key ?>" <?= isset($_GET['category_status']) && $_GET['category_status'] != '' && $_GET['category_status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
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
                                        <th width="20%">Tên</th>
                                        <th width="20%">Danh mục cha</th>
                                        <th width="10%">Trạng thái</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categorys)) : ?>
                                        <?php foreach ($categorys as $row) : ?>
                                            <tr id="category-<?= $row['id'] ?>">
                                                <td class="font-weight-bold"><?= $row['name'] ?></td>
                                                <td><?= isset($row['parent_name']) ? $row['parent_name'] : 'Không có' ?></td>
                                                <td class="">
                                                    <div class="checkbox-fade fade-in-primary ml-3">
                                                        <label class="check-task">
                                                            <input type="checkbox" onclick="return change_status(this, '<?= $row['id'] ?>', '<?= $row['name'] ?>')" <?= $row['status'] == DISPLAY ? 'checked' : '' ?>>
                                                            <span class="cr">
                                                                <i class="cr-icon feather icon-check txt-default"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('dashboard/category/detail/' . $row['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="delete_category('<?= $row['id'] ?>', '<?= $row['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-delete"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">
                                                <p class="card-text text-center">Hiện tại không có danh mục nào</p>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <?php if (isset($pager)) : ?>
                                            <?= $pager->links('default', 'default_full') ?>
                                        <?php endif ?>
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
    <script>
        function change_status(element, id, name) {
            const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của Category "${name}" ?`);
            if (!is_confirm) {
                return false
            }

            const data = new FormData();
            data.append('id', id);
            data.append('status', element.checked ? 1 : 0);
            var requestOptions = {
                method: 'POST',
                body: data,
                redirect: 'follow'
            };

            fetch('<?= base_url('dashboard/category/action-status') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        return true
                    }

                    const error = result.result.error;
                    if (error) {
                        msgbox_error(error)
                        
                        return false
                    }

                })
                .catch(error => {
                    msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!')
                    return false
                });
        }

        function delete_category(id, name) {
            const is_confirm = confirm(`Bạn muốn xóa Category "${name}" ?`);
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

            fetch('<?= base_url('dashboard/category/delete') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        document.getElementById(`category-${id}`).remove()
                        sleep(1)
                        window.location.reload()
                        return
                    }

                    const error = result.result.error;
                    if (error) {
                        msgbox_error(error)
                        return
                    }

                })
                .catch(error => msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!'));
        }
    </script>


    <?= $this->endSection() ?>