 <?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductApiControl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
			parent::__construct();
			$this->load->database();
			$this->load->Model('DataModel');

	
	}
	public function Getcategory()
	{
		$this->load->view('api/GetProductCategory');
	}
	public function Getsubcategory()
	{
		$this->load->view('api/GetProductSubCategory');
	}
	public function Getsupersubcategory(){
		$this->load->view('api/GetProductSuperSubCategory');
	}
	public function Getproducts(){
		
		$this->load->view('api/GetProducts');
	}
	public function getproductsinios()   //api root for ios
	{
		$this->load->view('iosapi/GetProducts');
	}
	public function Getproductvariation(){
		$this->load->view('api/ProductVariation');
	}
	public function SendAtradeyaProducts(){
		$this->load->view('AtradeyaApi/GetProducts');
	}
	/****************This function for react tset********************/
	public function GetcategoryinReact()
	{
		$this->load->view('reactapi/GetProductCategory');
	}

}
