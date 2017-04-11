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
    width: 100%;
    height: 100%;   
    position: relative;
    text-align: center;
    margin: 0 auto;
}
.home-active img{
    width: 100%;
    height: 100%;     
}
 
.block-hidden{ 
    height: 76%!important;    
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


</style>
<body class="nav-md">
    <div class="container body">
      
     
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <!-- <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div> -->

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $host.'/'.$data['inf']['imglogo']?>" alt=""><?php echo $data['inf']['name_agency'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $host.'/agency/infagency'?>"> Profile</a></li>
                    <!-- <li>
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
<h1>Profile </h1>
<?php if(isset($error)){
  echo $error;
  } ?>
  
 <!--  <form id="editpfile" enctype="multipart/form-data" action="<?php echo $host . "/agency/"; ?>saveinform" method="post"> -->
          
          <!-- <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" /> -->
 
           <div class="col-md-4">
    <div class="home-active">
          <img src="<?php echo $host.'/'.$data['inf']['imglogo']?>" style="width:304px;height:228px;" alt="Mountain View" >
        <div class="block-hidden">
          <div data-toggle="modal" data-target="#editimage" class="read-more">Edit image</div>
        </div>
    </div>
           <table class="table table-hover">
             <tr>
               <th>Name: </th><td><?php echo $data['inf']['name_agency']?></td>
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
               <th>Username: </th><td><?php echo $data['inf']['username']?></td>
             </tr>
            <!--  <tr>
               <th>Notes: </th><td><?php echo $data['inf']['notes']?></td>
             </tr> -->
           </table>
           <button style="margin-top:-35px;" type="submit" name="id" value="<?php echo $data['inf']['id']?>" data-toggle="modal" data-target="#editprof" class="btn btn-primary">Edit</button>
       </div>

         
        
    <!-- </form> -->
</div>
<div class="modal fade" id="editimage"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Upload new image: </h4>
        </div>
        <form id="editClien" enctype="multipart/form-data" action="<?php echo $host . "/agency/"; ?>updateimg" method="post">
          <div class="modal-body">
          <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" />
            <div class='form-group'>
                <input type="file" class="form-control" name="userfile" required />
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

<div class="modal fade" id="editprof"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Edit: </h4>
        </div>


<form id="ediForm" enctype="multipart/form-data" action="<?php echo $host . "/agency/"; ?>updateprof" method="post">
          <div class="modal-body">
          <input type="hidden" class="form-control" name="id" value="<?php echo $data['inf']['id']?>" />

              <div class='form-group'>
              <label> Name: </label>
                  <input type="text" class="form-control" name="name" value="<?php echo $data['inf']['name_agency']?>" placeholder = "Name" required />
              </div>
              <div class='form-group'>
              <label> Email: </label>
                  <input type="email" class="form-control" name="email" value="<?php echo $data['inf']['email']?>" placeholder = "Email" required />
              </div>
               <div class='form-group'>
              <label> Password: </label>
                  <input type="password" class="form-control" name="password" placeholder = "Password" />
              </div>
               <div class='form-group'>
              <label> Address: </label>
                  <input type="text" class="form-control" name="address" value="<?php echo $data['inf']['address']?>" placeholder = "Address" required />
              </div>
              <div class='form-group'>
              <label> Phone: </label>
                  <input type="text" class="form-control" name="phone" value="<?php echo $data['inf']['phone']?>" placeholder = "Phone" required />
              </div>
              <div class='form-group'>
              <label> Username: </label>
                  <input type="text" class="form-control" name="username" value="<?php echo $data['inf']['username']?>" placeholder = "Username" required />
              </div>
            <!--   <div class='form-group'>
                <input type="text" class="form-control" name="note" value="<?php echo $data['inf']['notes']?>" placeholder = "Notes" />
              </div> -->
            <!--    <div class='form-group'>
                <input type="file" class="form-control" name="userfile"/>
              </div> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
          
        
      </form>
    </div>
  </div>
</div>
<!--  -->

                <div class="clearfix"></div>
          <!--     </div>
            </div>

          </div> -->
          <br />

          <div class="row">



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
    