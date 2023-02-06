<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url() ?>\templates\libraries\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\icon\feather\css\feather.css">
    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\icon\themify-icons\themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\icon\font-awesome\css\font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\icon\icofont\css\icofont.css">

    <?php $this->renderSection('css') ?>

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\css\jquery.mCustomScrollbar.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\css\app.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>\templates\libraries\assets\pages\jquery.filer\css\jquery.filer.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>\templates\libraries\assets\pages\jquery.filer\css\themes\jquery.filer-dragdropbox-theme.css">
    <script src="<?= base_url() ?>/ckeditor/ckeditor.js"></script>

    <style>
        body {
            font-size: 16px;
        }

        select.form-control:not([size]):not([multiple]) {
            height: auto !important;
        }
    </style>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?= $this->include("Admin/header") ?>

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?= $this->include("Admin/navbar") ?>

                    <?= $this->renderSection('content') ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>

    <!-- notification js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.js"></script>

    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\modernizr\js\modernizr.js"></script>

    <script src="<?= base_url() ?>\templates\libraries\assets\pages\jquery.filer\js\jquery.filer.min.js"></script>
    <script src="<?= base_url() ?>\templates\libraries\assets\pages\filer\custom-filer.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>\templates\libraries\assets\pages\filer\jquery.fileuploads.init.js" type="text/javascript"></script>
    <!-- Chart js -->
    <script src="<?= base_url() ?>\templates\libraries\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url() ?>\templates\libraries\assets\js\pcoded.min.js"></script>
    <!-- custom js -->
    <script src="<?= base_url() ?>\templates\libraries\assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\script.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>\templates\libraries\bower_components\select2\css\select2.min.css">

    <script type="text/javascript" src="<?= base_url() ?>\templates\js\app.js"></script>
    <script>
        $('#remove-alert').on('click', function() {
            $('.alert').remove();
        })

        $(function() {
            $('[data-toggle="popover"]').popover({
                trigger: 'focus',
                container: 'body',
                boundary: 'body',
                fallbackPlacement: ['bottom', 'bottom', 'bottom', 'bottom']
            })
        })
    </script>

    <?= $this->renderSection('js') ?>
</body>

</html>