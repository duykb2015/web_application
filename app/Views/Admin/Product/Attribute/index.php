<?= $this->extend('admin/layout') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\data-table\css\buttons.dataTables.min.css">
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
                                    <h4>Danh sách thuộc tính sản phẩm</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <!-- Extra Large table start -->


                    <div class="card">


                        <!-- <div class="card-block"> -->
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <td class="align-middle" colspan="7">
                                            <form action="<?= base_url('dashboard/product/attribute') ?>" method="GET">
                                                <div class="row">

                                                    <div class="col-sm-5">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="<?= isset($_GET['attribute_name']) ? $_GET['attribute_name'] : '' ?>" name="attribute_name" placeholder="Nhập tên thuộc tính để tìm">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">

                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="attribute_status">
                                                                <option value="">Trạng thái</option>
                                                                <?php foreach (STATUS as $key => $val) : ?>
                                                                    <option value="<?= $key ?>" <?= isset($_GET['attribute_status']) && $_GET['attribute_status'] != '' && $_GET['attribute_status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 text-center">
                                                        <button type="submit" class="btn btn-success">Lọc</button>
                                                    </div>
                                                    <div class="col-sm-1 text-center">
                                                        <a href="<?= base_url('dashboard/product/attribute') ?>" class="btn btn-danger">Xoá</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($attributes)) : ?>

                                        <?php foreach ($attributes as $row) : ?>
                                            <tr id="attribute-<?= $row['id'] ?>">
                                                <td class="font-weight-bold"><?= $row['name'] ?></td>
                                                <td class="text-center">
                                                    <div class="checkbox-fade fade-in-primary ml-1">
                                                        <label class="check-task">
                                                            <input type="checkbox" id="checkbox" onclick="return change_status(this, '<?= $row['id'] ?>', '<?= $row['name'] ?>')" <?= $row['status'] == DISPLAY ? 'checked' : '' ?>>
                                                            <span class="cr">
                                                                <i class="cr-icon feather icon-check txt-default"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('dashboard/product/attribute/detail/' . $row['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="delete_attribute('<?= $row['id'] ?>', '<?= $row['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                            <span class="icofont icofont-ui-delete"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3">
                                                <p class="card-text text-center">Hiện tại không có thuộc tính nào</p>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <?php if (!empty($pager)) : ?>
                                        <?= $pager->links('default', 'default_full') ?>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- </div> -->

                        </div>
                        <!-- Extra Large table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('js') ?>
    <script>
        function change_status(element, id, name) {

            const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của thuộc tính "${name}" ?`);
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

            fetch('<?= base_url('dashboard/product/attribute/action-status') ?>', requestOptions)
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

        function delete_attribute(id, name) {
            const is_confirm = confirm(`Bạn muốn xóa thuộc tính "${name}" ?`);
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

            fetch('<?= base_url('dashboard/product/attribute/delete') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        document.getElementById(`attribute-${id}`).remove()
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