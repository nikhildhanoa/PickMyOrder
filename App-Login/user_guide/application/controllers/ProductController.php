<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
    $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->Model('ProductModel');
	$this->load->library('upload');
    $this->load->library('image_lib');
	
	}
	
   public function UpdateUrlMethod()
   {
    $siteurl=site_url();                   
    $siteur=explode('/',$siteurl);
    $updateurl=explode(':',$siteur[0]);
if($updateurl[0]!='https')
  {
	/* $updateurl=$updateurl[0].'s://'.$siteur[2];
	return($updateurl) */;
	$updateurl=site_url();
	return($updateurl);
  }
else
  {
	$updateurl=site_url();
	return($updateurl);
  } 
}
	public function Products(){
		if(isset($_SESSION['status'])){
			$tab_data= array();
			$FillterArrayEmpty=array();
			if(isset($_POST['AddGernelDetails']))
			{// print_r($_POST);die;         
				$bussiness_id=$_SESSION['status']['business_id'];
				if(isset($_SESSION['Current_Business']))
			{
					$bussiness_id=$_SESSION['Current_Business'];
					
			}
			if($this->input->post('Sub_Sub_Category'))
			{
				$SUPER_SUB_CAT_ID=$this->input->post('Sub_Sub_Category');
				$getsupersubcatname=$this->db->query("select name from super_sub_cat where id='$SUPER_SUB_CAT_ID'");
				$getsupersubcatname=$getsupersubcatname->result_array();
				$supersubcatnameis=$getsupersubcatname[0]['name'];
			}
			else
			{
				$SUPER_SUB_CAT_ID=0;
				$supersubcatnameis='';
			}
			if($this->input->post('Sub_Category'))
			{
				$SUB_CAT_ID=$this->input->post('Sub_Category');
				$getsubcatname=$this->db->query("select sub_cat_name from dev_product_sub_cat where id='$SUB_CAT_ID'");
				$getsubcatname=$getsubcatname->result_array();
				$subcatnameis=$getsubcatname[0]['sub_cat_name'];
			}
			else
			{
				$SUB_CAT_ID=0;
				$subcatnameis='';
			}
			if($this->input->post('Category'))
			{
				$CAT_ID=$this->input->post('Category');
				$getcatname=$this->db->query("select cat_name from dev_product_cat where id='$CAT_ID'");
				$getcatname=$getcatname->result_array();
				$catnameis=$getcatname[0]['cat_name'];
			}
			else
			{
				$CAT_ID=0;
				$catnameis='';
				
			}
			
			$exvat=0;
			$exvat=$this->input->post('Price_ex_VAT');
			$exvat=number_format((float)$exvat, 2, '.', '');
			$date=date('d-m-y h:i:s');
			if($this->input->post('Manufacture'))   //if manufacture details 
			{
				$Manufacture=$this->input->post('Manufacture');
			}
			else
			{
				$Manufacture='';
			}
			if($this->input->post('listid'))   //if list details 
			{
				$list=$this->input->post('listid');
				$list=json_encode(array($list));
			}
			else
			{
				$list='';
			}
			if($this->input->post('filteritem') && $this->input->post('filteritemvalue'))
			{
				
				$filteritemArray=$this->input->post('filteritem');
				$filteritemvalueArray=$this->input->post('filteritemvalue');
				for($i=0;$i<count($filteritemArray);$i++)
				{
					array_push($FillterArrayEmpty,array($filteritemArray[$i]=>$filteritemvalueArray[$i]));
				}
				
			}
			$productdetails=array('Manufacture'=>$Manufacture,'list_id'=>$list,'business_id'=>$bussiness_id,
			'title'=>$this->input->post('title'),'product_name'=>$this->input->post('name'),
			'vat_deductable'=>$this->input->post('deduct'),'SKU'=>$this->input->post('SKU'),
			'description'=>$this->input->post('Description'),'inc_vat'=>$this->input->post('Price_INC_VAT'),
			'ex_vat'=>$exvat,'tax_class'=>$this->input->post('tax'),'publish_status'=>$this->input->post('pub'),
			'categories'=>$CAT_ID,'sub_categories'=>$SUB_CAT_ID,'super_sub_cat_id'=>$SUPER_SUB_CAT_ID,
			'searchsupercat'=>$supersubcatnameis,'searchsubcat'=>$subcatnameis,'searchcat'=>$catnameis,'AddedFilters'=>serialize($FillterArrayEmpty),'dateandtime'=>$date);
				
              $table='dev_products';				
			    $insert=$this->ProductModel->insert($table,$productdetails);
				$_SESSION['last_insert_id']= $this->db->insert_id();
				$Last_Insert_Id= $_SESSION['last_insert_id'];
				if($insert)
				{
				   $this->session->set_flashdata('successdetails', "Product Details Add Successfully");
					$tab_data['tab']=array('main'=>'add_pd','sub'=>'pd');
					/*************curl to add product in atrdeya*****************/
					if($_SESSION['status']['iswholseller'])
					{
						
						$title=$this->input->post('title');
						$des=$this->input->post('Description');
						$name=$this->input->post('name');
						$sku=$this->input->post('SKU');
					     $MainUserId=$_SESSION['status']['user_id'];
						  $curl = curl_init();
						  curl_setopt_array($curl, array(
						  CURLOPT_URL => "http://atradeya.co.uk/test.php",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => "user=$MainUserId&description=$des&title=$title&mainid=$Last_Insert_Id&searchcat=$catnameis&spc=$name&Sale_price=$exvat&Sku=$sku",
						  CURLOPT_HTTPHEADER => array(
							"cache-control: no-cache",
							"content-type: application/x-www-form-urlencoded",
							"postman-token: 83cca713-3217-b44a-e59b-d46a925c3e5f"
						  ),
						));

						$response = curl_exec($curl);
						
						$err = curl_error($curl);

						curl_close($curl);  

						
					}
				
					/********************close***********************************/
					redirect('Edit_single_product?id='.$Last_Insert_Id);
				}
				else
				{
					$this->session->set_flashdata('faileddetails', "opration failed");
				}
            }
		   
			
			   
			else if(isset($_POST['hidsuppli']))
			{
				
			}
			else if(isset($_POST['spc0']))
			{
				
				 
			}
			else if(isset($_POST['gobackproduct']))
			{
				 

			}
		    $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('products.php',$tab_data);
			$this->load->view('footer.php'); 
		}
	else
	{	
		   redirect('dashboard');
	}
} 
   public function CheckProductExsist()
   {
	   $sku=$_POST['pro_sku'];
	   $getresult=$this->db->query("select * from dev_products where SKU='$sku'");
	   $getresult=$getresult->result_array();
	   if($getresult)
	   {
		  echo 'true';
	   }
	   else{
		  echo 'false'; 
	   }
   }
public function DeleteVariationOption(){
	
	$optionid=$_POST['optionid'];
	$pro=$_POST['product'];
	$table="dev_variation_option";
	
	$result=$this->db->query("delete from dev_variation_option where id=$optionid");
	
	if($result)
	{
		$result2=$this->db->query("delete from dev_product_variation where option_id=$optionid");
		if($result2)
		{
			echo "Delete Successfully";
		}
		else
		{
			echo "Delete Failed";
		}
	}
}
public function AddProductVariation(){
	$pid=0;
	if(isset($_GET['placeholder']) && isset($_GET['varname'])  ){
	if(isset($_GET['pro_id']))
	{
	$pid=$_GET['pro_id'];	
	}
	else
	{
		if(isset($_SESSION['last_insert_id']))
		{
		$pid=$_SESSION['last_insert_id'];
		}
		else
		{
			echo "Can't Add Option Please Add Product Details First";
			die;
		}
	}
	$table="dev_variation_option";
	$insert_option=array('plaseholder'=>$_GET['placeholder'],'option_name'=>$_GET['varname'],'product_id'=>$pid);
	 $insert=$this->ProductModel->insert($table,$insert_option);
	 $lastid = $this->db->insert_id();
	if($insert&&$lastid)
	{ 
	 $_SESSION['tab']='optiontab';
      echo "$lastid";
	 
	 }
	 else
	 {
		  $_SESSION['tab']='optiontab';
		 echo "Option Not ADD";
		
	 } 
		
	}else{
		  echo "Please Enter VAlue";
	}		
}
public function ViewSingleProductVariation()
{
		$pid=$_POST['editproid'];
		$varoption=$this->db->query("select * from dev_variation_option where id='$pid' ");
	   $varoption=$varoption->result_array();
	   
		 echo json_encode($varoption);
}
public function ViewProductVariation(){
	if(isset($_POST['editproid']))
	{
	$pid=$_POST['editproid'];
	}
	 else
	{
		$pid=$_SESSION['last_insert_id'];
	} 
       $varoption=$this->db->query("select * from dev_variation_option where product_id='$pid' ");
	   $varoption=$varoption->result_array();
	   
		 echo json_encode($varoption);

}
public function Delete_single_product(){
	$product_id=$_GET['id'];
	$delete=$this->db->query("delete from dev_products where id='$product_id'");
	if($delete)
	{
		redirect('products');
	}
	else
	{
	 echo "<script>alert('Prodcut Can Not Be Delete')</script>";	
	}
}
public function VariationPage(){
	   if(isset($_POST['Add_Variations']))
	   {
		   
		   $table="dev_product_variation";
		   $optionid=$this->input->post('optionid');
		  $name=$this->input->POST('name');
		  $Description= $this->input->POST('Description');
		  $SKU=$this->input->POST('SKU');
		  $price=$this->input->POST('price');
		  $inc_vat=$this->input->POST('inc_vat');
		  $variationdata=array('option_id'=>$optionid,'name'=>$name,'description'=>$Description,'pcode'=>$SKU,'price'=>$price,'inc_price'=>$inc_vat);
		$insert=$this->ProductModel->insert($table,$variationdata);
		  if($insert)
		  {
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ProductVariationPage.php');
			$this->load->view('footer.php');
		  }
		  else{
			  echo '<script>alert("Not Add Variation")</script>';
		  }  
		   
	   }
	   else if(isset($_POST['update'])){
		    $table="dev_product_variation";
		   $optionid=$this->input->post('optionid');
		  $name=$this->input->POST('name');
		  $Description= $this->input->POST('Description');
		  $SKU=$this->input->POST('SKU');
		  $price=$this->input->POST('price');
		  
		  $inc_vat=$this->input->POST('inc_vat');
		  $variationdata=array('name'=>$name,'description'=>$Description,'pcode'=>$SKU,'price'=>$price,'inc_price'=>$inc_vat);
		  $where=array('id'=> $optionid);
		$update=$this->ProductModel->update($table,$variationdata,$where);
		  if($this->db->affected_rows())
		  {
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ProductVariationPage.php');
			$this->load->view('footer.php');
		  }
		  else{
			  echo '<script>alert("Not update Variation")</script>';
			  redirect('ProductVariationPage.php');
		  }  
	   }
	   else{
	       $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ProductVariationPage.php');
			$this->load->view('footer.php');
	       }
}
public function DeleteSingleVariation()
{
	if(isset($_GET['id'])){
	$SingleVariation=$_GET['id'];
	$SingleVariationParent=$_GET['parent'];
	$result=$this->db->query("delete from dev_product_variation where id=$SingleVariation");
	redirect('variationpage?optionid='.$SingleVariationParent);
	}
}
public function EditSingleVariation()
{
	if(isset($_POST['variationid']))
	{
		$varationid=$_POST['variationid'];
		$data=$this->db->query("select *from dev_product_variation where id=$varationid");
		$data=$data->result_array();
		echo json_encode($data);
	}
}
public function EditProduct() //edit products
{
	        $this->load->view('header.php');
			$this->load->view('sidebar.php');
		    $this->load->view('EditProducts.php');
		    $this->load->view('footer.php');
			
	
}
public function DeleteProductImage()
{
	
	$colmnname = $_POST['imagenum'];
	$product_id = $_POST['product_id'];
   // $path=site_url().'/images/products/'.$imagename;
	
		$this->db->query("update dev_products set $colmnname=''  where id=$product_id");
		if($this->db->affected_rows())
		{
			
			echo $colmnname;
		}
		else
		{
			echo "0";
		}

}
public function DeleteProductPdf()
{
	$col2='';
	$product_id=$_POST['product_id'];
	$col=$_POST['colname'];
	if($col=='pdf_manual')
	{
		$col2='pdf_name';
	}
	if($col=='pdf_manual2')
	{
		$col2='pdf2_name';
	}
	if($col=='pdf_manual3')
	{
			$col2='pdf3_name';
	}
	if($col=='pdf_manual4')
	{
		$col2='pdf4_name';
	}
	if($col=='pdf_manual5')
	{
		$col2='pdf5_name';
	}
	if($col=='pdf_manual6')
	{
		$col2='pdf6_name';
	}
   // $path=site_url().'/images/products/'.$imagename;
	
		$this->db->query("update dev_products set $col='', $col2='' where id=$product_id");
		if($this->db->affected_rows())
		{
			
			echo $col;
		}
		else
		{
			echo "0";
		}

}
public function UpdateProducts()
{

	$table="dev_products";
	if(isset($_POST['product_id_in_details']))    //update single product
	{  $FillterArrayEmpty=array();
		  $_SESSION['tab']='';
		if($this->input->post('Sub_Sub_Category'))
			{
				$SUPER_SUB_CAT_ID=$this->input->post('Sub_Sub_Category');
				
				$getsupersubcatname=$this->db->query("select name from super_sub_cat where id='$SUPER_SUB_CAT_ID'");
				$getsupersubcatname=$getsupersubcatname->result_array();
				if($getsupersubcatname)
				{
				$supersubcatnameis=$getsupersubcatname[0]['name'];
				}
				else
				{
					$supersubcatnameis='0';
				}
			}
			else
			{
				$SUPER_SUB_CAT_ID=0;
				$supersubcatnameis='';
			}
			if($this->input->post('Sub_Category'))
			{
				
				$SUB_CAT_ID=$this->input->post('Sub_Category');
				
				$getsubcatname=$this->db->query("select sub_cat_name from dev_product_sub_cat where id='$SUB_CAT_ID'");
				$getsubcatname=$getsubcatname->result_array();
				if($getsubcatname)
				{
				$subcatnameis=$getsubcatname[0]['sub_cat_name'];
				}
				else
				{
					$subcatnameis='0';
				}
			}
			else
			{
				$SUB_CAT_ID=0;
				$subcatnameis='';
			}
			if($this->input->post('Category'))
			{
				$CAT_ID=$this->input->post('Category');
				
				$getcatname=$this->db->query("select cat_name from dev_product_cat where id='$CAT_ID'");
				$getcatname=$getcatname->result_array();
				if($getcatname)
				{
				$catnameis=$getcatname[0]['cat_name'];
				}
				else
				{
					$catnameis='0';
				}
			}
			else
			{
				$CAT_ID=0;
				$catnameis='';
				
			}
			
		 $product_hidden_id=$_POST['product_id_in_details'];
		 $updatedtax=$this->input->post('tax');
		 if($updatedtax=='')
		 {
			 $updatedtax='0';
		 }
		 /******************if manufacture************************/
		 if($this->input->post('Manufacture'))
		 {
			 $manufacture=$this->input->post('Manufacture');
		 }
		 else
		 {
			 $manufacture=='';
		 }
		 
		 if($this->input->post('filteritem') && $this->input->post('filteritemvalue'))
			{
				
				$filteritemArray=$this->input->post('filteritem');
				$filteritemvalueArray=$this->input->post('filteritemvalue');
				for($i=0;$i<count($filteritemArray);$i++)
				{
					array_push($FillterArrayEmpty,array($filteritemArray[$i]=>$filteritemvalueArray[$i]));
				}
				
			}
		 /********************************************************/
		$DetailsArr=array('Manufacture'=>$manufacture,'product_name'=>$this->input->post('name'),'title'=>$this->input->post('title'),'SKU'=>$this->input->post('SKU'),'inc_vat'=>$this->input->post('Price_INC_VAT'),'ex_vat'=>$this->input->post('Price_ex_VAT'),'vat_deductable'=>$this->input->post('deduct'),'tax_class'=>$updatedtax,'publish_status'=>$this->input->post('pub'),'super_sub_cat_id'=>$this->input->post('Sub_Sub_Category'),'sub_categories'=>$this->input->post('Sub_Category'),'categories'=>$this->input->post('Category'),'searchsupercat'=>$supersubcatnameis,'searchsubcat'=>$subcatnameis,'searchcat'=>$catnameis,'AddedFilters'=>serialize($FillterArrayEmpty));
	
		 $where=array('id'=>$product_hidden_id);
	    $this->DataModel->update($table,$DetailsArr,$where);
		 
		  if($this->db->affected_rows())
		 {
			 $_SESSION['tab']='';
			//$this->session->set_flashdata('succpd', "Product Details Update Successfully");
			//redirect(site_url('Edit_single_product?id='.$product_hidden_id)); */
			//echo "Update Successfully1";
		 }
		 //else
		 //{
			/*  $_SESSION['tab']='';
			 $this->session->set_flashdata('failpd', "Opration Failed");
			 redirect(site_url('Edit_single_product?id='.$product_hidden_id)); */
		   // echo "Update Failed2";
			 
		 //} 
		 echo "Update Successfully";
	}
	if(isset($_FILES['product_image_1']) || isset($_FILES['product_image_2']) )  //update images
	{
		
		  $_SESSION['tab']='';
		 $product_hidden_id=$_POST['product_id_in_images'];
		 $product_image_1=$_FILES['product_image_1'];
		 $product_image_2=$_FILES['product_image_2'];
			if($product_image_1['size']!=0)
			{
				 $image_name_1=$product_image_1['name'];
				 $tmpname=$product_image_1['tmp_name'];
				 $type=$product_image_1['type'];
				 
				 $uniqueid=rand();
				 $image_name_1=$uniqueid.$image_name_1;
				 $image_name_1=str_replace(' ', '',$image_name_1);
				 $url_image_name_1=$this->UpdateUrlMethod().'/images/products/'.$image_name_1;
				  $data=array('products_images'=>$url_image_name_1);
		           $where=array('id'=>$product_hidden_id);
				 if(move_uploaded_file($product_image_1["tmp_name"],"images/products/".$image_name_1)){
					$this->DataModel->update($table,$data,$where);
					if($_SESSION['status']['iswholseller'])
					{
							$curl = curl_init();

								curl_setopt_array($curl, array(
								  CURLOPT_URL => "http://atradeya.co.uk/UploadImageViaPickmyorder.php",
								  CURLOPT_RETURNTRANSFER => true,
								  CURLOPT_ENCODING => "",
								  CURLOPT_MAXREDIRS => 10,
								  CURLOPT_TIMEOUT => 30,
								  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								  CURLOPT_CUSTOMREQUEST => "POST",
								  CURLOPT_POSTFIELDS => "file=$url_image_name_1&&proid=$product_hidden_id",
								  CURLOPT_HTTPHEADER => array(
									"cache-control: no-cache",
									"content-type: application/x-www-form-urlencoded",
									"postman-token: 162fd895-4085-bcba-eb46-1fd544e88e90"
								  ),
								));

								$response = curl_exec($curl);
								$err = curl_error($curl);

								curl_close($curl);

								
                    }
					/********************close***********************************/
					
				  echo "update Successfully";
				 }
					
			}
			
			if($product_image_2['size']!=0)
			{
				$image_name_2=$product_image_2['name'];
				 $uniqueid=rand();
				 $image_name_2=$uniqueid.$image_name_2;
				 $image_name_2=str_replace(' ', '',$image_name_2);
				 $url_image_name_2=$this->UpdateUrlMethod().'/images/products/'.$image_name_2;
				  $data=array('product_image_two'=>$url_image_name_2);
		           $where=array('id'=>$product_hidden_id);
				 if(move_uploaded_file($product_image_2["tmp_name"],"images/products/".$image_name_2)){
					$this->DataModel->update($table,$data,$where);
				 }
				 
			}
		
		/* $_SESSION['tab']='image';
		$this->session->set_flashdata('succimg', "Image Successfully");
		redirect(site_url('Edit_single_product?id='.$product_hidden_id)); */
		echo "Update Successfully"; 
	
	}
	if(isset($_FILES['pdf_manual']) || isset($_FILES['pdf_manual2']) || isset($_FILES['pdf_manual3']) || isset($_FILES['pdf_manual4']) || isset($_FILES['pdf_manual5']) || isset($_FILES['pdf_manual6'])  ) //update images
	{
		  $_SESSION['tab']='';
		$result='2';
		$table="dev_products";
		 $product_hidden_id=$_POST['pdf_pid'];
		 $product_pdf=$_FILES['pdf_manual'];
		 $product_pdf2=$_FILES['pdf_manual2'];
		 $product_pdf3=$_FILES['pdf_manual3'];
		 $product_pdf4=$_FILES['pdf_manual4'];
		 $product_pdf5=$_FILES['pdf_manual5'];
		 $product_pdf6=$_FILES['pdf_manual6'];
		
		if($product_pdf['size']!=0)
			{
				 $pdf_name=$product_pdf['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual'=>$pdf_url,'pdf_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			 if(move_uploaded_file($product_pdf["tmp_name"],"images/productpdf/".$pdf_name))
			     {
					$this->DataModel->update($table,$data,$where);
					 echo "Update Successfully";
				 }
				
				else
				{
				
				}
	 
			}
			
			if($product_pdf2['size']!=0)  //pdf manual 2
			{
				 $pdf_name=$product_pdf2['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual2'=>$pdf_url,'pdf2_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			if(move_uploaded_file($product_pdf2["tmp_name"],"images/productpdf/".$pdf_name))
			     {
					$this->DataModel->update($table,$data,$where);
					 echo "Update Successfully";
				 }
				 else
			     {
				
			     }
	 
			}
			
			if($product_pdf3['size']!=0)  //pdf manual 3
			{
				 $pdf_name=$product_pdf3['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual3'=>$pdf_url,'pdf3_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			if(move_uploaded_file($product_pdf3["tmp_name"],"images/productpdf/".$pdf_name))
			{
				$this->DataModel->update($table,$data,$where);
				 echo "Update Successfully";
		    }
			else
			{
				
			}
	 
			}
			
			if($product_pdf4['size']!=0)  //pdf manual 4
			{
				 $pdf_name=$product_pdf4['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual4'=>$pdf_url,'pdf4_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			if(move_uploaded_file($product_pdf4["tmp_name"],"images/productpdf/".$pdf_name))
			{
				$this->DataModel->update($table,$data,$where);
				 echo "Update Successfully";
			}
			else
			{
			}	
	 
			}
			
			if($product_pdf5['size']!=0)  //pdf manual 5
			{
				 $pdf_name=$product_pdf5['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual5'=>$pdf_url,'pdf5_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			if(move_uploaded_file($product_pdf5["tmp_name"],"images/productpdf/".$pdf_name))
			{
				$this->DataModel->update($table,$data,$where);
				 echo "Update Successfully";
				 
			}
			else
			{
				
			}	
	 
			}
			
			if($product_pdf6['size']!=0)  //pdf manual 5
			{
				 $pdf_name=$product_pdf6['name'];
				 $uniqueid=rand();
				 $pdf_name=preg_replace('/\s+/', '', $uniqueid.$pdf_name);
				 $pdf_url=$this->UpdateUrlMethod().'/images/productpdf/'.$pdf_name;
				  $data=array('pdf_manual6'=>$pdf_url,'pdf6_name'=>$pdf_name);
		           $where=array('id'=>$product_hidden_id);
			if(move_uploaded_file($product_pdf6["tmp_name"],"images/productpdf/".$pdf_name))
			{
				$this->DataModel->update($table,$data,$where);
				 echo "Update Successfully";
				
			}
			else
			{
				
	
			}
	 
			}
			
		
	}
	if(isset($_POST['hideen_pid_supplier']))  //update suppliers cost
	{
		$suppliercost='';
		$numbersupp=$_POST['hideen_no_supp'];
		$product_id=$_POST['hideen_pid_supplier'];
	  
		 for($i=0;$i<=$numbersupp;$i++){
			 if($this->input->post('supp'.$i)&&$this->input->post('suppcost'.$i)){
		$suppliercost.=$_POST['supp'.$i].'=>'.$_POST['suppcost'.$i].','; 
		 }
		}
		$supplier_with_cost=rtrim($suppliercost,",");
		
		 $this->db->query("update dev_products SET supplier_with_cost='$supplier_with_cost' where id='$product_id'");
		
		 if($this->db->affected_rows())
		 {
			echo "Upadte Successfully";
			 $_SESSION['tab']='';
		 }
		  else
		 {
			
			echo "Opration Failed";
			 
		 }
		
		
	}
	
	if(isset($_POST['contant']))      //update spacification
	{
		$specification='';
		$product_id_sp=$_POST['hidproid_in_spc'];
		//$num_of_spc=$_POST['numberofspc'];
		/* for($i=0;$i<=$num_of_spc-1;$i++)
		{
			if($this->input->post('spc'.$i))
			{ */
		$specification=$_POST['contant'];
		  /*   }
		}	 */
	//$allspecification=rtrim($specification,",");
	     $this->db->query("update dev_products SET specification='$specification' where id='$product_id_sp'");
		 if($this->db->affected_rows())
		 {
			  $_SESSION['tab']='';
			 echo "Update Successfully";
			
			 /* $_SESSION['tab']='spc';
			 $this->session->set_flashdata('succsp', "specification Update Successfully");
	        redirect(site_url('Edit_single_product?id='.$product_id_sp)); */
		 }
		 else
		 {
			 echo "Update Failed";
			/* $_SESSION['tab']='spc';
			$this->session->set_flashdata('failsp', "Opration Failed");
			 redirect(site_url('Edit_single_product?id='.$product_id_sp)); */
			 
		 }
	}
	if(isset($_POST['goback']))      //update variation
	{
		    $proids=$this->input->post('hididforvariation');
		    $_SESSION['tab']='optiontab';
			redirect(site_url('Edit_single_product?id='.$proids));
	}
	
	 
}
function UpdateTaxClassVat()
{
	$vatcalss=$_POST['vatcalss'];
	$proid=$_POST['proid'];
	$this->db->query("update dev_products set tax_class='$vatcalss' where id='$proid'");
}
public function upload_pdf($tmp_name,$path,$data,$Last_Insert_Id)
   {

				if(move_uploaded_file($tmp_name,$path))
				{
					
					
					$where=array('id'=>$Last_Insert_Id);
					$table="dev_products";
					$this->ProductModel->update($table,$data,$where);
			
					if($this->db->affected_rows() )
					{
					 return "1";		
					}	
					else
					{
					return "0";
					}				 
			    }
				else
				{
					return "0";
				}
	}
	/****************ajax function for fetching price of product *********************/
	public function FetchDefaultPrice()
	{
		$optionid=$_POST['optionid'];
		$product_id=$this->db->query("select product_id from dev_variation_option where id='$optionid'");
		$product_id1=$product_id->result_array();
		$pid=$product_id1[0]['product_id'];
		$product=$this->db->query("select ex_vat,inc_vat,product_name from dev_products where id='$pid'");
		$product_data=$product->result_array();
		if($product_data)
		{
		echo json_encode($product_data);
		}
		else
		{
			echo "0";
		}
	}
	/*******************************check id's esist or not for import product**********************/
	public function check_exsist($id,$table)
	{
		$checkresult=$this->db->query("select * from $table where id='$id'");
		if($checkresult->num_rows())
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	/********************************************close**********************************************/
	/***********************uplode import cs file************************/
public function uploadcsvfilebyajax()
{
	$flag='0';

	
	$exsist_supersubcat='1';
	$exsist_subcat='1';
	$exsist_cat='0';
	$status_vat_deduct='1';
	$temp_data=array();
	$array_for_variations=array();
	$howmanyvariation=array();
	$CsvlineNumber=1;
	 $j=0;
	 $k=0;
	if(isset($_FILES['thisiscsv']))
	{
		 // $result =   $this->csvreader->parse_file($_FILES['thisiscsv']['tmp_name']);
		/*  echo "<pre>";
		 print_r($result); die; */
		
	foreach($result as $res)
	{   
	          	$empty_status_tsi="0";
				$numeric_status_tsi="0";
	          $bid=$res['Business ID'];
			 if( $res['Category ID']!='' && $res['Sub Category ID']!=''  && $res['Super Sub Cat ID']!=''   && $res['Product Name']!='' && $res['Title']!='' && $res['Description']!=''  && $res['Specification']!='' && $res['Inc_vat']!='' && $res['Vat Deductable']!='' && $res['Ex_vat']!='' && $res['Publish_Status']!='' && $res['Products_image_one']!='' && $res['PDF1']!='' && $res['Business ID']!='' && $res['UniqueCode']!='')
				{
					$empty_status="1";
					
				} 
				else
				{
					$empty_status="0";
					
				}
				
				 /*****************************************TSI Validation************************************/
				 if($res['Tsicode']!='')
				 {
					if( $res['Category ID']!='' && $res['Sub Category ID']!=''  && $res['Super Sub Cat ID']!=''  &&$res['Business ID']!=''  && $res['Product Name']!='' && $res['Inc_vat']!='' && $res['Vat Deductable']!='' && $res['Ex_vat']!='' && $res['UniqueCode']!='' )
					{
						$empty_status_tsi="1";
						
					} 
					
					if( is_numeric($res['Category ID']) && is_numeric($res['Sub Category ID']) && is_numeric($res['Super Sub Cat ID'])  && is_numeric($res['Business ID']) && is_numeric($res['Inc_vat']) && is_numeric($res['Ex_vat']) && is_numeric($res['Vat Deductable']) )
					{
						$numeric_status_tsi="1";
					}
					
				 }
				/*********************************************TSI Close*************************************/
		    if(is_numeric($res['List']) && is_numeric($res['Category ID']) && is_numeric($res['Sub Category ID']) && is_numeric($res['Super Sub Cat ID']) && is_numeric($res['Inc_vat']) && is_numeric($res['Ex_vat'])  && is_numeric($res['Business ID'])  && is_numeric($res['Vat Deductable']))
				{
					$numeric_status="1";
				}
				else
				{
					$numeric_status="0";
				}
				//List
				$ListId=$res['List'];
				if($ListId!='')
				{
				$checkresult=$this->db->query("select * from dev_productlist where id='$ListId'");
				if($checkresult->num_rows())
				{
				$exsist_list='1';
				}
				}
				//cat
				$id=$res['Category ID'];
				if($id!='0')
				{
				$checkresult=$this->db->query("select * from dev_product_cat where id='$id' && business_id='$bid'");
				if($checkresult->num_rows())
				{
				$exsist_cat='1';
				}
				}
				//subcat
				$id=$res['Sub Category ID'];
				$table="dev_product_sub_cat";
				if($id!='0')
				{
				$exsist_subcat=$this->check_exsist($id,$table);
				}
				//super
				$id=$res['Super Sub Cat ID'];
				$table="super_sub_cat";
				if($id!='0')
				{
				$exsist_supersubcat=$this->check_exsist($id,$table);
				}
				//bussiness
				$id=$res['Business ID'];
				$table="dev_business";
				$exsist_bussiness=$this->check_exsist($id,$table);
				//text class required if vat deduct is 1
				if($res['Vat Deductable']=='1' && $res['tax class']=='')
				{
					$status_vat_deduct='0';
				}
				
			 if($empty_status=='1' && $numeric_status=='1' && $exsist_bussiness=='1' && $exsist_supersubcat=='1' && $exsist_subcat=='1' &&  $exsist_cat=='1' || $status_vat_deduct=='1' && $numeric_status_tsi=="1" && $empty_status_tsi=="1" && $exsist_list=="1")
			{
				if($res['Tsicode']!='')
				{
					$pstatus='0';
				}
				else
				{
					$pstatus=$res['Publish_Status'];
				}
				$listid=json_encode(array($res['List']));
			array_push($temp_data, array('List'=>$listid,'Manufacture'=>$res['Manufacture'],'business_id'=>$res['Business ID'],'categories'=>$res['Category ID'],'sub_categories'=>$res['Sub Category ID'],'super_sub_cat_id'=>$res['Super Sub Cat ID'],'searchcat'=>$res['Category Name'],'searchsubcat'=>$res['Sub Category Name'],'searchsupercat'=>$res['Super Sub Category Name'],'SKU'=>$res['Sku'],'product_name'=> $res['Product Name'],'title'=>$res['Title'],'description'=>$res['Description'],'specification'=>$res['Specification'],'inc_vat'=>$res['Inc_vat'],'vat_deductable'=>$res['Vat Deductable'],'tax_class'=>$res['tax class'],'ex_vat'=>$res['Ex_vat'],'publish_status'=>$pstatus,'products_images'=>$res['Products_image_one'],'product_image_two'=>$res['Products_image_two'],'pdf_manual'=>$res['PDF1'],'pdf_manual2'=>$res['PDF2'],'pdf_manual3'=>$res['PDF3'],'pdf_manual4'=>$res['PDF4'],'pdf_manual5'=>$res['PDF5'],'pdf_manual6'=>$res['PDF6'],'option_name'=>$res['Option name'],'plaseholder'=>$res['Placeholder'],'option_name'=>$res['Option name'],'plaseholder'=>$res['Placeholder'],'supplier_with_cost'=>$res['Supplier With Cost'],'Tsicode'=>$res['Tsicode'],'UniqueCode'=>$res['UniqueCode']));
			$supplierwithcode=str_replace('&', ',', $res['Supplier With Cost']);
			
			$i=1;
			
             while(array_key_exists("variation name $i", $res) )
			 {			
			$array_for_variations[$j]=array('varname'=>$res['variation name '.$i],'vardescription'=>$res['variation  Description '.$i],'pcode'=>$res['variation  product code '.$i],'price'=>$res['variation_exvat '.$i],'inc_price'=>$res['variation_incvat '.$i]);
			if($res['variation name '.$i]!='')
			{
			  $howmanyvariation[$k]=$i;
			}
				$i++;
				$j++;
			 }
			
			}
			else
			{
				//print_r(array($empty_status, $numeric_status,  $exsist_bussiness,  $exsist_supersubcat, $exsist_subcat,  $exsist_cat, $status_vat_deduct, $numeric_status_tsi,  $empty_status_tsi));
				$flag='1';
				break;
			} 
   $k++;	
 $CsvlineNumber++;   
	}
	
     if($flag=='0')
	 {
		 $run=0;
		 $next=0;
		
		 foreach($temp_data as $data)
		 {
			
			   if($run<count($howmanyvariation))
			   {
			  $numberofvariationrow=$howmanyvariation[$run];
			   }
			   else
			   {
				   $numberofvariationrow=0;
			   }
			   if($data['Tsicode']!='') // if tsi code not entered in the sheet
			   {
				$uniqueCodecheck=$data['Tsicode'];
			   }
			   else
			   {
				   $uniqueCodecheck=$data['UniqueCode'];
			   }
			  $bussid=$data['business_id'];
			  $IsthisExsist=$this->db->query("select id,Tsicode from dev_products where Tsicode='$uniqueCodecheck' && business_id='$bussid'");
			  $preExsistData=$IsthisExsist->result_array();
			  if($IsthisExsist->result_array())
			  {    
			   $ExsistProduct_id=$preExsistData[0]['id']; 
			   $tsipre=$preExsistData[0]['Tsicode']; 
			   if($data['Tsicode']!='' && $tsipre==$data['Tsicode'])
			   { 
				    $xvat=number_format((float)$data['ex_vat'], 2, '.', '');
					$inv=number_format((float)$data['inc_vat'], 2, '.', '');
				   $this->db->query("update dev_products set Manufacture='$data[Manufacture]',list_id='$data[List]', Super_sub_cat_id='$data[super_sub_cat_id]', sub_categories='$data[sub_categories]', categories='$data[categories]',searchcat='$data[searchcat]',searchsubcat='$data[searchsubcat]',searchsupercat='$data[searchsupercat]',business_id='$data[business_id]',SKU='$data[SKU]',product_name='$data[product_name]',inc_vat='$inv',ex_vat='$xvat',vat_deductable='$data[vat_deductable]',publish_status='$data[publish_status]',tax_class='$data[tax_class]', product_image_two='$data[product_image_two]' ,pdf_manual3='$data[pdf_manual3]',pdf_manual4='$data[pdf_manual4]',pdf_manual5='$data[pdf_manual5]',pdf_manual6='$data[pdf_manual6]',supplier_with_cost='$supplierwithcode',Tsicode='$data[Tsicode]' where  id=$ExsistProduct_id");
			   }
			   else
			   {   
				   $xvat=number_format((float)$data['ex_vat'], 2, '.', '');
					$inv=number_format((float)$data['inc_vat'], 2, '.', '');
			   $this->db->query("update dev_products set Manufacture='$data[Manufacture]',list_id='$data[List]',Super_sub_cat_id='$data[super_sub_cat_id]', sub_categories='$data[sub_categories]', categories='$data[categories]',searchcat='$data[searchcat]',searchsubcat='$data[searchsubcat]',searchsupercat='$data[searchsupercat]',business_id='$data[business_id]',SKU='$data[SKU]',product_name='$data[product_name]',title='$data[title]',description='$data[description]', specification='$data[specification]',inc_vat='$inv',ex_vat='$xvat',vat_deductable='$data[vat_deductable]',publish_status='$data[publish_status]',tax_class='$data[tax_class]', products_images='$data[products_images]', product_image_two='$data[product_image_two]',pdf_manual='$data[pdf_manual]', pdf_manual2='$data[pdf_manual2]', pdf_manual3='$data[pdf_manual3]',pdf_manual4='$data[pdf_manual4]',pdf_manual5='$data[pdf_manual5]',pdf_manual6='$data[pdf_manual6]',supplier_with_cost='$supplierwithcode',Tsicode='$data[Tsicode]' where  id=$ExsistProduct_id");
			   if($this->db->affected_rows())
			   {
							/*   /*************************insert variation options***********************************
						 $this->db->query("update dev_variation_option set option_name='$data[option_name]', plaseholder='$data[plaseholder]' where product_id='$ExsistProduct_id'");
							if($this->db->affected_rows())
						   {
				   /****************************insert variation **********************************
						 // $numberofvariationrow=count($array_for_variations);
						  for($row=0;$row<$numberofvariationrow;$row++) 
						  {
							  if($array_for_variations[$row]['varname']!='' && $array_for_variations[$row]['vardescription']!='' && $array_for_variations[$row]['pcode']!='' &&$array_for_variations[$row]['price']!='' && $array_for_variations[$row]['inc_price']!='')
							  {
								 $varname= $array_for_variations[$next]['varname'];
								  $vardes=$array_for_variations[$next]['vardescription'];
								  $varpcode=$array_for_variations[$next]['pcode'];
								 $price= $array_for_variations[$next]['price'];
								 $varinc= $array_for_variations[$next]['inc_price'];
						   $this->db->query("update  dev_product_variation set option_id='',name='', description='',pcode='',price='',inc_price='') VALUES ('$last_insert_option','$varname','$vardes','$varpcode','$price','$varinc')"); 
											 
							 }
							  $next++;
						  }
						   } */
				}
			   }
			   }
			else
			{
				 $xvat=number_format((float)$data['ex_vat'], 2, '.', '');
					$inv=number_format((float)$data['inc_vat'], 2, '.', '');
			$insert_status=$this->db->query("INSERT INTO dev_products(super_sub_cat_id, sub_categories, categories,searchcat,searchsubcat,searchsupercat,business_id,list_id,Manufacture,SKU,product_name,title,description, specification,inc_vat,ex_vat,vat_deductable,publish_status,tax_class, products_images, product_image_two,pdf_manual, pdf_manual2, pdf_manual3,pdf_manual4,pdf_manual5,pdf_manual6,supplier_with_cost,Tsicode,UniqueCodeForImport) VALUES ('$data[super_sub_cat_id]','$data[sub_categories]','$data[categories]','$data[searchcat]','$data[searchsubcat]','$data[searchsupercat]','$data[business_id]','$data[List]','$data[Manufacture]','$data[SKU]','$data[product_name]','$data[title]','$data[description]','$data[specification]','$inv',' $xvat','$data[vat_deductable]','$data[publish_status]','$data[tax_class]','$data[products_images]','$data[product_image_two]','$data[pdf_manual]','$data[pdf_manual2]','$data[pdf_manual3]','$data[pdf_manual4]','$data[pdf_manual5]','$data[pdf_manual6]','$supplierwithcode','$data[Tsicode]','$data[UniqueCode]')");  
			  $last_insert_id = $this->db->insert_id(); 
			if($data['option_name']!='' && $data['plaseholder']!='')
			 {
		/*************************insert variation options************************************/
			 $this->db->query("INSERT INTO dev_variation_option(option_name, plaseholder, product_id) VALUES ('$data[option_name]','$data[plaseholder]','$last_insert_id')");
			  $last_insert_option = $this->db->insert_id();
	   /****************************insert variation ***********************************/
	         // $numberofvariationrow=count($array_for_variations);
			  for($row=0;$row<$numberofvariationrow;$row++) 
			  {
				  if($array_for_variations[$row]['varname']!='' && $array_for_variations[$row]['vardescription']!='' && $array_for_variations[$row]['pcode']!='' &&$array_for_variations[$row]['price']!='' && $array_for_variations[$row]['inc_price']!='')
				  {
					 $varname= $array_for_variations[$next]['varname'];
					  $vardes=$array_for_variations[$next]['vardescription'];
					  $varpcode=$array_for_variations[$next]['pcode'];
					 $price= $array_for_variations[$next]['price'];
					 $varinc= $array_for_variations[$next]['inc_price'];
			   $this->db->query("INSERT INTO dev_product_variation(option_id,name, description,pcode,price,inc_price) VALUES ('$last_insert_option','$varname','$vardes','$varpcode','$price','$varinc')"); 
                  				 
				 }
				  $next++;
			  }
			   
			 }
			}
			
			 $run++;
		 } 
		 print_r('Csv Import Successfully');
         echo "<a href='products'>BACK</a>";	 
	 }
	 else
	 {
		  print_r("Invalid Csv please check line number $CsvlineNumber");  
		  echo "<a href='products'>BACK</a>";
	 } 
   }
      		
}
/*******************************************close********************************************/	
	  public function GenrateTokenForLuckin()   //Token genrate
	  {
		  $curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => "https://xtra.luckinslive.com/LuckinsLiveRESTHTTPS/GetLogToken/1",
				 CURLOPT_RETURNTRANSFER => true,
				 CURLOPT_ENCODING => "",
				 CURLOPT_MAXREDIRS => 10,
				 CURLOPT_TIMEOUT => 30,
				 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				 CURLOPT_CUSTOMREQUEST => "POST",
				 CURLOPT_POSTFIELDS => "{\r\n\"ClientIPAddress\":\"212.48.65.56\",\r\n\"CustomerIdentifier\":\"BDBD001A00CC008D3FD9000059DF01070022B70037AA6459\"\r\n}",
				 CURLOPT_HTTPHEADER => array(
				   "cache-control: no-cache",
				   "content-type: application/json",
				   "postman-token: f339f530-aca3-7835-5c30-079c2fe5c186"
				 ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				 return "0";
				} 
				else 
				{
				 $mytoken=$response;
				 $mytokenfromltrim=ltrim($mytoken, '"');
	             $mytokenfromr=rtrim($mytokenfromltrim, '"');
				 return $mytokenfromr;
		        }
	  }
	  
	public function FetchingDataFromLuckins()   //function for feaching data from lucins api
	{
	   if(isset($_SESSION['Current_Business']))
			{
					$bussiness_id=$_SESSION['Current_Business'];
					
			} 
		
		$myflag=0;
		$token=$this->GenrateTokenForLuckin();
		$ResultData=$this->db->query("select id , Tsicode from dev_products where Tsicode!='' && business_id='$bussiness_id'");
		$data=$ResultData->result_array();
		if($ResultData->result_array())
		{
			foreach($data as $singledat)
			{
				
			$productid=$singledat['id'];
			$tsicode=$singledat['Tsicode'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://xtra.luckinslive.com/LuckinsLiveRESTHTTPS/ItemDetail/1",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => " {\r\n\"AssetSized2List\":[{\r\n\"Height\":400,\r\n\"MaintainAspectRatio\":true,\r\n\"Tag\":\"\",\r\n\"Width\":323\r\n}],\r\n\"TSIUniqueIdentifierPairList\":[{\r\n\"TSIUniqueIdentifierType\":1,\r\n\"TSIUniqueIdentifier\":\"$tsicode\"\r\n}],\r\n\"Token\":\"$token\",\r\n\"ViewportType\":3\r\n}\r\n\r\n",
				CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: 9463d12a-2823-7757-8215-fe1f10ac7a96"
								 			),));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) 
				{
				  echo "cURL Error #:" . $err;
				} 
				else
				{
					$myJSON = json_decode($response);
					
					
					
  					if($myJSON->ResultCount)
					{
						  $number=1;
						  $spcli='';
						  $labels='';
						 
						$title=$myJSON->ItemDetailsList[0]->ShortDescription;
						$image=$myJSON->ItemDetailsList[0]->Asset2List[2]->URL;
						$urlarray=$myJSON->ItemDetailsList[0]->Asset2List;
						$specificayionlist=$myJSON->ItemDetailsList[0]->AttributeList;
						$Shortkey=$myJSON->ItemDetailsList[0]->Sortkey;
						$Brand=$myJSON->ItemDetailsList[0]->BrandName;
						$Range=$myJSON->ProductRangeList[0]->Description;
						$Finish=$myJSON->ItemDetailsList[0]->Finish;
						if(!empty($myJSON->ItemDetailsList[0]->EANCodeList[0]))
							{
								$sku=$myJSON->ItemDetailsList[0]->EANCodeList[0]->EAN14Code;
							}
							else
							{
								$sku=''; 
							} 
						$description='<div>
							<ul class="des-details" >
								<li><b>Product code :</b>'.$Shortkey.'</li>
								<li><b>Brand :</b>'.$Brand.'</li>
								<li><b>Colour :</b>'.$Finish.'</li>
								<li><b>Range :</b>'.$Range.'</li>	
							</ul>
						</div>';
						
						foreach($specificayionlist as $sp)
						{
							$spcli.= "<li>$sp->Value</li>"; 
                            $labels.="<li></li>"; 						
						}
						foreach($urlarray as $singleurl)
						 {
							 
							
							 if (strpos($singleurl->URL , '.PDF') !== false)
								{
									
									if($number=='1')
									{
									$pdf1=$singleurl->URL;
									$luckname1=$singleurl->AdditionalInfo;
									}
									else
									{
										$pdf2=$singleurl->URL;
										$luckname2=$singleurl->AdditionalInfo; 
									}
									
									$number++;
								} 
								else
								{
									$image=$singleurl->URL;
								}
						 }
						 $specification='<div class="col-md-7">
							<ul class="spec-feature">'.
								$spcli.
							'</ul>
						</div>
						</div>';
						
						$this->db->query("update dev_products set pdf_name='$luckname1' ,pdf2_name='$luckname2' ,title='$title',description='$description',products_images='$image',pdf_manual='$pdf1',pdf_manual2='$pdf2',specification='$specification',product_name='$Shortkey',SKU='$sku' where id=$productid");
						if($this->db->affected_rows())
						{
							$myflag=$myflag+1;
						} 
					}					
					
				}
			}
			echo "$myflag Products Import Successfully";
		} 
		else
		{
		   echo "No Tsi Code Found";
		}
	}
	public function ProductList()
	{
			
          if($this->input->post('productlistbutton'))
			{
				$listname=$this->input->post('addlist');
				$ListArray=array('productlistname'=>$listname);
				$Insert=$this->ProductCategoryModal->insert('dev_productlist',$ListArray);
				
				if($Insert)
				{
						$message=array('success'=>'Add List Successfully','tab'=>'menu3');
						$this->load->view('header.php');
						$this->load->view('sidebar.php');
						$this->load->view('ProductList.php',$message);
						$this->load->view('footer.php');
				}
			}
			else
			{
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('ProductList.php');
				$this->load->view('footer.php');
			}
	}
	/*********************************assign product list to master list******************/
	public function assignmasterlist()
	{
		$id=$_POST['listid'];
		$action=$_POST['action'];
		$this->db->query("update dev_productlist set masterlist='$action' where id='$id'");
		if($this->db->affected_rows())
		{
			if($action){
			echo "Add Master list successfully";
			}else{ echo "Remove From Master list successfully";}
		}
		else
		{
			echo "Opration Failed";
		}
	}
	/******************************update product list name*****************************/
	 public function UpdateProductListName()
	   {
		   if(isset($_POST['listid'])&& isset($_POST['listname']))
		   {
			   $listid=$_POST['listid'];
			   $listname=$_POST['listname'];
			 
			   $this->db->query("update dev_productlist set productlistname='$listname' where id='$listid'");
			   if($this->db->affected_rows())
			   {
				   echo "Update Successfully";
			   }
			   else
			   {
				   echo "Update Failed";
			   }
		   }
		   else
		   {
			   echo "Opration Failed";
		   }
	   }
   /*****************************************************************************************/
	   public function ManageList()
	   {
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ManageList.php');
			$this->load->view('footer.php');
	   } 
	/************************************copy product in alist via ajax************************/
	public function GetListAndProduct()
	{
		$Listid=$_POST['list_id'];
		$productid=$_POST['product_id'];
		
		$productObj=$this->db->query("select list_id from dev_products where id='$productid'");
		$list=$productObj->result_array();
		$listarray=json_decode($list[0]['list_id']);
		
		if(!in_array($Listid,$listarray))
		{
		array_push($listarray,$Listid);
		$newencoded=json_encode($listarray);
		
		$this->db->query("update dev_products SET list_id='".$newencoded."' where id='$productid'");
		
		}
	}
	/************************************Remove a list from a product  via ajax************************/
	public function RemoveListFromAProduct()
	{
		$Listid=$_POST['list'];
		$productid=$_POST['product'];
		
		$productObj=$this->db->query("select list_id from dev_products where id='$productid'");
		$list=$productObj->result_array();
		$listarray=json_decode($list[0]['list_id']);
		
		if(in_array($Listid,$listarray))
		{
			$key = array_search($Listid,$listarray);
			unset($listarray[$key]);
			$newencoded=json_encode($listarray);
		    $this->db->query("update dev_products SET list_id='".$newencoded."' where id='$productid'");
		
		}
	}	
	/******************************list product view with fillter using ajax (spacialbusiness listbusiness businessid=15)**************************************/
	public function ApplyCatFillterOnListProduct()
	{
		$Listid=$_POST['list_id'];
		$catid=$_POST['cat_id'];
		$type=$_POST['type'];
		$proidarray=array();
		if($type=='1')
		{
		$listobj=$this->db->query("select id,list_id from dev_products where categories='$catid'");
		}
		if($type=='2')
		{
			$listobj=$this->db->query("select id,list_id from dev_products where Manufacture='$catid'");	
		}
		if($type=='3')
		{
			$listobj=$this->db->query("Select id,list_id from dev_products where Manufacture LIKE '$catid%' || searchcat LIKE '$catid%' || product_name LIKE '$catid%' ");
		}
		$lists=$listobj->result_array();
		
		foreach($lists as $list)
		{    
			if($list['list_id']!='') 
			{
			$listarray=json_decode($list['list_id']);
				if(in_array($Listid,$listarray))
				{
					$productid=$list['id'];
					array_push($proidarray,$productid);
				}
			}
		}
						
					$comaspratedid=implode(",",$proidarray);
					$productsobj=$this->db->query("select * from dev_products where id in($comaspratedid)");
					$proarray=$productsobj->result_array();
					print_r(json_encode($proarray));
				
	}
	/******************************list product view with fillter using ajax all normal business**************************************/
	public function ApplyFillterOnNormalProducts()
	{
		$businessid=$_POST['businessid'];
		$catid=$_POST['cat_id']; //cat id or manufactureid
		$type=$_POST['type'];
		$proidarray=array();
		if($type=='1')
		{
		$productobj=$this->db->query("select * from dev_products where categories='$catid' && business_id='$businessid'");
		}
		if($type=='2')
		{
		$productobj=$this->db->query("select * from dev_products where Manufacture='$catid' && business_id='$businessid'");	
		}
		if($type=='3')
		{
		$productobj=$this->db->query("Select * from dev_products where Manufacture LIKE '$catid%' && business_id='$businessid' || searchcat LIKE '$catid%' && business_id='$businessid' || product_name LIKE '$catid%' && business_id='$businessid' ");
		}
		$productarray=$productobj->result_array();
		
		print_r(json_encode($productarray));
				
	}
	/******************************Product List Transfer***************************************************/
	public function ProductListTransfer()
	{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ProductListTransfer.php');      
			$this->load->view('footer.php');
	}
	/******************************Product copy Transfer list to bussiness***************************************************/
	public function Copy_List_Product()
	{
		$proidarray=array();
		$destination_business=$_POST['newbid'];
		if(isset($_POST['productidarray']))
		{   
			$proidarray=$_POST['productidarray'];
		}
		else
		{
				$source_business=$_POST['bid'];
				$listid=$_POST['listid'];
				$listobj=$this->db->query("select id,list_id from dev_products");
				$list_array=$listobj->result_array();
				foreach($list_array as $list)
				{    
					if($list['list_id']!='') 
					{
					$listarray=json_decode($list['list_id']);
					
						if(in_array($listid,$listarray))
						{
							$productid=$list['id'];
							array_push($proidarray,$productid);	
						}
					}
				}
		}
		   
		 for($i=0;$i<count($proidarray);$i++)
		{
			 $productid=$proidarray[$i];
			 $copyinobj=$this->db->query("select copy_in from dev_products where id='$productid'"); 
					 $copyinarr=$copyinobj->result_array();
					
					  if($copyinarr[0]['copy_in']!='') 
						{
						$dataarray=json_decode($copyinarr[0]['copy_in']);
						
						}
						else
						{
							$dataarray=array();
						}
			  if(!in_array($destination_business,$dataarray))
				{
				 $status=$this->db->query("INSERT INTO `dev_products`(  `Manufacture`, `super_sub_cat_id`, `sub_categories`, `categories`, `searchcat`,
					 `searchsubcat`, `searchsupercat`,  `Tsicode`,  `product_name`, `title`, `description`,
					 `reviews`, `specification`, `price`, `inc_vat`, `ex_vat`, `vat_deductable`, `publish_status`, `tax_class`, `products_images`, 
					 `product_image_two`, `pdf_manual`, `pdf_manual2`, `pdf_manual3`, `pdf_manual4`, `pdf_manual5`, `pdf_manual6`, `pdf_name`, 
					 `pdf2_name`, `pdf3_name`, `pdf4_name`, `pdf5_name`, `pdf6_name`, `supplier_with_cost`, `dateandtime`) SELECT  
					 `Manufacture`, `super_sub_cat_id`, `sub_categories`, `categories`, `searchcat`, `searchsubcat`, `searchsupercat`,
					 `Tsicode`, `product_name`, `title`, `description`, `reviews`, `specification`, `price`, `inc_vat`,
					 `ex_vat`, `vat_deductable`, `publish_status`, `tax_class`, `products_images`, `product_image_two`, `pdf_manual`, `pdf_manual2`,
					 `pdf_manual3`, `pdf_manual4`, `pdf_manual5`, `pdf_manual6`, `pdf_name`, `pdf2_name`, `pdf3_name`, `pdf4_name`, `pdf5_name`,
					 `pdf6_name`, `supplier_with_cost`, `dateandtime` FROM `dev_products` WHERE id=$productid");
					 if($status)
					 {
						$insert_id = $this->db->insert_id();
						$this->db->query("update dev_products SET business_id='$destination_business' where id='$insert_id'");
						array_push($dataarray,$destination_business);
						$updatedcopy=json_encode($dataarray);
						$this->db->query("update dev_products SET copy_in='$updatedcopy' where id='$productid'");
					 }   
				} 
				
		} 
     	
	}
/******Get All products of a list and send via ajex in product page for add list product teb ***************************/
	public function CallMeForListProducts()
	{
		$listid=$_POST['listid'];
	   $productIdStore=array();
		$All_list_data= $this->db->query("select id,list_id from dev_products where 1");
		$All_list=$All_list_data->result_array();
		for($i=0;$i<count($All_list);$i++)
		{ 
	      $listarray=json_decode($All_list[$i]['list_id']);
		  if($listarray!='')
		  {
	        if(in_array($listid,$listarray))
			{
				$getproid=$All_list[$i]['id'];
				array_push($productIdStore,$getproid);
			}   
		  }
		} 
		if(count($productIdStore)){
		$allselectedid=implode(',',$productIdStore);
		$All_data= $this->db->query("select * from dev_products where id in($allselectedid)");
		$All_data_array=$All_data->result_array();
		print_r(json_encode($All_data_array));}else{echo "0";}
	}

}

