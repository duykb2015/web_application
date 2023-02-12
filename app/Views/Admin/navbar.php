<?php
$menu = [
    [
        'url' => base_url('dashboard'),
        'active' => 'dashboard',
        'name' => 'Admin',
        'icon' => '<i class="feather icon-home"></i>',
    ],
    [
        'url' => '',
        'active' => 'dashboard/admin',
        'name' => 'Quản lý Tài khoản',
        'icon' => '<i class="feather icon-user"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/admin'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/admin/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Danh mục',
        'active' => 'dashboard/category',
        'icon' => '<i class="feather icon-menu"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/category'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/category/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý sản phẩm',
        'active' => 'product',
        'icon' => '<i class="feather icon-shopping-cart"></i>',
        'sub_menu' => [
            [
                'url' => '',
                'name' => 'Danh mục',
                'active' => 'product-category',
                'sub_menu' => [
                    [
                        'url' => base_url('product-category'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => base_url('product-category/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Thuộc tính',
                'active' => 'product-attribute',
                'sub_menu' => [
                    [
                        'url' => base_url('product-attribute'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => base_url('product-attribute/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Dòng sản phẩm',
                'active' => 'product-line',
                'sub_menu' => [
                    [
                        'url' => base_url('product-line'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => base_url('product-line/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Sản phẩm',
                'active' => 'product-item',
                'sub_menu' => [
                    [
                        'url' => base_url('product-item'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => base_url('product-item/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ]
        ]
    ],



];
?>

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Bảng điều khiển</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($menu as $row) : ?>
                <?php $class_active = url_is($row['active'] . '*') ? ' pcoded-trigger' : '' ?>
                <li class="<?= !empty($row['url']) ? '' : 'pcoded-hasmenu' ?> <?= $class_active ?>">
                    <a href="<?= !empty($row['url']) ? $row['url'] : 'javascript:void(0)' ?>">
                        <span class="pcoded-micon"><?= $row['icon'] ?></span>
                        <span class="pcoded-mtext"><?= $row['name'] ?></span>
                    </a>

                    <?php if (!empty($row['sub_menu'])) : ?>
                        <ul class="pcoded-submenu">
                            <?php foreach ($row['sub_menu'] as $sub) : ?>

                                <?php if (!empty($sub['sub_menu'])) : ?>
                                    <?php $sub_class_active = url_is($sub['active'] . '*') ? ' pcoded-trigger' : '' ?>
                                    <li class="pcoded-hasmenu <?= $sub_class_active ?>">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <?php foreach ($sub['sub_menu'] as $val) : ?>
                                                <li class="<?= url_is(str_replace(base_url(), '', $val['url'])) ? 'active' : '' ?>">
                                                    <a href="<?= $val['url'] ?>">
                                                        <span class="pcoded-mtext"><?= $val['name'] ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li class="<?= url_is(str_replace(base_url(), '', $sub['url'])) ? 'active' : '' ?>">
                                        <a href="<?= $sub['url'] ?>">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</nav>