<?php 
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 $key=$_REQUEST['userid'];
  $emptyarray=array();
 
    if($key == '252')
   {
	   
	   
	$myarray = array(
      
    array("id"=>"1", "heading"=>"A", "Shelves"=>"test one"),
	 array("id"=>"2", "heading"=>"B", "Shelves"=>"test two"),
	  array("id"=>"3", "heading"=>"C", "Shelves"=>"test three")
    );
	
	$myarray1 = array(
      
    array("id"=>"1", "heading"=>"A", "Shelves"=>"https://app.pickmyorder.co.uk/images/cetalogues/15523372311623789568[image,https://app.pickmyorder.co.uk/images/cetalogues/21210224611623789658[pdf"),
	 array("id"=>"2", "heading"=>"B", "Shelves"=>"https://app.pickmyorder.co.uk/images/cetalogues/20265114931617175211[pdf"),
	 
	  array("id"=>"3", "heading"=>"C", "Shelves"=>"https://app.pickmyorder.co.uk/images/cetalogues/18529857541617281088[image")
    );
	
	
	foreach ($myarray as $mydata)
	{
		
		
		 array_push($emptyarray,array('id'=>$mydata['id'],'heading'=>$mydata['heading'],'Shelvesdata'=> $myarray1));
		 
		 
		
	}
	
	if($emptyarray)
	{
	
	echo json_encode(array("statusCode"=>200,'Shelves'=>$emptyarray));
	}
	
   }




?>