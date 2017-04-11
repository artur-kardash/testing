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
    <link href="<?php echo $host; ?>/assets/css/custom.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo $host; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $host; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $host; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $host; ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $host; ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $host; ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $host; ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $host; ?>/build/css/custom.min.css" rel="stylesheet">
</head>
<body>
  <script src="<?=__HOST__?>/vendors/jquery/dist/jquery.min.js"></script>
    <div class="container body">
      <!-- <div class="main_container"> -->
        
      

 <?php include 'app/views/'.$content_view; ?>

<!-- Javascripts -->
 <!-- jQuery -->
    <script src="<?php echo $host; ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $host; ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $host; ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $host; ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo $host; ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo $host; ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo $host; ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $host; ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo $host; ?>/vendors/skycons/skycons.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $host; ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $host; ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $host; ?>/build/js/custom.min.js"></script>

    <!-- Flot -->
      <!-- This demo uses the Chart.js graphing library and Moment.js to do date
        formatting and manipulation. -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>



  <!-- Include the DateRangeSelector component script. -->
  <script src="<?=__HOST__?>/js/embed-api/components/date-range-selector.js"></script>

    <!-- </div> -->
  </div>

  </body>
</html>

