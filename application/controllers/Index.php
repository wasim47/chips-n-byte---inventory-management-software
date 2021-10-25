<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public $cname;
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Checkout_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('common_helper');
		
		$userTable = company_information();
		if($userTable->num_rows() >0 ){
			foreach($userTable->result() as $user);
			$this->cname=$user->company_name;
			$this->cmob=$user->contact;
			$this->cem=$user->email;
			$this->cadd=$user->address;
			$this->clogo=$user->logo;
		}
		else{
			$this->cname='';
			$this->cmob='';
			$this->cem='';
			$this->cadd='';
			$this->clogo='';
		}	
	}
	function index()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title'] = $this->cname;
		$data['bannerslider']	= $this->Index_model->getDataById('banner','status','1','b_id','desc',10);
		$keyword = $this->input->post('keyword');
		$data['getAllProduct']	= $this->Index_model->getDataById('product','','','product_id','asc','');
		$seg= 3;
		$config = array();
		$page = ($this->uri->segment($seg)) ? $this->uri->segment($seg) : 0;
        $config['base_url'] = base_url('index/index/');
		$config['total_rows'] = $data['getAllProduct']->num_rows();
		$config['num_links'] = $data['getAllProduct']->num_rows();
      	$config['per_page'] = 50;
		$config['uri_segment'] =$seg;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['productgallery']	= $this->Index_model->product_gallery($keyword,$config['per_page'],$page);
	
		$data['main_content']="frontend/index";
        $this->load->view('template', $data);
	}
	
	
	 function userLogin()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title'] = "Customer Login : ".$this->cname;
				  $usertype = 'customer';
				 $username = $this->input->post("username");
				  $password = $this->input->post('password');
				 
				  $usr_result = $this->Index_model->get_userLogin($username, $password);
				   
				  if ($usr_result->num_rows() > 0) //active user record is present
				  {
				   $custres = $usr_result->row_array();
					$sessiondata = array(
					  'userAccessMail'=>$username,
					  'userAccessType'=>$usertype,
					  'userAccessName'=> $custres['name'],
					  'userAccessId' => $custres['customer_id'],
					  'userSalseId' => $custres['salse_id'],
					  'password' => TRUE
					 );
				  $this->session->set_userdata($sessiondata);
				  $this->session->set_flashdata('invalidmsg', 
					'<div class="alert alert-success text-center" style="padding:7px; margin-bottom:5px; color:red">Successfully Loggedin</div>');
				    redirect($_SERVER['HTTP_REFERER'], 'refresh');
				 }
				 else
				  {
					$this->session->set_flashdata('invalidmsg', 
					'<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px; color:red">Invalid Email and password!</div>');
					  redirect('index');
				  }
	 	}
		
		
		function logout()
		{
		 $sessiondata = array(
			  'userAccessMail'=>'',
			  'userAccessType'=>'',
			  'userAccessName'=> '',
			  'userAccessId' => '',
			  'userSalseId' => '',
			  'password' => FALSE
			 );
		$this->session->set_userdata($sessiondata);
		//$this->session->sess_destroy();
		redirect('index', 'refresh');
	  }
  	
	
		
	function ordersubmitted()
	 {
		if(!$this->session->userdata('userAccessMail')) redirect('index');
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title'] = "Order Checkout : ".$this->cname;
		$customername=$this->session->userdata('userAccessName');	
		$custId=$this->session->userdata('userAccessId');
		$userSalseId=$this->session->userdata('userSalseId');
		
			//if($this->input->post('confirmorder')){
				
					$order['customer_id']		= $custId;
					$order['salse_id']			= $userSalseId;
					$order['order_number']		= $this->input->post('order_number');
					$order['total_price']		= $this->input->post('total_price');
					$order['paid_amount']		= 0;
					$order['payment_status']	= 'Not Paid';
					$order['status']	= "Pending"; 
					$order['order_time']	= date('Y-m-d H:i:s');
					$order['date']	= date('Y-m-d');
					$orderId = $this->Index_model->inertTable('orders', $order);
					
					/*$sqlp = "SELECT * FROM customers WHERE customer_id = ? ORDER BY customer_id DESC";
					$custpayq = $this->db->query($sqlp,array($custId));
					$rowPay = $custpayq->row_array();
					$prev_balance = $rowPay['prev_balance'];*/	
					//$totaldueamount = $this->input->post('total_price') + $prev_balance;
					
					$customerPayment=array(
						'customer_id'=>$custId,
						'sales_id'=>$userSalseId,
						'order_id'=>$orderId,
						'sale_amount'=>$this->input->post('total_price'),
						'paid_amount'=>'0',
						//'due_amount'=>$totaldueamount,
						'payment_date'=>date('Y-m-d')
						);
				  $this->Index_model->inertTable('customer_payment', $customerPayment);
			
					$productId = $this->input->post('productId');
					$array=explode(',', $productId);
					$count = count($array);
					$check_id = $this->session->userdata('userAccessId');						
					$totalprice=$this->input->post('total_price');
					
					
					for($i=0; $i<=$count; $i++){
						$product_id[] = $this->input->post('product_id'.$i);
						$shipment[] = $this->input->post('shipment'.$i);
						$qty[] = $this->input->post('qty'.$i);
						$unit_price[] = $this->input->post('unit_price'.$i);
						$total_price[] = $this->input->post('sub_total'.$i);
						$date = date('Y-m-d');
					}
					
					//if($product_id!='' && $product_id!=0){
				    	$this->Checkout_model->save($orderId,$productId,$check_id,$product_id,$qty,$unit_price,$total_price,$date);
					//}
						
						/* $frommail="info@evenyoungstar.com";
						 $subject="New Order Request Submitted from ".$customername;
						 $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
						$this->email->initialize($config);
						$this->email->set_newline('\r\n');
						$email_body = $emailmsg;
					
						//$this->email->initialize($config);
						$this->email->from($frommail, 'Eve & Youngstar');
						$this->email->to($tomail);
						//$this->email->bcc();
						$this->email->subject($subject);
						$this->email->message($email_body);
						$this->email->send();
						
					  $tomail1="wasim.html@gmail.com";
					  $frommail1=$this->session->userdata('userAccessMail');
					  $subject1="New Order Request Submitted from ".$customername;
					  $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
							  $this->email->initialize($config);
							  $this->email->set_newline('\r\n');
							  $email_body1 =$emailmsg;
						  
							  //$this->email->initialize($config);
							  $this->email->from($frommail1, $customername);
							  $this->email->to($tomail1);
							  //$this->email->bcc();
							  $this->email->subject($subject1);
							  $this->email->message($email_body1);
							  $this->email->send();*/
							  redirect('index/payment_confirm', 'refresh');
				/*}
				else{
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}*/
	}
	
	function payment_confirm()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title'] = "Payment Confirm : ".$this->cname;
		$data['main_content']="frontend/payment_confirm";
     	$this->load->view('template', $data);
	}
	
	
}

?>
