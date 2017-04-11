<!-- page content -->
<div class="right_col" role="main">

    <h1>Google Search Console</h1>
    <h2><?=$data['cur_site']?></h2>
    <h5>Link for view-only mode:<a href="<?php echo $host.'/client/linksearch?id='.$data['hash']; ?>"> <?php echo $host.'/client/linksearch?id='.$data['hash']; ?></a></h5>
    
    <hr/>
    <?php if($data['search_console_error']):?>
        <?=$data['search_console_error']?>
        <style>
            .nav-tabs,.tab-content{display:none;}
        </style>
    <?php endif;?>

    <ul class="nav nav-tabs">
        <li <?php if($_SESSION['search_console_active_tab'] == 'sitemaps' || !$_SESSION['search_console_active_tab']) echo('class="active"');?>>
            <a data-toggle="tab" href="#sitemaps">Sitemaps</a>
        </li>
        <li <?php if($_SESSION['search_console_active_tab'] == 'search_statistic') echo('class="active"');?>>
            <a data-toggle="tab" href="#search_statistic">Search statistic</a>
        </li>
        <li><a data-toggle="tab" href="#scanning_errors">Scanning errors</a></li>
    </ul>

    <div class="tab-content">
        <div id="sitemaps" class="tab-pane fade <?php if($_SESSION['search_console_active_tab'] == 'sitemaps' || !$_SESSION['search_console_active_tab']) echo('in active');?>">
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <h3>Sitemaps</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <td>Sitemap</td>
                            <td>Last Downloaded</td>
                            <td>Last Submitted</td>
                            <td>Warnings/Errors</td>
                            <td>Submitted</td>
                            <td>Indexed</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sitemaps = $data['cur_site_sitemaps_data']['sitemap'];
                        foreach ($sitemaps as $sitemap):?>
                            <tr>
                                <td><?=$sitemap['path']?></td>
                                <td><?=$sitemap['lastDownloaded']?></td>
                                <td><?=$sitemap['lastSubmitted']?></td>
                                <td><?=$sitemap['warnings'].'/'.$sitemap['errors']?></td>
                                <td><?=$sitemap['contents'][0]['submitted']?></td>
                                <td><?=$sitemap['contents'][0]['indexed']?></td>
                                <td>
                                    <form method="POST" action="/searchconsole/">
                                        <input type="hidden"  name="delete" value="delete">
                                        <input type="hidden"  name="siteurl" value="<?=$data['cur_site']?>">
                                        <input type="hidden"  name="feedpath" value="<?=$sitemap['path']?>">
                                        <input type="submit" value="Delete sitemap" class="btn btn-danger btn-small">

                                    </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <h3>Upload new sitemap</h3>
                    <form method="POST" action="/searchconsole/index">
                        <input type="hidden"  name="siteurl" value="<?=$data['cur_site']?>">
                        <label>Feedpath</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="feedpath" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Uploaad sitemap" class="btn btn-large btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="search_statistic" class="tab-pane fade <?php if($_SESSION['search_console_active_tab'] == 'search_statistic') echo('in active');?>">
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <h3>Search statistic</h3>
                    <form method="post" action="/searchconsole/">
                        <?php if(isset($_SESSION['start_date']) && isset($_SESSION['end_date'])):?>
                            <input type="date" name="start_date" id="start-date" value="<?=$_SESSION['start_date']?>">
                            <input type="date" name="end_date" id="end-date" value="<?=$_SESSION['end_date']?>">
                        <?php else: ?>
                            <input type="date" name="start_date" id="start-date" value="<?=date("Y-m-d", mktime(0, 0, 0, date('m') - 3, date('d'), date('Y')))?>">
                            <input type="date" name="end_date" id="end-date" value="<?=date("Y-m-d")?>">
                        <?php endif;?>
                        <input type="submit" value="Set period" class="btn btn-small btn-primary">
                    </form>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Query</td>
                            <td>Clicks</td>
                            <td>Impressions</td>
                            <td>CTR</td>
                            <td>Position</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data["analytics"] as $row){?>
                            <tr>
                                <td><?=$row['keys'][0]?></td>
                                <td><?=$row['clicks']?></td>
                                <td><?=$row['impressions']?></td>
                                <td><?=round($row['ctr']*100, 2); ?>%</td>
                                <td><?=round($row['position'], 2);?></td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="scanning_errors" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <h3>Scanning errors</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Platform</td>
                            <td>Category</td>
                            <td>Count</td>
<!--                            <td>Data</td>-->
                            <td>URL</td>
                            <td>Last crawled</td>
                            <td>First detected</td>
                            <td>Response Code</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['urlCrawlErrors']['countPerTypes'] as $error):?>
                            <?php if($error['entries'][0]['count'] > 0):?>
                            <tr>
                                <td><?=$error['platform']?></td>
                                <td><?=$error['category']?></td>
                                <td><?=$error['entries'][0]['count']?></td>
<!--                                <td>--><?//=$error['entries'][0]['timestamp']?><!--</td>-->
                                <td><?=$error['URLCrawlErrorsSamples'][0]['pageUrl']?></td>
                                <td><?=$error['URLCrawlErrorsSamples'][0]['last_crawled']?></td>
                                <td><?=$error['URLCrawlErrorsSamples'][0]['first_detected']?></td>
                                <td><?=$error['URLCrawlErrorsSamples'][0]['responseCode']?></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php //echo('<pre>'); var_dump($data['urlCrawlErrors']['countPerTypes']);?>

                </div>
            </div>
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