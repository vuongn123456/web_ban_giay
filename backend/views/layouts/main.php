<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->page_title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    
    <?php require_once 'header.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!--            Hiển thị thông báo lỗi và thành công-->
            <?php if (!empty($this->error)): ?>
                <div class="alert alert-danger"><?php echo $this->error ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
    
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
            
            <!--            Nội dung hiển thị ở đây-->
            <?php echo $this->content; ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    <?php require_once 'footer.php'; ?>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!--CKEditor -->
<script src="assets/ckeditor/ckeditor.js"></script>
<!--My SCRIPT-->
<script src="assets/js/script.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="assets/js/myJS.js"></script>
<script>
    $(document).ready( function () {

        // Tích hợp CKFinder và CKEditor
        CKEDITOR.replace('descriptionn', {
            //đường dẫn đến file ckfinder.html của ckfinder
            filebrowserBrowseUrl: 'assets/ckfinder_php.7.x/ckfinder.html',
            //đường dẫn đến file connector.php của ckfinder
            filebrowserUploadUrl: 'assets/ckfinder_php.7.x/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });

        CKEDITOR.replace('summary', {
            //đường dẫn đến file ckfinder.html của ckfinder
            filebrowserBrowseUrl: 'assets/ckfinder_php.7.x/ckfinder.html',
            //đường dẫn đến file connector.php của ckfinder
            filebrowserUploadUrl: 'assets/ckfinder_php.7.x/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });

        CKEDITOR.replace('content', {
            //đường dẫn đến file ckfinder.html của ckfinder
            filebrowserBrowseUrl: 'assets/ckfinder_php.7.x/ckfinder.html',
            //đường dẫn đến file connector.php của ckfinder
            filebrowserUploadUrl: 'assets/ckfinder_php.7.x/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });


        CKEDITOR.replace('img_product_detail', {
            //đường dẫn đến file ckfinder.html của ckfinder
            filebrowserBrowseUrl: 'assets/ckfinder_php.7.x/ckfinder.html',
            //đường dẫn đến file connector.php của ckfinder
            filebrowserUploadUrl: 'assets/ckfinder_php.7.x/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });

    });
</script>
</body>
</html>
