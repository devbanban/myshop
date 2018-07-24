<?php include('h.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-12">
        	<?php include('navbar.php');?>
        </div>
    </div>
 </div> 
 
 <div class="container">
 	<div class="row">
        	<!-- categories-->
    	<div class="col-md-3">
        	<?php include('category.php');?>
        </div>
    	<div class="col-md-9">
        <div class="panel panel-default">
  				<div class="panel-body">
    				 <b>  ข่าวสารจากทางร้าน  </b>
  				</div>
		</div>
        		  
                
                <?php 
				$n_id = $_GET['n_id'];
				
				if($n_id !=''){
					include('list_news_detail.php');
					
				}else{
					include('list_news.php');
				}
				
				
				
				
				?>
        </div>
    </div>
</div>
 
  </body>
</html>
<?php include('f.php');?>