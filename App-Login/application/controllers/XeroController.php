<?php 
require_once FCPATH. '/vendor/autoload.php';
use XeroAPI\XeroPHP\AccountingObjectSerializer;
class XeroController extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('CommonModel');
	$this->load->library('session');
	
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

  public function  callXero()  
  {
  
  session_start();

  $provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'C7328F849DA24F7EA6D74FF4FDD70DEA',   
    'clientSecret'            => 'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D',
    'redirectUri'             => 'https://app.pickmyorder.co.uk/XeroCallBackFunction',
    'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
    'urlAccessToken'          => 'https://identity.xero.com/connect/token',
    'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
  ]);

  // Scope defines the data your app has permission to access.
  // Learn more about scopes at https://developer.xero.com/documentation/oauth2/scopes
  $options = [
    'scope' => ['openid email profile offline_access accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
  ];

  // This returns the authorizeUrl with necessary parameters applied (e.g. state).
  $authorizationUrl = $provider->getAuthorizationUrl($options);

  // Save the state generated for you and store it to the session.
  // For security, on callback we compare the saved state with the one returned to ensure they match.
  $_SESSION['oauth2state'] = $provider->getState();

  // Redirect the user to the authorization URL.
  header('Location: ' . $authorizationUrl);
  exit();
	
  }


  public function XeroCallBackFunction()
  {
	require_once FCPATH. '/xerostorage/storage.php'; 
  

  $storage = new StorageClass();  

  $provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'C7328F849DA24F7EA6D74FF4FDD70DEA',   
    'clientSecret'            => 'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D',
    'redirectUri'             => 'https://app.pickmyorder.co.uk/XeroCallBackFunction', 
    'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
    'urlAccessToken'          => 'https://identity.xero.com/connect/token',
    'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
  ]);
   
  // If we don't have an authorization code then get one
  if (!isset($_GET['code'])) {
    echo "Something went wrong, no authorization code found";
    exit("Something went wrong, no authorization code found");

  // Check given state against previously stored one to mitigate CSRF attack
  } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    echo "Invalid State";
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
  } else {
  
    try {
		
		
           $this->db->select('*');
		   $this->db->from('dev_Xero_Users');
		   $this->db->where('bussines_id',$this->BusinessIdFunction());
           $query = $this->db->get();
		    $query_data = $query->result_array();
			    
				
          
		if($query->num_rows()==1)
		{
			
			
			   $flag=1;
			
			    $query_data = $query->result_array();
			    
				 $xeroTenantId =   $query_data[0]['TenantId']; 
			    $old =  $query_data[0]['expires_in']; 
			    $new = strtotime(date("Y-m-d h:i:s")); 
			
				 if(($old>$new) && round(abs($old-$new) / 60,2)>3)
				 { 
			          $refresh_token =  $query_data[0]['refresh_token'];
					 $getToken =  $query_data[0]['access_token']; 
					
				 }
				 else
				 {
					 $refresh_token =  $query_data[0]['refresh_token']; 
			$header = 'Authorization: Basic '.base64_encode('C7328F849DA24F7EA6D74FF4FDD70DEA'.":".'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D');
							  $curl = curl_init();
							  curl_setopt_array($curl, array(
							  CURLOPT_URL => 'https://identity.xero.com/connect/token',
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => '',
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => 'POST',
							  CURLOPT_POSTFIELDS => array('grant_type' => 'refresh_token','refresh_token' => $refresh_token),
							  CURLOPT_HTTPHEADER => array($header),
							));

							   $response = curl_exec($curl);

							 curl_close($curl);
							 $response =  json_decode($response);
							
							 $getToken=$response->access_token;
							 $refresh_token=$response->refresh_token;
							   $new = strtotime(date("Y-m-d h:i:s"));
	                           $old=$new+1800;  
							 
							 $TableName='dev_Xero_Users';
							 $multiclause=array('access_token'=>$getToken,'refresh_token'=>$refresh_token,'expires_in'=>$old);
							 $WhereClause=array('bussines_id'=>$this->BusinessIdFunction());
							 $All_TOKENS= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
									 
				 }	 
				 
			  
		}  
        else
		{
			
		$flag=2;	
			
			 // Try to get an access token using the authorization code grant.
      $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);
          

        $insert_array['access_token']=$accessToken->getToken();
		$insert_array['expires_in']=$accessToken->getExpires();
		$insert_array['bussines_id']=$this->BusinessIdFunction();
		$insert_array['refresh_token']=$accessToken->getRefreshToken();
		
		 $Table_name='dev_Xero_Users';
	     $Last_insert_id=true;
		 $Insert_Batch=false;
         $insert_id = $this->CommonModel->InsertRecord($Table_name,$insert_array,$Last_insert_id,$Insert_Batch);
			
			$getToken = $accessToken->getToken();
		}	
      	
      $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( $getToken);
      $identityApi = new XeroAPI\XeroPHP\Api\IdentityApi(
        new GuzzleHttp\Client(),
        $config
      );
      
      $result = $identityApi->getConnections();
	  
	  if($insert_id!=NULL)
	  {  
		  $TableName='dev_Xero_Users';
		  $multiclause=array('TenantId'=>$result[0]->getTenantId());
		  $WhereClause=array('id'=>$insert_id);
		  $All_projects= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);    
	  }
    // 
    
	
	    if($flag=='1')
		{
			  
		$storage->setToken(
        $getToken,$old,
        $xeroTenantId,  
        $refresh_token ,
        $id_token=''
      );	
		}
		else
		{	
         $storage->setToken(
        $accessToken->getToken(),
        $accessToken->getExpires(),
        $result[0]->getTenantId(),  
        $accessToken->getRefreshToken(),
        $accessToken->getValues()["id_token"]
      );
	  
		}
	  
		
		
         header('Location: ' . 'XeroauthorizedResource');
         exit();
     
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      echo "Callback failed";
      exit();
    }
  }

  }
  
  
  
  public function XeroauthorizedResource()
   {
	
			   
	require_once FCPATH. '/xerostorage/storage.php';
	   
  // Storage Classe uses sessions for storing token > extend to your DB of choice
  $storage = new StorageClass();
  $xeroTenantId = (string)$storage->getSession()['tenant_id'];

 
  $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$storage->getSession()['token'] );

   $accountingApi = new XeroAPI\XeroPHP\Api\AccountingApi(
    new GuzzleHttp\Client(),
    $config
  );
  
     //  GET organisations name start
      $apiResponse = $accountingApi->getOrganisations($xeroTenantId);
      $Organisations_name = $apiResponse->getOrganisations()[0]->getName();
	  //  GET organisations name end
    
      
	  //  GET All Acounts start
	      $xeroTenantId = $xeroTenantId;
          $order = "Name ASC";

		try {
		  $result = $accountingApi->getAccounts($xeroTenantId,$order);
		} catch (Exception $e) {
		  echo 'Exception when calling AccountingApi->getAccounts: ', $e->getMessage(), PHP_EOL;
		}

          function accessProtected($obj, $prop) {
			  
		  $reflection = new ReflectionClass($obj);
		  $property = $reflection->getProperty($prop);
		  $property->setAccessible(true);
		  return $property->getValue($obj);

          }
	  
			$container=accessProtected($result, "container");
			$container=$container['accounts'];

		    $Bank_Name = '';
		    foreach($container as $container_single_data)
		    {   
				 $container_single_data = accessProtected($container_single_data, "container");
				 $combo = $container_single_data['account_id'].'/'.$container_single_data['code'];
				 $Bank_Name .= '<option value="'.$combo.'">'.$container_single_data['name'].'</option>';
		   }
     
	  //  GET All Acounts END  
			try {
			$tax_rate = $accountingApi->getTaxRates($xeroTenantId);
			} catch (Exception $e) {
			echo 'Exception when calling AccountingApi->getTaxRates: ', $e->getMessage(), PHP_EOL;
			}
              
		    $container_tax_rate=accessProtected($tax_rate, "container");
            $container_tax_rate=$container_tax_rate['tax_rates'];
			
	       $taxt_rate_Name = '';
		 foreach($container_tax_rate as $container_tax_rate_single_data)
		 {
			
			 
			 //  "container_tax_rate_single_data"  There's more array in it
			 $container_tax_rate_single_data = accessProtected($container_tax_rate_single_data, "container");
			 $taxt_rate_Name .= '<option value='.$container_tax_rate_single_data['tax_type'].'>'.$container_tax_rate_single_data['name'].'</option>';
		 }
		  
	  
	  $pass_array = array('Organisations_name'=>$Organisations_name,'Bank_Name'=>$Bank_Name,'taxt_rate_Name'=>$taxt_rate_Name);
	  
	  $this->load->view('XeroauthorizedResourcepage.php',$pass_array);
	  
	
   }
   
   public function GetItemCode($access_token,$xeroTenantId,$VENTDER_name)
   {
	   $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( $access_token );       

		$apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
		new GuzzleHttp\Client(),
		$config
		);
		$xeroTenantId = $xeroTenantId;
		$order = "Code ASC";
		
		             $this->db->select('xero_cateory');
					 $this->db->from('dev_supplier ');
					 $this->db->where('business_id',$this->BusinessIdFunction());
					 $this->db->like('suppliers_name',$VENTDER_name);
					$queryy= $this->db->get();
				
					if($queryy->num_rows()==1)
					{
					$xero_cateory =$queryy->result_array(); 
					 if($xero_cateory[0]['xero_cateory']!='')
					 {
						 $xero_cateory=$xero_cateory[0]['xero_cateory'];
						 
					 }else
					 {
						$xero_cateory='material';
					 }
					
					
					}else
                    {
						$xero_cateory='material';
					}
		
		
		
		try {
		$result = $apiInstance->getItems($xeroTenantId,$order);
		
		              function accessProtectedItem($obj, $prop) {  
					  $reflection = new ReflectionClass($obj);
					  $property = $reflection->getProperty($prop);
					  $property->setAccessible(true);
					  return $property->getValue($obj);
					   }
					   
			       $get_item = accessProtectedItem($result, "container");
			       $item_id=null;
				   
				 foreach($get_item['items'] as $get_single_item)
				 {		
					  $get_single_item = accessProtectedItem($get_single_item, "container");			 
					 
						  if($get_single_item['name']==$xero_cateory)
						  {
							 $code=$get_single_item['code'];
							 $item_id=$get_single_item['item_id'];   
						  
						  }	  
					  
				 }
		
		    if($item_id!=null)
			{
			  return	$code;
			} else
			{
				
				$item = new XeroAPI\XeroPHP\Models\Accounting\Item;
				$item->setCode('material');
				$item->setName('material');

				$items = new XeroAPI\XeroPHP\Models\Accounting\Items;
				$arr_items = [];
				array_push($arr_items, $item);
				$items->setItems($arr_items);

				try {
				  $result = $apiInstance->createItems($xeroTenantId, $items);
				  
				  $result = accessProtected($result, "container");
				  $result = accessProtected($result['items'][0], "container");			  
				  $item_id = $result['item_id'];
				  $code=$result['code'];
				   return $code;			   
				   
				} catch (Exception $e) {
				  echo 'Exception when calling AccountingApi->createItems: ', $e->getMessage(), PHP_EOL;
				}	
				
			}				
		
		} catch (Exception $e) {
		echo 'Exception when calling AccountingApi->getItems: ', $e->getMessage(), PHP_EOL;
		}  
	   
	   
	   
	   
   }
   
   
   public function createBill()
   {
	    
	
	      $paybill = $this->input->post('pay_bill');
	      $paybill = explode('/',$paybill);
		  
	      $VENTDER_name = $paybill[0];
	      $decription = $paybill[1];
	      $unitamount = $paybill[2];  
		  $Attachment_name = $paybill[3];
		  $Attachment_Id = $paybill[4]; 
		 
	   
	        $BusinessId = $this->BusinessIdFunction();
 
            $select='*';
            $TableName='dev_Xero_Users  ';
            $multiClause=array('bussines_id'=>$BusinessId);
            $result_as_array=true;
            $Xero_data = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
			
			if($Xero_data==false)
			{
				// echo 1 means this bussiness not connect with xero server
				echo '1'; die;
			}
            if($Xero_data[0]['Account_code']==null)
			{
				// echo 3 means xero account can't integrate with pmo 
				 echo '3'; die;
			}				
            $xeroTenantId =   $Xero_data[0]['TenantId']; 
			
			$business_id =  $Xero_data[0]['bussines_id']; 
			 $old =  $Xero_data[0]['expires_in']; 
			 $new = strtotime(date("Y-m-d h:i:s")); 
			
		 if(($old>$new) && round(abs($old-$new) / 60,2)>3)
		 { 
	 
	        /* echo round(abs($old-$new) / 60,2);
			ECHO '<BR>'; */
			 $access_token =  $Xero_data[0]['access_token']; 
			
		 }  else
         {
		
			$refresh_token =  $Xero_data[0]['refresh_token']; 
			
          $header = 'Authorization: Basic '.base64_encode('C7328F849DA24F7EA6D74FF4FDD70DEA'.":".'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D');
			  $curl = curl_init();
			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://identity.xero.com/connect/token',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('grant_type' => 'refresh_token','refresh_token' => $refresh_token),
			  CURLOPT_HTTPHEADER => array($header),
			));

               $response = curl_exec($curl);

             curl_close($curl);
             $response =  json_decode($response);
			
			 $access_token=$response->access_token;
			 $refresh_token=$response->refresh_token;
			 
             $new = strtotime(date("Y-m-d h:i:s"));
	         $old=$new+1800;
	
			 $TableName='dev_Xero_Users';
		     $multiclause=array('access_token'=>$access_token,'refresh_token'=>$refresh_token,'expires_in'=>$old);
		     $WhereClause=array('bussines_id'=>$this->BusinessIdFunction());
		     $All_TOKENS= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
			 
			
	 	 }	 
			// Q $VENTDER_name ='This is 2nd Test 14-6-2022';
			 $item_code = $this->GetItemCode($access_token,$xeroTenantId,$VENTDER_name);
		  
		 
		 
   $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken($access_token);    
  
			$apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
            new GuzzleHttp\Client(),
           $config
          );
			  
			   function accessProtected($obj, $prop) {
						  
					  $reflection = new ReflectionClass($obj);
					  $property = $reflection->getProperty($prop);
					  $property->setAccessible(true);
					  return $property->getValue($obj);
					  
					   }  
			
			 
			             /// Search  contact id start 
        	                   $order = "Name ASC";
		 
					try {
					  $getContactss = $apiInstance->getContacts($xeroTenantId,$order);
                 
					} catch (Exception $e) {
					  echo 'Exception when calling AccountingApi->getContacts: ', $e->getMessage(), PHP_EOL;
					}
                       
					 
					 $this->db->select('xero_vendor');
					 $this->db->from('dev_supplier ');
					 $this->db->where('business_id',$this->BusinessIdFunction());
					 $this->db->like('suppliers_name',$VENTDER_name);
					$queryy= $this->db->get();
				
					if($queryy->num_rows()==1)
					{
					$xero_vendor =$queryy->result_array(); 
					 if($xero_vendor[0]['xero_vendor']!='')
					 {
						 $VENTDER_name=$xero_vendor[0]['xero_vendor'];
						 
					 }else
					 {
						$VENTDER_name;
					 }
					
					
					}else
                    {
						$VENTDER_name;
					}						
					
					 
  
  
                      $getContacts_id = accessProtected($getContactss, "container");
					  
					   $contact_id=null;
					  foreach($getContacts_id['contacts'] as $get_Single_Contacts)
					  {
						  $get_Single_Contacts = accessProtected($get_Single_Contacts, "container");
						  if($get_Single_Contacts['name']==$VENTDER_name)
						  {
							  
						  $contact_id = $get_Single_Contacts['contact_id'];
						 
						  }
						 
						   
					  }
                
				   // check invoice vendor exist in xsro or not 
				       if($contact_id==null)
					   {
						   echo '2';
						   die;
					   }
                     
                     ///  /// Search  contact id  end  			
			 
					$dateValue = new DateTime();
					$dueDateValue = new DateTime('2022-06-08');

					$contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
					$contact->setContactID($contact_id);
                 
					$lineItem = new XeroAPI\XeroPHP\Models\Accounting\LineItem; 
					$lineItem->setDescription($decription);
					$lineItem->setQuantity('1');
					$lineItem->setUnitAmount($unitamount);
					$lineItem->setTaxtype($Xero_data[0]['Tax_Rate']);
					$lineItem->setAccountCode($Xero_data[0]['Account_code']);
                	$lineItem->setItemcode($item_code);	
					$lineItems = [];
					array_push($lineItems, $lineItem);
              
			  
			       ///   CREATE INVOICE START
					$invoice = new XeroAPI\XeroPHP\Models\Accounting\Invoice;
					$invoice->setType(XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCREC);
					$invoice->setContact($contact);
					$invoice->setDate($dateValue);
					$invoice->setDate($dueDateValue);
					$invoice->setLineItems($lineItems);
					$invoice->setReference('Website Design');
					$invoice->setStatus(XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_DRAFT);
                   
					$invoices = new XeroAPI\XeroPHP\Models\Accounting\Invoices;
					$arr_invoices = [];
					array_push($arr_invoices, $invoice);
					$invoices->setInvoices($arr_invoices);
					  ///   CREATE INVOICE end
					  
				
					  ///     CREATE bill START
					 $PayBill = new XeroAPI\XeroPHP\Models\Accounting\Invoice;
					$PayBill->setType(XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCPAY);
					$PayBill->setContact($contact);
					$PayBill->setDate($dateValue);
					$PayBill->setDate($dueDateValue);
					$PayBill->setLineItems($lineItems);  
					$PayBill->setReference('Website Design');
					
					$PayBill->setStatus(XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_DRAFT);
					 
					$PayBills = new XeroAPI\XeroPHP\Models\Accounting\Invoices;
					$arr_paybill = [];
					array_push($arr_paybill, $PayBill);
					$PayBills->setInvoices($arr_paybill);
					   ///   CREATE bill END
					   
	             
					   
					  
					try {
					  $Invoice_Generate = $apiInstance->updateOrCreateInvoices($xeroTenantId, $invoices);
					  $bill_Generate = $apiInstance->updateOrCreateInvoices($xeroTenantId, $PayBills);
					  
					   
					    $bill_Generate = accessProtected($bill_Generate, "container");
					    $bill_Generate2=$bill_Generate['invoices'][0];
					    $bill_Generate2 = accessProtected($bill_Generate2, "container");
			          	$last_bill_id=$bill_Generate2['invoice_id'];
						
						$filename = FCPATH.'NylasAttachment/'.$Attachment_name;
						$handle = fopen($filename, "r");
						$contents = fread($handle, filesize($filename));
						fclose($handle);
						
							
							 $Attchresult = $apiInstance->createInvoiceAttachmentByFileName($xeroTenantId,$last_bill_id,"62833e02ea35f.pdf",$contents);
							 
							 $select='MAX( Invoice_approve ) AS max';
							 $TableName='dev_NylasUsersAttachments ';
							 $multiClause=array('pdftype'=>2);
							 $result_as_array=true;
							 $max_inovice = $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array);
							 $max_inovice = $max_inovice[0]['max'];
							 
							 $max_inovice= $max_inovice+1;
							 
							 
							  $TableName='dev_NylasUsersAttachments';
							 $multiclause=array('Invoice_approve'=>$max_inovice,'Invoice_approve_time'=>date("d/m/Y"));
							 $WhereClause=array('id'=>$Attachment_Id);
							 $All_TOKENS= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
                    
							echo '4';
						
					} catch (Exception $e) {
					  echo 'Exception when calling AccountingApi->updateOrCreateInvoices: ', $e->getMessage(), PHP_EOL;
					}
				   
				   
			   }
			   
			   
			   
			   
	    public function CheckAccountInXero() 
        {
			
		$Account_value	= $this->input->post('Default_Account_payable');
		$Default_Tax_Rate	= $this->input->post('Default_Tax_Rate');
		$Account_value = explode("/",$Account_value);
		
		$Accound_id = $Account_value[0];
		$Accound_Code = $Account_value[1];
		
		$TableName = 'dev_Xero_Users';
		$multiclause = array('Account_id'=>$Accound_id,'Account_code'=>$Accound_Code,'Tax_Rate'=>$Default_Tax_Rate);
		$WhereClause = array('bussines_id'=>$this->BusinessIdFunction());
		$All_TOKENS  = $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
		
		if($All_TOKENS==true)
		{
			echo '1';
		} 	
		
			
		}		
  
  
      Public function ReconnectwithXero()
	  {
		  
		   $this->db->select('*');
		   $this->db->from('dev_Xero_Users');
		   $this->db->where('bussines_id',$this->BusinessIdFunction());
           $query = $this->db->get();
		    $query_data = $query->result_array();
			
				 $xeroTenantId =   $query_data[0]['TenantId']; 
			    $old =  $query_data[0]['expires_in']; 
			    $new = strtotime(date("Y-m-d h:i:s")); 
		  
		  
		  
		  if(($old>$new) && round(abs($old-$new) / 60,2)>3)
		 { 
	 
	        /* echo round(abs($old-$new) / 60,2);
			ECHO '<BR>'; */
			 $access_token =  $query_data[0]['access_token']; 
			
		 }  else
         {
		
			$refresh_token =  $query_data[0]['refresh_token']; 
			
          $header = 'Authorization: Basic '.base64_encode('C7328F849DA24F7EA6D74FF4FDD70DEA'.":".'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D');
			  $curl = curl_init();
			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://identity.xero.com/connect/token',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('grant_type' => 'refresh_token','refresh_token' => $refresh_token),
			  CURLOPT_HTTPHEADER => array($header),
			));

               $response = curl_exec($curl);

             curl_close($curl);
             $response =  json_decode($response);
			
			 $access_token=$response->access_token;
			 $refresh_token=$response->refresh_token;
			 
             $new = strtotime(date("Y-m-d h:i:s"));
	         $old=$new+1800;
	
			 $TableName='dev_Xero_Users';
		     $multiclause=array('access_token'=>$access_token,'refresh_token'=>$refresh_token,'expires_in'=>$old);
		     $WhereClause=array('bussines_id'=>$this->BusinessIdFunction());
		     $All_TOKENS= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
			 
			
	 	 } 
		  
		  
  $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken($access_token);

   $accountingApi = new XeroAPI\XeroPHP\Api\AccountingApi(
    new GuzzleHttp\Client(),
    $config
  );
  
     //  GET organisations name start
      $apiResponse = $accountingApi->getOrganisations($xeroTenantId);
      $Organisations_name = $apiResponse->getOrganisations()[0]->getName();
	  //  GET organisations name end
    
      
	  //  GET All Acounts start
	      $xeroTenantId = $xeroTenantId;
          $order = "Name ASC";

		try {
		  $result = $accountingApi->getAccounts($xeroTenantId,$order);
		} catch (Exception $e) {
		  echo 'Exception when calling AccountingApi->getAccounts: ', $e->getMessage(), PHP_EOL;
		}

          function accessProtected($obj, $prop) {
			  
		  $reflection = new ReflectionClass($obj);
		  $property = $reflection->getProperty($prop);
		  $property->setAccessible(true);
		  return $property->getValue($obj);

          }
	  
			$container=accessProtected($result, "container");
			$container=$container['accounts'];

		    $Bank_Name = '';
		    foreach($container as $container_single_data)
		    {   
				 $container_single_data = accessProtected($container_single_data, "container");
				 $combo = $container_single_data['account_id'].'/'.$container_single_data['code'];
				 $Bank_Name .= '<option value="'.$combo.'">'.$container_single_data['name'].'</option>';
		   }
     
	  //  GET All Acounts END  
			try {
			$tax_rate = $accountingApi->getTaxRates($xeroTenantId);
			} catch (Exception $e) {
			echo 'Exception when calling AccountingApi->getTaxRates: ', $e->getMessage(), PHP_EOL;
			}
              
		    $container_tax_rate=accessProtected($tax_rate, "container");
            $container_tax_rate=$container_tax_rate['tax_rates'];
			
	       $taxt_rate_Name = '';
		 foreach($container_tax_rate as $container_tax_rate_single_data)
		 {
			
			 
			 //  "container_tax_rate_single_data"  There's more array in it
			 $container_tax_rate_single_data = accessProtected($container_tax_rate_single_data, "container");
			 /*  $selected="";
					if($query_data[0]['Tax_Rate'] == $container_tax_rate_single_data['tax_type']){$selected="selected";}
					
					print_r($query_data[0]['Tax_Rate']);
                      die; */					
			 $taxt_rate_Name .= '<option value='.$container_tax_rate_single_data['tax_type'].'  >'.$container_tax_rate_single_data['name'].'</option>';
		 }
		  
	  
	  $pass_array = array('Organisations_name'=>$Organisations_name,'Bank_Name'=>$Bank_Name,'taxt_rate_Name'=>$taxt_rate_Name);
	  
	  $this->load->view('XeroauthorizedResourcepage.php',$pass_array);
	  }
  
  
  } 
  
  

  
