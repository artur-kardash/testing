<style type="text/css">
 .round {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 3px solid #e5dee5;
   }

    .sign {
    float: left; /* Выравнивание по правому краю */
    padding: 7px; /* Поля внутри блока */
    margin: 10px 0 5px 5px; /* Отступы вокруг */
   }

   .name_position{
    text-align: center;
   }

   *{
    padding: 0;
    margin: 0;
}

.home-active{
    width: 300px;
    height: 300px;   
    position: relative;
    text-align: center;
    margin: 0 auto;
}
.home-active img{
    width: 300px;
    height: 300px;     
}
 
.block-hidden{    
    display: none;
}

.home-active:hover .block-hidden{
    width: 100%;
    height: 100%;
    display: block;
    position: absolute; top: 0; left: 0;
    background: rgba(0,0,0,0.7);
    color: #fff;
}
.block-hidden h2{
    position: absolute; top: 5%; left: 5%;    
}
.block-hidden .read-more{
    margin-top: 50%;
    text-align: center;
    cursor: pointer;
    /*text-overflow: clip;*/
     /*bottom: 5%; right: 5%;    */
}
.block-hidden .read-more a{
    color: #fff;    
}
.right_col{
  margin-left: 0px!important;
}
footer{
  margin-left: 0px!important;
}
.main_container .top_nav {
    display: block;
    margin-left: 0px;
}

</style>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <!--  <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/agency/dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Jointoit!</span></a>
            </div>

            <div class="clearfix"></div>

         
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Artur</h2>
                 <a href="/agency/infagency">Profile</a>
              </div>
            </div>
          

            <br />

        
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Clients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#" class="edit-client" data-toggle="modal" class="edit-button" data-target="#client" >Add new clients</a></li>
                      <li><a href="/agency/allclients">List of clients</a></li>
                
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Setting <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Setting Form 1</a></li>
                      <li><a href="#">Setting Form 2</a></li>
                      <li><a href="#">Setting Form 3</a></li>
                      <li><a href="#">Setting Form 4</a></li>
                      <li><a href="#">Setting Form 5</a></li>
                
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Reports 1</a></li>
                      <li><a href="#">Reports 2</a></li>
                      <li><a href="#">Reports 3</a></li>
                      <li><a href="#">Reports 4</a></li>
                      <li><a href="#">Reports 5</a></li>
                      <li><a href="#">Reports 6</a></li>
                      <li><a href="#">Reports 7</a></li>

                    </ul>
                  </li>
             
                </ul>
              </div>
        

            </div>
      
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
         
          </div>
        </div> -->

   
        <div class="top_nav">
          <div class="nav_menu">

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<?php if($data['info'] == ""){ ?>
                    <img src="<?php echo $host.'/images/no_image.png'?>" alt=""><?php echo $data['info']['name_agency'];?>
<?php }else{ ?>
                    <img src="<?php echo $host.'/'.$data['info']['imglogo']?>" alt=""><?php echo $data['info']['name_agency'];?>
<? } ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $host.'/agency/infagency'?>"> Profile</a></li>
                  <!--   <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="<?php echo $host.'/index/logout'?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
<h1>Profile</h1>
  
  <form id="editpfile" enctype="multipart/form-data" action="<?php echo $host . "/agency/"; ?>saveinform" method="post">
          
          <!-- <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" /> -->

              <div class='form-group'>
                  <input type="text" class="form-control" name="agencyname" placeholder = "Agency name" required />
              </div>
              <div class='form-group'>
                  <input type="text" class="form-control" name="phone" placeholder = "Phone" required />
              </div>
               <div class='form-group'>
                  <input type="text" class="form-control" name="address" placeholder = "Address" required />
              </div>
               <div class='form-group'>
                <input type="file" class="form-control" name="image"/>
              </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default">Closed</button> -->
              <button type="submit" class="btn btn-primary">Save</button>
            </div>

         
        
    </form>
</div>
<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Edit: </h4>
        </div>


<form id="editnm" enctype="multipart/form-data" action="<?php echo $host . "/client/"; ?>updateclient" method="post">
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
 
                <div class="clearfix"></div>
          <!--     </div>
            </div>

          </div> -->
          <br />

          <div class="row">


      

            <div class="col-md-4 col-sm-4 col-xs-12">
           
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