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
<body class="nav-md">
  <script src="<?=__HOST__?>/vendors/jquery/dist/jquery.min.js"></script>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/agency/dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Jointoit!</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Setting <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Setting Form 1</a></li>
                      <li><a href="#">Setting Form 2</a></li>
                      <li><a href="#">Setting Form 3</a></li>
                      <li><a href="#">Setting Form 4</a></li>
                      <li><a href="#">Setting Form 5</a></li>
                      <!-- <li><a href="form_buttons.html">Form Buttons</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/client/clientanalytics?id=<?=$_GET['id'] ?>">Client Analytics - General</a></li>
                      <li><a href="/client/clientanalyticschannels?id=<?=$_GET['id'] ?>">Client Analytics - Channels</a></li>
                      <li><a href="/client/clientanalyticsconversions?id=<?=$_GET['id'] ?>">Client Analytics - Conversions</a></li>
                        <li><a href="/client/clientanalyticspdf?id=<?=$_GET['id'] ?>">Reports 1 PDF</a></li>
                      <li><a href="/searchconsole/searchconsole">Search console</a></li>
                      <li><a href="/serplab/">Serplab</a></li>
                      <li><a href="#">Reports 5</a></li>
                      <li><a href="#">Reports 6</a></li>
                      <li><a href="#">Reports 7</a></li>
                    </ul>
                  </li>
             
                </ul>
              </div>
       

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

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

  <div class="modal fade" id="client1"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Add new client: </h4>
        </div>
<style type="text/css">
  .erroremail{
    color: #ce0a0a;
  }
</style>

        <form id="editClientForm" enctype="multipart/form-data" action="<?php echo $host . "/agency/"; ?>addclients" method="post">
          <div class="modal-body">
          <div class="erroremail"></div>
              <div class='form-group'>
                <label> Name: </label>
                  <input type="text" class="form-control" name="name" placeholder = "Name" required />
              </div>
              <div class='form-group'>
              <label> Email: </label>
                  <input type="email" class="form-control" name="email" id="emailcheck" placeholder = "Email" required />
              </div>
               <div class='form-group'>
              <label> Password: </label>
                  <input type="password" class="form-control" name="password" placeholder = "Password" required />
              </div>
               <div class='form-group'>
              <label> Address: </label>
                  <input type="text" class="form-control" name="address" placeholder = "Address" required />
              </div>
              <div class='form-group'>
              <label> Phone: </label>
                  <input type="text" class="form-control" name="phone" placeholder = "Phone" required />
              </div>
              <div class='form-group'>
              <label> URL: </label>
                  <input type="text" class="form-control" name="url" placeholder = "Url" required />
              </div>
              <div class='form-group'>
              <label> Notes: </label>
                <input type="text" class="form-control" name="note" placeholder = "Notes" />
              </div>
               <div class='form-group'>
              <label> Image: </label>
                <input type="file" class="form-control" name="image"/>
              </div>
            <div class="modal-footer">
              <button type="button" id="closereload" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload(true)">Close</button>
              <button type="submit" id="savecheck" class="btn btn-primary">Save</button>
            <div class="bg-success success"></div>
            </div>
            </div>
          <!-- </div> -->
      </form>
    </div>
  </div>
</div>
  </body>
</html>

