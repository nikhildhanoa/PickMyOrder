<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
	   $Quotes_id=$_REQUEST['Quotes_id'];
	   $supplier_id=$_REQUEST['supplier_id'];
	  $delivery_time=$_REQUEST['delivery_time'];
	  $delivery_Date=$_REQUEST['delivery_Date'];
	  $collection_date=$_REQUEST['collection_date'];
	  $collection_time=$_REQUEST['collection_time'];
		   if($delivery_time)
		   {
				$collection_date=0;
				$collection_time=0;
		   }
		  if($collection_time)
		  {
			   $delivery_time=0;
			  $delivery_Date=0;
		  }
		  $FetchQuotesObj=$this->db->query("select * from dev_Quotes where id='$Quotes_id'");
		  $QuotesData=$FetchQuotesObj->result_array();
		   $SingleQuotesObj=$this->db->query("select * from dev_single_quotes where Reffrence_id='$Quotes_id'");
		  $SingleQuotesData=$SingleQuotesObj->result_array();
		 
		  $date=date('d-m-y');
		  $startorder=1;          //comment till monday
		$po_reffrence=rand();
		$order_table="dev_orders";
		$Single_order_table="dev_single_order";
		$numrows=$this->db->query("SELECT MAX( po_number ) AS max FROM `dev_orders` where business_id='$Busines_id'");
		$numrows=$numrows->result_array();
		$startorder=$numrows[0]['max'];

		$startorder=$startorder+1;
		
				 $insert=array('business_id'=>$QuotesData[0]['business_id'],'total_ex_vat'=>$QuotesData[0]['total_ex_vat'],'date'=>$date,'po_reffrence'=>$po_reffrence,'total_inc_vat'=>$QuotesData[0]['total_inc_vat'],'status'=>0,'engineer_id'=>$QuotesData[0]['engineer_id'],'supplier_id'=>$supplier_id,'instruction'=>$QuotesData[0]['instruction'],'odrdescrp'=>$QuotesData[0]['odrdescrp'],'givenprojectid'=>$QuotesData[0]['givenprojectid'],'givenprojectname'=>$QuotesData[0]['givenprojectname'],'po_number'=>$startorder,'quotes_status'=>1);
				$in=$this->DataModel->insert($order_table,$insert);
				
		        $insert_id_order = $this->db->insert_id();
				if($insert_id_order)
				{
					$this->db->query("delete from dev_Quotes where id='$Quotes_id'");
				}
				$uniqid=$insert_id_order; //change reff id
				$this->DataModel->update($order_table,array('po_reffrence'=>$uniqid),array('id'=>$insert_id_order));
				
		 if($insert_id_order)
		 {
			 foreach($SingleQuotesData as $Single)
			 {
				
				$insert=array('project_id'=>$Single['project_id'],'delivery_time'=>$delivery_time,'delivery_Date'=>$delivery_Date,'collection_date'=>$collection_date,'collection_time'=>$collection_time,'total_ex_vat'=>$Single['total_ex_vat'],'order_desc'=>$Single['order_desc'],'product_id'=>$Single['product_id'],'qty'=>$Single['qty'],'Reffrence_id'=>$insert_id_order,'status'=>0,'ex_vat'=>$Single['ex_vat'],'vat_class'=>$Single['vat_class'],'variation_option_name'=>$Single['variation_option_name'],'variation_id'=>$Single['variation_id'] ,'date'=>$date,'image'=>$Single['image'],'ProductTitle'=>$Single['ProductTitle'],'ProductCode'=>$Single['ProductCode'],'quotes_status'=>1);
				
				$procode_new=$Single['ProductCode'];
				$procode_title_new=$Single['ProductTitle'];
				$Qty=$Single['qty'];
				$single_ex_vat=$Single['ex_vat'];
				$taxclass=$Single['vat_class'];
				$total_ex_price=$Single['total_ex_vat'];
				$table_data .='<tr>  
							   <td style="text-align: left;
							   padding-top: 10px;">'.$procode_new.'</td>
								   <td style="text-align:center;padding-top: 10px;">'.$procode_title_new.'</td>
									  <td style="text-align:center;padding-top: 10px;">'.$Qty.'</td>
									  <td style="text-align:center; padding-top: 10px;">£'.$single_ex_vat.'</td>
									  <td style="text-align:center;padding-top: 10px;">'.$taxclass.'%</td>
									  <td  style="text-align:center; padding-top: 10px;">£'.$total_ex_price.'</td>
							   </tr>';
				 $in=$this->DataModel->insert($Single_order_table,$insert);
$insert_id_singleorder = $this->db->insert_id();
				 if($insert_id_singleorder)
				{
					$this->db->query("delete from dev_single_quotes where Reffrence_id='$Quotes_id'");
				} 
			 }
//print_r($table_data); die;
		 }
	
		 if($insert_id_order)
		{
			echo json_encode(array("statusCode"=>200,"valid"=>true,"orderid"=>$insert_id_order,"Limitstatus"=>''));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		}  
?>