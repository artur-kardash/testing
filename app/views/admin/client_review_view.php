<body class="nav-md">
    <div class="container body">
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="<?php echo($host.'/'.$data['prof']['imglogo']); ?>" alt=""><?php echo($data['prof']['name_agency']); ?> -->
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/index/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
<div class="right_col" role="main">
<div style="display: block; float: left; width: 25%; position: relative;">
    <h1>Client</h1>
 <div class="home-active">
          <img src="<?php echo $host.'/'.$data['inf']['img']?>" style="width: 300px; height: 300px; object-fit: cover;" alt="Mountain View" >
        <div class="block-hidden">
          <div data-toggle="modal" data-target="#editimg" class="read-more">Edit image</div>
        </div>
  </div>

   <table class="table table-hover">
                    <input type='hidden' name='id_client' value='<?php echo $data['inf']['id']?>'/>
                    <tr>
                        <td style="border-top: 1px solid black;">Name: </td><td style="border-top: 1px solid black;"><?php echo $data['inf']['name']?></td>
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
           
           <button style="margin-top:20px;" type="submit" name="id" value="<?php echo $data['inf']['id_ag']?>" data-toggle="modal" data-target="#editclient" class="btn btn-primary">Edit</button>
          <!--  <button style="margin-top:20px;" type="submit" name="delete" value="<?php echo $data['inf']['id_ag']?>" class="btn btn-danger">Delete</button> -->
           <a href="<?php echo $host; ?>/admin/deleteclient?id=<?php echo $inf['id']; ?>"><input style="margin-top: 20px;" type="button" class="btn btn-danger" name="delete" value="Delete"></a>
           <br/>
           <button style="margin-top:20px;" type="submit" name="back" onClick="history.back()" class="btn btn-primary">Back</button>
  </div>

</div>

  <div class="modal fade" id="editimg"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Upload new image: </h4>
                        </div>
                        <form id="editC" enctype="multipart/form-data" action="<?php echo $host . "/admin/"; ?>updateimages" method="post">
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

<div class="modal fade" id="editclient"  tabindex="-1" role="dialog" aria-labelledby="editCampaign">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Edit: </h4>
        </div>


<form id="editCliorm" enctype="multipart/form-data" action="<?php echo $host . "/admin/"; ?>updateclient" method="post">
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
                  <input type="text" class="form-control" name="address" value="<?php echo $data['inf']['address']?>" placeholder = "Address"  />
              </div>
              <div class='form-group'>
              <label>Phone:</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo $data['inf']['phone']?>" placeholder = "Phone"  />
              </div>
              <div class='form-group'>
              <label>Url:</label>
                  <input type="text" class="form-control" name="url" value="<?php echo $data['inf']['url']?>" placeholder = "Creator name"  />
              </div>
               <div class='form-group'>
              <label>Notes:</label>
                  <input type="text" class="form-control" name="notes" value="<?php echo $data['inf']['notes']?>" placeholder = "Creator name"  />
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
      

      <br />
    </div>
      
<footer>
  <div class="pull-right">
    JoinToIt! <!-- <a href="https://colorlib.com">Colorlib</a> -->
  </div>
  <div class="clearfix"></div>
</footer>
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>tinymce.init({ selector:'textarea' });</script>
 <style type="text/css">
 tr, th, td{
    border: 1px solid black;
}
 .logoclient{
  width: 100px!important;
  height: 100px!important;
  object-fit: cover!important;
   /* width: 200px;
    height: 200px;*/
    /*border-radius: 50%;*/
  border: 3px solid #e5dee5!important;
 }
 table{
    margin-top: 20px;
 }
    tr, th, td{
    border: 1px solid black;
    padding: 5px;
    text-align: center;
   }
   th{
    width: 33%;
   }
   td{
    width: 48%;
   }
.round {
    width: 200px;
    height: 200px;
    /*border-radius: 50%;*/
    border: 3px solid #e5dee5;
   }
  tbody tr:hover {
    background: #EDEDED; 
    color: #3a3737; 
   }

.home-active{
    width: auto;
    height: auto;
    position: relative;
    text-align: center;
    display: inline-block;
  /*  width: 300px;
    height: 300px;   
    position: relative;
    text-align: center;*/  
}
.home-active img{
    width: 300px;
    height: 300px;     
}
 
.block-hidden{  
    height: 76%!important;  
    display: none;
}

.home-active:hover .block-hidden{
    width: 100%;
    height: 100%!important;
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
   video{
    margin-bottom: 25px;
    margin-top: -60px;
   }
   .display{
      margin-bottom: 40px;
      z-index: 50;
      position: relative;
   }
   .dispcheck{
    vertical-align: sub;
    margin-left: 5px!important;
   }
   .modal-footer-two{
        padding: 15px 15px 0px 15px;

   }
   .textpos{
        margin: 0px;
        font-size: 14px;
        color: #000;
        margin-bottom: 50px;
   }
   .pos{
    margin-bottom: 30px;
   }
 </style>