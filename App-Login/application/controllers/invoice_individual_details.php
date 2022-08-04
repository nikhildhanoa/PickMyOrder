	
	<div class="container">
		<div class="card card-custom">
			<div class="card-header flex-wrap border-0 pt-6 pb-5">
				<h3 class="text-dark font-weight-bold my-1 mr-5" style="margin-bottom:20px">Invoice individual Details</h3>
					<table class="table" style="margin-top:20px">
						<thead class="thead-light">
							<tr>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">DOCUMENT</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">SUPPLIER</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">DOCUMENT</th>
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
							  foreach($data_invoice_attachment_detail as $data_invoice_data)
							  {
						if($data_invoice_data['pdftype']=='1'){ $type='Credit'; } elseif($data_invoice_data['pdftype']=='2') { $type='Invoice';  }  else {  $type='Quote'; }  
							?>
								<tr>
								  <td style="border-right:1px solid #fff"><?php echo $type ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['description'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['part_number'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['qty'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['price'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['per_uom'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['discount'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['total'] ; ?></td>
								  <td style="border-right:1px solid #fff"><?php echo $data_invoice_data['advice'] ; ?></td>
								</tr>
							<?php } ?>
							
							<tr class="thead-light">
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">TOTAL</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">AVERAGE</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;">£</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" ></th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;" >£</th>
								<th scope="col" style="border-right:1px solid #fff;background: #13499b;color:#fff;"></th>
							</tr>
						
						</tbody>
					</table>
			
			
			</div>
		</div>
	</div>	
		
		