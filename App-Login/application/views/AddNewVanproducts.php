
		 <div id="vs"  style=" margin-left:30px" class="tab-pane">
		
		 
					<!-- <div class="form-group" >
					 <table style="
    width: 45%;
">
		

		<tbody>
			<tr style="font-size:13px;text-transform:uppercase">
				<th scope="row" style="
    vertical-align: middle;width:27%">DRIVER'S NAME:</th>
				<td style="
    vertical-align: middle;">Abc</td>
				<th scope="row" style="
    vertical-align: middle;width:27%">REGISTRATION:</th>
				<td style="
    vertical-align: middle;">#123</td>
			</tr>
			
		
		</tbody>
	</table></div>-->
					 
					   <div class="form-group">
					   <label>Products</label>
				<input type="text" class="form-control "  style=" width: 30%;" value="" name="productcode" id="autocomplete" placeholder="Enter the product code" > </div>
				<input type="hidden" id="selectuser_id" name="">
				<div id="citylist"></div>
                </div>
				

					 <div class="form-group" style="margin-top:20px;">
								  
								  <div id="isVan" class="Isvan">
								  <label>Stock Level</label>
								  <input type="text" class="form-control vanlevel"  style=" width: 50%;" value="" name="stocklevel" id="stocklevel"> 
								  <label>Reorder Level</label>
								  <input type="text" name="reorderlevel" id="reorderlevel" value="" class="form-control vanlevel"  style=" width: 50%;">
								  </div>
								  
								  
								  <div class="form-group" style="margin-top:20px" >
								   <label> In Stock </label>
								   
								   
								  <input type="number" name="InStock"  value="" id="InStock" class="form-control form-control-solid"  style="width: 50%;">
								   </div>
							
                     </div>
					
					  </div>
		                <div class="col-md-12 marg_1">
                          <!-- <span class="btn btn-info" id="add_van1" >ADD </span>-->
                           <label>
                           <span  id="addpro" class="btn btn-info" >ADD</span>
                           </label> 
                        </div>
		 
		
		
		 
		 
      </div>
<script>
$( "#autocomplete" ).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "Fetchproductcode",
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
     $('#autocomplete').val(ui.item.label); // display the selected text
     $('#selectuser_id').val(ui.item.value); // save selected id to input
     return false;
  },
  focus: function(event, ui){
     $( "#autocomplete" ).val( ui.item.label );
     $( "#selectuser_id" ).val( ui.item.value );
     return false;
   },
 });
 
</script>