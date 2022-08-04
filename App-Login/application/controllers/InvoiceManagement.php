<?php 
require_once FCPATH. '/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
class InvoiceManagement extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->Model('DataModel');
		$this->load->Model('EngineerModel');
		$this->load->Model('SupplierModel');
		$this->load->Model('ProjectModel'); 
        $this->load->Model('CommonModel');
		$this->load->Model('NylasModel');
		$this->load->Model('ProductCategoryModal');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper("file");
	}
	
	public function BusinessIdFunction() 
	{
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
			  }
			  return $bid;
	}
	
	public function keysFunction()
	{
		$client_id='56cgcpbdnjaqaqu2eq4boe773';
		$client_secret='8u4ztah0w8w03bsxv5ww7nl92';
		$keys_array=array('client_id'=>$client_id,'client_secret'=>$client_secret);
		return($keys_array);
		
	}
	
	public function invoiceView()
	{
		
		/* $stripe = new \Stripe\StripeClient('sk_test_aE1Lwti0twn6RyEpNH9cXDi9');
$customer = $stripe->customers->create([
    'description' => 'example customer',
    'email' => 'email@example.com',
    'payment_method' => 'pm_card_visa',
]);
echo $customer; */
		
		
		
		/*  $business_id=$this->BusinessIdFunction();
		$this->db->select('id,email,date');
        $this->db->from('dev_PmoUserConnectNylas');
		$this->db->where('business_id', $business_id); 
		$data=$this->db->get()->result_array();
		$this->db->select('*');
        $this->db->from('dev_NylasUsersAttachments');
		$this->db->where('business_id', $business_id); 
		$data_attachments=$this->db->get()->result_array();
		
        $pass_array=array('key'=>$data,'attachments'=>$data_attachments);
 	    $this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('invoiceView.php',$pass_array);
		$this->load->view('footer.php');   */
		
		 $this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('invoiceView.php');
		$this->load->view('footer.php');
		
	}
	
	/****************************************************Setup email***************************************************/
	
	
	
	
	
	
	/******************************************************************************************************************/
	public function DeleteNyalsAccountt()
	{
		
			/* $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load(); */

// For sample support and debugging. Not required for production:
\Stripe\Stripe::setAppInfo(
  "stripe-samples/checkout-single-subscription",
  "0.0.3",
  "https://github.com/stripe-samples/checkout-single-subscription"
);

\Stripe\Stripe::setApiKey('sk_test_aE1Lwti0twn6RyEpNH9cXDi9');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  echo 'Invalid request';
  exit;
}

$domain_url = 'https://app.pickmyorder.co.uk';

// Create new Checkout Session for the order
// Other optional params include:
// [billing_address_collection] - to display billing address details on the page
// [customer] - if you have an existing Stripe Customer ID
// [payment_intent_data] - lets capture the payment later
// [customer_email] - lets you prefill the email input in the form
// [automatic_tax] - to automatically calculate sales tax, VAT and GST in the checkout page
// For full details see https://stripe.com/docs/api/checkout/sessions/create

// ?session_id={CHECKOUT_SESSION_ID} means the redirect will have the session ID set as a query param
$checkout_session = \Stripe\Checkout\Session::create([
  'success_url' => $domain_url . '/success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $domain_url . '/canceled.php',
  'mode' => 'subscription',
  // 'automatic_tax' => ['enabled' => true],
  'line_items' => [[
    'price' => $_POST['priceId'],
    'quantity' => 1,
  ]]
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

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
			$Encoded_Data=$this->UploadPdfByUrl($filename);
			
			$FinalResponce=$this->parseData($Encoded_Data->id);
			$decodedData=json_decode($FinalResponce);
			$invoice_number=json_decode(json_encode($decodedData[$get]->invoice_number),true);
			print_r($invoice_number);
			$AllInvoicesNumber=$this->db->query("select id from invoices where invoice_number='$invoice_number'");
			$InvoiceNumbers=$AllInvoicesNumber->result_array();   
			if(count($InvoiceNumbers))
			{
					echo "alre";                                      
			}
			else
			{ echo "insert";
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

	
	public function setupInvoiceEmail()
	{
		if($this->input->post('send'))
		{ 
			
			$emailaddress = $this->input->post('emailaddress');
			$Process_Emails = $this->input->post('Process_Emails');
			$Store_Emails = $this->input->post('Store_Emails');
			
			if($Store_Emails=='1')
			{
				$Number_of_Day='';
			}else
			{
				$Number_of_Day = $this->input->post('Number_of_Day');
			}	
			
			$bid=$this->BusinessIdFunction() ;
			
			$this->db->select('email,id');
			$this->db->from('dev_PmoUserConnectNylas ');
			$this->db->like('email',$emailaddress,'none');
			$Section_data2=$this->db->get();
		
			if($Section_data2->num_rows())
			{
				
			$mail_section=$Section_data2->result_array();
			$id=$mail_section[0]['id'];
			$sessiondata=array('insert_id'=>$id,'emailaddress'=>$emailaddress);
			$this->session->set_userdata('nylasUser',$sessiondata);	
			}
            else
            {	
			$insert_array=array('email'=>$emailaddress,'business_id'=>$bid,'Process_Emails'=>$Process_Emails,'Store_Emails'=>$Store_Emails,'Number_of_Day'=>$Number_of_Day);
			$this->db->insert('dev_PmoUserConnectNylas ',$insert_array);
			$insert_id = $this->db->insert_id();
			$sessiondata=array('insert_id'=>$insert_id,'emailaddress'=>$emailaddress);
			$this->session->set_userdata('nylasUser',$sessiondata);
		    }
			
			$keys=$this->keysFunction();
             $client_id=$keys['client_id'];	
	        
			
			$url="https://api.nylas.com/oauth/authorize?client_id=$client_id&redirect_uri=https://app.pickmyorder.co.uk/EmailConnectWithNylas&response_type=code&login_hint=$emailaddress&scopes=email.read_only,calendar.read_only,contacts.read_only&state=mycustomstate";
				redirect($url);
			
			
			
		}else{
			
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('invoiceView.php');
			$this->load->view('footer.php');          
		}     
	}
	
	
	
	
	
	
	
	
	public function EmailConnectWithNylas()
	{
	
	 $code=$_GET['code'];
	
	$nylasUserid = $this->session->userdata('nylasUser');
	 $nylasUserid=$nylasUserid['insert_id'];
	
	  $this->db->select('Process_Emails');
	  $this->db->from('dev_PmoUserConnectNylas ');
	  $this->db->where('id',$nylasUserid,'none');
	  $Process_data=$this->db->get();
	  $Process_data=$Process_data->result_array();
	 
	
	$keys=$this->keysFunction();
    $client_id=$keys['client_id'];	
	$client_secret=$keys['client_secret'];
	
	$curl_array=array('client_id'=>$client_id,'client_secret'=>$client_secret,'grant_type'=>'authorization_code','code'=>$code);
	$data=json_encode($curl_array)."\n"; 
		
	 $response= $this->NylasModel->GetTokenFroNylas($data);
     $access_token=$response->access_token;
	 if(!empty($access_token)){
     $token_type=$response->token_type;
     
	 $autharray=array('Authorization: Bearer'.'  '.$access_token.'' );
	 
	 $AccountStatus= $this->NylasModel->GetNylasAccountStatus($autharray);
	 $status=$AccountStatus->sync_state;
	 $account_id=$AccountStatus->account_id;
	 
	 $status =($status=='running') ? ('1') : ('2');
	 
     $update_array=array('Auth_token'=>$access_token,'token_type'=>$token_type,'status'=>$status,'account_id'=>$account_id);
     $this->db->where('id',$nylasUserid);
     $this->db->update('dev_PmoUserConnectNylas',$update_array);
	 
	
	 $response= $this->NylasModel->GetFileIdFromNylas($autharray);
	
       $BlankArray=array();
	 foreach($response as $responses)
	 {
		 $date=$responses->date;
		 $files=$responses->files;   
		 $from=$responses->from;
		 $Sendermail=$from[0]->email;
		/*  if(!empty($files)){  */
		$result = (str_contains($Sendermail, '@')) ? "1" : "0";
		if($result=='1'){$explodedata =explode('@', $Sendermail); $data=$explodedata[1]; $BlankArray[]=$data; }else{$data=pathinfo($Sendermail, PATHINFO_EXTENSION);}
		/*  } 	 */ 
	 }
	
	
	   $BlankArray_count_values=array_count_values($BlankArray);
	   $senddata=array('key'=>$BlankArray_count_values,'viewTab'=>'credit');
	
	     $this->load->view('header.php');
		$this->load->view('sidebar.php');
	    $this->load->view('SetUp.php', $senddata);
	    $this->load->view('footer.php');
		
		
		
	 }else{redirect(base_url('SetUp'));}
	 
	   
      }
	
	public function TrigerEmailsData()
	{
		
		
	    $data=file_get_contents("php://input");  
		
	 mail( 'nikhil.scorpsoft@gmail.com', 'subject', $data); 
	   $data=json_decode($data,true);
	  
	  $account_id=$data['deltas'][0]['object_data']['account_id'];
	  $message_id=$data['deltas'][0]['object_data']['id'];
	
	  $this->db->select('id,Auth_token,business_id,Process_Emails');
	  $this->db->from('dev_PmoUserConnectNylas ');
	  $this->db->like('account_id',$account_id,'none');
	  $Auth_token=$this->db->get();
	
	 if($Auth_token->num_rows())
	 {  
		$Auth_token=$Auth_token->result_array();
		$Auth_token_id=$Auth_token[0]['Auth_token'];
		$PmoNylasid=$Auth_token[0]['id'];
		$business_id=$Auth_token[0]['business_id'];
		$Process_Emails=$Auth_token[0]['Process_Emails'];
		if($Process_Emails=='0')
		{
			return false;
		}	
        $autharray=array('Authorization: Bearer'.'  '.$Auth_token_id.'' );
        $responsedata= $this->NylasModel->TrigerEmailFileAttachment($autharray,$message_id); 
		$http_code=$responsedata['check']['http_code'];
 
        if($http_code=='200')
		{ 
		$response=$responsedata['response'];
		$response=json_decode($response);
		$BlankArray=array();
		$date=$response->date;   
		$filesData=$response->files;
		$fromemail=$response->from[0]->email;
		$explodedata =explode('@', $fromemail); $datas=$explodedata[1];
         
		$this->db->select('domains');
	    $this->db->from('dev_PmoNylas_users_domains');
		$this->db->where("Nylas_users_id", $PmoNylasid);
	    $this->db->like('domains',$datas,'none');
		$domainexist=$this->db->get();
         
		 
		if(!empty($filesData) && $domainexist->num_rows())
		{
	      foreach($filesData as $files)
		  {   
		$content_type=$files->content_type;
		$id=$files->id;	 
		$array = explode('/', $content_type);
		$AttachmentType=$array[0];
		$AttachmentExtension=$array[1];
		 if($AttachmentExtension=='pdf')
		 {
			  
			 
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.nylas.com/files/'.$id.'/download',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => $autharray,
		));

		$response = curl_exec($curl);
		$check= curl_getinfo($curl);
		curl_close($curl);
		 $response;
		 
		$http_code=$check['http_code'];
		if($http_code=='200'){
		$uniqid = uniqid();
		$pdfname=$uniqid.'.'.$AttachmentExtension;
		
		$fp = fopen("NylasAttachment/".$pdfname,"wb");
        fwrite($fp,$response);
        fclose($fp); 
		
		$InsertFileInAws=$this->SendNylasAttachmentInAws($pdfname) ;
		$url=base_url().'/NylasAttachment/'.$pdfname;
		 $insertArray=array('NylasUserId'=>$PmoNylasid,'Attachment'=>$url,'Attachment_type'=>$AttachmentType,'Attachment_Date'=>$date,'Attachment_name'=>$pdfname,'business_id'=>$business_id); 
		array_push($BlankArray,$insertArray); 
		 }
		 else
		 {
			  $token=implode(" ",$autharray);
			mail("nikhil.scorpsoft@gmail.com","token:'".$token."'","File_Id:'".$id."'----Filename=(controller(invoiceManagement.php)),currentlineNo=491"); 
		 } 
		}
	    }
		 if(!empty($BlankArray))
		 {
		 $this->db->insert_batch('dev_NylasUsersAttachments', $BlankArray); 
		 }
		 $this->session->unset_userdata('nylasUser');
		 print_r('All Document Save');
		 die;
	
		}else{echo "no data found";}	
		} 			
		
	 }
	 else
     {
	  print_r('Not Found Auth_token');	 
	 }		 
			
	}
	
	
	public function SendNylasAttachmentInAws($pdfname)
	{
		
		$s3Client = new S3Client([
		'version' => 'latest',
		'region'  => 'eu-west-2',
		'credentials' => [
			'key'    => 'AKIAYBHU5TTPYJHCIU7M',
			'secret' => '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'
		]
	]);
	  
	$bucket = 'pmo-s3-json-input-bucket';
	$file_Path = FCPATH.'/NylasAttachment/'.$pdfname.'';
	$key = basename($file_Path);
	  
	// Upload a publicly accessible file. The file size and type are determined by the SDK.
	try {
		$result = $s3Client->putObject([
			'Bucket' => $bucket,
			'Key'    => $key,
			'Body'   => fopen($file_Path, 'r'),
			'ACL'    => 'public-read', // make file 'public'
		]);
		return '1';
		mail('nikhil.scorpsoft@gmail.com','Nylas API Upload File AWS','file upload .');
	} catch (Aws\S3\Exception\S3Exception $e) {
		mail('nikhil.scorpsoft@gmail.com','Nylas API Upload File AWS','There was an error uploading the file.');
		echo $e->getMessage();
	}
		
	}
	
	
	public function DeleteNyalsAccount()
	{
    $Account_id=$this->uri->segment(2);	 
	$this->db->select('account_id');
    $this->db->from('dev_PmoUserConnectNylas');
    $this->db->where('id', $Account_id);
	$data=$this->db->get()->result_array();
	$NylasccountId=$data[0]['account_id'];
		
	if(!empty($NylasccountId))
	{
		$responsedata= $this->NylasModel->DeleteNyalsUser($NylasccountId); 
		$http_code=$responsedata['check']['http_code'];
 
        if($http_code=='200')
		{
		
		 $this->db->delete('dev_PmoUserConnectNylas ', array('id' => $Account_id));
		 $this->db->delete('dev_NylasUsersAttachments ', array('NylasUserId' => $id));
		 redirect(base_url('invoiceView'));
		}
	}
    else
	{
		 $this->db->delete('dev_PmoUserConnectNylas ', array('id' => $Account_id));
		 redirect(base_url('invoiceView'));
	}		
	}
	
	public function GEtjsonFilesFromAws()
	{
		  $jsonfile=$_POST['data'];
		$filename=$_POST['filename']; 
		$mail=mail("nikhil.scorpsoft@gmail.com",$filename,$jsonfile); 
		/* $filename='627ba9bf095d910.txt';
		$jsonfile='[[{"currentPage": "1", "pdftype": "quotation", "VENDOR_NAME": "Edmundson Electrical Ltd", "EMAIL TO:": "SCOTT@SPARKSELC.CO.UK", "YOUR REF:": "3PHASE AC BATT&ZAPPI", "PAGE": "1", "TERMS": "", "Form": "1066", "CARRIAGE": "0.00", "DD4 OND": "", "Edmundson Electrical Ltd.": "", "TOTAL": "7603.85", "TO:": "SCOTT SANDEMAN\nSPARKS ELECTRICAL (DUNDEE) LTD\n14 BALLUMBIE DRIVE\nDUNDEE", "INVOICE_RECEIPT_DATE": "10/11/21", "INVOICE_RECEIPT_ID": "073-41053", "PHONE:": "01382 814931"}], [[{"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "SOLIS SOLIS-3P12K-4G-DC INVERTER 12.0KW\n2 STRINGS OF 18 PANELS", "Price": "785.00", "Per": "1", "Disc.": "N", "Total": "785.00"}, {"currentPage": "1", "Qty.": "2", "Unit": "EACH", "Description": "SCAME 590.EM3215 32A 4POLE ISOLATOR IP65", "Price": "81.24", "Per": "1", "Disc.": "74.00", "Total": "42.24"}, {"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "E350/ AEL.TR.32-MID TP GENERATION METER", "Price": "75.00", "Per": "1", "Disc.": "N", "Total": "75.00"}, {"currentPage": "1", "Qty.": "2", "Unit": "PK", "Description": "IND SIGNS IS8800SA SOLAR LABELS PK=5", "Price": "4.76", "Per": "1", "Disc.": "20.00", "Total": "7.62"}, {"currentPage": "1", "Qty.": "2", "Unit": "EACH", "Description": "IND SIGNS IS8910RP DC CABLE MARKER PKT10", "Price": "4.76", "Per": "1", "Disc.": "20.00", "Total": "7.62"}, {"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "IND SIGNS IS9210SA SOLAR ON ROOF LABEL", "Price": "2.00", "Per": "1", "Disc.": "N", "Total": "2.00"}, {"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "PUREDRIVE PURESTORAGEII 3PH AC CPLD 10KW\nCAR CHARGER", "Price": "5850.00", "Per": "1", "Disc.": "N", "Total": "5850.00"}, {"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "MYENERGI ZAPPI-222TB TP 22KW T", "Price": "785.90", "Per": "1", "Disc.": "20.00", "Total": "628.72"}, {"currentPage": "1", "Qty.": "1", "Unit": "EACH", "Description": "MYENERGI ZAPPI/I EDDI HUB INTERFACE", "Price": "86.25", "Per": "1", "Disc.": "20.00", "Total": "69.00"}, {"currentPage": "1", "Qty.": "2", "Unit": "EACH", "Description": "MYENERGI HARVI-65A3P HARVEST W/LESS SNSR", "Price": "57.28", "Per": "1", "Disc.": "20.00", "Total": "91.65"}, {"currentPage": "1", "Qty.": "3", "Unit": "EACH", "Description": "MYENERGI CT100-16-05 TRANSFORMER 5M 100A", "Price": "18.75", "Per": "1", "Disc.": "20.00", "Total": "45.00"}]]]'; */
		

		$data=json_decode($jsonfile);
		
		
		
		
		$table_array=$data[0];
		$invoice_number='';
		$net='';
		$tax='';
		$total='';   
		$vendor_name='';
		$invoice_date='';
		$pdftype='';
		$ordernumber='';
		

		for($i=0;$i< count($table_array);$i++)
		{
			$table_object=$table_array[$i];
			foreach($table_object as $key=>$value)
			{
				 if($key=='pdftype' && $pdftype=='' ){
					if($value=='creditnote'){$pdftype=1;}else if($value=='invoice'){$pdftype=2;}else{$pdftype=3;} 
				 } 
				 if($key=='TOTAL' && $total=='' ){
					 $total=$value;
				 }
				 if($key=='VENDOR_NAME' && $vendor_name=='' ){
					 $vendor_name=$value;
				 }
				 if($key=='INVOICE_RECEIPT_DATE' && $invoice_date=='' ){
					 $invoice_date=$value;
				 }
				 if($key=='INVOICE_RECEIPT_ID' && $invoice_number=='' ){
					 $invoice_number=$value;
				 }
				 if($key=='SUBTOTAL' && $net=='' ){
					 $net=$value;
				 }
				if($key=='order_no' && $ordernumber=='' ){
					 $ordernumber=$value;
				 }
				 if($key=="YOUR ORDER No." && $ordernumber=='' ){
					 $ordernumber=$value;
				 }
				 if($key=="Taxable" && $net=='' ){
					 $net=$value;
				 }
			}	
		}
		
		/************check vender limitions start****************/
		   $select='Process_Invoices,Discard_Duplicated_Documents';
           $TableName='dev_supplier ';
           $multiClause=array('suppliers_name'=>$vendor_name);
           $result_as_array=true;
           $All_supplier_data= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
		 
           if($All_supplier_data!=false)
             { 
				$Process_Invoices = $All_supplier_data[0]['Process_Invoices'];
				$Discard_Duplicated_Documents = $All_supplier_data[0]['Discard_Duplicated_Documents']; 
				if($Process_Invoices=='0')
				{
					return false;
				}
			
				/*********check Duplicated status********/
				$select='vendor_name';
			    $TableName='dev_NylasUsersAttachments';
			    $multiClause=array('vendor_name'=>$vendor_name);
			    $result_as_array=true;
			    $Check_status= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
				
				 if($Check_status!=false)
                 {
					    if($Discard_Duplicated_Documents=='0')
						{
							return false;
						} 
				 }
			 }
			
	
		/************check vender limitions end****************/
		if($ordernumber=='')
		{
			$ordernumber='DAMMY';
		}	
        	
		if($total!='' && $net!='')
		{	
			if(!is_numeric($total))
			{
					$total=filter_var($total,  FILTER_SANITIZE_NUMBER_INT)/100;
					$total=number_format($total,2);	
			}
			if(!is_numeric($net))
			{
					$net=filter_var($net,  FILTER_SANITIZE_NUMBER_INT)/100;
					$net=number_format($net,2);	
			}
			
			$tax=$total-$net;
		}	
		
		
		if(!empty($invoice_date))
		{ 
		   $invoice_date1=explode('/',$invoice_date);
		   $current_month=$invoice_date1[1];
		}else{
			$current_month='';
		}
			
		$line_array= $data[1];
		$line_json=json_encode($line_array);
		 $Import_date= date("d/m/Y"); 
		 $current_month= date("m"); 
		$filename=str_replace('txt','pdf',$filename);
		
		 
		    /******Fetch  engineer id or project id from Quotes if order number match *****/
			/* $ordernumber='dummy order number-95'; */
			
			if(!empty($ordernumber))
			{
		       $select='engineer_id,givenprojectid';
			   $TableName='dev_Quotes';
			   $multiClause=array('po_reffrence'=>$ordernumber); 
			   $result_as_array=true;
			   $Quotes_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			   if($Quotes_data!=false)
			   {   
				   $engineer_id=$Quotes_data[0]['engineer_id'];
				   $givenprojectid=$Quotes_data[0]['givenprojectid'];
				   $qoute_flag=0;
			   }
			    else
                {
				   $engineer_id=0;
			       $givenprojectid=0;
                   $qoute_flag=1;				   
				}
				
			}
			else
			{
			   $engineer_id=0;
			   $givenprojectid=0;
			   $qoute_flag=1;
			}	
		    
			   
		
		 $data1 =[
            'vendor_name' =>$vendor_name,
			'total' => $total,
			'subtotal' => $net,
			'tax' => $tax,
			'invoice_date' => $invoice_date,
			'document_number' => $invoice_number,
			'document_type' => 1,
			'json_line_data'=>$line_json,
            'pdftype'=>$pdftype,
            'Import_date'=>$Import_date,
			'current_month'=>$current_month,
			'order_number'=>$ordernumber,
			'engineer_id'=>$engineer_id,
			'project_id'=>$givenprojectid,
			'flag_invoice'=>$qoute_flag,
			
			];
		
        $this->db->where('Attachment_name',$filename);
		$updatedId = $this->db->get('dev_NylasUsersAttachments')->row()->id;
		$this->db->where('id', $updatedId);
        $response_data = $this->db->update('dev_NylasUsersAttachments', $data1);
		
		
		$qty_array = array("quantity", "qty","qtty","quantity no","QUANTITYSUPPLIED","Quantity Product","Qty.","Quantity");
		
		$part_array = array("Part No.","CODE","Part","SKU Number");
		$per_array = array("PER","Per UOM","Per","Unit");
		
		$description_array = array("Description","CATALOGUE No. AND DESCRIPTION","Product Description");
		$price_array = array("PRICE","Price");   
		$discount_array = array("Discount(%)","Disc %","DISCOUNT","Disc.");
		$total_array = array("EXTENSION","Amount VAT","Total V","Total","Amount VAT Invoice","Net");
		
	   
		for($i=0;$i<count($line_array);$i++)
		{
			$table_value=$line_array[$i];
		
			
			
			
			
			for($j=0;$j<count($table_value);$j++)
			{	
				
				$row_data=$table_value[$j];
				$qty = '';
				$part_number = '';
				$per = '1';
				$description = '';
				$price = '';
				$discount = '';
				$total = '';
				
				foreach($row_data as $key=>$value)
				{
					 $key=str_replace("\n","",$key);	 
					 if(in_array($key,$qty_array)){
						$qty = $value;
						
					 }
					 elseif(in_array($key,$part_array)){
						 if($part_number!=''){$part_number.=" $value";}
						 else $part_number=$value;
					 }
					 elseif(in_array($key,$per_array)){
						 $per=$value;
					 }
					 elseif(in_array($key,$description_array)){
						 $description=$value;
					 }
					 elseif(in_array($key,$price_array)){
						 $price=$value;
					 }
					 elseif(in_array($key,$discount_array)){
						 $discount=$value;
					 }
					 elseif(in_array($key,$total_array)){
						 $total=$value;
					 }
					
				 
				}	
					$array = array(
				'nylas_id'=>$updatedId,
				'qty'=>$qty,
				'part_number'=>$part_number,
				'per_uom'=>$per,
				'description'=>$description,
				'price'=>$price,
				'discount'=>$discount,
				'total'=>$total
				
				);
				
				  $response = $this->db->insert('nylas_invoice_attachement_detail',$array);
			}
			
					
		}
        
		
		die;
		
		
		  if($mail)
			{
			echo json_encode(array("statusCode"=>200,"valid"=>true,"message"=>"success"),JSON_FORCE_OBJECT);	
			}
	}
	
	public function pdfview()
	{
	 if(empty($this->session->userdata('status'))){
        redirect(base_url('index'));
	    }
	    else
		{
		  $business_id=$this->BusinessIdFunction();
		 
		  //*********Comment_on_invoice ********//
         $Account_id=$this->uri->segment(2);
		 $this->db->select('Comment,UserName');
		 $this->db->from('dev_Nylas_Attachments_Comments');
         $this->db->where('Attachment_id', $Account_id);
	     $Comment_data=$this->db->get()->result_array();
		 
		  //*********invoice ********//
         $this->db->select('*');
		 $this->db->from('dev_NylasUsersAttachments');
         $this->db->where('id', $Account_id);
	     $data=$this->db->get()->result_array();
		 $Allocate_project=$data[0]['Allocate_project'];

		  //*********data_invoice_attachment_data ********//
		 $this->db->select('id,nylas_id,qty,part_number,description,price,per_uom,discount,total');
		 $this->db->from('nylas_invoice_attachement_detail');
		 $this->db->where('nylas_id',$Account_id);
		 $data_invoice_attachment_data = $this->db->get()->result_array();
		 $vendor_name=$data[0]['vendor_name'];
         
		 
		 
		 //*********Fetch invoice logo ********//
		    $this->db->select('Supliers_logo');
			$this->db->like('Supliers_Name',$vendor_name);
			$query=$this->db->get("dev_GlobalSupliers");
			$GlobalSupliers_logo=$query->result_array();
			
            //*********Fetch   tolerance Price  ********//
			$this->db->select('Price_Increase_Monitoring,Price_Increase_Tolerance');
			$this->db->like('suppliers_name',$vendor_name);
			$queryy=$this->db->get("dev_supplier");
			$tolerancePrice =$queryy->result_array();

          /********Fetch all project current business**********/
           $select='id,project_name';
           $TableName='dev_projects';
           $multiClause=array('business_id'=>$business_id);
           $result_as_array=true;
           $All_projects= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
		  
           if($All_projects!=false)
             {    
                   $option_data='';
                   $option_data='<option value=0>---Select Project---</option>';
                  foreach($All_projects as $Single_project)
                         {
                      $selected="";
					if($Single_project['id']==$Allocate_project){$selected="selected";}
                    $option_data.="<option value='".$Single_project['id']."'".$selected." >".$Single_project['project_name'].'</option>';
							
                         }
             }
             else
             {
               $option_data='<option value=00>No Record Found </option>';
             } 
             /*************End Project section***************/
			 
			  /*************Fetch all supplier current business***************/
			 $select='id,suppliers_name';
			$TableName='dev_supplier  ';
			$multiClause=array('business_id'=>$business_id);  
			$result_as_array=true;
			$All_supplier = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			 
			 if($All_supplier!=false)
             {    
                   $supplier_html='';
                   $supplier_html='<option value=0>---Select Supplier---</option>';
                  foreach($All_supplier as $Single_supplier)
                         {
                        $supplier_html.="<option value=".$Single_supplier['id'].">".$Single_supplier['suppliers_name'].'</option>';
                         }
             }
             else
             {
               $supplier_html='<option value=00>No Record Found </option>';
             } 
			 /**************End supplier section***************/ 
			 
			 /*************Fetch all engineer current business***************/
			$select='user_id,name';
			$TableName=' dev_engineer';
			$multiClause=array('business_id'=>$business_id);  
			$result_as_array=true;
			$All_engineer = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array); 
			 
			  if($All_engineer!=false)
             {    
                   $engineer_html='';
                   $engineer_html='<option value=0>---Select Engineer---</option>';
                  foreach($All_engineer as $Single_engineer)
                         {
                        $engineer_html.="<option value=".$Single_engineer['user_id'].">".$Single_engineer['name'].'</option>';
                         }
             }
             else
             {
               $engineer_html='<option value=00>No Record Found </option>';
             } 
			 
			  /**************End engineer section***************/ 

		$data=array('key'=>$data,'Commentdata'=>$Comment_data,'GlobalSupliers_logo'=>$GlobalSupliers_logo,'data'=>$data_invoice_attachment_data,'tolerancePrice'=>$tolerancePrice,'option_data'=>$option_data,'engineer_html'=>$engineer_html,'supplier_html'=>$supplier_html); 
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('pdfview.php',$data);
		$this->load->view('footer.php');
		} 
	}
    
     /***************Allocate a project to invoice ***************/	
    
      public function AllcateProjectToInvoice()
      {
         $project_id=$this->input->post('project_value');
         $invoice_id=$this->input->post('InvoiceId');
                  
          $TableName='dev_NylasUsersAttachments';
          $multiclause=array('Allocate_project'=>$project_id,'flag_invoice'=>0);
          $WhereClause=array('id'=>$invoice_id);
         $All_projects= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
         if($All_projects==true)
           {
            echo '1';
           }else{ echo '2';}
      }
     /***********************************************************/
	 
	  /***************Update Invoice Flag  ***************/	
    
      public function UpdateInvoiceFlagValue()
      {  
         $invoice_flag_value=$this->input->post('invoice_flag_value');
         $invoice_id=$this->input->post('InvoiceId');
         $change_invoice_flag_value=($invoice_flag_value=='0') ? '1' : '0';            
          $TableName='dev_NylasUsersAttachments';
          $multiclause=array('flag_invoice'=>$change_invoice_flag_value);
          $WhereClause=array('id'=>$invoice_id);
         $All_projects= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
         if($All_projects==true)
           {
            echo '1';
           }else{ echo '2';}
      }
     /***********************************************************/
	public function  AddCommentToAttachment()   
	{   
	    $UserName=$_SESSION['status']['name'];
		$TextareaValue=$this->input->post('TextareaValue'); 
		$InvoiceId=$this->input->post('InvoiceId');
		$insert_array=array('UserName'=>$UserName,'Comment'=>$TextareaValue,'Attachment_id'=>$InvoiceId);
		$insert=$this->db->insert('dev_Nylas_Attachments_Comments',$insert_array);
		
		if($insert==true)
		{
			echo"1";
		}
		
		
	}
	
	
	
	
     public function Invoice()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Invoice.php');
		$this->load->view('footer.php');
		} 
	}
	
public function invoiceProduct()   
	{ 
		
		$bid=$this->BusinessIdFunction() ;
	
	    $this->db->select('email,id,date');
		$this->db->from('dev_PmoUserConnectNylas  ');
		$this->db->where('business_id',$bid);
		$data=$this->db->get()->result_array();
		$blank_array=array();
		foreach($data as $datas)
		{
			$email=$datas['email'];
			$date=$datas['date'];
			$id=$datas['id'];
			$setarray=array('id'=>$id,'email'=>$email,'AllEmails'=>'All Emails','date'=>$date); 
			array_push($blank_array,$setarray);
		}
		 $blank_array=json_encode($blank_array);
		 print_r($blank_array);
	}
	
	
	public function SetUp()
	{
	 if(empty($this->session->userdata('status'))){
        redirect(base_url('index'));
	    }
	    else
		{
			
		$bid=$this->BusinessIdFunction() ;
        $this->db->select('email,id,date,Auth_token,Process_Emails,Store_Emails,Number_of_Day');
		$this->db->from('dev_PmoUserConnectNylas');
		$this->db->where('business_id',$bid);
		$data=$this->db->get()->result_array();
		
		if(!empty($data))
		{
			
         $Auth_token=$data[0]['Auth_token'];
		
		
		
		 
		 if(!empty($Auth_token)) { 
		 
		  $autharray=array('Authorization: Bearer'.'  '.$Auth_token.'' );
	     $response= $this->NylasModel->GetFileIdFromNylas($autharray);
         $BlankArray=array();
		 
		 
			 foreach($response as $responses)
			 {
				 $date=$responses->date;
				 $files=$responses->files;   
				 $from=$responses->from;
				 $Sendermail=$from[0]->email;
				/*  if(!empty($files)){  */
				$result = (str_contains($Sendermail, '@')) ? "1" : "0";
				if($result=='1'){$explodedata =explode('@', $Sendermail); $datas=$explodedata[1]; $BlankArray[]=$datas; }else{$datas=pathinfo($Sendermail, PATHINFO_EXTENSION);}
				/*  } 	 */ 
			 }
	
	
	       $BlankArray_count_values=array_count_values($BlankArray);
         }
		 else
		 {
			 $TableName='dev_PmoUserConnectNylas ';
			 $id_array=array('id'=>$data[0]['id']);
			 $Delete= $this->CommonModel->DeleteRecord($TableName,$id_array); 
			 $BlankArray_count_values='';
			 $data='';
			 }

		}else{$BlankArray_count_values='';}	
		
		
        $senddata=array('viewTab'=>'home','listdata'=>$data,'key'=>$BlankArray_count_values);
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('SetUp.php',$senddata);
		$this->load->view('footer.php');
		} 
	}
	
	public function FetchInvoices()
	{	
	 $bid=$this->BusinessIdFunction(); 
	 $multiClause = array('pdftype' => 2,'document_type' => 1,'business_id'=>$bid );
	 $this->db->select('id,vendor_name,vendor_name,total,subtotal,tax,invoice_date,current_month,order_number,document_number,Allocate_project,flag_invoice');
	 $this->db->from('dev_NylasUsersAttachments ');
	 $this->db->where($multiClause);
	 $data=$this->db->get()->result_array();
	 
	 $blank_array=array();
	 foreach($data as $datatwo)
	 {
		  $id=$datatwo['id'];
		  $document_number=$datatwo['document_number'];
		  $vendor_name=$datatwo['vendor_name'];
		  $total=$datatwo['total'];
		  $subtotal=$datatwo['subtotal'];
		  $tax=$datatwo['tax'];
		  $invoice_date=$datatwo['invoice_date'];
		  $current_month=$datatwo['current_month'];   
		  $order_number=$datatwo['order_number'];   
          $Allocate_project=$datatwo['Allocate_project'];     
          $flag_invoice=$datatwo['flag_invoice'];
		  if($order_number=='DAMMY'){$order_number2='';}else{$order_number2=$order_number;} 
		  
		  $insert=array('id'=>$id,'vendor_name'=>$vendor_name,'total'=>$total,'subtotal'=>$subtotal,'tax'=>$tax,'invoice_date'=>$invoice_date,'current_month'=>$current_month,'order_number2'=>$order_number2,'order_number'=>$order_number,'document_number'=>$document_number,'Allocate_project'=>$Allocate_project,'flag_invoice'=>$flag_invoice);
		  array_push($blank_array,$insert);
	 }
	  
		 $data=json_encode($blank_array);
		 print_r($data);
	}
	
	public function FetchCreditnote()
	{
		$bid=$this->BusinessIdFunction();
	 $multiClause = array('pdftype' => 1,'document_type' => 1,'business_id'=>$bid );
	 
	 $this->db->select('id,vendor_name,document_number,total,subtotal,tax,invoice_date,Attachment,invoice_date,current_month,order_number');
	 $this->db->from('dev_NylasUsersAttachments ');
	 $this->db->where($multiClause);
	 $data=$this->db->get()->result_array();
	 $blank_array=array();
	 foreach($data as $datatwo)
	 {
		  $id=$datatwo['id'];
		  $document_number=$datatwo['document_number'];
		  $vendor_name=$datatwo['vendor_name'];
		  $total=$datatwo['total'];
		  $subtotal=$datatwo['subtotal'];
		  $tax=$datatwo['tax'];
		  $invoice_date=$datatwo['invoice_date'];
		  $current_month=$datatwo['current_month'];
		  $order_number=$datatwo['order_number'];
		  if($order_number=='DAMMY'){$order_number2='';}else{$order_number2=$order_number;} 
		  
		  $insert=array('id'=>$id,'vendor_name'=>$vendor_name,'total'=>$total,'subtotal'=>$subtotal,'tax'=>$tax,'invoice_date'=>$invoice_date,'current_month'=>$current_month,'order_number2'=>$order_number2,'order_number'=>$order_number,'document_number'=>$document_number);
		  array_push($blank_array,$insert);
	 }
	  
		 $data=json_encode($blank_array);
	     print_r($data);
	}
	
	public function FetchQuotation()
	{	
	
    	$bid=$this->BusinessIdFunction();
	 $multiClause = array('pdftype' => 3,'document_type' => 1,'business_id'=>$bid );
	 $this->db->select('id,vendor_name,document_number,total,subtotal,tax,invoice_date,Attachment,invoice_date,current_month,order_number');
	 $this->db->from('dev_NylasUsersAttachments ');
	 $this->db->where($multiClause);
	 $data=$this->db->get()->result_array();
	 $blank_array=array();
	 foreach($data as $datatwo)
	 {
		  $id=$datatwo['id'];
		  $document_number=$datatwo['document_number'];
		  $vendor_name=$datatwo['vendor_name'];
		  $total=$datatwo['total'];
		  $subtotal=$datatwo['subtotal'];
		  $tax=$datatwo['tax'];
		  $invoice_date=$datatwo['invoice_date'];
		  $current_month=$datatwo['current_month'];
		  $order_number=$datatwo['order_number'];
		  if($order_number=='DAMMY'){$order_number2='';}else{$order_number2=$order_number;} 
		  
		  $insert=array('id'=>$id,'vendor_name'=>$vendor_name,'total'=>$total,'subtotal'=>$subtotal,'tax'=>$tax,'invoice_date'=>$invoice_date,'current_month'=>$current_month,'order_number2'=>$order_number2,'order_number'=>$order_number,'document_number'=>$document_number);
		  array_push($blank_array,$insert);
	 }
	  
		  $data=json_encode($blank_array);
	      print_r($data);
	}
	
	public function AssociatedInvoice()
	{	
	
		 $order_number=$this->uri->segment(2);
		 
		 $multiClause = array('pdftype' => 2,'order_number' =>$order_number);
		 $bid=$this->BusinessIdFunction();
		 $this->db->select('*');
		 $this->db->from('dev_NylasUsersAttachments');
		 $this->db->where($multiClause);
		 
		 $data=$this->db->get()->result_array();
		if(count($data)>=2)
		{
			$data=json_encode($data);
			print_r($data);
		}	
	}
	
	
	
	 public function Quotation()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Quotation.php');
		$this->load->view('footer.php');
		} 
	}
	
	
	 public function Creditnote()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Creditnote.php');
		$this->load->view('footer.php');
		} 
	}
	
	
	
	public function InsertUsersDomians()
	{
       $domains=$this->input->post('val');
	   $blank='';
	   $blank_array=array();
	   foreach($domains as $domainsdata)
	   {
		  if(!empty($domainsdata))
		  {			  
		   $blank.=','.$domainsdata;
		  }		 
	   }
		$blank=trim($blank,','); 
		$sendData=explode(",",$blank);
		echo json_encode($sendData);
	
	}
	
	public function SetupUserDomain()
	{
		 $userid=$this->input->post('userid');
         $domains=$this->input->post('val');
		     $blank_array=array();
			 $blank_array2=array();
		     $this->db->select('domains');
			 $this->db->from('dev_PmoNylas_users_domains');
			 $this->db->where('Nylas_users_id ',$userid);
			 $Domains_array=$this->db->get()->result_array(); // Get domains add by user
			  
			  foreach($Domains_array as $key=>$val)
			  {
				  $name=$val['domains'];
				  $blank_array2[]=$name;
			  }
		$blank_array=array();
		foreach($domains as $domainsdata)
	   { 
		  if(!empty($domainsdata) && !in_array($domainsdata,$blank_array2))
		  {			  
		   $insert_array=array('domains'=>$domainsdata,'Nylas_users_id'=>$userid);
		   array_push($blank_array,$insert_array);
		  }		 
	   }
	   if(!empty($blank_array))
	   {
		$insert=$this->db->insert_batch('dev_PmoNylas_users_domains', $blank_array);
	   }		
		
			echo "1";
		
		
	}
	
	
	public function EditDomains()
	{
	 if(empty($this->session->userdata('status'))){
        redirect(base_url('index'));
	    }
	    else
		{
		$User_id=$this->uri->segment(2);
		
		$this->db->select('dev_PmoUserConnectNylas.email,dev_PmoNylas_users_domains.domains,dev_PmoNylas_users_domains.id');
		$this->db->from('dev_PmoUserConnectNylas');
		$this->db->join('dev_PmoNylas_users_domains', 'dev_PmoNylas_users_domains.Nylas_users_id=dev_PmoUserConnectNylas.id');
		$this->db->where('dev_PmoNylas_users_domains.Nylas_users_id',$User_id);
		$query = $this->db->get()->result_array();
        $data=array('key'=>$query);
		
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('EditDomains.php', $data);
		$this->load->view('footer.php');
		} 
	}


    public function DeleteDomain()
	{
		$id=$_REQUEST['id'];
	    $this->db->delete('dev_PmoNylas_users_domains ',array('id'=>$id));
        if($this->db->affected_rows())
		{echo'1';}}
	
	 /* public function EditSingleDomain()
	{
		$id=$_POST['id'];
		$val=$_POST['val'];
        $data=array('domains'=>$val);
		$this->db->where('id',$id);
		$this->db->update('dev_PmoNylas_users_domains', $data);
		echo'1';
	    } */
	
	public function GetFileById($id,$autharray)
	{
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.nylas.com/files/'.$id.'/download',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => $autharray,
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	
	public function EditSingleDomain()
	{
	 $this->db->select('id,account_id,Auth_token');
	 $this->db->from('dev_PmoUserConnectNylas');
	 $this->db->where(' cron_Setup ', 0);
	 $data=$this->db->get()->result_array();
	 
	foreach($data as $dataval)
	{
		$user_id=$dataval['id'];
		$account_id=$dataval['account_id'];
		$Auth_token=$dataval['Auth_token'];
		$Process_Emails=$dataval['Process_Emails'];
		
		if($Process_Emails=='0')
		{
			return false;
		}	
		
		 $autharray=array('Authorization: Bearer'.'  '.$Auth_token.'' );
		 $response= $this->NylasModel->GetFileIdFromNylas($autharray);   // Get All mail messages
		 
		     $BlankArray2=array();
		     $blank_array=array();
		     $this->db->select('domains');
			 $this->db->from('dev_PmoNylas_users_domains');
			 $this->db->where('Nylas_users_id ',$user_id);
			 $Domains_array=$this->db->get()->result_array(); // Get domains add by user
			  
			  foreach($Domains_array as $key=>$val)
			  {
				  $name=$val['domains'];
				  $blank_array[]=$name;
			  }
			  
				 foreach($response as $responsedata) // Get mail message one by one 
				{
					$date=$responsedata->date;
					$files=$responsedata->files;   
		            $from=$responsedata->from;
		            $Sendermail=$from[0]->email;
					$explodeDomain =explode('@', $Sendermail);
					$Email=$explodeDomain[1];
					
						if(in_array($Email,$blank_array))
						{
							if(!empty($files))
		                    { 
						       $content_type=$files[0]->content_type;
		                       $id=$files[0]->id;	 
		                       $array = explode('/', $content_type);
		                       $AttachmentType=$array[0];
		                       $AttachmentExtension=$array[1];
							   
						         if($AttachmentExtension=='pdf')
		                         {
									   $file_Response=$this->GetFileById($id,$autharray); //  get file grom nylas
									   $uniqid = uniqid();
									   $pdfname=$uniqid.'.'.$AttachmentExtension;
									   
									   $fp = fopen("NylasAttachment/".$pdfname,"wb");      // create file in M8 server 
									   fwrite($fp,$file_Response);
									   fclose($fp);
									   
									   $InsertFileInAws=$this->SendNylasAttachmentInAws($pdfname); // Send file path in Aws server
									   $url=base_url().'/NylasAttachment/'.$pdfname;
									   $insertArray=array('NylasUserId'=>$user_id,'Attachment'=>$url,'Attachment_type'=>$AttachmentType,'Attachment_Date'=>$date,'Attachment_name'=>$pdfname); 
									   array_push($BlankArray2,$insertArray);
								 }
						
						    }
						}
					 
					
				} 
					if(!empty($BlankArray2)){$this->db->insert_batch('dev_NylasUsersAttachments', $BlankArray2);}
					$this->db->where('id',$user_id);
					 $this->db->update('dev_PmoUserConnectNylas',array('cron_Setup'=>'1'));
	     
	}
	} 
	
	public function GlobalSupliers()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('GlobalSupliers.php');
		$this->load->view('footer.php');
		} 
	}
	
	
	public function AddNewGlobalSuppliers()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('AddNewGlobalSuppliers.php');
		$this->load->view('footer.php');
		} 
	}
	
	public function EditSingleSuplier()
	{
	 if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{	
		
		$User_id=$this->uri->segment(2);
		$this->db->select('*');
		$this->db->from('dev_GlobalSupliers');
		$this->db->where('id',$User_id);
		$query = $this->db->get()->result_array();
        $data=array('key'=>$query);
		
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('EditGlobalSuppliers.php',$data);
		$this->load->view('footer.php');
		} 
	}
	
    public function AddNewSingleGlobalSupplier()
	{
		
		$SupplierName=$this->input->post('SupplierName');
		$Supplierlogo=$_FILES['Supplierlogo'];
		$Supplierlogo_name=$_FILES['Supplierlogo']['name'];
		$Supplierlogo_tmp_name=$_FILES['Supplierlogo']['tmp_name'];
		
		$pathinfo=pathinfo($Supplierlogo_name, PATHINFO_EXTENSION);
		$imagename=uniqid().$pathinfo;
		
		$url=base_url().'images/GlobalSuplier/'.$imagename;
		
		 if(move_uploaded_file($Supplierlogo_tmp_name,"images/GlobalSuplier/".$imagename)){
			 
			$array_Insert=array(
			    'Supliers_logo'=>$url,
				'Supliers_Name'=>$SupplierName
			    );
			 $insert=$this->db->insert(' dev_GlobalSupliers',$array_Insert);
			 if($insert==true)
			 {
				 redirect(base_url('GlobalSupliers'));
			 }
		     }else{"error in file uploading";}
	}
	
	 public function EditSingleGlobalSupplier()
	{
		$id=$this->input->post('hiddenid');
		$SupplierName=$this->input->post('SupplierName');
		$Supplierlogo=$_FILES['Supplierlogo'];
		$Supplierlogo_name=$_FILES['Supplierlogo']['name'];
		$Supplierlogo_tmp_name=$_FILES['Supplierlogo']['tmp_name'];
		
		if(!empty($Supplierlogo_name))
		{
		  $pathinfo=pathinfo($Supplierlogo_name, PATHINFO_EXTENSION);
		$imagename=uniqid().$pathinfo;
		
		$url=base_url().'images/GlobalSuplier/'.$imagename;
		
		 if(move_uploaded_file($Supplierlogo_tmp_name,"images/GlobalSuplier/".$imagename)){
			 
			$Update_array=array(
			    'Supliers_logo'=>$url,
				'Supliers_Name'=>$SupplierName
			    );
		     }else{"error in file uploading";}
	    }
        else{
			$Update_array=array('Supliers_Name'=>$SupplierName);
		}
		
		$this->db->where('id',$id);
        $update=$this->db->update('dev_GlobalSupliers',$Update_array);
        if($update==true)
		{
			redirect(base_url('GlobalSupliers'));
		}
		
	}
	public function FetchAllGlobalSuppliers()
	{	
	 $this->db->select('*');
	 $this->db->from('dev_GlobalSupliers');
	 $data=$this->db->get()->result_array();
	 $data=json_encode($data);
	 print_r($data);
	}
	
	public function DeleteSingleSuplier()
	{
		$Global_Supplier_id=$this->uri->segment(2);
	    $delete=$this->db->delete('dev_GlobalSupliers',array('id'=>$Global_Supplier_id));
        if($delete==true)
		{
			redirect(base_url('GlobalSupliers'));
		}
       }
	
	public function DeleteSingleSuplierLogo()
	{
		$id= $this->input->post('id');
		
		$data=array('Supliers_logo'=>'');
		$this->db->where('id',$id);
        $update=$this->db->update('dev_GlobalSupliers', $data);
        if($update==true)
		{
			echo"1";
		}
		
       }
	   
	   /******** fetch invoice nylas attachment details ******/
	public function invoiceNylasAttachmentDetails()
	{	
	    
	 /******** part=part no/ dec=Description ******/
	 $Check_row=$this->uri->segment(3);
	 $invoice_id=$this->uri->segment(2);
	 
	  $select=($Check_row=='part') ? 'part_number' : 'description'; 
	  $this->db->select($select);
	  $this->db->from('nylas_invoice_attachement_detail');
	  $this->db->where('id',$invoice_id);
	  $query = $this->db->get()->result_array();
	  
	  $select_query=($Check_row=='part') ? $query[0]['part_number'] : $query[0]['description']; 
	 
	 $this->db->select('nylas_invoice_attachement_detail.id,nylas_invoice_attachement_detail.nylas_id,nylas_invoice_attachement_detail.qty,nylas_invoice_attachement_detail.part_number,nylas_invoice_attachement_detail.description,nylas_invoice_attachement_detail.price,nylas_invoice_attachement_detail.per_uom,discount,nylas_invoice_attachement_detail.total,dev_NylasUsersAttachments.pdftype,dev_NylasUsersAttachments.vendor_name,dev_NylasUsersAttachments.document_number,dev_NylasUsersAttachments.order_number,dev_NylasUsersAttachments.id as idtwo');
	 $this->db->from('nylas_invoice_attachement_detail');
	 $this->db->join('dev_NylasUsersAttachments ', 'dev_NylasUsersAttachments.id=nylas_invoice_attachement_detail.nylas_id');
	 $this->db->where('nylas_invoice_attachement_detail.'.$select,$select_query); 
	 
	 $data_invoice_attachment_details['data_invoice_attachment_detail'] = $this->db->get()->result_array();
	
	 $this->load->view('header.php');
	 $this->load->view('sidebar.php');
	 $this->load->view('invoice_individual_details.php',$data_invoice_attachment_details);
	 $this->load->view('footer.php');
	 
	}
	
	public function productCatalogue()
	{
		if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('product_catalogue.php');
			$this->load->view('footer.php');
		}
	}
	
	public function productCatalogueDataFetch()
	{
		$bid=$this->BusinessIdFunction();
        
		//$multiClause = array('pdftype' => 2 );
		$product_catalogues = $this->db->query("SELECT nylas_invoice_attachement_detail.id, nylas_invoice_attachement_detail.nylas_id, nylas_invoice_attachement_detail.qty, nylas_invoice_attachement_detail.part_number, nylas_invoice_attachement_detail.description, nylas_invoice_attachement_detail.price, nylas_invoice_attachement_detail.per_uom, discount, nylas_invoice_attachement_detail.total, dev_NylasUsersAttachments.pdftype, dev_NylasUsersAttachments.vendor_name, dev_NylasUsersAttachments.document_number, dev_NylasUsersAttachments.order_number, dev_NylasUsersAttachments.id as idtwo FROM nylas_invoice_attachement_detail JOIN dev_NylasUsersAttachments ON dev_NylasUsersAttachments.id=nylas_invoice_attachement_detail.nylas_id WHERE pdftype = 2 AND business_id = $bid GROUP BY concat(part_number, description, vendor_name) ORDER BY nylas_id DESC"); 
		$product_catalogue = $product_catalogues->result_array();
		$all_products=array();
		foreach($product_catalogue as $product)
		{
			if($product['part_number']=='')
			{
				$product['part_number']=$product['description'];
						
			}	
			
			
			$all_products[]=$product;
		}
		
		
		
		$product_data = json_encode($all_products);
	    print_r($product_data);
		exit;
	
		
	}



    public function FetchInvoiceUnderProject()
    {
        $project_id=$this->uri->segment(2);

        $select='*';
        $TableName='dev_NylasUsersAttachments ';
        $multiClause=array('Allocate_project'=>$project_id);  
        $result_as_array=true;
        $All_under_projects= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
        print_r(json_encode($All_under_projects));
    }
    
	/***************InvoiceUnderProject view page ***************/
	
     public function InvoiceUnderProject()
	{
		if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('InvoiceUnderProject.php');
			$this->load->view('footer.php');
		}
	}

     /***************Allocate a project to invoice ***************/	
    
      public function DeleteInvoice()
      {
      
         $invoice_id=$this->input->post('InvoiceId');
                  
         $TableName='dev_NylasUsersAttachments ';
         $multiclause=array('document_type'=>3);
         $WhereClause=array('id'=>$invoice_id);
         $All_projects= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
         if($All_projects==true)
           {
            echo '1';
           }else{ echo '2';}
      }
     /***********************************************************/
	
	 public function UpdateINvoice()
      {
		  $InvoiceId= $this->input->post('InvoiceId');
		  $Order_Number= $this->input->post('Order_Number');
		  
		  $TableName='dev_NylasUsersAttachments';
          $multiclause=array('order_number'=>$Order_Number);
          $WhereClause=array('id'=>$InvoiceId);
		  $Update_order= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
		  
		  if($Update_order==true)
		  {
			  
			$select='order_number';
			$TableName='dev_NylasUsersAttachments ';
			$multiClause=array('id'=>$InvoiceId);  
			$result_as_array=true;
		
			$Get_order_no= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);  
			$order_no=$Get_order_no[0]['order_number'];
			
			redirect(base_url('/pdfview/'.$InvoiceId.'/'.$order_no));
		
	      }
	  }
	  
	  
	  /********************************/
	public function Statement()
	{
		if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('Statement.php');
			$this->load->view('footer.php');
		}
	}
	  
	public function ViewStatements()
	{
		if(empty($this->session->userdata('status'))){ 
        redirect(base_url('index'));                                  
	    }
	    else
		{
			$Attachment_id=$this->uri->segment(2);
			
			$select='DISTINCT(vendor_name)';
			$TableName='dev_Nylas_statements';
			$multiClause=array('Attachment_id'=>$Attachment_id);  
			$result_as_array=true;
		    $vendor_name= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			
			$data['key']=$vendor_name[0]['vendor_name'];
			
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ViewStatements.php',$data);
			$this->load->view('footer.php'); 
		}
	}  
	  /***************fetch view statement****************/
	 
	 public function FetchViewStatement()
	 {
		   $Attachment_id=$this->uri->segment(2);	
			
			$select='*';
			$TableName='dev_Nylas_statements';
			$multiClause=array('Attachment_id'=>$Attachment_id);  
			$result_as_array=true;
		    $All_statements= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			
			$blank_array=array();
			foreach($All_statements as $single_statement)
			{   
				if(!empty($single_statement['document_number'])){
					 
							 $select='Allocate_project';
			                 $TableName='dev_NylasUsersAttachments';
			                 $multiClause=array('document_number'=>$single_statement['document_number']);  
			                 $result_as_array=true;
            
		                     $Allocate_project_id= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
							
                             if($Allocate_project_id!='0' && $Allocate_project_id!=false)
							   {
								  $this->db->where('id',$Allocate_project_id[0]['Allocate_project']);
		                          $project_name = $this->db->get('dev_projects ')->row()->project_name; 
							   }
							   else
							   {
								 $project_name='';
							   } 
									$singel_array['id']=$single_statement['id'];
									$singel_array['statement_no']=$single_statement['document_number'];;
									$singel_array['procurehq_item']=$single_statement['document_number'];;
									$singel_array['project']=$project_name;
									$singel_array['sub_total']=$single_statement['sub_total'];
									$singel_array['vat']=$single_statement['vat'];
									$singel_array['total']=$single_statement['total'];
									$singel_array['approve']='';
									$singel_array['accounting_software_entery']='';
									$singel_array['status']='';
									array_push($blank_array,$singel_array);
				}
			}   
			                       print_r(json_encode($blank_array));
	 }
      	 
	  
	  
	  /***************Fetch all statement ****************/
	  
	  public function FetchAllStatement()
	  {
		  
		    
			/* select  count(*) count1 from `dev_Nylas_statements`, `dev_NylasUsersAttachments` where Attachment_id=9 and dev_Nylas_statements.document_number=dev_NylasUsersAttachments.document_number and pdf  */
			 $bid=$this->BusinessIdFunction(); 
			$select='id';
			$TableName='dev_NylasUsersAttachments';
			$multiClause=array('pdftype'=>4,'business_id'=>$bid);  
			$result_as_array=true;
            
		    $All_diff_ids= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
		 
		    $blank_array=array();
		   foreach($All_diff_ids as $fetch_single_data)
		   {
			   $Attachment_id=$fetch_single_data['id'];
			   $select2='vendor_name,COUNT(document_number)  AS  inovie_count';
			   $TableName2='dev_Nylas_statements';
			   $multiClause2=array('Attachment_id'=>$Attachment_id); 
			   $manage_invoice= $this->CommonModel->Fetchdata($select2,$TableName2,$multiClause2,$result_as_array);
			  
					 $select='count(*) as inovie_match ';
					 $TableName='dev_NylasUsersAttachments';
					 $multiClause=array('dev_NylasUsersAttachments.pdftype'=>2,'dev_Nylas_statements.Attachment_id'=>$Attachment_id);
					 $join_table='dev_Nylas_statements';
					 $join_relation=' dev_Nylas_statements.document_number=dev_NylasUsersAttachments.document_number';
					 $result_as_array=true;
				  
	$inovie_match= $this->CommonModel->Fetchjoindata($select,$TableName,$multiClause,$result_as_array,$join_table,$join_relation);	
			  
						$vendor_name=$manage_invoice[0]['vendor_name'];
						$inovie_count=$manage_invoice[0]['inovie_count'];
						$inovie_match=$inovie_match[0]['inovie_match'];
						$invoice_not_processed = $inovie_count- $inovie_match;
						$invoice_not_processed = ($invoice_not_processed < 0 ) ? '0' : $invoice_not_processed;
				
							$singel_array['Attachment_id']=$Attachment_id;
							$singel_array['vendor_name']=$vendor_name;
							$singel_array['inovie_count']=$inovie_count;
							$singel_array['inovie_match']=$inovie_match;
							$singel_array['invoice_not_processed']=$invoice_not_processed; 
							array_push($blank_array,$singel_array);
		   }
		                       print_r(json_encode($blank_array));
		   
	  }
	  
	  /*****************************************/
	  
	  	public function GEtjsonFilesFromAwsToStatement()
	    {
			
			
			 $filename=$_POST['filename']; 
			 $jsonfile=$_POST['data']; 
			 mail( 'nikhil.scorpsoft@gmail.com',$filename, $jsonfile); 
		
			 
			$jsonfile= trim($jsonfile, "'");
			mail( 'nikhil.scorpsoft@gmail.com',$filename, $jsonfile); 
			$data=json_decode($jsonfile);
		
		      $filename=str_replace('txt','pdf',$filename);
	 	      $this->db->where('Attachment_name',$filename);
		      $Attachment_id = $this->db->get('dev_NylasUsersAttachments')->row()->id;  
		
				$TableName='dev_NylasUsersAttachments';
				$multiclause=array('pdftype'=>4,'document_type'=>1);
				$WhereClause=array('id'=>$Attachment_id);
				$update_type= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
		
							$VENDOR_NAME=$data[0][0]->VENDOR_NAME;
						
							$line_array=$data[1];
							
							for($i=0;$i<count($line_array);$i++)
							{
								$table_value=$line_array[$i];
								for($j=0;$j<count($table_value);$j++)
								{	
									
									$row_data=$table_value[$j];
									$document_no='';
									$Total='';
									$VAT='';
									$sub_total='';
									$document_type='';				
									foreach($row_data as $key=>$val)
									{
										 if($key=="Doc. No." && $document_no==''){ $document_no=$val;} 

										 if($key=="VAT" && $VAT==''){ $VAT=$val;}
										 
										 if($key=="Amount\nPayable" && $Total==''){ $Total=$val;} 
										 
										 if($key=="Remaining\nAmount" && $sub_total==''){ $sub_total=$val;} 

										  if($key=="Doc.\nType" && $document_type==''){ $document_type=$val;}  
										  
										 $insert_array['document_number']=$document_no;  
										 $insert_array['vat']=$VAT;
										 $insert_array['total']=$Total;
										 $insert_array['sub_total']=$sub_total;
										 $insert_array['Attachment_id']=$Attachment_id;
										 $insert_array['vendor_name']=$VENDOR_NAME;	
															 
									}
													  if(!empty($VAT) && $document_type=='IN' )
													  {
													     $this->db->insert('dev_Nylas_statements',$insert_array);
													  }
								}
								
								
							}
		
			
		}
	  
	  
	   /******************make order to qoute********************/
	   
	   public function CreteOrderToqoute()
	   {
		 
		   
		   
		  if($this->input->post('checkMethod')=='AutoKey')
		  {
			  
		       $checkMethod = $this->input->post('checkMethod');
			 
		  }
		  else
          {
			   $checkMethod = $this->input->post('checkMethod'); 
			   $project_id = $this->input->post('project_id');
			   $engineer_id = $this->input->post('engineer_id');
			   $vendor_name =  $this->input->post('supplier_id');
		       $globel_Delivery_Collection_time = $this->input->post('birthday_time'); 
		       $globel_Delivery_Collection_date = $this->input->post('birthday_date'); 
		       
			   if($this->input->post('deduct')==1)
			   {
				   $globel_Delivery_Collection_type = 'Delivery';
			   }else
			   {
				   $globel_Delivery_Collection_type = 'Collection';
			   } 


			  
		  }  			  
		  
		       $InvoiceId = $this->input->post('InvoiceId');
			  
			   $iswholeseller='block';
			   $wholesellerview='none';
			   $today_date=date('d-m-y');
			   $what1='block';
			   $what2='none';
		       /************Fetch qoute************/
		       $select = '*';
			   $TableName = 'dev_NylasUsersAttachments'; 
			   $multiClause = array('id'=>$InvoiceId); 
			   $result_as_array = true;
			   $Fetch_qoute = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			   
			   if($this->input->post('checkMethod')=='AutoKey')
		       {
			   $project_id = $Fetch_qoute[0]['project_id'];
			   $engineer_id = $Fetch_qoute[0]['engineer_id'];
               $vendor_name = $Fetch_qoute[0]['vendor_name'];
			   }			   
			   $po_reffrence = $Fetch_qoute[0]['order_number'];  
			   $json_line_data = $Fetch_qoute[0]['json_line_data'];
			   $grandtotal = $Fetch_qoute[0]['total'];
			   $grandsubtotal = $Fetch_qoute[0]['subtotal'];
			   $grandvat = $Fetch_qoute[0]['tax'];
			   $date = date('d-m-y h:i:s');
			    
			   
					   /***************Po number**************/
					   $select3 = 'MAX( po_number ) AS max_po';
					   $TableName3 = 'dev_orders';
					   $multiClause3 = array(); 
					   $result_as_array = true;
					   $max_po_number = $this->CommonModel->Fetchdata($select3,$TableName3,$multiClause3,$result_as_array);
					   $po_number = $max_po_number[0]['max_po']+1;
					   
					    if($this->input->post('checkMethod')=='AutoKey')
		                 {
							   /*************Delivery Collection instruction**********/
							   $select='globel_Delivery_Collection_time,globel_Delivery_Collection_date,globel_Delivery_Collection_type';
							   $TableName='dev_Quotes';
							   $multiClause=array('po_reffrence'=>$po_reffrence); 
							   $result_as_array=true;
							   $Quotes_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
							   $globel_Delivery_Collection_time = $Quotes_data[0]['globel_Delivery_Collection_time'];
							   $globel_Delivery_Collection_date = $Quotes_data[0]['globel_Delivery_Collection_date'];
							   $globel_Delivery_Collection_type = $Quotes_data[0]['globel_Delivery_Collection_type'];
						 }
							   /*************user data**********/
								 $select = 'dev_users.role,dev_engineer.*';
								 $TableName = 'dev_users';
								 $whereClause = array('dev_users.id'=>$engineer_id);
								 $join_table = 'dev_engineer';
								 $join_relation = 'dev_engineer.user_id=dev_users.id';
								 $result_as_array = true;
							 
								 $Engineer_info = $this->CommonModel->Fetchjoindata($select,$TableName,$whereClause,$result_as_array,$join_table,$join_relation);
							 
								 $engineer_role = $Engineer_info[0]['role']; 
								 $engineer_business_id = $Engineer_info[0]['business_id'];
								  $engineer_newaccnumber = $Engineer_info[0]['newaccnumber'];
								  $engineer_user_name = $Engineer_info[0]['user_name'];
								  $engineer_business_id = $Engineer_info[0]['business_id'];
								  $engineer_business_id = $Engineer_info[0]['business_id'];
			             
									  /*************project details**********/
									   $select = '*';
									   $TableName = 'dev_projects ';
									   $multiClause = array('id'=>$project_id); 
									   $result_as_array = true;
									   $project_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
									   $project_name = $project_data[0]['project_name'];
									   $project_Delivery_Address = $project_data[0]['Delivery_Address'];
									   $project_delivery_city = $project_data[0]['delivery_city'];
									   $project_post_code = $project_data[0]['post_code'];
									   
									   /*************dev_business details**********/
									   $select = '*';
									   $TableName = 'dev_business ';
									   $multiClause = array('id'=>$engineer_business_id); 
									   $result_as_array = true;
									   $business_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
									   $bussiness_logo = $business_data[0]['bussiness_logo'];
									   $business_name = $business_data[0]['business_name'];
									   $business_address = $business_data[0]['address'];
									   $business_email = $business_data[0]['email'];  
									   $post_code = $business_data[0]['post_code'];
									           /*************suppliers details**********/
											    
											   $select = '*';
											   $TableName = 'dev_supplier ';
											   if($this->input->post('checkMethod')=='AutoKey')
		                                        {
													$multiClause = array('suppliers_name'=>$vendor_name); 
												}else{
													$multiClause = array('id'=>$vendor_name);
												}
											   $result_as_array = true;
											   $suppliers_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
											   $suppliers_name = $suppliers_data[0]['suppliers_name'];
											   $suppliers_address = $suppliers_data[0]['address'];
											   $suppliers_city = $suppliers_data[0]['suppliers_city'];
											   $suppliers_post_code= $suppliers_data[0]['post_code'];
											   $suppliers_email = $suppliers_data[0]['email'];
											   $suppliers_AccountNumber = $suppliers_data[0]['AccountNumber'];
						                       $to = $suppliers_data[0]['email'];
						    
												  $order_array['business_id'] = $engineer_business_id;
												  $order_array['total_ex_vat'] = $grandtotal;
												  $order_array['date'] = $date;
												  $order_array['po_reffrence'] = $po_reffrence;
												  $order_array['status'] = '0';
												  $order_array['instruction'] = '';
												  $order_array['odrdescrp'] = '';
												  $order_array['givenprojectid' ] = $project_id;
												  $order_array['givenprojectname'] = $project_name;
												  $order_array['po_number'] = $po_number;
												  $order_array['Transaction_id'] = 'none';
												  $order_array['payment_status'] = 'none';
						  
						                            
						                           
						                            $qty_array = array("quantity", "qty","qtty","quantity no","QUANTITYSUPPLIED","Quantity Product","Qty.","Quantity");
													$part_array = array("Part No.","CODE","Part","SKU Number");
													$per_array = array("PER","Per UOM","Per","Unit");
													$description_array = array("Description","CATALOGUE No. AND DESCRIPTION","Product Description");
													$price_array = array("PRICE","Price");   
													$discount_array = array("Discount(%)","Disc %","DISCOUNT","Disc.");
													$total_array = array("EXTENSION","Amount VAT","Total V","Total","Amount VAT Invoice","Net");
						                             
													 $json_line_data = json_decode($json_line_data);
													    $line_array=$json_line_data[0];
														
														$table_data='';
						                              for($i=0;$i<count($line_array);$i++)
														{      
															$table_value=$line_array[$i];
														
																$row_data=$table_value;
																
																$qty = '';
																$part_number = '';
																$per = '1';
																$description = '';
																$price = '';
																$discount = '';
																$total = '';
																$refrence_id=rand();
																
																foreach($row_data as $key=>$value)
																{
																	 $key=str_replace("\n","",$key);	 
																	 if(in_array($key,$qty_array)){
																		$qty = $value;
																		
																	 }
																	 elseif(in_array($key,$part_array)){
																		 if($part_number!=''){$part_number.=" $value";}
																		 else $part_number=$value;
																	 }
																	 elseif(in_array($key,$per_array)){
																		 $per=$value;
																	 }
																	 elseif(in_array($key,$description_array)){
																		 $description=$value;
																	 }
																	 elseif(in_array($key,$price_array)){
																		 $price=$value;
																	 }
																	 elseif(in_array($key,$discount_array)){
																		 $discount=$value;
																	 }
																	 elseif(in_array($key,$total_array)){
																		 $total=$value;
																	 }
																	
																	
																	
																 
																}	
																
																$table_data .='<tr>  
												          <td style="text-align: left;padding-top: 10px;">'.$description.'</td>
													      <td style="text-align:center;padding-top: 10px;">'.$description.'</td>
														  <td style="text-align:center;padding-top: 10px;">'.$qty.'</td>
														  <td style="text-align:center; padding-top: 10px;">£'.$price.'</td>
														  <td style="text-align:center;padding-top: 10px;">'.$total.'%</td>
														  <td  style="text-align:center; padding-top: 10px;">£'.$price.'</td>
												   </tr>';
																
																
																   
																     if($globel_Delivery_Collection_type == 'Delivery')
																	 {
																	 $single_order_array['delivery_time'] = $globel_Delivery_Collection_time;
																	 $single_order_array['delivery_Date'] = $globel_Delivery_Collection_date;
																	 $single_order_array['collection_date'] = '';
																	 $single_order_array['collection_time'] = '';
																	 }
																	 else
																	 {
																		 
																	 $single_order_array['delivery_time'] = '';
																	 $single_order_array['delivery_Date'] = '';
																	 $single_order_array['collection_date'] = $globel_Delivery_Collection_date;
																	 $single_order_array['collection_time'] = $globel_Delivery_Collection_time; 
																	 
																	 }	 
																
																
																     $single_order_array['project_id'] = $project_id;
																	 $single_order_array['total_ex_vat'] = $price;
																	 $single_order_array['order_desc'] = $description;
																	 $single_order_array['product_id'] = '';
																	 $single_order_array['qty'] = $qty;
																	 $single_order_array['Reffrence_id'] = $refrence_id;
																	 $single_order_array['status'] = '44';
																	 $single_order_array['ex_vat'] = $total;
																     $single_order_array['vat_class'] = $total;
																     $single_order_array['variation_option_name'] = '';
																     $single_order_array['variation_id'] = '';
																     $single_order_array['date'] = $date;
																     $single_order_array['image'] = '';
																     $single_order_array['ProductTitle'] = $description;
																     $single_order_array['ProductCode'] = $description;
																     
																	
													                 $Table_name=' dev_single_order ';
																	  $Insert_array=$single_order_array;
																	  $Last_insert_id=false;
																	  $Insert_Batch=false;
																	  $insert_id = $this->CommonModel->InsertRecord($Table_name,$Insert_array,$Last_insert_id,$Insert_Batch);
																
																
																  
															
															
																	
														}
						  
												  $Table_name='dev_orders';
												  $Insert_array=$order_array;
												  $Last_insert_id=true;
												  $Insert_Batch=false;
												  $insert_id = $this->CommonModel->InsertRecord($Table_name,$Insert_array,$Last_insert_id,$Insert_Batch);
                                                  $uniqid=$insert_id;
												  
						                          
						$message='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>td {vertical-align: -webkit-baseline-middle;}</style></head>

	  <body style="font-family:lato;font-size:14px; padding:0px;margin:0px;"  >
	  <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
	  <tr>
	  <td align="center">
		  <table style="border-bottom: 1px dotted #bfbebe;"width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			 <tr> 
				  <td style="width:200px;"><img style="width: 170px;" src="'.trim($bussiness_logo).'"/></td>
				 <td style="width:300px;">
					<ul style="width:179px;list-style:none;margin-left:187px;padding:12px 12px;display:'.$iswholeseller.'">
					  <li>'.$business_name.'</li>
					  <li>'.$business_address.'</li>
					  <li>'.$post_code.'</li>
					  <li>'.$business_email.'</li>
					</ul>
				 </td>
				 </tr>
		</table>
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
						<td  width="400px;"><h3 style="font-weight: bold;">QUOTATION</h3>
							<ul style="list-style:none; padding-left:0px;display:'.$iswholeseller.'">
						
				  <li>'.$suppliers_name.'</li>
				  <li>'.$suppliers_address.'</li>
				  <li>'.$suppliers_city.'</li>
				  <li>'.$suppliers_post_code.'</li>
				  <li>'.$suppliers_email.'</li>
				 
						</ul>
						<ul style="list-style:none; padding-left:0px;display:'.$wholesellerview.'">
				 <li><b>From</b></li>	
				       <li>'.$business_name.'</li>
					  <li>'.$business_address.'</li>
					  <li>'.$post_code.'</li>
					  <li>'.$business_email.'</li>
				 
				 
						</ul>
						
						</td>
						<td width="200px;">
						<ul style="list-style:none; padding-left:0px;">
						  <li style="padding-bottom: 5px;"><b>QUOTATION DATE</b></li>
						   <li style="padding-bottom: 5px;">'.$today_date.'</li>
						 
						   <li style="padding-bottom: 5px;"><b>Account Number</b></li>
						   <li style="padding-bottom: 5px; display:'.$iswholeseller.'";>'.$suppliers_AccountNumber.'</li>
						   <li style="padding-bottom: 5px; display:'.$wholesellerview.'";>'.$engineer_newaccnumber.'</li>
						   <li style="padding-bottom: 5px;"><b>QUOTATION NUMBER</b></li>
						   <li style="padding-bottom: 5px;">quote no-'.$uniqid.'</li>
						    <li style="padding-bottom: 5px; display:'.$wholesellerview.'"><b>Oprative Name</b></li>
						   <li style="padding-bottom: 5px; display:'.$wholesellerview.'">'.$engineer_user_name.'</li>
						   <li style="padding-bottom: 5px;"><b>Order Description</b>
						   <li style="padding-bottom: 5px;"> </li>
					       <li style="padding-bottom: 5px;"><b>project Name</b>
						   <li style="padding-bottom: 5px;">'.$project_name.'</li>
						   <li style="padding-bottom: 5px;"><b>Order Number</b>  
						   <li style="padding-bottom: 5px;">'.$po_reffrence.'</li>
						</ul>
						
						</td>
				</tr>
		</table>
		
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
		   <tr>  
		   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 100px;text-align: left;
		padding-top: 33px;">Product Code</th>
		<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
		padding-top: 33px;width:100px">Description</th>
				  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
		padding-top: 33px;width:100px">Quantity</th>
				  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
		padding-top: 33px;width:100px"> Unit Price</th>
				  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
		padding-top: 33px;width:100px">VAT</th>
				  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
		padding-top: 33px;width:100px;">Total EX VAT</th>
		   </tr>
		   
		   <tr>  
		   '.$table_data.'
		   </tr>
		   <tr>  
		   
		   <tr>  
		   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
				  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
				  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">Subtotal</td>
				  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$grandsubtotal.'</td>
		   </tr>
		   <tr>     
		   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;
		padding-left: 20px;">TOTAL VAT</td>
				 <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$grandvat, 2, '.', '').'</td>
		   </tr>
		   <tr>  
		   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
				  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL </b></td>
				  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$grandtotal.'</td>
		   </tr>
		   
		</table>
		
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;display:'.$what1.';">
		
		<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
		<tr> 
		   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Delivery Address</b></li>
						   <li>'.$project_Delivery_Address.'</li>
						   <li>'.$project_Delivery_Address.'</li>
						   <li>'.$project_post_code.'</li>
						  
						</ul>
		   </td>
		   
		   <td width="150px" style="padding-left: 50px;" >
						<ul style="list-style:none; padding-left:0px;">
						 
						  
						</ul>
		   </td>
		</tr>
		
		</table>  
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display:'.$what2.';">
		
		<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
		<tr> 
		   <td style="display:'.$iswholeseller.'" width="200px"  style="border-right: 1px solid #d8d4d4;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Collection Address</b></li>
						   <li>'.$suppliers_name.'</li>
						   <li>'.$suppliers_address.'</li>
						   <li>'.$suppliers_city.'</li>
						   <li>'.$suppliers_post_code.'</li>
						   <li>'.$suppliers_email.'</li>
						  
						</ul>
		   </td>
		   
		  
		</tr>
		
		</table>
		<p style="text-align: left;font-size: 12px; padding-top: 27px;">Company Registration No:SC622115. Registered Office:14 Ballumbie Derive,Dundee,Angus,DD4 0NP   </p>
			 </td>
		  </tr>
		  </table>
	  </body>
	</html>';
						 
		     $headers  = "From: noreply@pickmyorder.co.uk\r\n"; 
             $headers .= "Content-type: text/html\r\n";
		 $mail = mail("nikhil.scorpsoft@gmail.com",'You Have An Quotation ',$message,$headers);    
       
  		 if($mail==true) 
		 {
			  if($this->input->post('checkMethod')=='AutoKey')
		         {
					 echo"1";								
				 }									
													
			
		 }
	   }
	   
	   
	   
	  public function SaveSetupChange()
	  {
		  $Process_Emails = $this->input->post('Process_Emails');
		 
		  $Store_Emails = $this->input->post('Store_Emails');
		  $business_id=$this->BusinessIdFunction();
		  
		 if($Store_Emails=='1')
			{
				$Number_of_Day='';
			}else
			{
				$Number_of_Day = $this->input->post('Number_of_Day');
			}
		  
		  $TableName='dev_PmoUserConnectNylas';
          $multiclause=array('Process_Emails'=>$Process_Emails,'Store_Emails'=>$Store_Emails,'Number_of_Day'=>$Number_of_Day);
          $WhereClause=array('business_id'=>$business_id);
         $update= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
         if($update==true)
           {
            echo '1';
           }else{ echo '2';}
		  
	  } 
	  
	  
	  public function CronSetUpForStopAttachmentToSave()
	  {
		  
		   $select3 = 'id,Store_Emails,Number_of_Day,date';
		   $TableName3 = 'dev_PmoUserConnectNylas';
		   $multiClause3 = array('Store_Emails'=>0); 
		   $result_as_array = true;
		   $data = $this->CommonModel->Fetchdata($select3,$TableName3,$multiClause3,$result_as_array);
		   
		   if($data!=false)
		   {
			  foreach($data as $single_data)
			  {
				  $Number_of_Day = $single_data['Number_of_Day'];  
				  $Store_Emails = $single_data['Store_Emails'];  
				  $id = $single_data['id'];
				  $date = $single_data['date'];
				  
				  $date = explode(" ", $date);
				  $date= strtotime($date[0]);
				  $currnet_date = strtotime(date('Y-m-d'));
				
                 
                 $datediff = $currnet_date - $date;
				 $count_days = floor($datediff / (60 * 60 * 24));
				
				 
				 if($Store_Emails=='0')
				   { 
			         if($count_days >= $Number_of_Day)
					 { 
					   $select3 = 'Attachment_name';
					   $TableName3 = 'dev_NylasUsersAttachments ';
					   $multiClause3 = array('NylasUserId'=>$id); 
					   $result_as_array = true;
					   $Attatchment_data = $this->CommonModel->Fetchdata($select3,$TableName3,$multiClause3,$result_as_array); 
					  
					   foreach($Attatchment_data as $Attatchment_single_data)   
					   {    
							$file_Path = FCPATH.'/NylasAttachment/'.$Attatchment_single_data['Attachment_name'].'';
							
							 if(file_exists($file_Path))
							{
								 unlink($file_Path);
								 $keyname=$Attatchment_single_data['Attachment_name'];
		                         $DEleteFileInAws=$this->DeleteAttachmentInAWS($keyname) ;
								
							}
								 
					   }
					  
					 }
					
					   
					  
				   } 
			  }			  
		   }
		  
		  
		  
		  
		 
		  
	  }
	  
	  public function DeleteAttachmentInAWS($keyname)
      {
		  
		  $bucket = 'pmo-s3-json-input-bucket';
			$keyname = $keyname;

			$s3 = new S3Client([
			'version' => 'latest',
			'region'  => 'eu-west-2',
			'credentials' => [
				'key'    => 'AKIAYBHU5TTPYJHCIU7M',
				'secret' => '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'
			]
		]);
		
			// 1. Delete the object from the bucket.
			try
			{
				/* echo 'Attempting to delete ' . $keyname . '...' . PHP_EOL; */

				$result = $s3->deleteObject([
					'Bucket' => $bucket,
					'Key'    => $keyname
				]);
               
				if ($result['DeleteMarker'])
				{
					return $keyname . ' was deleted or does not exist.' . PHP_EOL;
				} else {
					exit('Error: ' . $keyname . ' was not deleted.' . PHP_EOL);
				}
			}
			catch (S3Exception $e) {
				exit('Error: ' . $e->getAwsErrorMessage() . PHP_EOL);
			}

			// 2. Check to see if the object was deleted.
			try
			{
				return 'Checking to see if ' . $keyname . ' still exists...' . PHP_EOL;

				$result = $s3->getObject([
					'Bucket' => $bucket,
					'Key'    => $keyname
				]);

				return 'Error: ' . $keyname . ' still exists.';
			}
			catch (S3Exception $e) {
				exit($e->getAwsErrorMessage());
			}
		  
	  }
	   
}
	   