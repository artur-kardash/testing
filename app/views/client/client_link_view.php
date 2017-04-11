        <!-- page content -->
<div class="right_col" role="main">
    <div class="tab-content">
        <div id="client" class="tab-pane fade in active">
            <h2>Generator of link</h2>
    			<div >
		          	<div >
                        <div class="col-sm-4 linkpos">
                            <h3>Client Analitics -<br/> General</h3>
                            <h5>Here is your link:<p class="cursor"><?php echo $host.'/client/linkgeneral?id='.$data['inf']['id']; ?></p></h5>
             			</div> 
             			<div class="col-sm-4 linkpos">
                            <h3>Client Analitics -<br/> Channels</h3>
                            <h5>Here is your link: <p class="cursor"><?php echo $host.'/client/linkchannels?id='.$data['inf']['id']; ?></p></h5>
             			</div>
             			<div class="col-sm-4 linkpos">
                            <h3>Client Analitics -<br/> Conversions</h3>
                            <h5>Here is your link:<p class="cursor"> <?php echo $host.'/client/linkconversions?id='.$data['inf']['id']; ?></p></h5>
             			</div>
         			</div>
         			<div>
             			<div class="col-sm-4 linkpos" >
                            <h3>PDF</h3>
                            <h5>Here is your link:<br/> <p class="cursor"><?php echo $host.'/client/linkpdf?id='.$data['inf']['id']; ?></p></h5>
             			</div>
             			<div class="col-sm-4 linkpos">
                            <h3>Search console</h3>
                            <h5>Here is your link:<p class="cursor"> <?php echo $host.'/client/linksearch?id='.$data['inf']['id']; ?></p></h5>
             			</div>
             			<div class="col-sm-4 linkpos">
                            <h3>Gmetrix</h3>
                            <h5>Here is your link:<p class="cursor"> <?php echo $host.'/client/linkgmetrix?id='.$data['inf']['id']; ?></p></h5>
             			</div> 
		           </div>
    			</div>

    <div class="clearfix"></div>
    <br />  
      	</div>
    </div>
</div>
<style type="text/css">
	
.linkpos{
	margin-top: 50px;
	border: 4px solid #EDEDED;
	margin-left: 13px;
    width: 300px;
    border-radius: 7px;
}
.cursor{
	cursor: pointer;
}

.cursor:hover{
	color: #2583ba ;
}



</style>
<footer>
  <div class="pull-right">
    Jointoit! 
  </div>
  <div class="clearfix"></div>
</footer>

</body>