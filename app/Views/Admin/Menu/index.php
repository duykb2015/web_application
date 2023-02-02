<?= $this->extend('layout') ?>


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
                                    <h4>Danh sách Menu</h4>
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
                                            <form action="<?= base_url('menu') ?>" method="get">
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control " value="<?= isset($_GET['menu_name']) ? $_GET['menu_name'] : '' ?>" name="menu_name" placeholder="Nhập tên menu để tìm">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="menu_parent">
                                                                <option value="">Menu cha</option>
                                                                <?php if (isset($parent_menu)) : ?>
                                                                    <?php foreach ($parent_menu as $val) : ?>
                                                                        <option value="<?= $val['id'] ?>" <?= isset($_GET['menu_parent']) && ($_GET['menu_parent'] == $val['id']) ? 'selected' : '' ?>><?= $val['id'] ?></option>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="menu_type">
                                                                <option value="">Loại menu</option>
                                                                <?php foreach (MENU_TYPE as $key => $val) : ?>
                                                                    <option value="<?= $key ?>" <?= isset($_GET['menu_type']) && ($_GET['menu_type'] == $key) ? 'selected' : '' ?>><?= $val ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="menu_status">
                                                                <option value="">Trạng thái</option>
                                                                <?php foreach (STATUS as $key => $val) : ?>
                                                                    <option value="<?= $key ?>" <?= isset($_GET['menu_status']) && $_GET['menu_status'] != '' && $_GET['menu_status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 text-center">
                                                        <button type="submit" class="btn btn-success">Lọc</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th width="20%">Tên</th>
                                        <th width="20%">Phân Loại</th>
                                        <th width="20%">Menu Cha</th>
                                        <th width="10%">Trạng thái</th>
                                        <th width="10%">Ngày tạo</th>
                                        <th width="10%">Ngày cập nhật</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($menu)) : ?>
                                        <?php foreach ($menu as $row) : ?>
                                            <tr id="menu-<?= $row['id'] ?>">
                                                <td class="font-weight-bold"><?= $row['name'] ?></td>
                                                <td><?= MENU_TYPE[$row['type']] ?></td>
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
                                                <td><?= $row['created_at'] ?></td>
                                                <td><?= $row['updated_at'] ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('menu/detail/' . $row['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="delete_menu('<?= $row['id'] ?>', '<?= $row['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-delete"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">
                                                <p class="card-text text-center">Hiện tại không có menu nào</p>
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
            const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của Menu "${name}" ?`);
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

            fetch('<?= base_url('menu/action-status') ?>', requestOptions)
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

        function delete_menu(id, name) {
            const is_confirm = confirm(`Bạn muốn xóa Menu "${name}" ?`);
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

            fetch('<?= base_url('menu/delete') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        document.getElementById(`menu-${id}`).remove()
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