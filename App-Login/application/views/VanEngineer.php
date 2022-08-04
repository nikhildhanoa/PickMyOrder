<?php 

if(isset($key) && isset($van) && isset($engineers_deatils) )
{
  
	       $query = $this->db->query("select van_id from dev_van_engineer where van_id='$van'");  
           $num=$query->num_rows();
		   if($num)
		   {
			   $showDivFlag=true;
		   }
		   else
		   {
			  $showDivFlag=false;  
		   }
	
	        
	
	

?>

<div><div><div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
										<div class="row">
											<table class="table">

  <tbody>
 
    <tr style="color:#bbbbbb;font-size:13px;text-transform:uppercase">
      <td>Driver's Name</td>
      <td>Vehicle Registration</td>      
    </tr>
    <tr style="font-size:">
     
      <td><?php echo $key[0]['driver_name'];?></td>
      <td><?php echo $key[0]['vehicle_registration'];?></td>
    </tr>
  </tbody>
</table>
<div class="All_products_aign" style="display:flex;justify-content:flex-start;align-items:flex-end;height:50px;width:100%">
<h3 style="
    font-family: inherit">Van Engineer</h3></div>
</div>

										</div>
										<div class="card-toolbar" style="align-items:flex-start;">
											<!--begin::Dropdown-->
											
										
										
											<a class="btn btn-primary" href="<?php echo site_url('VanAllOrder?id='.$van);?>" role="button" style=" margin: 0 10px; display: inline-block;">All Orders</a>
											
											<a class="btn btn-primary" href="<?php echo base_url('vanAllProducts?id='.$van); ?>" role="button">All products</a>
											<!--end::Button-->
										</div>
									</div>
									
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					
					
					
					
						<!-- Latest_table -->
					
					
					<div class="new_table" style="margin:20px 0"><div><div class="container"<?php if ($showDivFlag===true){?>style="display:none"<?php } ?> >
								<!--begin::Card-->
								<!-- /*<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
										
									
											<div class="row" >
											<table>

  <tbody>
 
    <tr style="color:#bbbbbb;font-size:13px;text-transform:uppercase;height:30px">
      <td >Add Engineer</td>
           
    </tr>
    <tr style="font-size:">
     
      <td style="height: 53px;"><input type="text" style="width:80%;border: none!important; border-bottom: 2px solid #c1c1c1!important;" placeholder="Enter Engineer" id="autocomplete"></td>
   
	<input type="hidden" class="eng" id="selectuser_id" name="products">
   
	
	<td style="width: 725px;"></td>
	<td><a class="btn btn-primary"  role="button" style=" margin: 0 10px; " id="end_id">Add </a></td>
    </tr>
  </tbody>
</table>

</div>









										</div>
									
									</div>
									<div class="card-body" style="
    padding: 14px;
">
										
										
								
							</div>
							
						</div>-->
						<!--end::Entry-->
					</div>
				
					
					<!--end::Content-->
				<div class="form_part" style="margin-top: 24px;">
<div class="container">
								<div class="card card-custom">
									
									<div class="card-body">
										
										<div class="mb-7">
											<div class="datatable datatable-bordered datatable-head-custom printable" id="kt_datatable"></div>
										</div>
									
									</div>
								</div>
				</div>
							</div>

		
		<?php
        }
       ?>		
					
<script>
 
 $( "#autocomplete" ).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "FetchVanEngineer",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term
    },
    success: function( data ) {
     response( data );
    }
   });
  },
  select: function (event, ui) {
     // Set selection
     $('#autocomplete').val(ui.item.label); 
     $('#selectuser_id').val(ui.item.value); 
     return false;
  },
  focus: function(event, ui){
     $( "#autocomplete" ).val( ui.item.label );
     $( "#selectuser_id" ).val( ui.item.value );
     return false;
   },
 });
 
 
$('#end_id').click(function(){
	
    var eng=$('.eng').val();
  if(eng == '')
  {
	  alert("Add Engineer First");
  }
  else
  {
        $.ajax({
	   
				url:"<?= base_url('')?>InsertVanEngineer",
				method:"post",
				data:{'engid':eng,'vanid':<?php echo $van ?>},
				success:function(data){
					
					if(data == 1)
					{
						alert("Van Engineer Add successfully");
						location.reload();
					}
				    }
                          
          });
  }
          });
</script>