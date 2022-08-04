<?php error_reporting(0);
 

  /**************************************/
   if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
			
 }else
 {
	 $bid=$_SESSION['status']['business_id'];		
 }
 $role=$_SESSION['status']['role'];
 
 
 
    
	if($role=="1")
	{
	   $Shelves=$this->db->query("select * from dev_Shelves  where business_id='$bid' ORDER BY sort_order ");	
	}
	else
	{
		$Shelves=$this->db->query("select * from dev_Shelves  where business_id='$bid' and lock_shelves=0 ORDER BY sort_order ");
	}	

  $Shelves=$Shelves->result_array();
 
?>


<div class="container">
  <ul class="nav nav-tabs">
  
   <li><a data-toggle="tab" href="#AddShelves">Add Shelves</a></li>
    <li><a data-toggle="tab" href="#ManageShelves">Manage Shelves</a></li>
   
  </ul>
 <div class="tab-content">
 
 <!------------------------------------------->
  <div id="AddShelves" class="tab-pane active background">
     
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Add Shelves</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
           
              <form  method="post" action="<?php echo site_url('AddShelves'); ?>">
			 
				  
							   <div class="form-group ">
								  <div>Shelves Name</div>
								 
									<input type="text" name="Shelves" placeholder="Shelves Name" class="col-md-6 form-control form-control-solid mt-5" required>
									
								 
								</div>
				  
					   <div class="form-group ">
								<input type="submit" name="addShelves" Value="Add Shelves" class="btn btn-info">
						</div>
					
					 
               </form>
       

  </div>
   </div>
    </div>
	</div> 
</div>
</div>
 </div>
  </div>
   </div>
 <!------------------------------------------>
 <div id="ManageShelves" class="tab-pane   background">
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Manage Shelves</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
 
      
	 <table   class="table table-striped">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Shelves</th>
       <th>Date</th>
	  
		<th>Edit</th>
		<th>Delete</th> 
	<?php if($role=='1')  { ?><th>shelves Lock</th> <?php } ?>
	   <th>Add Section</th> 
		 
      </tr>
    </thead>
    <tbody id="sortable">
 

  <?php  foreach( $Shelves as $Shelvesdata ) 
          
  { 
  ?>
  
	    <tr class="ui_state_default" id="<?php echo $Shelvesdata['id'];  ?>">
		<td ><?php echo $Shelvesdata['id'];  ?></td>
		<td ><?php echo $Shelvesdata['shelves_name'];  ?></td>
		<td ><?php echo $Shelvesdata['date'];  ?></td>
		
		<td ><a href="<?php  echo base_url('EditShelves?id='.$Shelvesdata['id']);  ?>"><i style="color:#5867dd" class="fa fa-edit" aria-hidden="true"></i></a></td>
		<td ><a href="<?php  echo base_url('DeleteShelves?id='.$Shelvesdata['id']);  ?>" class="newanchor " id="cat_delet" ><i class="fa fa-times-circle" aria-hidden="true"></a></i></td>
		
		
 <?php if($role=='1')  { ?> <td style="padding-left: 50px;">  <input  id="lock_ids" class="form-check-input" type="checkbox" value="<?php echo $Shelvesdata['id'];  ?>" id="flexCheckDefault" <?php if($Shelvesdata['lock_shelves']=='1'){  ?> checked <?php } ?>    ></td> <?php } ?> 
 
 
        <td style="padding-left: 50px;" ><a href="<?php  echo base_url('ManageCatalogSection?id='.$Shelvesdata['id']);  ?>" class="newanchor " id="cat_delet" ><i class="fa fa-eye" id="eyes" aria-hidden="true"></a></i></td>		
		</tr>
  <?php } ?>

	    </tbody>
  </table>
  <div class="set_order_button"  style="display: flex;
    justify-content: flex-end;">
	<?php if($role=='1')  { ?><span class="lock_shelve" type="" style="padding: 5px  10px;background-color: #3699ff;color: #fff;border-radius: 9px;font-size: 14px;line-height: 29px;margin: 6px;cursor: pointer;">update Shelve</span>  <?php } ?>
	
  <span class="divbutton2" type="" style="padding: 5px  10px;background-color: #3699ff;color: #fff;border-radius: 9px;font-size: 14px;line-height: 29px;margin: 6px;cursor: pointer;">SET ORDER</span>
  </div>
 </div>
  </div>
   </div>
    </div>
	 </div>
	  </div>
	   </div>
	    </div>
		 </div>

 
<!--::js""-->
<script>
/**************set order*************/
  $("#sortable").sortable();
    $("#sortable").disableSelection();
	
/**************lock shelve***************/	
	$('.lock_shelve').click(function(){
	
	    var checkids=[];
	$('#lock_ids:checked').each(function(k){
		 checkids[k] = $(this).val();
	});	
	    var uncheckids=[];
	$('#lock_ids:not(:checked)').each(function(k){
		 uncheckids[k] = $(this).val();
	});
        
   
		
		$.ajax({
			
			  url:'<?base_url('')?>LockShelve',
			  method:'post',
			  data:{'checkids':checkids,'uncheckids':uncheckids},
			  success:function(data)
				  {
					 if(data==1)
					 {
						 alert("Shelves update");
						 location.reload();
					 }						 
				  }
		      });
	

  	
		
	});
	
	
	
	
/**********************************/	
$(".divbutton2").click(function(){
  var ids='';
  $(".ui_state_default").each(function(){
	if(ids!='')ids =ids+','+this.id; else ids =this.id;     
 }); 
	
 if(ids)
  {
	  
	 $.ajax({
			url:"<?= base_url('')?>GetSetOrderIdsShelve",
			method:"post",
			data:{'setorderid':ids},
			success:function(data)
			{
				if(data== 1)
				{
					alert("your Order Set");
					
				}
			}
	  });
	  
  } 
 });







/************ggg*/
jQuery('#SelectSectionForCatalog').change(function(){
	  jQuery(".addepter").empty();
      selctvalue = jQuery(this).val();
	  
	  
      jQuery.ajax({
          url:"<?= base_url('')?>newcatalogcontroller/ShowCatalogBySection",
          method:"post",
          data:{'selectedid':selctvalue},
          success:function(data)
          {
			  
			  if(data!='0')
			  {
				  
				  parseddata = JSON.parse(data);
				  
				   if(parseddata.length)
				  {
					  for(i=0;i<parseddata.length;i++)
					  {
						  
						  url=parseddata[i]['url'];
						  id = parseddata[i]['id'];
						  jQuery(".addepter").append("<div class='col-sm-3 imgbox'><img src='"+url+"' style='width:100px;height:100px'><i class='fa fa-times deleteicon' id='"+id+"' aria-hidden='true'></i></div>");
						  
						
					}   
						jQuery(".deleteicon").click(function(){

							id = $(this).attr('id');
							jQuery.ajax({
							  url:"<?= base_url('')?>newcatalogcontroller/DeleteCateLougesImg",
							  method:"post",
							  data:{'id':id},
							  success:function(data)
							  {
								  console.log('delete sucessfully');
							  }
							 	
							});	
							jQuery(this).parent('.imgbox').remove();  
						});			  
				}
				  
			  }
			  else
			  {
				  alert('Select a section');
			  }
          }
      })
});

//confirmatiom-Of-Delete

$('.newanchor').click(function(){
		var myIdd = $(this).attr('id');
		$("#deca").attr("href", myIdd);
	});

</script>
