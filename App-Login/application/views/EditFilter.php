<?php 
$id=$_GET['id'];
$catobj=$this->db->query("select filter from dev_product_cat where id='$id'");
$catArray=$catobj->result_array();
$SerializeData=$catArray[0]['filter'];
$fulldata=unserialize($SerializeData);

?>
<style>
.form-control{
	width:100%;
	background-color: #EAF1F7;
}
#form_top{
    padding: 20px;
    background-color: #fff;
    margin: 40px;
	border-radius: 10px;
}
.content {
	
}
</style>
<section id="form_top">
<div class="container">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Edit Fillter</a></li>
	
  </ul>

  <div class="tab-content">
 
<!------------------------------------------------------------------s---------------------------------------------------------------------->
    <div id="home" class="tab-pane  background active">

<form class="addblock" method="post"  action="<?php echo site_url('editfillter');?>">
<input type="hidden" name="catid" value="<?php echo $id;?>" id="cat">
<div class="col-md-12">
<button   class="add_field_button btn btn-info active">Add More Atrributes</button>
<div class="input_fields_wrap">
<?php
foreach($fulldata as $f)
{
	$key=array_keys($f);
	$value=array_values($f);
 
?>
<div class="row">
<div class="col-md-3">
<div class="form-group" >
<label for="">Atibute key</label>

<input name="key[]" type="text" value="<?php echo $key[0]; ?>" class="form-control" required="">
</div></div>

<div class="col-md-7">
<div class="form-group">
<label for="">Values</label>
<input name="value[]" type="text" value="<?php echo $value[0];?>" class="form-control" required>
</div>
</div>

<div style="cursor:pointer;;" class="remove_field ">Remove</div>
</div>
<?php } ?>

</div>
</div>
<button  name="Editfillter" class="btn btn-info">UPDATE</button>    
</form>
</div></div></div>
</section>
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

});
</script>
