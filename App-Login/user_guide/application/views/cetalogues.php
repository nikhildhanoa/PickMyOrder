<?php error_reporting(0); ?>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Catalogues</a></li> 		
  </ul>
 <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Catalogues</h3> 
   <div class="row">
	    <div style="margin-top:100px;margin-bottom:100px">
           
              <form enctype="multipart/form-data" method="post" action="<?php echo site_url('cetalogues');?>">
			  <div class="col-sm-6">
               <input type="file" name="pdffile" required>
            </div>
        <div class="col-sm-6">
            <input type="submit" value="Upload PDF" name="uploadpdf">
        </div>
               </form>
        </div>
   </div><hr>
   <?php 
    if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	$All_Cetalogues=$this->CetaloguesModels->ViewCatelog($bid);
 }else
 {
	 $bid=$_SESSION['status']['business_id'];
	$All_Cetalogues=$this->CetaloguesModels->ViewCatelog($bid); 
 }
   
   ?>
      <div class="row">
	<?php  foreach($All_Cetalogues as $single_catelog)
     { 
   ?>
         <div class="col-sm-3">
		 <a href="<?php echo site_url('deletecatelog?id='.$single_catelog['id']);?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
          <iframe class="pdfshow" src="<?php echo $single_catelog['url'];?>"   height="200px" width="100%" frameborder="0"></iframe>
         </div>
 <?php } ?>
       </div>
   
    </div>

  </div>
  
</div>

