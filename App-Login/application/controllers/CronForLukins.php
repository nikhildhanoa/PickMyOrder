<?php $servername = "localhost";
$username = "u479956399_scott";
$password = "~4TjCkVWA";
$dbname = "u479956399_pickmyorderapp";
$get_lucking_info=1;


$conn=mysqli_connect($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

/**********************************************/


	//public function FetchingDataFromLuckins()   //function for feaching data from lucins api
	//{
	  //if(isset($_SESSION['Current_Business']))
			//{
					//$bussiness_id=$_SESSION['Current_Business'];
					
			//} 
		$bussiness_id=36;
		$myflag=0;
		
		$sql = "select id , Tsicode from dev_products where Tsicode!='' && business_id='$bussiness_id' && lukin_update=0";
        $ResultData= mysqli_query($conn,$sql);
		
		
		// $ResultData=$this->db->query("select id , Tsicode from dev_products where Tsicode!='' && business_id='$bussiness_id' && lukin_update=0");
		// $data=$ResultData->result_array(); 
		
       	$Get_lukins_token=$this->db->query("select token,Token_Time  from dev_lukins_token ");
		$Get_lukins_token=$Get_lukins_token->result_array();
		$token=$Get_lukins_token[0]['token'];
		
		//$token=$this->GenrateTokenForLuckin();
		   
		// if($ResultData->result_array())
		if(mysqli_num_rows($ResultData)>=1) 
		{
			while($singledat=mysqli_fetch_array($ResultData))
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
					
						//print_r($myJSON);die;
					
  					if($myJSON->ResultCount)
					{
						  $number=1;
						  $spcli='';
						  $labels='';
						  $image1='';
						  $image2='';
						  $image3='';
						  $image4='';
						  $image5='';
						 $luckname1='';
						 $pdf1='';
						$pdf2='';
						$luckname2='';
						     
						$title=$myJSON->ItemDetailsList[0]->ShortDescription;
						//print_r($myJSON->ItemDetailsList[0]->Asset2List[1]->URL);die;
						// $image=$myJSON->ItemDetailsList[0]->Asset2List[1]->URL;
						$urlarray=$myJSON->ItemDetailsList[0]->Asset2List;
						$specificayionlist=$myJSON->ItemDetailsList[0]->AttributeList;
						$Shortkey=$myJSON->ItemDetailsList[0]->Sortkey;
						$Brand=$myJSON->ItemDetailsList[0]->BrandName;
						$Range=$myJSON->ProductRangeList[0]->Description;
						$Finish=$myJSON->ItemDetailsList[0]->Finish;
						
						// $CalculatedDiscountedPrice_Ex_vat=$myJSON->ItemPriceList[0]->CalculatedDiscountedPrice;
						// $CalculatedDiscountedUnitPrice=$myJSON->ItemPriceList[0]->CalculatedDiscountedUnitPrice;
					 	 $BasePrice=$myJSON->ItemDetailsList[0]->ItemPriceList[0]->BasePrice;
						
						
						
					 $productData="select tax_class,vat_deductable  from dev_products where id='$productid'";
				
					$ResultData2= mysqli_query($conn,$productData);
					
					$productData1=mysqli_fetch_array($ResultData2);
					
					 $tax_class=$productData1['tax_class'];	
					 $vat_deductable=$productData1['vat_deductable'];	
						
					
						//	
						
						
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
								elseif($image1=='')
								{
									if($singleurl->Tag!='Thumbnail') 
										$image1=$singleurl->URL;
									
								}
								elseif($image2=='')
								{
									if($singleurl->Tag!='Thumbnail')
									$image2=$singleurl->URL;
								}
								elseif($image3=='')
								{
									if($singleurl->Tag!='Thumbnail')
									$image3=$singleurl->URL;
								}
								elseif($image4=='')
								{
									if($singleurl->Tag!='Thumbnail')
									$image4=$singleurl->URL;
								}
								elseif($image5=='')
								{
									if($singleurl->Tag!='Thumbnail')
									$image5=$singleurl->URL;
								}
						 }
						 $specification='<div class="col-md-7">
							<ul class="spec-feature">'.
								$spcli.
							'</ul>
						</div>
						</div>';
						
						$lukin_error_info='';
						$lukin_update=1;
						
						if($Shortkey=='')
						{
								$lukin_error_info="Description";
								$lukin_update=2;
								
						}
						if($image1=='')
						{
							$lukin_error_info=$lukin_error_info.' Image';
							$lukin_update=2;
						}
						if($pdf1=='')
						{	
							$lukin_error_info=$lukin_error_info.' PDF';
							$lukin_update=2;
						}
						if($get_lucking_info=="1")
						{
							if($tax_class==5 || $tax_class==10 || $tax_class==20 || $tax_class==0)
							{
								$tax_class = (float)$tax_class;
								
									$Inc_vat=$BasePrice+$BasePrice*$tax_class/100;
										
							}
							else
							{
									$Inc_vat=$BasePrice+$BasePrice*20/100;
									
							}
							
							$Inc_vat=number_format($Inc_vat,2); 
							
							 mysqli_query($conn,"update dev_products set pdf_name='$luckname1' ,pdf2_name='$luckname2' ,title='$title',description='$description',products_images='$image1',product_image_two='$image2',product_image_three='$image3',product_image_four='$image4',product_image_five='$image5',pdf_manual='$pdf1',pdf_manual2='$pdf2',specification='$specification',product_name='$Shortkey',SKU='$sku',inc_vat='$Inc_vat',ex_vat='$BasePrice',lukin_update='$lukin_update' where id=$productid"); 
							 
							 echo $productid. ' <br>';
							
						
					
							
						//	$update_array=array('pdf_name'=>$luckname1,'pdf2_name'=>$luckname2,'title'=>$title,'description'=>$description,'products_images'=>$image1,'product_image_two'=>$image2,'product_image_three'=>$image3,'product_image_four'=>$image4,'product_image_five'=>$image5,'pdf_manual'=>$pdf1,'pdf_manual2'=>$pdf2,'specification'=>$specification,'product_name'=>$Shortkey,'SKU'=>$sku,'lukin_update'=>$lukin_update,'lukin_error_info'=>$lukin_error_info,'inc_vat'=>$Inc_vat,'ex_vat'=>$BasePrice);
						       // $this->db->where('id', $productid);
                                // $this->db->update('dev_products', $update_array); 
							
							
						}
						
						
						//if($this->db->affected_rows()) 
						if(mysqli_affected_rows())
						{
							$myflag=$myflag+1;
							if($myflag>=20){exit;}
						} 
					}
					else{
						         // $update_Failure_array=array('lukin_update'=>2,'lukin_error_info'=>'ALL');
						          /// $this->db->where('id', $productid);
                                   //$this->db->update('dev_products',$update_Failure_array); 
								   
				 mysqli_query($conn,"UPDATE dev_products SET lukin_update = 2, lukin_error_info = 'ALL' WHERE id = $productid");			   
									  
					}
						
					
				}
				
				
				
			}
			echo "$myflag Products Import Successfully";
		} 
		else
		{
		   echo "No Tsi Code Found";
		}
	//}
 




















/***************************************************/

    
	
	
	
	








?>