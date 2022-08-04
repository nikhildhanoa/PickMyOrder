<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class QuotesController extends CI_Controller {
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('QuoteModel');
	
	}
	
	public function Quotes(){
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		
		$this->load->view('quotes.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
	}
		public function View_Single_Quote()
	{
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('single_quote_view.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
	}
	
	public function DeleteQuote(){
		$id=$_GET['id'];
		if(isset($_GET['id'])){
		$result=$this->db->query("delete from dev_quotes where id=$id");
		redirect('quotes');
		}
	}
}
