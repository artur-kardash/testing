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
    <h1>Setting of Agency</h1>
<table>
  <thead>
    <tr>
      <th width="5%" >ID</th>
      <th width="20%">Name</th>
      <th width="30%">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>

    <? foreach($data['inf'] as $inf) :?>
      <td> <?= $inf['id_ag'] ?> </td>
      <td> <?= $inf['name_agency'] ?> </td>
      <td> 
        <a href="<?php echo $host; ?>/admin/review?id=<?php echo $inf['id']; ?>"><input type="button" name="review" value="View/Edit"></a> 
        <a href="<?php echo $host; ?>/admin/delete?id=<?php echo $inf['id']; ?>"><input type="button" name="delete" value="Delete"></a> 
      </td>
    </tr>  
     <? endforeach; ?>
  </tbody>
</table>
</div>
          <br />
    </div>
<footer>
  <div class="pull-right">
   JoinToIt! <!-- <a href="https://colorlib.com">Colorlib</a> -->
  </div>
  <div class="clearfix"></div>
</footer>
<!--  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>tinymce.init({ selector:'textarea' });</script> -->
  <style type="text/css">
 table{
    margin-top: 20px;
 }
   th{
    border: 1px solid black;
    padding: 5px;
    text-align: center;
   }
   td{
    border: 1px solid black;
    padding: 5px;
    text-align: center;
   }
  tbody tr:hover {
    background: #EDEDED; 
    color: #3a3737; 
   }
 </style>      
   