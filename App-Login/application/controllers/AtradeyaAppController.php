
<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class AtradeyaAppController extends CI_Controller
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
	public function Delevercost()
	{
	    if($this->input->post('title')!='' && $this->input->post('cost')!='')
        	 {
        	       $bid=$this->input->post('bid');
        	       $title=$this->input->post('title');
        	       $cost=$this->input->post('cost');
        	       $status=$this->db->query("insert into dev_delevery(bussiness,title,cost)value('$bid','$title','$cost')");
        	     redirect('Delevercost');
        	 }
        	 else
        	 {//print_r('dd');die;
					if(isset($_SESSION['status']['user_id']))
					{
						$this->load->view('header.php');
						$this->load->view('sidebar.php');
						$this->load->view('DelevercostPage.php');
						$this->load->view('footer.php');
					}
					else
					{
						$this->load->view('login-v1.php');
					}
        	    
        	 }
	}
    /**********************************UpdateDeleveryCost***************************************/
    public function UpdateDeleveryCost()
    {
         if($this->input->post('title')!='' && $this->input->post('cost')!='' &&  $this->input->post('id')!='')
        	 {
        	   
        	       $title=$this->input->post('title');
        	       $cost=$this->input->post('cost');
        	       $id=$this->input->post('id');
        	       $this->db->query("update dev_delevery SET title='$title' , cost='$cost' where id='$id'");
        	       redirect('Delevercost');
        	 }
        	 else
        	 {
        	    $this->load->view('header.php');
        	    $this->load->view('sidebar.php');
        	    $this->load->view('UpdateDeleveryCost.php');
        	    $this->load->view('footer.php');
        	 }
        	
    }
    /************************delete shipping******************************/
        /**********************************Stores***************************************/
    public function Stores()
    {
            if($this->input->post('submit_store'))
            {
                $store_name=$this->input->post('Store_Name');
                $storeaddress1=$this->input->post('Store_Address_one');
                $storeaddress2=$this->input->post('Store_Address_two');
                $city=$this->input->post('City');
                $postcode=$this->input->post('Post_Code');
                $contact=$this->input->post('Contact_Number');
                $email=$this->input->post('Email');
                $default=$this->input->post('defaultcheck');
                $bid=$this->input->post('bid');
                $status=$this->db->query("insert into dev_stores(bussiness,Store_Name,Store_Address_one,Store_Address_two,City,Post_Code,Contact_Number,Email,defaultcheck)value('$bid','$store_name','$storeaddress1','$storeaddress2','$city','$postcode','$contact','$email','$default')");
        	     redirect('Stores');
                
            }
            else
            {
                if(isset($_SESSION['Current_Business']))
                {
                    $bid=$_SESSION['Current_Business'];
                }
                else
                {
                    $bid=$_SESSION['status']['business_id'];
                }
                
                $dataobj=$this->db->query("select * from dev_stores where bussiness=$bid");
                $dataarray=$dataobj->result_array();
                $resultset['result']=$dataarray;
                $this->load->view('header.php');
                $this->load->view('sidebar.php');
                $this->load->view('OurStores.php',$resultset);
                $this->load->view('footer.php'); 
            }
    }
    /**************************************edit store************************/
    public function EditStore($id)
    { 
        if($this->input->post('edit_store'))
            { 
                $store_name=$this->input->post('Store_Name');
                $storeaddress1=$this->input->post('Store_Address_one');
                $storeaddress2=$this->input->post('Store_Address_two');
                $city=$this->input->post('City');
                $postcode=$this->input->post('Post_Code');
                $contact=$this->input->post('Contact_Number');
                $email=$this->input->post('Email');
                $default=$this->input->post('defaultcheck');
                
                 $status=$this->db->query("update dev_stores set Store_Name='$store_name',Store_Address_one='$storeaddress1',Store_Address_two='$storeaddress2' ,City='$city' ,Post_Code='$postcode',Contact_Number='$contact',Email='$email',defaultcheck='$default' where id='$id'");
        	     redirect('Stores');
                
            }
            else
            {
                
                $dataobj=$this->db->query("select * from dev_stores where id=$id");
                $dataarray=$dataobj->result_array();
                $resultset['EditArray']=$dataarray;
                $this->load->view('header.php');
                $this->load->view('sidebar.php');
                $this->load->view('EditOurStore.php',$resultset);
                $this->load->view('footer.php'); 
            }
    }
    /************************delete store******************************/
    
    public function deletestore($id)
    {
        
        $status=$this->db->query("delete from dev_stores where id='$id'");
        if($status)
        {
              redirect('Stores');
        }
    }
    /************************delete shipping******************************/
    
    public function deleteshipping()
    {
        $id=$_REQUEST['id'];
        $status=$this->db->query("delete from dev_delevery where id='$id'");
        if($status)
        {
              redirect('Delevercost');
        }
    }
	public function GenratePasswordAndSendApi()
	{
		$this->load->view('api/GenrateAtradeyaPassword.php');
	
	}
	public function CreateAtradeyaAppUsers()
	{
	   $this->load->view('api/CreateAtradeyaAppUsers.php');
	}
	public function SendStore()
	{
	    $this->load->view('api/SendStore.php');
	}
	public function SendDeleveryCost()
	{
	    $this->load->view('api/SendDeleveryCost.php');
	}
	public function AtradeyNewGetOrder()
	{
	    $this->load->view('api/AtradeyNewGetOrder.php');
	}
	//fillter
	public function ApplyFilter()
	{ 
	    $this->load->view('api/ApplyFillter.php');
	}
	public function fillter()  
	{
		if(isset($_POST['addfillter']))
		{
			$data=array();
			$catid=$_POST['catid'];
			if($catid)
			{
					$keys=$_POST['key'];
					$values=$_POST['value'];
					for($i=0;$i<count($keys);$i++)
					{
						array_push($data,array($keys[$i]=>$values[$i]));
					}
					$serializeData=serialize($data);
			$this->db->query("update dev_product_cat set filter= '$serializeData' where id=$catid");
			if($this->db->affected_rows())
			{
				$sendmessage=array("message"=>"Add fillter successfully");
			}
			else
			{
				$sendmessage=array("message"=>"Add fillter successfully");
			}

			}
			
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('fillter_view.php',$sendmessage);  
				$this->load->view('footer.php');
			 
		}    
		else
		{
			if(isset($_SESSION['status']['user_id']))
			{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('fillter_view.php');  
			$this->load->view('footer.php');
			}
			else{
				$this->load->view('login-v1.php');
			}
		}
	}
		
	public  function EditFillter()
		{
			if(isset($_POST['Editfillter']))
			{
				$data=array();
				$catid=$_POST['catid'];
				if($catid)
				{  
					$keys=$_POST['key'];
					$values=$_POST['value'];
					for($i=0;$i<count($keys);$i++)
					{
						array_push($data,array($keys[$i]=>$values[$i]));
					}
					$serializeData=serialize($data);
					$this->db->query("update dev_product_cat set filter= '$serializeData' where id=$catid");
					redirect('editfillter?id='.$catid);
                }
			  
			}
			else  
			{ 
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('EditFilter.php');  
				$this->load->view('footer.php'); 
			}
					
		}
		
	
}
