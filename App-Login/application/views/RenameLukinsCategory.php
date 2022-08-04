<?php error_reporting(0); 
/* print_r($key);die; */

?>
<div class="container">

    <form class="form-signin" id="login" method="post" action="Notifications">
        <div class="row">
            <table>
                <tr id="noticetable"></tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Rename Lukins Category</h3>

                    </div>
                    <div class="card-body">
                        <div class="form-group dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
								
								<div class="form-group">
                                        <span>Lukins Category List</span>
                                        <select class="form-control form-control-solid mt-2 drop_list" id="Category_List" >
                                            <option  value="0" selected>Select Category</option>
                                            <?php foreach($key as $cat_Data) { ?>
                                            <option value="<?= $cat_Data['COM_Code'];?>">
                                                <?php echo $cat_Data['COM_Description']; ?>
                                            </option>

                                            <?php } ?>
                                        </select>
                                    </div>
								
                                    <div class="form-group">
                                        <span>Enter New Category Name</span>
                                       <input type="text" name="rename" id="newcatname"  class="form-control form-control-solid mt-2 drop_list">


                                    </div>

                                     <div class="form-group" id='renamecatspiner' style="display:none">
                                        <span class="form-control btn btn-info"  ><img src="https://app.pickmyorder.co.uk/images/loder/Iphone-spinner-2%20(1).gif" alt="loader1" style="height:30px; width:30px;position: relative;top:-5px;" id="loaderImg"></span>
                                    </div>
                                    <div class="form-group" id='renamecatbutton' style="display:block">
                                        <span class="form-control btn btn-info" id="renamecat">Rename Category</span>
                                    </div>

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

$('#renamecat').click(function(){
	
	var categoryHtml  = $("#Category_List option:selected").html();
	var newcatname  = $("#newcatname").val();
	
	if(categoryHtml=='Select Category')
	{
		alert('Please select category');
	}
	else if(newcatname=='')
	{
		alert('please Enter Category Name');
	}
    else
	{
		
		$.ajax({
			
			url:'<?=base_url()?>changecatname',
			type:'post',
			data:{'categoryHtml':categoryHtml,'newcatname':newcatname},
			beforeSend: function() {
		    $("#renamecatspiner").show();
		    $("#renamecatbutton").hide(); },
                         
			success:function(data)
			{
			   $("#renamecatspiner").hide();
			   $("#renamecatbutton").show();
			   $("#Category_List").val(0);
			   $("#newcatname").val('');
					 
				if(data == 1)
				{
					alert('This category Name Allready change');  
				} 
                else
				{
					
				alert('category Name  change');
					
				}
						  
			},
			
			
			
		});
		
	}		
	
    	
	
	
});




</script>