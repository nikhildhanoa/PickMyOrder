
setTimeout(function(){
$('.checkbox-all').change(function(){
	
	if($(this).children().is(":checked")) 
	{
		  obj=document.getElementsByClassName('datatable-cell-check');
		
			for(i=1;i<obj.length;i++)
			{
				$chekedid=obj[i].getAttribute('aria-label');
				
				  $.ajax({
						   url:"https://stagingapp.pickmyorder.co.uk/themeCustomization/insertidintableforprint",
						   type:"post",
						   data:{'pid':$chekedid}, 
						   success:function(data){
							  
						   }
						}); 
		
			}			
    }
	
	if(!$(this).children().is(":checked")) 
	{
		  
		  $.ajax({
					url:"https://stagingapp.pickmyorder.co.uk/themeCustomization/UpdateIdinTableForPrint",	
				});
    }
	
});

/* $('.datatable-cell-check').change(function(){
		var attr = $(this).attr('aria-label');
		
		if (typeof attr !== typeof undefined && attr !== false)
		{
		   if($('.datatable-cell-check > span > label').children().is(":checked"))
			   { 
					alert('ceck');
					
					  $.ajax({
							   url:"https://stagingapp.pickmyorder.co.uk/themeCustomization/insertidintableforprint",
							   type:"post",
							   data:{'pid':attr}, 
							   success:function(data){
								 
							   }
							});  
			   }
			if(!$('.datatable-cell-check > span > label').children().is(":checked"))
			   {
					
					
					  $.ajax({
							   url:"https://stagingapp.pickmyorder.co.uk/themeCustomization/uncheckedaorderprint",
							   type:"post",
							   data:{'unchked_id':attr}, 
							   success:function(data){
								  alert(data);
							   }
							});  
			   }
		}
		
}); */
$('.dz-default.dz-message').css('border','2px dashed #3699ff'); 
  $('.dz-default.dz-message').css('padding','40px');
   

}, 3000);    



Dropzone.autoDiscover = false;
$(".dropzone").dropzone({
 addRemoveLinks: true,
 removedfile: function(file) {
   
   var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
 }
});
