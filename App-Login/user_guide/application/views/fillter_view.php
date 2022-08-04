<?php 
if(isset($_SESSION['Current_Business']))
{
	$business_id=$_SESSION['Current_Business'];
}
else
{   
	$business_id=$_SESSION['status']['business_id'];
}
$catobj=$this->db->query("select * from dev_product_cat where business_id='$business_id' ");
$catArray=$catobj->result_array();

$catFillterObj=$this->db->query("select * from dev_product_cat where business_id='$business_id' && filter!=''");
$catFillterArray=$catFillterObj->result_array();

?>
<style>
.form-control{
	width:100%;
}
</style>
<div class="container">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">Manage Fillter</a></li>
	
    <li ><a data-toggle="tab" href="#home">Add Fillter</a></li>
   <!------ <li><a data-toggle="tab" href="#menu1">Add Projects</a></li>----------->
		
  </ul>

  <div class="tab-content">
  <div id="list" class="tab-pane  active background">
      <p>Choose a category to edit filters.</p>
		<div class="row">
			
				<?php foreach($catFillterArray as $single){
                    if(count(unserialize($single['filter'])))
					{
					?>
					<div class="col-md-3">
						<div class="form-group" >
							<a href='<?php echo site_url()."editfillter?id=".$single['id'] ?>' ><?php echo $single['cat_name']; ?></a>
						</div>
					 </div>	
					<?php } }?>
		</div>
	</div>
<!---------------------------------------------------------------------------------------------------------------------------------------->
    <div id="home" class="tab-pane  background">
      <h3>Add Fillter</h3>
<div class="row">
<div class="col-md-3">
<div class="form-group" >
<label for="">Select Category</label>
<select class="form-control catbox">
	<option value=0>----Select-----</option>
	<?php foreach($catArray as $cat)
	{ 
	 
	  if(!count(unserialize($cat['filter'])) || $cat['filter']=='')
		{
	?>
	<option value="<?php echo $cat['id'];?>"><?php echo $cat['cat_name']; ?></option>
		<?php } }?>
</select>
</div>
</div>
</div>

<form class="addblock" method="post" style="display:none" action="<?php echo site_url('fillter');?>">
<div class="col-md-12">
<div class="input_fields_wrap">
<div class="row">
<div class="col-md-3">
<div class="form-group" >
<label for="">Atibute key</label>
<input type="hidden" name="catid" value="0" id="cat">
<input name="key[]" type="text" value="" class="form-control" required="">
</div></div>

<div class="col-md-7">
<div class="form-group">
<label for="">Values</label>
<input name="value[]" type="text" value="" class="form-control" required>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<br>
<button   class="add_field_button btn btn-info active">Add More Atrributes</button>
</div></div>
</div>
</div>
</div>
<input type="submit" name="addfillter" class="btn btn-info">
</form>
</div></div></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="row"><div class="col-md-3"><div class="form-group"><label for="">Atribute Key</label><input required name="key[]" type="text" class="form-control"></div></div><div class="col-md-7"><div class="form-group"><label for="">Values</label><input required name="value[]" type="text" class="form-control"></div></div><div style="cursor:pointer;;" class="remove_field ">Remove</div></div>'); //add input box
}
});
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault(); $(this).parent('div').remove(); x--;
})
$('.catbox').change(function(){
	
	if($(this).val()!=0)
	{
		$('.addblock').css('display','block');
		$("#cat").val($(this).val());
	}
	else
	{
		$('.addblock').css('display','none');
			$("#cat").val(0);
	}
});
});
</script>
