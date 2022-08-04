<?php error_reporting(0);

 ?>
<div class="container">

 
   
          <form class="form-signin" id="login" method="post" action="Notifications">
		  <div class="row">
		  <table>   
		  <tr id="noticetable"></tr>
		  </table>
		  </div>
		   <div class="row" style="margin-bottom:20px">
			
				<div class="col-md-11 col-xs-11 mx-auto">
							<div class="card card-custom gutter-b example example-compact">
							<div class="card-header">
                        <h3 class="card-title"><?php echo $key[0]['email'];?></h3>
                  <img src="https://app.pickmyorder.co.uk/images/loder/Iphone-spinner-2%20(1).gif" alt="loader1" style="display:none; height:50px; width:50px;position: relative;top: 6px;" id="loaderImg">
                    </div>
					
					<div class="card-body">
                        <div class="dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
					<div class="form-group">
				<span></span>
				
			
				<table id="" style="width:100%;margin-bottom:25px">
			   <thead>
			          
			          <tr style="background: #e8e8e8;color: #000;">
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;font-size: 15px;font-weight: 500;">Domains</th>
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;">Edit</th>
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;">Delete</th>
					  </tr>
					
			  </thead>
				
	          <tbody>			
					<?php  if(!$key=='') { foreach($key as $keydata){   ?>                      
			  <tr style="border: 1px solid #DADADB;"> 
			   <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"><span id="<?php echo 'span'.$keydata['id'];  ?>"><?php echo  $keydata['domains']; ?></span>
<input type="text" value="<?php echo $keydata['domains'];?>" id="<?php echo'input'.$keydata['id'];?>"  style="display:none">
			   
			   </td>
			   <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf">
			   <i id="<?php echo 'checkin'.$keydata['id'];  ?>" style="display:block" data-id="<?php echo $keydata['id'];  ?>" class="fa fa-edit editdimain" aria-hidden="true"></i>
			   <i  id="<?php echo 'checkout'.$keydata['id'];  ?>" data-key-id="<?php echo $keydata['id'];?>" style="display:none" class="fa fa-check checkdomain" aria-hidden="true"></i></td>
			  
			   <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"><i  class="fa fa-times-circle delete" id="<?php echo $keydata['id'];  ?>" aria-hidden="true"></i></td>
							   
				</tr>
					<?php } ?>
									  
					  </tbody>
			   </table>
			   <?php }else{ ?>
					
             <span  style="position: absolute;bottom: 38px;width: 100%;text-align: center;font-weight: bold;">This User Has Not Added Any Domain<a style="margin-left:5px" href="<?php base_url() ?>/SetUp">Go Back</a></span>
			      
					<?php  } ?>  
			   
				</div>
				
		<!--<div class="form-group">
		
			<span  class="form-control btn btn-info" id="enter">Edit</span >
		</div >  -->
		
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
$(".checkdomain").click(function(){

  id=$(this).attr('data-key-id');
  var val=$('#input'+id).val();
  
	$.ajax({
		   url:'<?= base_url('')?>EditSingleDomain',
           method:'post',
           data:{'id':id,'val':val},
		   success:function(data)
		   {  
			 if(data==1)
			 {
				$('#checkout'+id).css("display", "none");
	            $('#checkin'+id).css("display", "block"); 
				 $('#input'+id).css("display", "none");
	             $('#span'+id).css("display", "block");
				 $('#span'+id).html(val);
			 }
		   }
	      });
});


  
$(".editdimain").click(function(){

	id=$(this).attr('data-id');
	 $('#checkout'+id).css("display", "block");
	$('#checkin'+id).css("display", "none");
	 $('#input'+id).css("display", "block");
	$('#span'+id).css("display", "none");
});



$(".delete").click(function(){
	
	 id=$(this).attr('id');
	
	$.ajax({
		   url:'<?= base_url('')?>DeleteDomain',
           method:'post',
           data:{'id':id},
		   success:function(data)
		   {  
			 if(data==1){location.reload();}
		   }
	      });
	
});
  </script>

