<style type="text/css">
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
    width: 200px;
   }

   .name_position{
    text-align: center;
   }
</style>
<body class="nav-md">
    <div class="container body">
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <ul class="nav navbar-nav navbar-right">
                <li class="">

                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php if($data['prof'] == null){ ?>
                    
                    <img src="<?php echo($host.'/images/no_image.png'); ?>" alt="">
<?php }else{ ?>

                    <img src="<?php echo($host.'/'.$data['prof']['imglogo']); ?>" alt=""><?php echo($data['prof']['name_agency']); ?>

<?php } ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $host.'/agency/infagency'?>"> Profile</a></li>
                    <li><a href="/index/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                 <li>
                    <a href="#" class="edit-client" data-toggle="modal" class="edit-button" data-target="#client" >
                      <!-- <span class="badge bg-red pull-right">50%</span> -->
                      <span>Add new client</span>
                    </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
       <h1>All clients</h1>
<div class="hero-grid clearfix">
  <div class="hero-grid__item">
  <? foreach($data['all'] as $inf): ?>
      <div class="home-active">
        <figure class="sign">
          <a href="<?php echo $host; ?>/client/clientinfo?id=<?php echo $inf['id']; ?>"><img class="logoclient" src="/<?php echo $inf['img']; ?>"></a>
          <figcaption class="name_position"><?php echo $inf['name']; ?></figcaption>
         </figure>
      </div>
    <? endforeach ?>
  </div>
</div> 

</div>
  <div class="clearfix"></div>
          <br />

          <div class="row">
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Simon project! <!-- <a href="https://colorlib.com">Colorlib</a> -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>