
<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceParserTest extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->Model('DataModel');
		$this->load->Model('EngineerModel');
		$this->load->Model('SupplierModel');
		$this->load->Model('ProjectModel');
		$this->load->Model('ProductCategoryModal');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	public function invoiceView()
	{
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('invoiceView.php');
		$this->load->view('footer.php');
	}
	public function invoiceProduct()   
	{ 
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('invoiceProduct.php');
		$this->load->view('footer.php');
	}
	/****************************************************Setup email***************************************************/
	public function setupInvoiceEmail()
	{
		if($this->input->post('send'))
		{ 
			$setting=$this->input->post('setting');
			$emailaddress=$this->input->post('emailaddress');
			$password=$this->input->post('password');
		/* Connecting Gmail server with IMAP */
        $connection = imap_open('{imap.123-reg.co.uk}INBOX', 'suppliers@sparkselc.co.uk', 'Scottlou1316@') or die('Cannot connect to Gmail: ' . imap_last_error());
		print_r( $connection);      
		die;
			$con=array("status"=>$connection);
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('invoiceView.php',$con);
			$this->load->view('footer.php');          
		}     
	}
	/******************************************************************************************************************/
	public function parseData($document_id)
	{
		
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.docparser.com/v1/results/qkzgcoghwaej/$document_id",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Basic MGE0ZjUyNmY0ZWNmNDRmOTdjZTMwMmQxNjVhZWM3MDkzYWNlNjVmOTo=",
					"Cookie: landed=%2Faccount%2Flogin%2F%3Fred%3Dv1%2Fdocument%2Fupload; referer=https%3A%2F%2Fapi.docparser.com%2Fv1%2Fdocument%2Fupload%2F; dp2019=rej22ifed919tmh3ak1bihffp9491egq"
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				return($response);

	}
	public function UploadPdfByUrl($filename)
	{
	

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.docparser.com/v1/document/fetch/qkzgcoghwaej",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "url=https://stagingapp.pickmyorder.co.uk/invoices/$filename",
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Basic MGE0ZjUyNmY0ZWNmNDRmOTdjZTMwMmQxNjVhZWM3MDkzYWNlNjVmOTo=",
				"Content-Type: application/x-www-form-urlencoded",
				"Cookie: landed=%2Faccount%2Flogin%2F%3Fred%3Dv1%2Fdocument%2Fupload; referer=https%3A%2F%2Fapi.docparser.com%2Fv1%2Fdocument%2Fupload%2F; dp2019=rej22ifed919tmh3ak1bihffp9491egq"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
		 return($response);

	}
	
	
	public function FetchInvoiceAndStore()
	{
		$TableData=array();
		
$attachments = array();
$base=array();
$nonbase=array();
    if (! function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    }
	else
		{
        
        
        /* Connecting Gmail server with IMAP */
        $connection = imap_open('{imap.123-reg.co.uk}INBOX', 'suppliers@sparkselc.co.uk', 'Scottlou1316@') or die('Cannot connect to Gmail: ' . imap_last_error());
      
        /* Search Emails having the specified keyword in the email subject */
        $emailData = imap_search($connection, 'SUBJECT "Invoice"');
   
        if (! empty($emailData)) {
			
		    
            foreach ($emailData as $emailIdent)
			
			{
			  $structure = imap_fetchstructure($connection, $emailIdent);
			$overview = imap_fetch_overview($connection,$emailIdent,0);
			
			  $emaildateTime=$overview[0]->udate;
			  $fromSupplier=$overview[0]->from;
              if(isset($structure->parts) && count($structure->parts)) 
			  {
				  for($i = 0; $i < count($structure->parts); $i++)
				  {
					  $attachments[$i] = array(
												'is_attachment' => false,
												'filename' => '',
												'name' => '',
												'attachment' => ''
											);
											
											if($structure->parts[$i]->ifdparameters)
												{
												foreach($structure->parts[$i]->dparameters as $object) {
													if(strtolower($object->attribute) == 'filename') {
														$attachments[$i]['is_attachment'] = true;
														$attachments[$i]['filename'] = $object->value;
													}
												}
											}
											
											if($structure->parts[$i]->ifparameters) {
												foreach($structure->parts[$i]->parameters as $object) {
													if(strtolower($object->attribute) == 'name') {
														$attachments[$i]['is_attachment'] = true;
														$attachments[$i]['name'] = $object->value;
													}
												}
											}
											
											if($attachments[$i]['is_attachment']) {
												$attachments[$i]['attachment'] = imap_fetchbody($connection, $emailIdent, $i+1);
												if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
												//	$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
	                                                $AllInvoicesid=$this->db->query("select id from invoices where dateAndTime='$emaildateTime'");
													
													$InvoiceidSingle=$AllInvoicesid->result_array();   
												
													if(count($InvoiceidSingle))
													{
													    
													}
													else
													{
														array_push($base,array('udate'=>$emaildateTime,"data"=>base64_decode($attachments[$i]['attachment'])));
													}
												}
												elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
												
												}  
											}
										}
									}     
		 } 
        
        imap_close($connection);   
    }}

	for($get=0;$get<count($base);$get++)
	{
		
		$filename=rand()*time().$get."INVOICE.pdf";
		$url=base_url().$filename;
		if(file_put_contents("./invoices/$filename",$base[$get]['data']))
		{
		//	$Encoded_Data=$this->UploadPdfByUrl($filename);
			$FinalResponce=$this->parseData("5861e19cf13649e5fb9c5cfb405c0cfe");
			$decodedData=json_decode($FinalResponce);
			
			$invoice_number=json_decode(json_encode($decodedData[$get]->invoice_number),true);
			
			$AllInvoicesNumber=$this->db->query("select id from invoices where invoice_number='$invoice_number'");
			$InvoiceNumbers=$AllInvoicesNumber->result_array();   
			if(count($InvoiceNumbers))
			{
					echo "alre";                                   
			}
			else
			{  echo "insert";
			$totals=json_decode(json_encode($decodedData[$get]->totals),true);
					for($i=0;$i<count($decodedData[$get]->line_items);$i++)
					{
				
						array_push($TableData,array_filter(json_decode(json_encode($decodedData[$get]->line_items[$i]),true)));
					}	
				
					$data=array('invoice_number'=>$invoice_number,'FileName'=>$filename,'supplier'=>$fromSupplier,'net'=>$totals['net'],'tax'=>$totals['tax'],'total'=>$totals['total'],'confidence'=>$totals['confidence'],'tableData'=>json_encode($TableData),'dateAndTime'=>$base[$get]['udate']);
					$this->db->insert('invoices',$data);
					
			} 
		
		}	
		
			          
	}
	


	}
}
	   