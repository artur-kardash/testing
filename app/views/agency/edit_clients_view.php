        <!-- page content -->
<div class="right_col" role="main">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#client">Client</a></li>
        <li><a data-toggle="tab" href="#integrations">Integrations</a></li>
    </ul>

    <div class="tab-content">

        <div id="client" class="tab-pane fade in active">
            <h2>Client</h2>
            <div class="col-md-4">
                <div class="home-active">
                    <img src="<?php echo $host.'/'.$data['inf']['img']?>" class="logoclient" alt="Mountain View" >
                    <div class="block-hidden">
                        <div data-toggle="modal" data-target="#editimg" class="read-more">Edit image</div>
                    </div>

                </div>
                <table class="table table-hover">
                    <input type='hidden' name='id_client' value='<?php echo $data['inf']['id']?>'/>
                    <tr>
                        <th>Name: </th><td><?php echo $data['inf']['name']?></td>
                    </tr>
                    <tr>
                        <th>Email: </th><td><?php echo $data['inf']['email']?></td>
                    </tr>
                    <tr>
                        <th>Password: </th><td>****</td>
                    </tr>
                    <tr>
                        <th>Address: </th><td><?php echo $data['inf']['address']?></td>
                    </tr>
                    <tr>
                        <th>Phone: </th><td><?php echo $data['inf']['phone']?></td>
                    </tr>
                    <tr>
                        <th>URL: </th><td><?php echo $data['inf']['url']?></td>
                    </tr>
                    <tr>
                        <th>Notes: </th><td><?php echo $data['inf']['notes']?></td>
                    </tr>
                </table>
                <div style="position:relative;top:20px;">
                    <button style="margin-top:-35px;" type="submit" name="id" value="<?php echo $data['inf']['id']?>" data-toggle="modal" data-target="#edit" class="btn btn-primary">Edit</button>
                </div>
            </div>

            <div class="modal fade" id="editimg"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Upload new image: </h4>
                        </div>


                        <form id="editC" enctype="multipart/form-data" action="<?php echo $host . "/client/"; ?>updateimg" method="post">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" />
                                <div class='form-group'>
                                    <input type="file" class="form-control" name="image" required />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                    </div>

                    </form>
                </div>
            </div>


            <div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Edit: </h4>
                        </div>


                        <form id="editCli" enctype="multipart/form-data" action="<?php echo $host . "/client/"; ?>updateclient" method="post">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" />

                                <div class='form-group'>
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['inf']['name']?>" placeholder = "Name" required />
                                </div>
                                <div class='form-group'>
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $data['inf']['email']?>" placeholder = "Email" required />
                                </div>
                                <div class='form-group'>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder = "Password" />
                                </div>
                                <div class='form-group'>
                                    <label>Address:</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $data['inf']['address']?>" placeholder = "Address" required />
                                </div>
                                <div class='form-group'>
                                    <label>Phone:</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $data['inf']['phone']?>" placeholder = "Phone" required />
                                </div>
                                <div class='form-group'>
                                    <label>URL:</label>
                                    <input type="text" class="form-control" name="url" value="<?php echo $data['inf']['url']?>" placeholder = "Url" required />
                                </div>
                                <div class='form-group'>
                                    <label>Note:</label>
                                    <input type="text" class="form-control" name="note" value="<?php echo $data['inf']['notes']?>" placeholder = "Notes" />
                                </div>
                                <!--    <div class='form-group'>
                                    <input type="file" class="form-control" name="userfile"/>
                                  </div> -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <!--  </div> -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="integrations" class="tab-pane fade">
            <h2>Edit Integrations</h2>

            <form action="" method="post" id="form">
                <input type="hidden" name="client_id" placeholder="client_id" id="client_id" value="<?=$_SESSION['client_id']; ?>">
                <input type="hidden" name="api_name" placeholder="api_name" id="api_name" value="api_analitics">
                <input type="hidden" name="api_profile_id" placeholder="api_profile_id" id="api_profile_id">
            </form>

            <ul class="integrations-list">
                <li class="google-analitics-logo">Google Analytics
                    <div class="loading_ajax" style="display: inline;">
                        <span  class="glyphicon glyphicon-refresh spinning"></span>
                    </div>
                    <span class="connect" id="connect-analytics">
                        <div class="loading_ajax" style="display: inline;">
                            <span  class="glyphicon glyphicon-refresh spinning"></span>
                        </div>
                        CONNECT
                    </span>
                    <span class="disconnect" id="disconnect-analytics">DISCONNECT</span>
                </li>

                <div class="analytics-connection-container">

                    <form action="" method="post" id="form">
                        <input type="hidden" name="client_id" placeholder="client_id" id="client_id" value="<?=$_SESSION['client_id']; ?>">
                        <input type="hidden" name="api_name" placeholder="api_name" id="api_name" value="api_analitics">
                    </form>

                    <script>
                        (function(w,d,s,g,js,fs){
                            g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
                            js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
                            js.src='https://apis.google.com/js/platform.js';
                            fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
                        }(window,document,'script'));
                    </script>

                    <div id="embed-api-auth-container"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="view-selector-container"></div>
                        </div>
                    </div>

                    <!-- Include the ViewSelector2 component script. -->
                    <script src="<?=__HOST__?>/js/embed-api/components/view-selector2.js"></script>

                    <script>

                        gapi.analytics.ready(function() {

                            /**
                             * Authorize the user immediately if the user has already granted access.
                             * If no access has been created, render an authorize button inside the
                             * element with the ID "embed-api-auth-container".
                             */
                            gapi.analytics.auth.authorize({
                                container: 'embed-api-auth-container',
                                clientid: '201890636942-vr0pgotfrschlt1p8o5q9v3u9bqhnmdu.apps.googleusercontent.com'
                            });

                            /*** Check if Analytics is connected*/
                            $.ajax({
                                type: "POST",
                                url: "/ajax/get_client_api_profile",
                                data: {val: $('#form').serialize() }
                            }).done(function( msg ) {
                                var data = $.parseJSON(msg);
                                console.log(data);

                                if(data !== null){
                                    /**
                                     * Create a new ViewSelector2 instance to be rendered inside of an
                                     * element with the id "view-selector-container".
                                     */
                                    var viewSelector = new gapi.analytics.ext.ViewSelector2({
                                        container: 'view-selector-container',
                                        ids: data.api_profile_id.replace("%3A", ":")
                                    })
                                        .execute();

                                    function second_passed() {
                                        console.log(viewSelector);
                                        $( "li.google-analitics-logo" ).append( $( '<span id="connected"><i>(Connected:<strong>"'+viewSelector.account.name+' - '+viewSelector.property.websiteUrl+'"</strong>)</i></span>' ) );
                                        $('.loading_ajax').css('display', 'none');
                                    }
                                    setTimeout(second_passed, 1000)

                                    $('#connect-analytics').text("RECONNECT").on('click', function(){
                                        $('.analytics-connection-container').show();

                                        viewSelector.on('change', function(ids) {
                                            console.log(ids);
                                            $("#api_profile_id").val(ids);

                                            $.ajax({
                                                type: "POST",
                                                url: "/ajax/add_api_profile",
                                                data: { val: $('#form').serialize() }
                                            }).done(function( msg ) {
                                                console.log(msg);
                                            });
                                        });
                                    });
                                }
                                else{

                                    var viewSelector = new gapi.analytics.ext.ViewSelector2({
                                        container: 'view-selector-container'
                                    })
                                        .execute();
                                    $('.loading_ajax').css('display', 'none');
                                    $('#connect-analytics').on('click', function(){
                                        $('.analytics-connection-container').show();

                                        viewSelector.on('change', function(ids) {
                                            console.log(ids);
                                            $("#api_profile_id").val(ids);

                                            $.ajax({
                                                type: "POST",
                                                url: "/ajax/add_api_profile",
                                                data: { val: $('#form').serialize() }
                                            }).done(function( msg ) {
                                                console.log(msg);
                                            });
                                        });
                                    });
                                };
                            });
                        });
                    </script>

                </div>

                <script>
                    $('#connect-analytics').on('click', function(){
                        $('.analytics-connection-container').show();
                        $('#connect-analytics').hide();
                        $('#connected').hide();
                        $('#disconnect-analytics').show();

                    });

                    $('#disconnect-analytics').on('click', function(){
                        $.ajax({
                            type: "POST",
                            url: "/ajax/remove_api_profile",
                            data: { val: $('#form').serialize() }
                        }).done(function( msg ) {
                            console.log(msg);
                            gapi.analytics.auth.signOut();
                            //$('.analytics-connection-container').hide();
                            $('#disconnect-analytics').hide();
                            $('#view-selector-container').hide();
                        });
                    });

                    $('#embed-api-auth-container').on('click', function(){
                        $('#view-selector-container').show();
                    });
                </script>

                <li class="google-console-logo">
                    Google Search Console
                    <?php if (isset($data['searchconsole']['authUrl'])): ?>
                        <span class="connect">
                            <a href="<?= $data['searchconsole']['authUrl'] ?>">CONNECT</a>
                        </span>
                    <?php else:?>
                        <!--<span class="connect" style="display:block;">
                           <a href="?logout">RECONNECT</a>
                        </span>-->
                    <?php endif; ?>
                </li>
                <?php if (!isset($data['searchconsole']['authUrl'])): ?>
                    <div id="search-console-connection">
                        <h5>Choose the site to connect Seaarch Console</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <select id="select-search-console" class="FormField form-control">
                                    <?php foreach ($data['searchconsole']['sites'] as $site): ?>
                                        <option value="<?=($site)?>" <?php if(trim($site) == trim($data['searchconsole']['cur_site'])) echo ('selected');?> >
                                            <?php echo($site);?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <script>
                        <?php if(!isset($data['searchconsole']['cur_site'])):  ?>
                        $( document ).ready(function() {
                            var site = $("#select-search-console").val();
                            console.log(site);
                            $.ajax({
                                type: "POST",
                                url: "/client/searchConsoleUpdateSite",
                                data: 'site='+site
                            }).done(function( msg ) {
                                console.log(msg);
                            });
                        });
                        <?php endif;?>

                        $("#select-search-console").on('click', function() {
                            var site = $("#select-search-console").val();
                            console.log(site);
                            $.ajax({
                                type: "POST",
                                url: "/client/searchConsoleUpdateSite",
                                data: 'site='+site
                            }).done(function( msg ) {
                                console.log(msg);
                            });
                        });
                    </script>
                <?php endif; ?>
                <li class="gmetrix-logo">
                    Gmetrix
                    <?php if($data['gmetrix']['url']):?>
                        <i>(Connected:<strong>"<?=$data['gmetrix']['url']?>"</strong>)</i>
                        <span class="connect" id="gmetrix-connect">RECONNECT</span>
                    <?php else:?>
                        <span class="connect" id="gmetrix-connect">CONNECT</span>
                    <?php endif; ?>

                </li>
                <div id="gmetrix-connection">
                    <h5>Enter the url of the site:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="gmetrix_url" value="<?=$data['gmetrix']['url']?>" id="gmetrix_url" class="form-control">
                            <button class="btn btn-primary" id="gmetrix_save" style="margin-top:10px;">Save</button>
                        </div>
                    </div>
                </div>
                <script>
                    $('#gmetrix-connect').on('click', function(){
                        $('#gmetrix-connection').show();
                        $('#gmetrix-connect').hide();
                    });
                    $('#gmetrix_save').on('click', function(){
                        var gmetrix_url = $("#gmetrix_url").val();
                        console.log(gmetrix_url);
                        $.ajax({
                            type: "POST",
                            url: "/client/gmetrixUpdateUrl",
                            data: 'url='+gmetrix_url
                        }).done(function( msg ) {
                            console.log(msg);
                            $('#gmetrix-connection').hide();
                            $('li.gmetrix-logo').append("(Connected:<strong>"+gmetrix_url+"</strong>)");
                        });
                    });
                </script>

            </ul>

        </div>

    </div>

    <div class="clearfix"></div>

    <br />

     <div class="row">




        <div class="col-md-4 col-sm-4 col-xs-12">



            <!-- end of weather widget -->
          </div>
      </div>
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