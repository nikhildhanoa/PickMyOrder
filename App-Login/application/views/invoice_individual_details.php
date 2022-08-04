	
	<div class="container">
		<div class="card card-custom">
			<div class="card-header flex-wrap border-0 pt-6 pb-5">
				<h3 class="text-dark font-weight-bold my-1 mr-5" style="margin-bottom:20px">Invoice individual Details</h3>
					<table class="table" style="margin-top:20px">
						<thead class="thead-light">
							<tr>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">DOCUMENT</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">SUPPLIER</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">DOCUMENT No.</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">QTY</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">NAME</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">PRICE</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" >DISCOUNT</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" >TOTAL</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">PRICE PER 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							   $x=0;
							   $qty=0;
							   $AVERAGE='';
							   $divide='';
							  foreach($data_invoice_attachment_detail as $data_invoice_data)
							  {
								   /* echo '<pre>';
								  print_r($data_invoice_data);die;  */
								  //$user_id_link = $data_invoice_data['order_number'];
								  $user_id_link =$data_invoice_data['order_number'];
								 //$user_id =  rawurldecode($user_id_link);
								// $user_link = urldecode($user_id_link);
								 //print_r($user_link);die;
if($data_invoice_data['pdftype']=='1'){$pdftype='Creditnote';}else if($data_invoice_data['pdftype']=='2'){$pdftype='Invoice';}else{$pdftype="Quote";} 				
		/* $dec_link='<a href=Quotation>'.$data_invoice_data['document_number'].'</a>'; */
							
$dec_link="<a href='pdfview/".$data_invoice_data['idtwo']."/".$user_id_link."'>".$data_invoice_data['document_number'].'</a>';		              
	if(!empty($data_invoice_data['total'])){$x+= $data_invoice_data['total'];}
    if(!empty($data_invoice_data['qty'])){$qty+= $data_invoice_data['qty'];}  							
	if(!empty($data_invoice_data['total'] && $data_invoice_data['qty'] )){$divide=$data_invoice_data['total']/$data_invoice_data['qty'];}  
	if(!empty($x && $qty )){$AVERAGE=$x/$qty; $AVERAGE_num=number_format($AVERAGE, 2, ',', ' ');   }

                       if(preg_match("/[a-z]/i", $data_invoice_data['total'])){
              $dATA=explode("S",$data_invoice_data['total']);
			  $A=$dATA[0];
           }else{
			    $A=$data_invoice_data['total'];
		   }

	?>						     
							
								<tr>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $pdftype ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $data_invoice_data['vendor_name'] ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo  $dec_link; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $data_invoice_data['qty'] ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $data_invoice_data['description'] ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $data_invoice_data['price'] ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $data_invoice_data['discount'] ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $A ; ?></td>
				  <td style="border-right:1px solid #fff;background: #F3F6F9;"><?php echo $divide; ?></td>
								</tr>
							<?php } ?>
		
							<tr class="thead-light">
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">TOTAL</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"> <?php echo $qty;  ?></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">AVERAGE</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">£<?php echo $AVERAGE_num  ?></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" ></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" >£ <?php echo $x;  ?></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
							</tr>
						
						</tbody>
					</table>
			
			
			</div>
		</div>
	</div>	
		
		