<!-- page content -->
<div class="right_col" role="main">

    <h1>Gmetrix</h1>
    <?php if(!$data["gmetrix"]["url"]): ?>
        <h2>Integration is not set!</h2>
        <p>Please, go to clients integration to connect Gmetrix.</p>
        <a class="btn btn-primary" href="/client/clientinfo">Set integrations</a>
        <style>
            .gmetrix-main-container{display:none;}
        </style>
    <?php endif; ?>
    <h2><?=$data["gmetrix"]["url"]?></h2>
    <h5>Link for view-only mode:<a href="<?php echo $host.'/client/linkgmetrix?id='.$data['hash']; ?>"> <?php echo $host.'/client/linkgmetrix?id='.$data['hash']; ?></a></h5>

    <hr/>
    <div class="row">
        <div class="col-md-12 gmetrix-main-container">
            <img id="site-screen" src=""/>
            <script>
                var scr_url = '<?=$data["gmetrix"]["url"]?>';

                $.ajax({
                    url: 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=' + scr_url + '&screenshot=true',
                    context: this,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        data = data.screenshot.data.replace(/_/g, '/').replace(/-/g, '+');
                        $('#site-screen').attr('src', 'data:image/jpeg;base64,' + data);
                    }
                });

            </script>
            <?php //echo('<pre>'); var_dump($data);?>
            <div class="report-performance clear">
                <div class="report-scores ">
                    <h3>Performance Scores</h3>
                    <div class="box clear">
                        <div class="report-score">
                            <h4>PageSpeed Score</h4><div class="load" hidden><span  class="glyphicon glyphicon-refresh spinning"></span> Loading...</div>
                            <span class="report-score-grade color-grade-E"><i class="sprite-grade-E"></i>
                                <span id="pagespeed_score" class="report-score-percent">
                                    <?=$data["gmetrix"]["pagespeed_score"]?>
                                </span>
                            </span>
                        </div>
                        <div class="report-score">
                            <h4>YSlow Score</h4>
                            <span class="report-score-grade color-grade-C">
                                <i class="sprite-grade-C"></i>
                                <span id="yslow_score" class="report-score-percent">
                                <?=$data["gmetrix"]["yslow_score"]?>
                                </span>
                            </span>

                        </div>
                    </div>
                </div>

                <div class="report-page-details">
                    <h3>Page Details</h3>
                    <div class="box clear">
                        <div class="report-page-detail">
                            <h4>Page Load Time</h4>
                            <span class="report-page-detail-value" id="html_load_time">
                                <?=$data["gmetrix"]["html_load_time"]/1000?> s
                            </span>
                        </div>
                        <div class="report-page-detail report-page-detail-size">
                            <h4>Total Page Size</h4>
                            <span class="report-page-detail-value" id="page_bytes">
                                <?=round($data["gmetrix"]["page_bytes"]/1024/1024, 2)?> MB
                            </span>
                        </div>
                        <div class="report-page-detail report-page-detail-requests">
                            <h4>Requests</h4>
                            <span class="report-page-detail-value" id="page_elements">
                                <?=$data["gmetrix"]["page_elements"]?>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <h2 style="margin-top:20px;">PDF Report</h2>
            <a href="<?=$data["gmetrix"]["report_pdf"]?>" class="btn btn-primary" target="_blank">PDF Report</a>
        </div>
    </div>

    <div class="clearfix"></div>
    <br />
</div>
</div>
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
</body>