<?php error_reporting(0); 


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
                        <h3 class="card-title">General Details</h3>

                    </div>
                    <div class="card-body">
                        <div class="form-group dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
								
								<div class="form-group">
                                        <span>Source Category List</span>
                                        <?php $cat_list_name=$this->db->query("select id,catalog_list_name from dev_categorylist where Category_ids!=''");
                                              $cat_list_name=$cat_list_name->result_array();
										?>
                                        <select class="form-control form-control-solid mt-2 drop_list" id="Category_List" >
                                            <option  value="0" selected>Select  Category List</option>
                                            <?php foreach($cat_list_name as $cat_Data) { ?>
                                            <option value="<?= $cat_Data['id'];?>">
                                                <?php echo $cat_Data['catalog_list_name']; ?>
                                            </option>

                                            <?php } ?>
                                        </select>


                                    </div>
								
								
								
                                    <div class="form-group">
                                        <span>Source Bussiness</span>
                                        <?php $Get_Data = $this->DataModel->Select_All_business(0); ?>
                                        <select class="form-control form-control-solid mt-2" id="source">
                                            <option value="0" disabled selected>Select Bussiness</option>
                                            <?php foreach($Get_Data as $Data) { ?>
                                            <option value="<?= $Data['id'];?>">
                                                <?php echo $Data['business_name']; ?>
                                            </option>

                                            <?php } ?>
                                        </select>


                                    </div>



                                    <div class="form-group">


                                        <span>Destination Bussiness</span>


                                        <select class="form-control form-control-solid mt-2" id="desti">
                                            <option value="0" disabled selected>Select Bussiness</option>
                                            <?php foreach($Get_Data as $Data) { ?>
                                            <option value="<?= $Data['id'];?>">
                                                <?php echo $Data['business_name']; ?>
                                            </option>

                                            <?php } ?>
                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <span class="form-control btn btn-info" id="enter">Copy All Category</span>
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

 $('#Category_List').change(function(){
	 $('#source').val(0);
	  
  });
  
  $('#source').change(function(){
	 $('#Category_List').val(0);
	  
  });




    $('#enter').click(function () {  
        bid = $('#source option:selected').val();
        newbid = $('#desti option:selected').val();
		 CategoryList = $('#Category_List').val();
		//alert(CategoryList);
		if(CategoryList=="0" && bid==0)
		{
			alert("Please select either source category list or source business");
		}
		else if(newbid==0)
		{
			alert("Please select destination business");
		}
	    else
		{	
		
        $.ajax({
            url: "<?= base_url('')?>getbusinesscat",
            method: "get",
            data: { 'bid': bid, 'newbid': newbid,'CategoryList':CategoryList},
            success: function (data) 
			{

               
			if (data == 1) {
                    alert("Categories copied");
                }
                else {
                    alert("There are no new categories to copy in this business");
                }
            }
        });
		}
    });


</script>