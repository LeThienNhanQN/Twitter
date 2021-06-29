<html>
<head>
    <title>Admin/Trang Chủ</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">
    <link rel="stylesheet" href="../public/template/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../public/template/admin/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../public/template/admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <script src="../public/template/admin/assets/js/ace-extra.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type='text/javascript' src="../public/template/admin/js/jquery-2.2.3.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.2.1.1.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../public/template/paging/jquery.twbsPagination.js"></script>
    <link rel="stylesheet" href="../public/css/admin/style.css">
    <!-- page specific plugin styles -->
	<link rel="stylesheet" href="../public/css/admin/dropzone.min.css" />
</head>
<body class="no-skin">
    <?php include_once('layout/header.php') ?>

    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        <?php include_once('layout/menu.php') ?>
        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="<?php echo BASE_URL.'admin' ?>">Trang chủ</a>
                        </li>
                    </ul><!-- /.breadcrumb -->
                </div>
                <div class="page-content">
                    <div class="row" >
                        <div class="col-xs-12">
                            <?php include_once('layout/main.php') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.main-content -->

         <!-- footer -->
            <?php include_once('layout/footer.php') ?>
        <!-- footer -->
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse display">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
         </a>
    </div>
    <script src="../public/template/admin/assets/js/bootstrap.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery-ui.custom.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.easypiechart.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.sparkline.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.flot.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.flot.pie.min.js"></script>
    <script src="../public/template/admin/assets/js/jquery.flot.resize.min.js"></script>
    <script src="../public/template/admin/assets/js/ace-elements.min.js"></script>
    <script src="../public/template/admin/assets/js/ace.min.js"></script>
    <script src="../public/template/admin/assets/js/bootstrap.min.js"></script>


    <!-- page specific plugin scripts -->
    <script src="../public/template/admin/assets/js/jquery-ui.min.js"></script>
    <script src="../public/js/disableUser.js"></script>
    <script src="../public/js/enableUser.js"></script>
    <script src="../public/js/DisableTweet.js"></script>
    <script src="../public/js/EnableTweet.js"></script>
</body>
</html>
