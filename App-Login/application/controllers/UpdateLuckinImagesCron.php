<?php ini_set('display_errors',1);
$servername = "localhost";
$username = "u479956399_scott";
$password = "~4TjCkVWA";
$dbname = "u479956399_pickmyorderapp";
$get_lucking_info=1;

// print_r(date("h:i:sa"));die;
// for sql database update data
$conn=mysqli_connect($servername, $username, $password,$dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
	$res = $conn->query("update `dev_products`,dev_temp_lukins_data set `dev_products`.products_images=dev_temp_lukins_data.products_images,`dev_products`.product_image_two=dev_temp_lukins_data.product_image_two ,`dev_products`.product_image_three=dev_temp_lukins_data.product_image_three,`dev_products`.pdf_manual=dev_temp_lukins_data.pdf_manual,	`dev_products`.pdf_manual2=dev_temp_lukins_data.pdf_manual2,`dev_products`.pdf_name=dev_temp_lukins_data.pdf_name,`dev_products`.pdf2_name=dev_temp_lukins_data.pdf2_name,
	`dev_products`.publish_status=dev_temp_lukins_data.publish_status 
	where  	Tsicode =ITM_ItemCode");
	?>