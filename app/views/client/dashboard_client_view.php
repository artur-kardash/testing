<?php
    $host = 'http://' . $_SERVER['HTTP_HOST']; // для правильной подгрузки стилей и скриптов
?>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo $host; ?>/client/dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Hello <?php echo $data['inf']['name']?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $host.'/'.$data['inf']['img']?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Max</h2>
                 <a style="cursor: pointer;" data-toggle="modal" class="edit-button" data-target="#editClient">Edit Profile</a>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-desktop"></i> Analitics <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $host; ?>/client/analitics">Overview</a></li>
                      <li><a href="<?php echo $host; ?>/client/analitics2">Sessions</a></li>
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
              <a href="<?php echo $host; ?>/index/logout" data-toggle="tooltip" data-placement="top" title="Logout">
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
                    <img src="<?php echo $host.'/'.$data['inf']['img']?>" alt="">Max
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a data-toggle="modal" class="edit-button" data-target="#editClient"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo $host; ?>/index/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

        <h1>Hello</h1>
        <div class="row">
        <div class="col-md-4">
          <div class="home-active">
              <img src="<?php echo $host.'/'.$data['inf']['img']?>" class="logoclient" alt="Mountain View" >
            <div class="block-hidden">
              <div data-toggle="modal" data-target="#editimg" class="read-more">Edit image</div>
          </div>
        </div>
            <table class="table table-hover">
              <tr>
                <th>Name: </th><td><?php echo $data['inf']['name']?></td>
              </tr>
              <tr>
                <th>Email: </th><td><?php echo $data['inf']['email']?></td>
              </tr>
              <tr>
                <th>Password: </th><td><?php echo $data['inf']['password']?></td>
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
        </div>

      <div class="modal fade" id="editimg"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="exampleModalLabel">Upload new image: </h4>
       </div>


<form id="updateimg" enctype="multipart/form-data" action="<?php echo $host . "/client/"; ?>updateimgclient" method="post">
         <div class="modal-body">
         <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" />
           <div class='form-group'>
                <label for="uploadbtn" class="uploadButton">Update logo</label>
                <input id="uploadbtn" type="file" class="form-control" style="opacity: 0; z-index: -1;" name="image" required />
              </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
             <button type="submit" class="btn btn-primary">Upload</button>
           </div>
           </div>
     </form>
   </div>
  </div>
</div>

        <div class="col-md-8">
          <div class="profile_title">
                        <div class="col-md-6">
                          <h2>User Activity Report</h2>
                        </div>
                        <div class="col-md-6">
                          <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                          </div>
                        </div>
                      </div>
          <div class="x_panel">
                  <div class="x_title">
                    <h2>Basic Tables <small>basic table subtitle</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Tabs <small>Float left</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                            synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>
                    <div>
      <!--               <script type="text/javascript">
      function handleClientLoad() {
        // Loads the client library and the auth2 library together for efficiency.
        // Loading the auth2 library is optional here since `gapi.client.init` function will load
        // it if not already loaded. Loading it upfront can save one network request.
        gapi.load('client:auth2', initClient);
      }

      function initClient() {
        // Initialize the client with API key and People API, and initialize OAuth with an
        // OAuth 2.0 client ID and scopes (space delimited string) to request access.
        gapi.client.init({
            apiKey: 'AIzaSyBmGLvEONXWmnWY5GW4099nI08Q4jh-ZHo',
            discoveryDocs: ["https://people.googleapis.com/$discovery/rest?version=v1"],
            clientId: '964278882460-aegm4msfo0irbv9st0k1b862trquf79g.apps.googleusercontent.com',
            scope: 'profile'
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        });
      }

      function updateSigninStatus(isSignedIn) {
        // When signin status changes, this function is called.
        // If the signin status is changed to signedIn, we make an API call.
        if (isSignedIn) {
          makeApiCall();
        }
      }

      function handleSignInClick(event) {
        // Ideally the button should only show up after gapi.client.init finishes, so that this
        // handler won't be called before OAuth is initialized.
        gapi.auth2.getAuthInstance().signIn();
      }

      function handleSignOutClick(event) {
        console.log(event);
        gapi.auth2.getAuthInstance().signOut();
      }

      function makeApiCall() {
        // Make an API call to the People API, and print the user's given name.
        gapi.client.people.people.get({
          resourceName: 'people/me'
        }).then(function(response) {
          console.log('Hello, ' + response.result.names[0].givenName);
        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });
      }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <button id="signin-button" onclick="handleSignInClick()">Sign In</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign Out</button> -->
    <?php
$client_id = '964278882460-aegm4msfo0irbv9st0k1b862trquf79g.apps.googleusercontent.com'; // Client ID
$client_secret = '301Xaip00Nt2JBqVgus239eC'; // Client secret
$redirect_uri = 'http://test8.jointoit.com/client/dashboard'; // Redirect URIs
$url = 'https://accounts.google.com/o/oauth2/auth';
$params = array(
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'client_id'     => $client_id,
    'scope'         => 'https://www.googleapis.com/auth/webmasters.readonly https://www.googleapis.com/auth/webmasters'
);
echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Google</a></p>';
if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri'  => $redirect_uri,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code']
    );
    $url = 'https://accounts.google.com/o/oauth2/token';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl,  CURLOPT_HTTPHEADER, array(
    // "Authorization: Bearer ".$tokenInfo['access_token']
    // ));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $tokenInfo = json_decode($result, true);
    curl_setopt($curl,  CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$tokenInfo['access_token'],
    "Content-Type: multipart/mixed; boundary=batch_foobarbaz"
    ));
    if (isset($tokenInfo['access_token'])) {
        $server_output = curl_exec($curl);
        var_dump($server_output);
        die();
    }
}
?>

<script type="text/javascript">
function postquery(){
xhr = new XMLHttpRequest();
var url = "https://accounts.google.com/o/oauth2/token";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-type", "application/json");
xhr.onreadystatechange = function () { 
    if (xhr.readyState == 4 && xhr.status == 200) {
        var json = JSON.parse(xhr.responseText);
        console.log(json.startDate + ", " + json.endDate + ", " + json.dimensions)
    }
}
var data = JSON.stringify({"redirect_uri":"http://test8.jointoit.com/client/dashboard","client_id":"964278882460-aegm4msfo0irbv9st0k1b862trquf79g.apps.googleusercontent.com","client_secret":"301Xaip00Nt2JBqVgus239eC","grant_type":"authorization_code","code":"4/cXOErI3qBNlCj5tJ7KqMdk0CZhrkGiQI6OHnCZ_z0Kg"});
xhr.send(data);
}
</script>
                          <div><h1><?php//var_dump($server_output); ?></h1></div>
                    </div>

                  </div>
                </div>
              </div>
        </div>

      </div>  

  <div class="modal fade" id="editClient"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Update profile: </h4>
        </div>

        <form id="UpdateProfile" action="<?php echo $host . "/client/"; ?>UpdateProfile" method="post">
          <div class="modal-body">
              <div class='form-group'>
                <p>Name</p>
                <input type="text" class="form-control" name="name" value="<?php echo $data['inf']['name']?>" placeholder = "Name" />
                </div>
              <div class='form-group'>
                <p>Email</p>
                <input type="email" class="form-control" name="email" value="<?php echo $data['inf']['email']?>" placeholder = "Email" />
                </div>
              <div class='form-group'>
                <p>Password</p>
                <input type="password" class="form-control" name="password" value="<?php echo $data['inf']['password']?>" placeholder = "Password" />
              </div>
              <div class='form-group'>
                <p>Address</p>
                <input type="address" class="form-control" name="address" value="<?php echo $data['inf']['address']?>" placeholder = "Address" />
              </div>
              <div class='form-group'>
                <p>Phone</p>
                <input type="phone" class="form-control" name="phone" value="<?php echo $data['inf']['phone']?>" placeholder = "Phone" />
              </div>
              <div class='form-group'>
                <p>URL</p>
                <input type="text" class="form-control" name="url" value="<?php echo $data['inf']['url']?>" placeholder = "Url" />
              </div>
              <div class='form-group'>
                <p>Notes</p>      
                <input type="text" class="form-control" name="notes" value="<?php echo $data['inf']['notes']?>" placeholder = "Notes" />

                <!-- <div class="bg-success success"></div> -->
              </div>
              <!-- <div class='form-group'>
                <label for="uploadbtn" class="uploadButton">Update logo</label>
                <input id="uploadbtn" type="file" class="form-control" style="opacity: 0; z-index: -1;" name="image"/>
              </div> -->
              <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update info</button>
        </div>
            </div>
          </div>
        
      </form>
    </div>
  </div>
</div>

       

                <div class="clearfix"></div>
          <!--     </div>
            </div>

          </div> -->
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
            JoinToIt! <!-- <a href="https://colorlib.com">Colorlib</a> -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>