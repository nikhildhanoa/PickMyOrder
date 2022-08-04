<?php error_reporting(0); ?>
<div class="container">

 
   
          <form class="form-signin" id="login" method="post" action="Notifications">
		  <div class="row">
		  <table>   
		  <tr id="noticetable"></tr>
		  </table>
		  </div>
		   <div class="row" style="margin-bottom:20px">
			
				<div class="col-md-6 col-xs-12">
							<div class="card card-custom gutter-b example example-compact">
							<div class="card-header">
                        <h3 class="card-title">General Details</h3>
                  <img src="https://app.pickmyorder.co.uk/images/loder/Iphone-spinner-2%20(1).gif" alt="loader1" style="display:none; height:50px; width:50px;position: relative;top: 6px;" id="loaderImg">
                    </div>
					
					<div class="card-body">
                        <div class="dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
					<div class="form-group">
				<span>Source Product List</span>
				
			
				<?php $AllProductList= $this->db->query("select * from dev_productlist"); 
						$productlistarray=$AllProductList->result_array();
				?>
					 <select class="form-control form-control-solid" id="list" class="drop_list">
					 <option value="0"  selected>Select List</option>
					 <?php foreach($productlistarray as $Data) { ?>
						<option value="<?= $Data['id'];?>" ><?php echo $Data['productlistname']; ?></option>
						
					 <?php } ?>
					</select>
				</div>
					 
			
				
	  
	
		
			
				<div class="form-group">
				<span>Source Bussiness</span>
				
				
				<?php $Get_Data = $this->DataModel->Select_All_business(0); ?>
					 <select class="form-control form-control-solid" id="source">
					 <option value="0" class="mainselect"  selected>Select Bussiness</option>
					 <?php foreach($Get_Data as $Data) { ?>
						<option <?php if($Data['id']=='15'){ ?> class="defaultbusiness" <?php } ?> value="<?= $Data['id'];?>" ><?php echo $Data['business_name']; ?></option>
						
					 <?php } ?>
					</select>
			
					 
				</div >
				
	  
	

	      <div class="form-group">
				
					<span>Destination Bussiness</span>
				
			
					 <select class="form-control form-control-solid" id="desti">
					 <option value="0"  selected>Select Bussiness</option>
					 <?php foreach($Get_Data as $Data) { ?>
						<option value="<?= $Data['id'];?>" ><?php echo $Data['business_name']; ?></option>
						
					 <?php } ?>
					</select>
				
		  </div >  
    
	 	
		<div class="form-group">
		
			<span  class="form-control btn btn-info" id="enter">Copy All Product</span >
		</div >  
		
    </div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	 </form>
	
 

  </div>
  <script>
 $('#source').change(function(){
 $('#list').val(0);
 });	 
  
$('#list').change(function(){
 $('#source').val(0);
 });  
  
 /*******************/ 
 $('#enter').click(function(){  
	 bid=$('#source').val(); 
	  newbid=$('#desti').val();
	  listid=$('#list').val();
	  
	  if(listid=='0' && bid=='0')
	  {
		  alert("Please select either source product list or source business ");
	  }
	  else if(newbid=='0')
	  {
		  alert("select Destination Bussiness  ");
	  }  
	  
      else
	  {
	 $.ajax({
		url:"<?= base_url('')?>Copy_List_Product", 
		method:"POST",
		data:{'bid':bid,'newbid':newbid,'listid':listid},
		 beforeSend: function() {
        $("#loaderImg").show();
                           },
		success:function(data)
		{    
		   
			if(data==0)
			{
				$("#loaderImg").hide();
				alert("copy success");
			}
		    else 
			{ 
		        $("#loaderImg").hide();
				alert("copy success");
			}
		}
	 });
	  }
  }); 
  
  </script>

