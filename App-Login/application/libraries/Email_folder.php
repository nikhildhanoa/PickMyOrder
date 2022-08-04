<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_folder {
   
    public $CI;
    public function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->library('email');
       $this->CI->load->model('User_model');
       $this->CI->load->helper('url');
        }
/********************* to set the header of email *******************/		
public function set_header(){
	return $header = '<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>EdenMoney</title>
</head>

<body yahoo bgcolor="#ffffff">
<table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0">
<tr>
  <td>
   
    <table bgcolor="#ffffff" style="width: 100%; max-width: 600px;" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td valign="top" style="font-size: 14px; padding-top: 1em; padding-bottom: 0.929em;" align="center">

					
						<img src="'.base_url().'/img/edenlogo.png" width="130px" style="margin-bottom:20px;">
					

				</td>
			</tr>
			<tr>
				<td align="center" valign="top">
						<!-- BEGIN BODY // -->
							<table border="0" cellspacing="0" cellpadding="20" width="100%" style="border: 1px solid #e2e2e2; border-radius: 4px;">
									<tr>
											<td valign="top" style="color: #505050; font-family: Gotham, Helvetica Neue, Helvetica, Arial, "sans-serif"; font-size: 14px; line-height: 150%; text-align: left; padding:20px;">';
}
/********************* to set the footer of email *******************/	
public function set_footer(){
	return $footer = '<br><br>'.$this->CI->lang->line('mailtext_footer1').'<br><br><strong>'.$this->CI->lang->line('mailtext_footer2').'</strong></td></tr></table></td></tr></table></td></tr></table></body></html>';
}
/******************* welcome Controller*******************************/
    
    
    /******************* Email - Sign up*******************************/
    public function order_confirmation($data){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to('rohitkumar.scorpsoft@gmail.com'); 
		$this->CI->email->subject($this->CI->lang->line('mailsubject_signup'));
		$this->CI->email->message('Order Details');
		$this->CI->email->set_mailtype('html');
		 if($this->CI->email->send())
		 {
			return 1;
		 }
		 else
		 {
			return 0;
		 }
    }

    /******************* Email - Password reset*******************************/
    public function reset_email($usermail,$reset_code){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($usermail); 
		$this->CI->email->subject($this->CI->lang->line('mailsubject_password'));
		$this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('mailheading_password').'</h2><br>'.$this->CI->lang->line('mailtext_password1').'<br><br><a href="'.base_url('reset_password').'?reset_code='.$reset_code.'">'.$this->CI->lang->line('mailtext_password2').'</a>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		 if($this->CI->email->send())
		 {
			return 1;
		 }
		 else
		 {
			return 0;
		 }
    }

    /******************* Email - New activity*******************************/
    public function new_activity_mail($email,$city,$country,$_user_agent){

    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('mailsubject_activity'));
		$this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('mailheading_activity').'</h2><br>'.
		$this->CI->lang->line('mailtext_activity1').'<br><br>'.
		$city.', '.$country.'<br><br>'.
		$this->CI->lang->line('Browser').': '.$_user_agent.'<br><br><strong>'.
		$this->CI->lang->line('mailtext_activity2').'</strong>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }

    /************************Admin Controller *****************/
    
    /******************* Email - New bank added *******************************/
    public function new_bank($user_email,$iban_no)
	{
		$from_email = 'admin@edenmoney.eu';
		$this->CI->email->from($from_email, 'EdenMoney');
		$this->CI->email->to($user_email); 
		$this->CI->email->subject($this->CI->lang->line('mailsubject_addbank'));
		$this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('mailheading_addbank').'</h2><br>'.$this->CI->lang->line('mailtext_addbank1').'<br><br><strong>'.$iban_no.'</strong>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		
		if($this->CI->email->send())
		{			
			return 1;			
		}
		else
		{
			return 0;
		}
    }
    
    /******************* Email - Bank reference *******************************/
    public function reference_email($email,$reference_number){

    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('ref_no'));
		$this->CI->email->message($this->set_header().'<br><br><h3>'.$this->CI->lang->line('ref_no_bank').': '.$reference_number.'</h3>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }
    
    /******************* Email - Bank reference *******************************/
    public function withdraw($email,$amount,$currency){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('with_wallet'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('trans_suc').'<br>'.$this->CI->lang->line('with_suc').' '.$amount.' '.$currency.' '.$this->CI->lang->line('frm_you').' '.$currency.' '.$this->CI->lang->line('wallet').'</h3>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }
    
    
    /******************* Email - FX transaction *******************************/
    public function foreign_exchange($email,$transfer_amount,$base_currency,$converted_amount,$quote_currency){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('ForeignExchangeWallet'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('exc_trans').'<br>'.$this->CI->lang->line('exc_have').''.$transfer_amount.' '.$base_currency.' '.$this->CI->lang->line('into').' '.$converted_amount.' '.$quote_currency.' '.$this->CI->lang->line('wallet').'</h3>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }

    public function add_merchant_email($useremail){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($useremail); 
		$this->CI->email->subject($this->CI->lang->line('email_regis'));
		$this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('thank_regis').'</h2><br>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		 if($this->CI->email->send())
		 {
			return 1;
		 } 
		 else
		 {
			return 0;
		 }
    }
	
    public function new_bank_firstdeposit($user_email){
    	$this->CI->email->to('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->from($user_email); 
		$this->CI->email->subject($this->CI->lang->line('add_bank_firstdeposit'));
		$this->CI->email->message($this->set_header().'<h4>'.$this->CI->lang->line('add_frstrequset').'</h4>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }

    /************************ Merchant Controller***************/

    public function refund_email($customer_email,$amount,$refund_currency)
    {
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($customer_email); 
		$this->CI->email->subject($this->CI->lang->line('refund_money'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('trans_suc').'<br><br></h3><h4>'.$this->CI->lang->line('you_refund').' '.$amount.' '.$refund_currency.''.$this->CI->lang->line('you_refund').''.$refund_currency.''.$this->CI->lang->line('wallet').'</h4>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) 
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }

    public function payout_email($email,$wthreturn_url,$money_to_withdraw,$purchase_currency){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('payout_frm'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('PayoutFrom_').$wthreturn_url.'</h3><br><br>'.$this->CI->lang->line('total_amt').' '.$money_to_withdraw.' '.$purchase_currency.''.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return 1;
		} 
		else
		{
			return 0;
		}
    }
    // Change name to : deposit_bank
    public function deposit_email($email,$amount,$currency_of_bank_dep){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('dep_mon'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('trans_suc').'<br>'.$this->CI->lang->line('you_add').''.$amount.' '.$currency_of_bank_dep.''.$this->CI->lang->line('into').''.$currency_of_bank_dep.''.$this->CI->lang->line('wallet').'</h3>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	} 
	
	public function purchase_email($email,$return_url,$money_to_transfer,$purchase_currency){
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject($this->CI->lang->line('thank_pur'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('wallet').''.$return_url.'</h3><br><br>'.$this->CI->lang->line('total_amt').''.$money_to_transfer.' '.$purchase_currency.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) 
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	/********************* upaywise controller *********************/
     // change name to deposit_card
	public function deposit_to_card($useremail,$initial_amount,$currency){
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($useremail); 
		$this->CI->email->subject($this->CI->lang->line('DepositCardWallet'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('trans_suc').' <br> '.$this->CI->lang->line('you_add').' '.$initial_amount.' '.$currency.' '.$this->CI->lang->line('IntoYour').' '.$currency.' '.ucfirst($this->CI->lang->line('wallet')).'</h3>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cardrefer($useremail,$card_number,$reference_number)
	{
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($useremail); 
		$this->CI->email->subject($this->CI->lang->line('NewCardAdded'));
		$this->CI->email->message($this->set_header().'<h3>'.$this->CI->lang->line('cardEnd').' '.$card_number.' '. $this->CI->lang->line('cardEndadd') .'</h3><br>'.$this->CI->lang->line('cardref') .$reference_number.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()){
			return true;
		}
		else
		{
			return false;
		}
	}
	public function kyc_step_two($email,$acc)
	{
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject("KYC Verification for EdenMoney");
		$this->CI->email->message($this->set_header().'<h3>2nd Step for KYC Verification</h3><br>You have completed the first step. To proceed further <a href="http://80.79.117.171:8100?'.base64_encode($acc).'">Click here.</a>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()){
			return true;
		}
		else
		{
			return false;
		}
	}
	public function token_forward($email,$token)
	{
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject("Generated Token");
		$this->CI->email->message($this->set_header().'<h3>Token:'.$token.'</h3><br>You can use this token in your site to integrate your account in EdenMoney.'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/********* Purchase product from merchant ***************/
	
	public function non_crypto_purchase_email($to_email,$amount,$currency,$merchant){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
        $this->CI->email->subject($this->CI->lang->line('mailsubject_purchase'));
        $this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('mailheading_purchase').'</h2><br>'.$this->CI->lang->line('mailtext_purchase1').$amount.$currency.$this->CI->lang->line('mailtext_purchase2').$merchant.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
    public function crypto_purchase_email($to_email,$amount,$currency,$merchant){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
		 $this->CI->email->subject($this->CI->lang->line('mailsubject_purchase'));
        $this->CI->email->message($this->set_header().'<h2>'.$this->CI->lang->line('mailheading_purchase').'</h2><br>'.$this->CI->lang->line('mailtext_purchase1').$amount.$currency.$this->CI->lang->line('mailtext_purchase2').$merchant.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
    
    /********* Funding ***************/

	public function non_crypto_funding_email($to_email,$amount,$currency,$merchant)
	{
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
		$this->CI->email->subject("Funding from EdenMoney");
		$this->CI->email->message($this->set_header()."<h3>You have recieved  $amount $currency from $merchant using EdenMoney Wallet.</h3>".$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
    
    public function btc_funding_email($to_email,$amount,$currency,$merchant){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
		$this->CI->email->subject("Funding from EdenMoney");
		$this->CI->email->message($this->set_header()."<h3>You have recieved  $amount $currency from $merchant using EdenMoney Wallet.</h3>".$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	} 
    
    
    /********* Payout ***************/

	public function non_crypto_payout_email($to_email,$amount,$currency,$merchant){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
		$this->CI->email->subject("Payout to EdenMoney");
		$this->CI->email->message($this->set_header()."<h3>You have recieved  $amount $currency from $merchant using EdenMoney Wallet.</h3>".$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	
	public function payout_merchant_to_customer($to_email,$amount,$currency,$merchant){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($to_email); 
		$this->CI->email->subject("Payout to EdenMoney");
		$this->CI->email->message($this->set_header()."<h3>You have received  $amount $currency from $merchant using EdenMoney Wallet.</h3>".$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	/************* kyc failed *******************/
	public function kyc_failed_to_admin($Username,$dateofkyc,$typeofkyc,$reason,$accountno){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to('admin@edenmoney.eu'); 
		$this->CI->email->subject("Kyc Failed");
		$this->CI->email->message($this->set_header().'<div class="table-summary-wrap">
								<table class="table-summary">
									<tr>
										<td class="tdlabel total"><label class="form-control-label" for="wallet_rec">'.$this->CI->lang->line('acc_num').'</label></td>
										<td class="tdvalue total"><span class="acc_num">'.$accountno.'</span></td>
									</tr>
									<tr>
										<td class="tdlabel"><label class="form-control-label" for="User">'.$this->CI->lang->line('cust_name').'</label></td>
										<td class="tdvalue"><span class="username">'.$Username.'</span></td>
									</tr>
									<tr>
										<td class="tdlabel"><label class="form-control-label" for="fee" id="fee">'.$this->CI->lang->line('dateofkyc').'</label></td>
										<td class="tdvalue"><span class="dateofkyc">'.$dateofkyc.'</span></td>
									</tr>
									<tr>
										<td class="tdlabel"><label class="form-control-label" for="User">'.$this->CI->lang->line('reason').'</label></td>
										<td class="tdvalue"><span class="reason">'.$reason.'</span></td>
									</tr>
								</table>
							</div>'.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	/************* kyc failed *******************/
	
	public function kyc_failed_to_customer($customer_name,$toemail,$type){
    	$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($toemail); 
		$this->CI->email->subject("There is a problem with your verification.");
		$this->CI->email->message($this->set_header()."<h3>".$customer_name." There is an issue with your ".$type."</h3><br><br><p>Please contact support@edenmoney.eu </p>".$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	/*************** bank_deposit_data **************************/
	public function bank_deposit_request($email,$amount,$fee,$final_amt,$currency)
	{
		$this->CI->email->from('admin@edenmoney.eu', 'EdenMoney');
		$this->CI->email->to($email); 
		$this->CI->email->subject("Deposit from Bank to wallet");
		$this->CI->email->message($this->set_header().'<div class="table-summary-wrap">
								<table class="table-summary">
									<tr>
										<td class="tdlabel"><label class="form-control-label" for="dep_amt1">'.$this->CI->lang->line('dep_amt1').'</label></td>
										<td class="tdvalue"><span class="Amount">'.$amount.'</span>.00'.$currency.'</td>
									</tr>
									<tr>
										<td class="tdlabel"><label class="form-control-label" for="fee" id="fee">'.$this->CI->lang->line('fee').'</label></td>
										<td class="tdvalue"><span class="fee_get">'.$fee.'</span>'.$currency.'</td>
									</tr>
									<tr>
										<td class="tdlabel total"><label class="form-control-label" for="wallet_rec">'.$this->CI->lang->line('wallet_rec').'</label></td>
										<td class="tdvalue total"><span class="wallet_rec_bank">'.$final_amt.'</span>'.$currency.'</td>
									</tr>
								</table>
							</div>.'.$this->set_footer());
			$this->CI->email->set_mailtype('html');
			if($this->CI->email->send()){
				return true;
			}
			else
			{
				return false;
			}
	}
	
	
	/************* compose message email ****************/
	
	public function compose_message_email($subject,$message,$from_email = '', $toemail = '')
	{
		$from_email = $from_email !='' ?  $from_email : 'admin@edenmoney.eu';
		$toemail 	= $toemail !='' ?  $toemail : 'admin@edenmoney.eu';
		
    	$this->CI->email->from($from_email, 'EdenMoney');
		$this->CI->email->to($toemail); 
		$this->CI->email->subject($subject);
		$this->CI->email->message($this->set_header().$message.$this->set_footer());
		$this->CI->email->set_mailtype('html');
		if($this->CI->email->send()) 
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
?>