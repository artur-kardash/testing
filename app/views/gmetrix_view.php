<?php
/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 28.01.2017
 * Time: 13:23
 */
//echo '<pre>';
//var_dump($data);
//echo '</pre>';
//Dump::out($data, '$data');
?>



<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/agency/dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Jointoit!</span></a>
                </div>

                <div class="clearfix"></div>



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
                                    <li><a href="/client/clientanalytics?id=<?=$_GET['id'] ?>">Reports 1</a></li>
                                    <li><a href="/client/clientanalyticspdf?id=<?=$_GET['id'] ?>">Reports 1 PDF</a></li>
                                    <li><a href="#">Reports 3</a></li>
                                    <li><a href="#">Reports 4</a></li>
                                    <li><a href="#">Reports 5</a></li>
                                    <li><a href="#">Reports 6</a></li>
                                    <li><a href="#">Reports 7</a></li>
                                    <!--                      <li><a href="inbox.html">Inbox</a></li>
                                                         <li><a href="calendar.html">Calendar</a></li> -->
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

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">

                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $host.'/'.$data['info']['imglogo']?$data['info']['imglogo']:'';?>" alt=""><?php echo $data['info']['name_agency']?$data['info']['name_agency']:'';?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php echo $host.'/agency/infagency'?>"> Profile</a></li>
                                <!--   <li>
                                    <a href="javascript:;">
                                      <span class="badge bg-red pull-right">50%</span>
                                      <span>Settings</span>
                                    </a>
                                  </li> -->
                                <!-- <li><a href="javascript:;">Help</a></li> -->
                                <li><a href="<?php echo $host.'/'.'index/logout'; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="edit-client" data-toggle="modal" class="edit-button" data-target="#client" >
                                <!-- <span class="badge bg-red pull-right">50%</span> -->
                                <span>Add new client</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $host.'/'.'agency/dashboard'; ?>">
                                <!-- <span class="badge bg-red pull-right">50%</span> -->
                                <span>All clients</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-sm-3" id="gmetix_form">
                <form action="" method="post" id="gmetrix_account_data" class="form-horizontal">
                    <div class="form-group">
                    <input class="form-control" type="text" id="account_email" name="account_email" placeholder="account email" value="<?=$data['acount_email']?>">
                        </div>
                    <div class="form-group">
                    <input class="form-control" type="text" id="api_key" name="api_key" placeholder="api_key" value="<?=$data['api_key']?>">
                        </div>
                    <div class="form-group">
                    <input class="form-control btn  btn-dark" type="submit">
                        </div>
                </form>

                <form action="" id="gmetrix_start_test" class="form-horizontal">
                    <div class="form-group">
                    <input class="form-control" type="url"  name="gmetrix_url" placeholder="url" id="gmetrix_url">
                        </div>
                    <div class="form-group">
                    <input class="form-control btn btn-dark" type="submit" value="start testing" id="start_gmetrix">
                    <div id="load" style="display: none"><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                        </div>
                </form>
                </div>
<!--                </div>-->
                <div class="col-sm-4">
                    <img id="test_url_screen" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D" data-url="http://google.com" alt="Google" hidden>

                </div>
                <div id="gmetix_test_info" class="col-sm-8" style="padding-left: 20px" hidden>
                    <h1>Report for:</h1>
                    <div><a href="" id="test_url"></a></div>
                    <div id="gmetrix-loadbar-container">
                        <p>We are working. Please wait, your request may take up to one minute.</p>
                        <div class="progress progress-striped active">
                            <div id="gmetrix-loadbar" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                <!--<span class="sr-only">40% Complete (success)</span>-->
                            </div>
                            <script>
                                var elem = document.getElementById("gmetrix-loadbar");
                                var width = 1;
                                var id = setInterval(frame, 500);
                                function frame() {
                                    if (width >= 100) {
                                        clearInterval(id);
                                    } else {
                                        width++;
                                        elem.style.width = width + '%';
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <span>
                        <a href="" id="gmetrix_pdf_full"></a>
                    </span>
                </div>
            </div>
            <div class="col-sm-12" id="gmetrix-results">

            </div>
            <div class="col-sm-12" id="gmetrix-resources">

            </div>
            <div class="col-sm-12" id="gmetrix-locations">

<!--                report-->

                <div class="report-performance clear" style="display: none">
                    <div class="report-scores ">
                        <h3>Performance Scores</h3>
                        <div class="box clear">
                            <div class="report-score">
                                <h4>PageSpeed Score</h4><div class="load" hidden><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                                <span class="report-score-grade color-grade-E"><i class="sprite-grade-E"></i>
                                    <span id="pagespeed_score" class="report-score-percent">
<!--                                        <div class="load" hidden>-->
<!--                                            <span  class="glyphicon glyphicon-refresh spinning"></span> Loading...-->
<!--                                        </div>-->
                                    </span>
                                </span>
                                <i class="site-average sprite-average-below"></i>
                                <div class="site-average-tooltip hide">
                                    <h4>Relative Score</h4>
                                    <p>The average PageSpeed score is <strong>72%</strong></p>
                                    <a href="/faq.html#faq-relative-score" class="tooltip-help" title="Click to learn more">Learn more</a>
                                </div>
                            </div>
                            <div class="report-score">
                                <h4>YSlow Score</h4><div class="load" style="display: none"><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                                <span class="report-score-grade color-grade-C"><i class="sprite-grade-C"></i><span id="yslow_score" class="report-score-percent">

                                    </span></span>
                                <i class="site-average sprite-average-above"></i>
                                <div class="site-average-tooltip hide">
                                    <h4>Relative Score</h4>
                                    <p>The average YSlow score is <strong>69%</strong></p>
                                    <a href="/faq.html#faq-relative-score" class="tooltip-help" title="Click to learn more">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="report-page-details">
                        <h3>Page Details</h3>
                        <div class="box clear">
                            <div class="report-page-detail">
                                <h4>Page Load Time</h4><div class="load" style="display: none"><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                                <span class="report-page-detail-value" id="html_load_time"></span>
                                <i class="site-average sprite-average-above"></i>
                                <div class="site-average-tooltip hide">
                                    <h4>Relative Page Load Time</h4>
                                    <p>The average Page Load Time is <strong><span id="page_load_time">

                                            </span></strong></p>
                                    <a href="/faq.html#faq-relative-score" class="tooltip-help" title="Click to learn more">Learn more</a>
                                </div>
                            </div>
                            <div class="report-page-detail report-page-detail-size">
                                <h4>Total Page Size</h4><div class="load" style="display: none"><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                                <span class="report-page-detail-value" id="page_bytes"></span>
                                <i class="site-average sprite-average-below"></i>
                                <div class="site-average-tooltip hide">
                                    <h4>Relative Total Page Size</h4>
                                    <p>The average Total Page Size is <strong><span id="html_bytes"></span>

                                        </strong></p>
                                    <a href="/faq.html#faq-relative-score" class="tooltip-help" title="Click to learn more">Learn more</a>
                                </div>
                            </div>
                            <div class="report-page-detail report-page-detail-requests">
                                <h4>Requests</h4><div class="load" style="display: none"><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                                <span class="report-page-detail-value" id="page_elements">

                                </span>
                                <i class="site-average sprite-average-below"></i>
                                <div class="site-average-tooltip hide">
                                    <h4>Relative Requests</h4>
                                    <p>The average number of Requests is <strong>67</strong></p>
                                    <a href="/faq.html#faq-relative-score" class="tooltip-help" title="Click to learn more">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--            /    report-->


            </div>
        </div>





        <script src="<?=__HOST__?>/js/gmetrix.js"></script>
        <div class="clearfix"></div>


        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Jointoit! <!-- <a href="https://colorlib.com">Colorlib</a> -->
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

