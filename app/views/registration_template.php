<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo _FIRST_TITLE_ . ' | ' . _MAIN_TITLE_ ?></title>
    <?php
      $host = 'http://' . $_SERVER['HTTP_HOST']; // для правильной подгрузки стилей и скриптов
    ?> 

    <!-- Bootstrap -->
    <link href="<?php echo $host; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $host; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $host; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo $host; ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $host; ?>/build/css/custom.min.css" rel="stylesheet">
  </head>

<body class="login">

	    <?php include 'app/views/'.$content_view; ?>
	<!-- Page Content -->

<!-- Javascripts -->
<script src="<?php echo $host; ?>/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/pace-master/pace.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/switchery/switchery.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/offcanvasmenueffects/js/classie.js"></script>
<script src="<?php echo $host; ?>/assets/plugins/waves/waves.min.js"></script>
<script src="<?php echo $host; ?>/assets/js/modern.min.js"></script>
</body>
</html>
