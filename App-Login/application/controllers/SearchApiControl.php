<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchApiControl extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->database();
			$this->load->Model('DataModel');

	}
	public function Search()
	{
		$this->load->view('api/SearchingApi.php');
	}
	

}
