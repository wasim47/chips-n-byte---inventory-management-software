<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $cname;
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Stock_model');
		$this->load->model('Pre_stock_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->helper('security');
		$this->load->helper('common_helper');
		$this->load->library('excel');//load PHPExcel library 
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		
		
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
	
/*	public function commonInfo(){
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		return $data['cname'];
	}
*/	


public function upload_product()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;	
		$data['title']="Admin Registration | Pharmacy Management System";
		$data['main_content']="admin/product/upload_product";
		$this->load->view('admin_template', $data);
	}
	
	
	
	public	function ExcelDataAdd()	{  
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;	
		$data['title']="Product Import | Pharmacy Management System";
			
			 //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
			 $configUpload['upload_path'] = FCPATH.'uploads/excel/';
			 $configUpload['allowed_types'] = 'xls|xlsx|csv';
			 $configUpload['max_size'] = '5000';
			 $this->load->library('upload', $configUpload);
			 $this->upload->do_upload('userfile');	
			 $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			 $file_name = $upload_data['file_name']; //uploded file name
			 $extension=$upload_data['file_ext'];    // uploded file extension
			
			//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
			 $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
			  //Set to read only
			  $objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $proName		= 	$objWorksheet->getCellByColumnAndRow(0,$i)->getValue(); //Excel Column 0	
				  $strength		= 	$objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
				  $qty	= 	$objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
				  $price		= 	$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
				  $saleprice		= 	$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
				  $manufecturer		= 	$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
				  //$expd			=	$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
				  $productcode = $this->Index_model->productcode();
				  
				  $data_user=array(
						  'product_name'=>$proName, 
						  'pro_code'=>$productcode,
						  'strength'=>$strength,
						  'manufecturer'=>$manufecturer,
						  'qty'=>$qty,
						  'price'=>$price ,
						  'sale_price'=>$saleprice,
						  'status'=>1
					  );
				  $insertpro = $this->Index_model->Add_User($data_user);
				  
				  if($insertpro){
				  	 $sql = "SELECT s_id FROM stock WHERE product_id = '".$insertpro."'";
					$queryCheck = $this->db->query($sql);
					  $stockData = array(
							'stock_id'=>1,
							'product_id'=>$insertpro,
							'init_qty'=>$qty,
							'unit_price'=>$price,
							'init_date'=>date('Y-m-d'),
							'date'=>date('Y-m-d')
						);
								
						if($queryCheck->num_rows() >0 ){
							$rowval = $queryCheck->row_array();
							$this->Index_model->update_table('stock','s_id',$rowval['s_id'],$stockData);
						}
						else{
							$this->Index_model->inertTable('stock', $stockData);
						}
						
						$temp = $productcode;
						$file = Zend_Barcode::draw('code128', 'image', array('text' => $temp), array());
						$code = time().$temp;
						$store_image = imagepng($file,"D:/xampp/htdocs/wasim/pharmacy/asset/barcode/{$code}.png");
				
				   }
			  }
			// unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
			 //redirect(base_url() . "put link were you want to redirect");
			 $this->session->set_flashdata('globalMsg', '<div class="alert alert-danger">Successfully Uploaded </div>');
			 redirect($_SERVER['HTTP_REFERER'],'refresh');
		
     }
	 
function index()
	{
		if($this->session->userdata('AdminAccessMail')) redirect("admin/dashboard");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
        $this->load->view('admin/index',$data);
	}

/////////////////////// Admin Part ////////////////////////////////	 
	
	
	function dashboard()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['title']="Dashboard | inventory";
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		
		$data['main_content']="admin/dashboard";		
        $this->load->view('admin_template',$data);
	}
	
	
	
	
	
	function admin_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Article List CMSN Networks | inventory";
		
		if($this->session->userdata('AdminType')=="Precident"){
			$data['admin_list'] = $this->Index_model->getTable('users','id','desc');
		}
		elseif($this->session->userdata('AdminType')=="CEO"){
			$data['admin_list'] = $this->Index_model->getCountryManager();
		}
		elseif($this->session->userdata('AdminType')=="Country Manager"){
			$data['admin_list'] = $this->Index_model->getEmployee();
		}
		
		$data['main_content']="admin/administration/admin_list";
        $this->load->view('admin_template',$data);
	} 
	
	function admin_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Admin Registration | CMSN Networks";
		$userId=$this->uri->segment(3);
		$data['adminUpdate'] = $this->Index_model->getAllItemTable('users','id',$userId,'','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($userId!=''){
				$original_value = $this->db->query("SELECT email FROM users WHERE id = ".$userId)->row()->email;
				if($this->input->post('email') != $original_value) {
				   $is_unique =  '|is_unique[users.email]';
				} else {
				   $is_unique =  '';
				}
		}
		else{
			$is_unique =  '|is_unique[users.email]';	
		}
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required'.$is_unique);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			
			if($this->form_validation->run() != false){
				if($this->input->post('userAccess')!=""){
				$userAccess = $this->input->post('userAccess');
					//print_r($userAccess);
				$impaccess=implode(',',$userAccess);
				}
				else{
				 $impaccess='';
				}
						
				$save['username']	    = $this->input->post('username');
				$save['contactno']	    = $this->input->post('contactno');
				$save['admin_type']	    = $this->input->post('admintype');
				$save['admin_access']	= $impaccess;
				$save['email']	    	= $this->input->post('email');
				$save['password']	    = sha1($this->input->post('password'));
				$save['pass_hints']	    = $this->input->post('password');
				$save['created_on']	    = date('Y-m-d');
				$save['active']	    	= 1;
				
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('users','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('users', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/admin_list', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/administration/admin_registration";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/administration/admin_registration";
        $this->load->view('admin_template', $data);
	}
	
	function configuration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Admin Registration | CMSN Networks";
		$userId=$this->uri->segment(3);
		$data['configurationUpdate'] = $this->Index_model->getAllItemTable('company_info','','','','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required');
			
			if($this->form_validation->run() != false){
				$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
				$config['remove_spaces'] = true;
				$config['upload_path'] = './uploads/images/company/';
				$config['charset'] = "UTF-8";
				$new_name = "cmsn_".time();
				$config['file_name'] = $new_name;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if (isset($_FILES['logo']['name']))
				{
				if($this->upload->do_upload('logo')){
						$upload_data	= $this->upload->data();
						$save['logo']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('mainImg');
						$save['logo']	= $upload_data;	
					}
				}	
						
				$save['company_name']	= $this->input->post('username');
				$save['contact']	    = $this->input->post('contactno');
				$save['email']	    	= $this->input->post('email');
				$save['address']	    = $this->input->post('address');
				$save['create_on']	    = date('Y-m-d');
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('company_info','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('company_info', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/configuration', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/configuration/admin_registration";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/configuration/admin_registration";
        $this->load->view('admin_template', $data);
	}
	
	
	
	public function userLogin()
     {
         $username = $this->input->post("username");
  		 $password = $this->input->post("password");
         $this->form_validation->set_rules("username", "Email", "trim|required|min_length[6]|valid_email");
         $this->form_validation->set_rules("password", "Password", "trim|required");

		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
          if ($this->form_validation->run() == FALSE)
          {
              redirect('admin');
          }
          else
          {
                   $usr_result = $this->Index_model->get_AdminLogin($username, $password);
				   //print_r($usr_result);
                     if ($usr_result->num_rows() > 0) //active user record is present
                    {
					 $rowval = $usr_result->row_array();
					  $sessiondata = array(
						'AdminAccessMail'=>$username,
						'AdminAccessName'=> $rowval['username'],
						'AdminType'=> $rowval['admin_type'],
						'AdminAccessPermission'=> $rowval['admin_access'],
						'AdminAccessId' => $rowval['id'],
						'password' => TRUE
					   );
						$this->session->set_userdata($sessiondata);
						redirect("admin/dashboard/");
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('admin');
                    }
          }
     }
	 
    function logout()
  	{
	  $sessiondata = array(
				'AdminAccessMail'=>'',
				'AdminAccessName'=> '',
				'AdminType'=> '',
				'AdminAccessPermission'=> '',
				'AdminAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('admin', 'refresh');
  }
  	
	
	
	
	function stock_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Article List CMSN Networks | inventory";
		$data['stock_list'] = $this->Index_model->getTable('stock_manage','id','desc');
		
		$data['main_content']="admin/stock/stock_list";
        $this->load->view('admin_template',$data);
	} 
	
	function stock_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Admin Registration | CMSN Networks";
		$userId=$this->uri->segment(3);
		$data['adminUpdate'] = $this->Index_model->getAllItemTable('stock_manage','id',$userId,'','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('stock_name', 'User Name', 'trim|required');
			if($this->form_validation->run() != false){			
				$save['stock_name']=$this->input->post('stock_name');
				$save['stock_incharge']=$this->input->post('stock_incharge');
				$save['address']=$this->input->post('address');
				$save['mobile']=$this->input->post('mobile');
				$save['email']=$this->input->post('email');
				
				
				if($this->input->post('id')!=""){
					$user_id=$this->input->post('id');
					$this->Index_model->update_table('stock_manage','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('stock_manage', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/stock_list', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/stock/stock_registration";
        		$this->load->view('admin_template', $data);
			}
		}
		else{
			$data['main_content']="admin/stock/stock_registration";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	
	////////////// Customer Part/////////////////////////////////////////////////////////
	function customer_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="customer List | CMSN Networks";
		$details=$this->uri->segment(3);
		$data['customer_list'] = $this->Index_model->getTable('customers','customer_id','desc');
		if($details!=''){
			$mid=$this->uri->segment(4);
			$data['customerDetails'] = $this->Index_model->getAllItemTable('customers','customer_id',$mid,'','','customer_id','desc');
			$data['main_content']="admin/customer/customerDetails";
		}
		else{
			$data['main_content']="admin/customer/customer_list";
		}
		$this->load->view('admin_template',$data);
	} 
	
	function customer_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$mid=$this->uri->segment(3);
		$data['salse_represntative']= $this->Index_model->getDataById('sales_represntative','','','username','asc','');
		$data['customerUpdate'] = $this->Index_model->getAllItemTable('customers','customer_id',$mid,'','','customer_id','desc');
		$expensecode = $this->Index_model->getAllItemTable('customers','','','','','cid','desc');
		$rowExp = $expensecode->row_array();
		$data['lastCode'] = $rowExp['cid']+1;
		
		//print_r($data['customerUpdate']);
		$data['title']="Customer Registration | CMSN Networks";
		
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($mid){
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
				$this->form_validation->set_rules('code', 'Code', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[customers.email]');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[customers.mobile]');
				$this->form_validation->set_rules('code', 'Code', 'trim|required|is_unique[customers.cid]');
			}
			
			$this->form_validation->set_rules('customerName', 'customer Name', 'trim|required');
			//$this->form_validation->set_rules('password', 'Password', 'trim|required');
			//$this->form_validation->set_rules('salse_id', 'salse_id', 'trim|required');
			
			if($this->form_validation->run() != false){
				//$digits = 4;
				//$cuniqid = rand(pow(10, $digits-1), pow(10, $digits)-1);
				//$save['cid']	        = $cuniqid;
				$save['cid']	      = $this->input->post('code');
				$save['name']	        = $this->input->post('customerName');
				$save['salse_id']	    = $this->input->post('salse_id');
				$save['mobile']	    	= $this->input->post('mobile');
				$save['address']	    = $this->input->post('address');
				$save['email']	    	= $this->input->post('email');
				$save['prev_balance']	= $this->input->post('prev_balance');
				$save['password']	    = md5($this->input->post('password'));
				$save['passwordHints']	= $this->input->post('password');
				$save['created_at']	= date('Y-m-d H:i:s');
				$save['updated_at']	= date('Y-m-d H:i:s');
				$save['status']	= 0;
				
				
				if($this->input->post('customer_id')!=""){
					$customer_id=$this->input->post('customer_id');
					$this->Index_model->update_table('customers','customer_id',$customer_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('customers', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				
				redirect('admin/customer_list', 'refresh');
			}
		}
		$data['main_content']="admin/customer/customer_action";
        $this->load->view('admin_template', $data);
	}
	
	


/////////////////////// brand ////////////////////////////////	 
	function brand_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		
		$data['brand_list'] = $this->Index_model->getTable('brand','cid','desc');
		$data['main_content']="admin/brand/brand_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function brand_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		$artiId=$this->uri->segment(3);
		$data['brandUpdate'] = $this->Index_model->getAllItemTable('brand','cid',$artiId,'','','cid','desc');
		
		$this->form_validation->set_rules('brand_name', 'brand name', 'trim|required');
		//$this->form_validation->set_rules('class_id', 'Class', 'trim|required');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/brand/';
				$config['charset'] = "UTF-8";
				$new_name = "brand_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
					
								
				$expval=explode(' ',$this->input->post('brand_name'));
				$impval=implode('-',$expval);
				$save['class_id']	    = $this->input->post('class_id');
				$save['cat_name']	    = addslashes($this->input->post('brand_name'));
				$save['brand_title']	    = addslashes(strtolower($impval));
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('cid')!=""){
					$cid=$this->input->post('cid');
					$this->Index_model->update_table('brand','cid',$cid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('brand', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/brand_list', 'refresh');
			}
			else{
				$data['main_content']="admin/brand/brand_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/brand/brand_action";
			$this->load->view('admin_template', $data);
		}
	}
	

/////////////////////// Category ////////////////////////////////	 
	function category_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['main_content']="admin/product_category/category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function category_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		$artiId=$this->uri->segment(3);
		$data['categoryUpdate'] = $this->Index_model->getAllItemTable('category','cid',$artiId,'','','cid','desc');
		
		$this->form_validation->set_rules('category_name', 'category name', 'trim|required');
		//$this->form_validation->set_rules('class_id', 'Class', 'trim|required');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/category/';
				$config['charset'] = "UTF-8";
				$new_name = "category_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
					
				$config1['allowed_types'] = '*';
				$config1['remove_spaces'] = true;
				$config1['max_size'] = '1000000';
				$config1['upload_path'] = './uploads/images/product_category/category/banner/';
				$config1['charset'] = "UTF-8";
				$new_nameb = "Banner_".time();
				$config1['file_name'] = $new_nameb;
				$this->load->library('upload', $config1);
				$this->upload->initialize($config1);
					if (isset($_FILES['banImage']['name']))
					{
						if($this->upload->do_upload('banImage')){
							$upload_data	= $this->upload->data();
							$save['banImage']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimageB');
							$save['banImage']	= $upload_data;	
						}
					}	
				
				$expval=explode(' ',$this->input->post('category_name'));
				$impval=implode('-',$expval);
				$save['class_id']	    = $this->input->post('class_id');
				$save['cat_name']	    = addslashes($this->input->post('category_name'));
				$save['caegory_title']	    = addslashes(strtolower($impval));
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('cid')!=""){
					$cid=$this->input->post('cid');
					$this->Index_model->update_table('category','cid',$cid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product_category/category_action";
			$this->load->view('admin_template', $data);
		}
	}
	


/////////////////////// sub_category ////////////////////////////////	 
	function sub_category_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		
		$data['title']="sub_category List | softXmagic";
		$data['sub_category_list'] = $this->Index_model->getTable('sub_category','scid','desc');
		$data['main_content']="admin/product_category/sub_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function sub_category_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		$artiId=$this->uri->segment(3);
		$cate=$this->input->post('category');

		$data['sub_categoryUpdate'] = $this->Index_model->getAllItemTable('sub_category','scid',$artiId,'','','scid','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		if(!$artiId){
			$data['title']="sub_category Registration | softXmagic";
			//$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required|is_unique[sub_category.sub_cat_name]');
			$this->form_validation->set_rules('sub_category_name', 'Sub Category name', 'callback_subcategory_check['.$cate.']');
		}
		else{
			$data['title']="sub_category Update | softXmagic";
			$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/sub_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				
				$expval=explode(' ',$this->input->post('sub_category_name'));
				$impval=implode('-',$expval);
				$save['cat_id']	    = $cate;
				$save['sub_cat_name']	    = addslashes($this->input->post('sub_category_name'));
				$save['sub_cat_title']	    = addslashes(strtolower($impval));
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('scid')!=""){
					$scid=$this->input->post('scid');
					$this->Index_model->update_table('sub_category','scid',$scid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('sub_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/sub_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/sub_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/sub_category_action";
        $this->load->view('admin_template', $data);
	}

	public function subcategory_check($str,$catid)
	{
		$value = $this->Index_model->subcategory_exist($str,$catid);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('subcategory_check', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	/////////////////////// last_category ////////////////////////////////	 
	function last_category_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		
		$data['title']="last_category List | Butikbd";
		$data['last_category_list'] = $this->Index_model->getTable('last_category','id','desc');
		$data['main_content']="admin/product_category/last_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function last_category_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']=$this->cname." | Inventory Management System";
		
		$artiId=$this->uri->segment(3);
		$cate=$this->input->post('cat_id');
		$scate=$this->input->post('subcat_id');
		$data['last_categoryUpdate'] = $this->Index_model->getAllItemTable('last_category','id',$artiId,'','','id','desc');
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if(!$artiId){
			$data['title']="last_category Registration | Butikbd";
			//$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required|is_unique[last_category.lastcat_name]');
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		else{
			$data['title']="last_category Update | Butikbd";
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/last_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				$save['cat_id']	    = $cate;
				$save['subcat_id']	    = $scate;
				$expval=explode(' ',$this->input->post('last_category_name'));
				$impval=implode('-',$expval);
				$save['lastcat_name']	    = addslashes($this->input->post('last_category_name'));
				$save['last_cat_title']	    = addslashes($impval);
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('last_category','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('last_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/last_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/last_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/last_category_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	
	function ajaxCatData()
	{
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$url="'".base_url()."admin/ajaxData?sroot_id='+this.value+''";
			$sroot_category = $this->Index_model->getAllItemTable('category','root_id',$rid,'','','category_name','asc');
			$svar='<select name="sroot_id" class="form-control" style="width:60%;" onChange="getSubcategory('.$url.')">
								<option value="">Sub category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('sroot_id')!=""){
			$rid=$this->input->get('sroot_id');
			$sroot_category = $this->Index_model->getAllItemTable('category','sroot_id',$rid,'','','category_name','asc');
			$svar='<select name="lroot_id" class="form-control" style="width:60%;">
								<option value="">Last category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}




	
///////////////////////////////////// ====^^^^^=====!!!!!!!======================///////////////////////////////////
	function product_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Product List | CMSN Networks";
		$data['product_list'] = $this->Index_model->getInstockProduct();
		$data['main_content']="admin/product/product_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function product_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Product Insert | CMSN Networks";
		}
		else{
			$data['title']="Product Update | CMSN Networks";
		}
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		$data['allbrand']		= $this->Index_model->getDataById('brand','','','cat_name','asc','');
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		$data['productUpdate'] = $this->Index_model->getAllItemTable('product','product_id',$artiId,'','','product_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
		if($artiId!=""){
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rules('pro_name', 'Product Name', 'trim|required');
		}
		else{
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required|is_unique[product.pro_code]');
			$this->form_validation->set_rules('pro_name', 'Product Name', 'trim|required|is_unique[product.product_name]');
		}
		
		/*$this->form_validation->set_rules('full_description', 'Product Details', 'trim|required');
		if (empty($_FILES['main_images']['name']))
		{
			$this->form_validation->set_rules('main_images', 'Product Image', 'required');
		}*/
		
		if ($this->form_validation->run() != FALSE){
			ini_set( 'memory_limit', '200M' );
			ini_set('max_input_time', 3600);  
			ini_set('max_execution_time', 3600);

			$config['allowed_types'] = 'jpg|png|jpeg|gif|bmp';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/product/main_img/';
			$config['charset'] = "UTF-8";
			$new_name = "CMSN Networks_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['main_images']['name']))
			{
			if($this->upload->do_upload('main_images')){
					$upload_data	= $this->upload->data();
					$save['main_image']	= $upload_data['file_name'];
					$this->_CreatePageThumbnail($upload_data['file_name'], $config['upload_path'],150,200);			
					$save['thumb'] = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
				}
				else{
					$upload_data	= $this->input->post('mainImg');
					$save['thumb']=$this->input->post('thumbImg');
					$save['main_image']	= $upload_data;	
				}
			}	
			
			$config2['allowed_types'] = '*';
			$config2['remove_spaces'] = true;
			$config2['max_size'] = '1000000';
			$config2['upload_path'] = './uploads/images/product/photo1/';
			$config2['charset'] = "UTF-8";
			$new_name2 = "CMSN Networks_".time();
			$config2['file_name'] = $new_name2;
			$this->load->library('upload', $config2);
			$this->upload->initialize($config2);
			
			if (isset($_FILES['photo1']['name']))
			{
			if($this->upload->do_upload('photo1')){
					$upload_data	= $this->upload->data();
					$save['photo1']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo1');
					$save['photo1']	= $upload_data;	
				}
			}
			
			$config3['allowed_types'] = '*';
			$config3['remove_spaces'] = true;
			$config3['max_size'] = '1000000';
			$config3['upload_path'] = './uploads/images/product/photo2/';
			$config3['charset'] = "UTF-8";
			$new_name3 = "CMSN Networks_".time();
			$config3['file_name'] = $new_name3;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			
			if (isset($_FILES['photo2']['name']))
			{
			if($this->upload->do_upload('photo2')){
					$upload_data	= $this->upload->data();
					$save['photo2']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo2');
					$save['photo2']	= $upload_data;	
				}
			}
			
			
			$config4['allowed_types'] = '*';
			$config3['remove_spaces'] = true;
			$config3['max_size'] = '1000000';
			$config3['upload_path'] = './uploads/images/product/photo3/';
			$config3['charset'] = "UTF-8";
			$new_name3 = "CMSN Networks_".time();
			$config3['file_name'] = $new_name3;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			
			if (isset($_FILES['photo2']['name']))
			{
			if($this->upload->do_upload('photo2')){
					$upload_data	= $this->upload->data();
					$save['photo3']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo2');
					$save['photo3']	= $upload_data;	
				}
			}	
			
		  		$productCode = $this->input->post('pro_code');
				$save['product_name']	    = addslashes($this->input->post('pro_name'));
				$proTitle = explode(' ',$this->input->post('pro_name'));
				$proUrl = implode("-",$proTitle);
				$save['slug']		= str_replace('/', '', strtolower($proUrl));
				$save['pro_code']		= $productCode;
				$save['details']	    = addslashes($this->input->post('full_description'));
				
				$save['commission']		= $this->input->post('commission');
				$save['vat']		= $this->input->post('vat');
				$save['seo_title']		= $this->input->post('seo_title');
				$save['keyword']	    = $this->input->post('keyword');
				$save['seo_details']	= $this->input->post('meta_details');
				$save['status']		=    $this->input->post('status');
				$save['supplier']		=    $this->input->post('supplier');
				$save['price']		=    $this->input->post('pro_price');
				$save['qty']		=    $this->input->post('quantity');
				$save['color']		=    $this->input->post('color');
				$save['size']		=    $this->input->post('size');
				$save['cat_id']		=    $this->input->post('cat_id');
				$save['scat_id']		=    $this->input->post('subcat_id');
				$save['brand']		=    $this->input->post('brand');
				
				$defstock = $this->Index_model->getOneItemTable('stock_manage','default_stock',1,'id','desc');				
				if($this->input->post('product_id')!=""){
					$b_id=$this->input->post('product_id');					
					$query = $this->Index_model->update_table('product','product_id',$b_id,$save);		
					
					$stockData = array(
						'stock_id'=>$defstock['id'],
						'product_id'=>$b_id,
						'init_qty'=>$this->input->post('quantity'),
						'unit_price'=>$this->input->post('pro_price'),
						'init_date'=>date('Y-m-d'),
						'date'=>date('Y-m-d')
					);
					$sql = "SELECT s_id FROM stock WHERE product_id = '".$b_id."' AND init_qty != ''";
					$queryCheck = $this->db->query($sql);
					if($queryCheck->num_rows() >0 ){
						$rowval = $queryCheck->row_array();
						$this->Index_model->update_table('stock','s_id',$rowval['s_id'],$stockData);
					}
					else{
						$stockData = array(
							'stock_id'=>$defstock['id'],
							'product_id'=>$b_id,
							'init_qty'=>$this->input->post('quantity'),
							'unit_price'=>$this->input->post('pro_price'),
							'init_date'=>date('Y-m-d'),
							'date'=>date('Y-m-d')
						);
						$this->Index_model->inertTable('stock', $stockData);
					}					
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Updated</h2>');
					redirect('admin/product_list', 'refresh');
				}
				else{
					$serialno = $this->input->post('serial_no');
					//print_r($serialno);
					foreach($serialno as $k=>$val){
						$save['serialno']	=    $serialno[$k];
						$query = $this->Index_model->inertTable('product', $save);
						$stockData = array(
							'stock_id'=>$defstock['id'],
							'product_id'=>$query,
							'init_qty'=>$this->input->post('quantity'),
							'unit_price'=>$this->input->post('pro_price'),
							'init_date'=>date('Y-m-d')
						);
						$this->Index_model->inertTable('stock', $stockData);
					}
				}
				
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Inserted</h2>');
				redirect('admin/product_list', 'refresh');
								
			}
			else{
				$data['main_content']="admin/product/product_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product/product_action";
			$this->load->view('admin_template', $data);
		}
	}
	

///////////  Stock, Acocunt and Orders///////////////////////

	function order_list()
	 {
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="CMSN Networks | Customer Order List";
		 $keywords = $this->input->post('keywords');
			$customerinfo= $this->Index_model->getDataById('customers','cid',$keywords,'customer_id','desc','1');
			if($customerinfo->num_rows() > 0){
				$custrow = $customerinfo->row_array();
				$custoid = $custrow['customer_id'];
			}
			else{
				$custoid ='';
			}
		//echo $custoid;
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/order_list');
		$config['total_rows'] = $this->Index_model->totalOrder();
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['orderinfo'] = $this->Index_model->orderWithSearch($keywords,$custoid,$config['per_page'],$page);
		
		$data['main_content']="admin/order/order_list";
	    $this->load->view('admin_template', $data);
	}
	
	function completed_order()
	 {
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/order_list');
		$config['total_rows'] = $this->Index_model->totalOrder();
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;		
		$data['orderinfo'] = $this->Index_model->completedOrder($config['per_page'],$page);
				
		$data['title']="CMSN Networks | Completed Order List";
		$data['main_content']="admin/order/order_list";
	    $this->load->view('admin_template', $data);
	}
	
	function view_order($order_id)
	 {
		 //if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		 	$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
			foreach($data['order_q']->result() as $rowq);
			$status=$rowq->status;
	 	    $customer_id=$rowq->customer_id;
			
			$data['customerQ']= $this->Index_model->getDataById('customers','customer_id',$customer_id,'customer_id','desc','1');
			
			
			$data['customer_id']=$customer_id;
			$data['order_id']=$order_id;
			$data['orderstatus']=$status;
			$data['title']="CMSN Networks | Customer Order Details";
			$data['main_content']="admin/order/view_order";
			$this->load->view('admin_template', $data);
	}
	
	
	
	function update_quantity()
	{
		$oid = $this->input->post('opid');
		$product_id = $this->input->post('product_id');
		$cqty = $this->input->post('cqty');
		$cprice = $this->input->post('cprice');
		
		$orderid = $this->input->post('oid');
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			
			$sqlu = "SELECT * FROM orders_products WHERE id = ? AND product_id = ?";
			$orderstatusd = $this->db->query($sqlu,array($oid,$product_id));
			
			if($orderstatusd->num_rows() > 0){				
				$save['qty']=$cqty;
				$save['unit_price']=$cprice;
				$save['total_price']=$cqty*$cprice;
				$query = $this->Index_model->update_table('orders_products','id',$oid,$save);
				
				$sqltotal = "SELECT SUM(total_price) AS total FROM orders_products WHERE order_id = ?";
				$opsqltotal = $this->db->query($sqltotal,array($orderid));
				$updateTotal = $opsqltotal->row_array();
				$orderdetails = $this->Index_model->getDataById('orders','order_id',$orderid,'order_id','desc','1');
				if($orderdetails->num_rows() > 0){
					$totalprice = $updateTotal['total'];
					
					$ordin = $orderdetails->row_array();					
					$paidamount = $ordin['paid_amount'];
					$saveorder['total_price']=$totalprice;
					$this->Index_model->update_table('orders','order_id',$orderid,$saveorder);
					
					$customerPayment=array(
						'sale_amount'=>$totalprice
						);
					$this->Index_model->updateTable('customer_payment','order_id',$orderid, $customerPayment);	
				}
			}
			
		
		
		if($query){	
			$jsondata = array('jsonmsg'=>'Successfully Updated','color'=>'#0e9a46');
		}
		else{
			$jsondata = array('jsonmsg'=>'Failed to Update','color'=>'#ff0000');
		}
		

		echo json_encode($jsondata);
	}
	
	//New invoice generate for a orders and customer
	//Udpate Order total price information
	//update customer payment and invoice information
	function new_invoice(){
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		if($this->input->post('invoiceCreate')!=""){
			$cust_id=$this->input->post('cust_id');
			$salse_id=$this->input->post('salse_id');
			$order_id=$this->input->post('order_id');
			$totalPrice = $this->input->post('total_price');
			$paid_amount = $this->input->post('paid_amount');
			$pay_method = $this->input->post('pay_method');
			
			if($this->input->post('pay_method')!=""){
				if($pay_method=="Bank"){
					$bankinfo = $this->input->post('bankinfo');
					$bankRec=array(
						'customer_id'=>$cust_id,
						'bank_id'=>$bankinfo,
						'total_amount'=>$paid_amount,
						'payment_date'=>date('Y-m-d'),
						'subimition_date'=>date('Y-m-d')
					);
					$bankid = $this->Index_model->inertTable('bank_received', $bankRec);
					$bkashid='';
				    $cashid='';
				}
				elseif($pay_method=="bKash"){
					$bkash_no = $this->input->post('bkash_no');
					$tranid = $this->input->post('tranid');
					$bkashRec=array(
						'customer_id'=>$cust_id,
						'account_no'=>$bkash_no,
						'tran_id'=>$tranid,
						'total_amount'=>$paid_amount,
						'payment_date'=>date('Y-m-d'),
						'subimition_date'=>date('Y-m-d')
					);
					$bkashid = $this->Index_model->inertTable('bkash_received', $bkashRec);
					$bankid='';
					$cashid='';
				}
				elseif($pay_method=="Cash"){
					$cashRec=array(
						'customer_id'=>$cust_id,
						'total_amount'=>$paid_amount,
						'payment_date'=>date('Y-m-d'),
						'subimition_date'=>date('Y-m-d')
					);
					$cashid = $this->Index_model->inertTable('cashbook', $cashRec);
					$bankid='';
					$bkashid='';
				}
			}
			else{
				$bankinfo='';
				$tranid='';
				$bankid='';
				$bkashid='';
				$cashid='';
			}
			
			//Update Order Table Total Price
			$sqlu = "SELECT * FROM orders WHERE order_id = ?";
			$orderstatusd = $this->db->query($sqlu,array($order_id));
			if($orderstatusd->num_rows() > 0){
				$rowOrd = $orderstatusd->row_array();
				$excPaid = $rowOrd['paid_amount'];
				//$excDue = $rowOrd['due_amount'];
				
				
				$subtotalPaid = $excPaid+$paid_amount;
				//$due_amount = $totalPrice - $subtotalPaid;
				if($totalPrice == $subtotalPaid){
					$paystatus = "Full Paid";
				}
				else{
					$paystatus = "Partial Paid";
				}
				$saveorder['paid_amount'] = $subtotalPaid;
				//$saveorder['due_amount'] = $due_amount;
				$saveorder['payment_status'] = $paystatus;
				$this->Index_model->updateTable('orders','order_id',$order_id, $saveorder);
			}
		
			//Insert New Invoice
			$insertTranstion=array(
					'cust_id'=>$cust_id,
					'order_num'=>$this->input->post('orderNumber'),
					'order_id'=>$order_id,					
					'create_date'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$lastInvoiceId = $this->Index_model->inertTable('invoice', $insertTranstion);
			
			//Get total invoice for customer
			$custinvoice = $this->Index_model->getDataById('invoice','cust_id',$cust_id,'inv_id','desc','');
			$custTotalInv = $custinvoice->num_rows();
			
			//Get total invoice for table
			$totalDBInvQue = $this->Index_model->getDataById('invoice','','','inv_id','desc','');
			$totalDBInv = $totalDBInvQue->num_rows();
			
			//Select existing record for customer order
			$sqlp = "SELECT * FROM customer_payment WHERE order_id = ?";
			$custpayq = $this->db->query($sqlp,array($order_id));
			$rowPay = $custpayq->row_array();
			$exccTotal = $rowPay['sale_amount'];
			$exccPaid = $rowPay['paid_amount'];
			//$exccDue = $rowPay['due_amount'];	
				
			$subCustPaid = $exccPaid+$paid_amount;
			//$dueCustAmount = $exccTotal - $subCustPaid;
			
			//Update Customer Invoice Information
			$customerPayment=array(
					'customer_id'=>$cust_id,
					'sales_id'=>$salse_id,
					'invoice_type'=>'Invoice',
					'invoice'=>$lastInvoiceId,
					'paid_amount'=>$subCustPaid,
					'total_invoice'=>$custTotalInv,
					'total_db_invoice'=>$totalDBInv,
					'pay_method'=>$pay_method,
					'bank_id'=>$bankid,
					'cash_id'=>$cashid,
					'bkash_id'=>$bkashid,
					'payment_date'=>date('Y-m-d')
					);
			$this->Index_model->updateTable('customer_payment','order_id',$order_id, $customerPayment);	
			redirect('admin/invoice/'.$lastInvoiceId);
		}
		else{
			 $this->session->set_flashdata('failedMsg', '<div class="alert alert-danger text-center">Failed To insert</div>');
			 redirect('admin/view_order/'.$order_id, 'refresh');	
		}
			
	}
	
	function invoice($inpoiceId)
	 {
		 //if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		 	if(!$inpoiceId) redirect('error');
		 	$data['invoiceData']= $this->Index_model->getDataById('invoice','inv_id',$inpoiceId,'inv_id','desc','1');
			foreach($data['invoiceData']->result() as $invoiceData);
			$order_id = $invoiceData->order_id;
		 	$data['order_id']=$order_id;
			$data['inv_id']=$inpoiceId;
			$data['title']="CMSN Networks | Customer Order Details";
			
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
			foreach($data['order_q']->result() as $rowq);
			$status=$rowq->status;
	 	    $customer_id=$rowq->customer_id;
			
			$data['customerQ']= $this->Index_model->getDataById('customers','customer_id',$customer_id,'customer_id','desc','1');
			
			if($this->input->get('status') && $this->input->get('status')!=""){
				$this->load->view('admin/order/invoice_print', $data);
			}
			else{
				$data['main_content']="admin/order/invoice";
				$this->load->view('admin_template', $data);
			}
	}
	
	
	
	function update_status()
	{
		
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		
		
		$status=$this->input->get('status');
		$view_order=$this->input->get('view_order');
		$table=$this->input->get('table');
		$id=$this->input->get('id');
	    $this->Index_model->update_status($table,$status,$id); 
		/*$existingData =  $this->Index_model->getDataById($table,'order_id',$id,'order_id','desc','1'); 
		$exisStatus = $existingData->row_array();
		
		if(isset($exisStatus['status']) && $exisStatus['status']!=""){
			$finalStatus = $exisStatus['status'].','.$status;
		}
		else{
			$finalStatus = $status;
		}*/
		
		//echo $finalStatus;
		$adminid = $this->session->userdata('AdminAccessId');
		$order_number=$this->input->get('order_number');
		$customer_id=$this->input->get('customer_id');
		$total_price=$this->input->get('total_price');
		//$shipping_id=$this->input->get('shipid');
		//$pay_id=$this->input->get('payid');

		//$this->Index_model->update_status($table,$finalStatus,$id); 
		
		if($status=="Delivered"){
			/*$genereteInvoice=array(
						cust_id'=>$customer_id,
						shipping_id'=>$shipping_id,
						pay_id'=>$pay_id,
						order_num'=>$order_number,
						order_id'=>$id,
						create_date'=>date('Y-m-d h:i:s'),
						date'=>date('Y-m-d')
						);
				$invoiceid = $this->Index_model->inertTable('invoice', $genereteInvoice);*/
			
				/*$insertTranstion=array(
							'order_id'=>$id,
							'order_number'=>$order_number,
							'user_id'=>$customer_id,
							'total_amount'=>$total_price,
							'admin_id'=>$adminid,
							'invoiceid'=>$invoiceid,
							'payment_date'=>date('Y-m-d h:i:s'),
							'subimition_date'=>date('Y-m-d')
							);
				$incsource = $this->db->query("select * from income_source where order_id='".$id."'");
				
				if($incsource->num_rows() > 0){
				foreach($incsource->result() as $incrow);
					$incid = $incrow->inc_id;
					$this->Index_model->updateTable('income_source','inc_id',$incid, $insertTranstion);
				}
				else{
					$this->Index_model->inertTable('income_source', $insertTranstion);
				}*/
				
				
				
				 $orderproid = $this->Index_model->getAllItemTable('orders_products','order_id',$id,'','','id','desc');
				 $numofpro = $orderproid->num_rows();
				 foreach($orderproid->result() as $orPro){
					$prod_id = $orPro->product_id;
					$prod_qty = $orPro->qty;
					$query = $this->db->query("select * from stock where pro_id ='".$prod_id."'");
					if($query->num_rows() > 0){
						foreach($query->result() as $row);
						$qty = $row->pro_qty; 
					}
					else{
						$qty=0;	
					}	
		
					$update['pro_qty']=$qty - $prod_qty;
					$update['pro_id']=$prod_id;
					$save['pro_id']=$prod_id;
					$save['buy_type']="Retail";
					$save['cust_id']=$customer_id;
					$save['pro_qty']=$prod_qty;
					$save['remarks']=$numofpro." Products Retails sold with this order number (".$order_number.")";
					$save['out_date']=date('Y-m-d');
					$status = 'stockout';
						
					$this->Index_model->stock_update($update,$save,$status); 
				}
		}
		else{
				$this->db->query("delete from income_source where order_id='".$id."'");
		}
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	
	
	/////////////////////// Account part ////////////////////////////////	 
	function expense_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="expense List | CMSN Networksbd";
		$data['expense_list'] = $this->Index_model->getTable('expense','par_id','desc');
		$data['main_content']="admin/expense/expense_list";
        $this->load->view('admin_template',$data);
	} 
	 
 	
	function expense_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['expenseUpdate'] = $this->Index_model->getAllItemTable('expense','par_id',$artiId,'','','par_id','desc');
		$expensecode = $this->Index_model->getAllItemTable('expense','','','','','code','desc');
		$rowExp = $expensecode->row_array();
		$data['lastCode'] = $rowExp['code']+1;
		
		$data['title']="expense Registration | CMSN Networksbd";
		$this->form_validation->set_rules('expense_name', 'expense name', 'trim|required');
		$this->form_validation->set_rules('code', 'Code', 'trim|required|is_unique[expense.code]');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			$expval=explode(' ',$this->input->post('expense_name'));
			$impval=implode('-',$expval);
				$save['expense_name'] = addslashes($this->input->post('expense_name'));
				$save['code']	      = addslashes($this->input->post('code'));
				$save['subimition_date']	    = date('Y-m-d');
				
				if($this->input->post('par_id')!=""){
					$par_id=$this->input->post('par_id');
					$this->Index_model->update_table('expense','par_id',$par_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('expense', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/expense_list', 'refresh');
			}
			else{
				$data['main_content']="admin/expense/expense_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/expense/expense_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	///////////////////////internal_cost ////////////////////////////////	 
	function internal_cost_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="internal_cost List | CMSN Networksbd";
		$data['payment_list'] = $this->Index_model->getTable('internal_cost','pay_id','desc');
		$data['main_content']="admin/internal_cost/payment_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function internal_cost_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="payment Registration | CMSN Networksbd";
		}
		else{
			$data['title']="payment Update | CMSN Networksbd";
		}
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('internal_cost','pay_id',$artiId,'','','pay_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
				
				 $digits = 4;
				 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
				 
				if($this->input->post('registration')){
					$assetinvest = $this->input->post('assetinvest');
					$serial_no = $serial;
					$amount = $this->input->post('investamount');
					$pay_date = $this->input->post('pay_date');
					$amount_in_word = $this->input->post('amount_in_word');
					$cost_by = $this->input->post('cost_by');
					$dateconv=date('Y-m-d',strtotime($pay_date));
				}
				else{
					$assetinvest=$this->session->userdata('assetinvest');
					$serial_no=$this->session->userdata('serial_no');
					$amount=$this->session->userdata('investamount');
					$amount_in_word=$this->session->userdata('amount_in_word');
					$cost_by=$this->session->userdata('cost_by');
					$dateconv=$this->session->userdata('pay_date');
				}
					$sessionSearchdata = array(
								  'assetinvest' => $assetinvest,
								  'cost_by' => $cost_by,
								  'serial_no' => $serial_no,
								  'amount_in_word' => $amount_in_word,
								  'investamount' => $amount,
								  'pay_date' => $dateconv,
							 );
				$this->session->set_userdata($sessionSearchdata);

				$save['amount_in_word']	    = $amount_in_word;
				$save['cost_by']	    = $cost_by;
				$save['serial_no']	    = $serial_no;
				$save['paymentfor']	    = $assetinvest;
				$save['total_amount']	    = $amount;
				$save['payment_date']	    = $dateconv;
				
				if($this->input->post('pay_id')!=""){
					$pay_id=$this->input->post('pay_id');
					$this->Index_model->update_table('internal_cost','pay_id',$pay_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('internal_cost', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/internal_cost_print', 'refresh');
		}
		else{
		  $data['main_content']="admin/internal_cost/payment_action";
		  $this->load->view('admin_template', $data);
		  }
	}
	
	
	
	function internal_cost_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
				
		$printsegment=$this->uri->segment(3);
		$data['cost_by']=$this->session->userdata('cost_by');
		$data['amount_in_word']=$this->session->userdata('amount_in_word');
		$data['serial_no']=$this->session->userdata('serial_no');
		$data['paymentfor']=$this->session->userdata('assetinvest');
		$data['amount'] = $this->session->userdata('investamount');
		$data['pay_date'] =  $this->session->userdata('pay_date');
		
		$data['title']="Payment Print | CMSN Networksbd";
		if(!$printsegment){
			$data['main_content']="admin/internal_cost/payment_print";
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/internal_cost/payment_print_form',$data);
		}
	} 
	

	
	
	/////////////////////// Bank part ////////////////////////////////	 
	function bank_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="bank List | CMSN Networksbd";
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		$data['main_content']="admin/bank/bank_list";
        $this->load->view('admin_template',$data);
	} 
	 
 	
	function bank_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['bankUpdate'] = $this->Index_model->getAllItemTable('bank','b_id',$artiId,'','','b_id','desc');
		$data['root_bank'] = $this->Index_model->getAllItemTable('bank','','','','','bank_name','asc');
		$data['title']="bank Registration | CMSN Networksbd";
		$this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			$expval=explode(' ',$this->input->post('bank_name'));
			$impval=implode('-',$expval);
				$save['bank_name']	    = addslashes($this->input->post('bank_name'));
				$save['account_name']	    = addslashes($this->input->post('account_name'));
				$save['account_no']	    = addslashes($this->input->post('account_no'));
				$save['branch']	    = addslashes($this->input->post('branch'));
				$save['details']	    = addslashes($this->input->post('details'));
				$save['subimition_date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('bank','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('bank', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/bank_list', 'refresh');
			}
			else{
				$data['main_content']="admin/bank/bank_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/bank/bank_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	///////////////////////bank_deposit ////////////////////////////////	 
	function bank_deposit_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="bank_deposit List | dot3bdbd";
		$data['payment_list'] = $this->Index_model->getTable('bank_deposit','bd_id','desc');
		$data['main_content']="admin/bank_deposit/bank_deposit_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function bank_deposit_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="payment Registration | dot3bdbd";
		}
		else{
			$data['title']="payment Update | dot3bdbd";
		}
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('bank_deposit','bd_id',$artiId,'','','bd_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
				
				$digits = 4;
				 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
				 
				if($this->input->post('registration')){
					$assetinvest = $this->input->post('bankname');
					$account_no =  $this->input->post('account_no');
					$amount = $this->input->post('investamount');
					$pay_date = $this->input->post('pay_date');
					$amount_in_word = $this->input->post('amount_in_word');
					$deposit_by = $this->input->post('deposit_by');
					$dateconv=date('Y-m-d',strtotime($pay_date));
				}
				else{
					$assetinvest=$this->session->userdata('bankname');
					$account_no=$this->session->userdata('account_no');
					$amount=$this->session->userdata('investamount');
					$amount_in_word=$this->session->userdata('amount_in_word');
					$deposit_by=$this->session->userdata('deposit_by');
					$dateconv=$this->session->userdata('pay_date');
				}
					$sessionSearchdata = array(
								  'bankname' => $assetinvest,
								  'deposit_by' => $deposit_by,
								  'account_no' => $account_no,
								  'amount_in_word' => $amount_in_word,
								  'investamount' => $amount,
								  'pay_date' => $dateconv,
							 );
				$this->session->set_userdata($sessionSearchdata);

				$save['amount_in_word']	    = $amount_in_word;
				$save['deposit_by']	    = $deposit_by;
				$save['account_no']	    = $account_no;
				$save['bank_name']	    = $assetinvest;
				$save['total_amount']	    = $amount;
				$save['payment_date']	    = $dateconv;
				
				if($this->input->post('bd_id')!=""){
					$bd_id=$this->input->post('bd_id');
					$this->Index_model->update_table('bank_deposit','bd_id',$bd_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('bank_deposit', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/bank_deposit_list', 'refresh');
		}
		else{
		  $data['main_content']="admin/bank_deposit/bank_deposit_action";
		  $this->load->view('admin_template', $data);
		  }
	}
	
	
	
	
	
	
	
	
	
	
	
	/////////////////////// payment ////////////////////////////////	
	function payment_history()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		 $this->load->view('admin/payment/paymentHistory');
	}
	 
	 function ajaxDataPayment()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->get('custid')!=""){
			$sid=$this->input->get('custid');
					$quecust=$this->db->query("SELECT prev_balance FROM customers where customer_id='".$sid."'");
					$rowc = $quecust->row_array();
					$prevbalance = $rowc['prev_balance'];
					
					$querypay=$this->db->query("SELECT SUM(sale_amount) AS total,
					SUM(paid_amount) AS paid,SUM(due_amount) AS due FROM customer_payment where customer_id='".$sid."'");
					if($querypay->num_rows() > 0){
						foreach($querypay->result() as $payrow);
						$payable_amount=($payrow->total)+$prevbalance;
						$paid_amount=$payrow->paid;
						$due=$payrow->due;
					}
					else{
						$payable_amount=0;
						$paid_amount=0;
						$due = 0;
					}
				
			$svar='
				<div class="col-sm-12">
				  <h4>Total Payable Amount: <strong>BDT '.$payable_amount.'&nbsp;TK</strong></span></h4>
				  <h4>Paid Amount: <strong>BDT '.$paid_amount.'&nbsp;TK</strong></h4>
				  <h4>Due Amount: <strong>BDT '.$due.'&nbsp;TK</strong></h4>
				  <div class="col-sm-12"><h2>
				 <a href="'.base_url('admin/payment_history?custid='.$sid).'" target="_blank">
				  View Installment History</a>				  
				  <h2></div>
			  </div>
			';
			echo $svar;
		}

	}
	
	
	/*function payment_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="payment List | CMSN Networks";
		$data['payment_list'] = $this->Index_model->getTable('customer_payment','id','desc');
		$data['main_content']="admin/payment/payment_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function payment_registration()
	{
		
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Payment Registration | CMSN Networks";
		}
		else{
			$data['title']="Payment Update | CMSN Networks";
		}
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('custid', 'Customer name', 'trim|required');
			$this->form_validation->set_rules('pay_method', 'Method', 'trim|required');
			$this->form_validation->set_rules('pay_date', 'Payment Date', 'trim|required');
			$this->form_validation->set_rules('sale_amount','Total amount','trim|required');
			
			if($this->form_validation->run() != false){
				
				 $digits = 4;
				 $serial = rand(pow(10, $digits-1), pow(10, $digits)-1);
				 
				if($this->input->post('registration')){
					$custid = $this->input->post('custid');
					$pay_method = $this->input->post('pay_method');
					$serial_no = $serial;
					$amount_in_word = $this->input->post('amount_in_word');
					$total_amount = $this->input->post('sale_amount');
					$pay_date = $this->input->post('pay_date');
				}
				else{
					$custid=$this->session->userdata('custid');
					$pay_method=$this->session->userdata('pay_method');
					$serial_no=$this->session->userdata('serial_no');
					$amount_in_word=$this->session->userdata('amount_in_word');
					$total_amount=$this->session->userdata('total_amount');
					$pay_date=$this->session->userdata('pay_date');
				}
					$pdate = date('Y-m-d H:i:s',strtotime($pay_date));
					$sessionSearchdata = array(
								  'custid' => $custid,
								  'pay_method' => $pay_method,
								  'serial_no' => $serial_no,
								  'amount_in_word' => $amount_in_word,
								  'total_amount' => $total_amount,
								  'pay_date' => $pdate,
								  'date' => date('Y-m-d'),
							 );
				$this->session->set_userdata($sessionSearchdata);
				
				
				
				$sqlp = "SELECT * FROM customer_payment WHERE customer_id = ? ORDER BY id DESC";
				$custpayq = $this->db->query($sqlp,array($custid));
				$rowPay = $custpayq->row_array();
				$exccTotal = $rowPay['sale_amount'];
				$exccPaid = $rowPay['paid_amount'];
				$exccDue = $rowPay['due_amount'];	
					
				$subCustPaid = $exccPaid+$total_amount;
				$dueCustAmount = $exccTotal - $subCustPaid;
				$customerPayment=array(
						'customer_id'=>$custid,
						'invoice_type' =>  'Voucher',
						'voucher' =>  $serial_no,
						'sale_amount'=>$exccDue,
						'paid_amount'=>$total_amount,
						'delay_paid'=>'',
						'due_amount'=>$dueCustAmount,
						'pay_method'=>$pay_method,
						'payment_date'=>$pdate
						);
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('customer_payment','id',$id,$customerPayment);
					$s='Updated';
				}
				else{
					$this->Index_model->inertTable('customer_payment', $customerPayment);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('admin/payment_print', 'refresh');
			}
			else{
				$data['main_content']="admin/payment/payment_action";
        		$this->load->view('admin_template', $data);
			}
		}
		else{
		  $data['main_content']="admin/payment/payment_action";
		  $this->load->view('admin_template', $data);
	   }
	}
	
	
	
	function payment_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['custid'] = $this->session->userdata('custid');
		$data['pay_method']=$this->session->userdata('pay_method');
		$data['amount_in_word']=$this->session->userdata('amount_in_word');
		$data['serial_no']=$this->session->userdata('serial_no');
		$data['amount'] = $this->session->userdata('total_amount');
		$data['pay_date'] =  $this->session->userdata('pay_date');
		
		$data['title']="Payment Print | CMSN Networks";
		$this->load->view('admin/payment/payment_print_form',$data);
	} */
	
	
	
	
	
/////////////==============================Debit And Credit Voucher==========================////////////////////
	function credit_voucher()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['title']="Debit/Credit | CMSN Networks";
		
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		
		  $data['main_content']="admin/debit_credit/credit_action";
		  $this->load->view('admin_template', $data);
	}	
	
	function debit_voucher()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['title']="Debit/Credit | CMSN Networks";
		
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		
		  $data['main_content']="admin/debit_credit/debit_action";
		  $this->load->view('admin_template', $data);
	}	
	
	
	
	/*function credit_voucher()
	{
		$data['title']="Payment Update | CMSN Networks";
		//$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
				 $custid = $this->input->post('userid');
				$pay_date = $this->input->post('pay_date');
				$amount = $this->input->post('amount');
				$voucher = $this->input->post('voucher');
				$pay_method = $this->input->post('pay_method');
				$pdate = date('Y-m-d',strtotime($pay_date));
				$sdate = date('Y-m-d');
				
						if($this->input->post('pay_method')!=""){
							if($pay_method=="Bank"){
								$bankinfo = $this->input->post('bankinfo');
								$bankRec=array(
									'customer_id'=>$cust_id,
									'bank_id'=>$bankinfo,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('bank_received', $bankRec);
							}
							elseif($pay_method=="bKash"){
								$bkash_no = $this->input->post('bkash_no');
								$tranid = $this->input->post('tranid');
								$bkashRec=array(
									'customer_id'=>$cust_id,
									'account_no'=>$bkash_no,
									'tran_id'=>$tranid,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('bkash_received', $bkashRec);
							}
							elseif($pay_method=="Cash"){
								$cashRec=array(
									'customer_id'=>$cust_id,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('cashbook', $cashRec);
							}
					}
					else{
						$bankinfo='';
						$tranid='';
					}
			
				$arrayCredit=array(
						'userid'=>$custid,
						'voucher' =>  $voucher,
						'amount'=>$amount,
						'pay_method'=>$pay_method,
						'received_by'=>$this->input->post('received_by'),
						'particulars'=>$this->input->post('particulars'),
						'payment_date'=>$pdate,
						'subimition_date'=>$sdate
						);
				
				$this->Index_model->inertTable('credit_voucher', $arrayCredit);
				
				$customerPayment=array(
						'customer_id'=>$custid,
						'invoice_type' =>  'Voucher',
						'voucher' =>  $voucher,
						'sale_amount'=>'0',
						'paid_amount'=>$amount,
						'pay_method'=>$pay_method,
						'payment_date'=>$pdate
						);
				$this->Index_model->inertTable('customer_payment', $customerPayment);		
						
				$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
				$fmsg = $this->session->flashdata('jobseekerssuccessMsg');
				
				$jsondata = array('msg'=>$fmsg);
				echo json_encode($jsondata);
	}*/	
	
	
	
	
	function credit_voucher_action()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Payment Update | CMSN Networks";
		//$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
				$cust_id = $this->input->get('userid');
				$pay_date = $this->input->get('pay_date');
				$amount = $this->input->get('amount');
				$voucher = $this->input->get('voucher');
				$pay_method = $this->input->get('pay_method');
				$pdate = date('Y-m-d',strtotime($pay_date));
				$sdate = date('Y-m-d');
				
						if($this->input->post('pay_method')!=""){
							if($pay_method=="Bank"){
								$bankinfo = $this->input->get('bankinfo');
								$bankRec=array(
									'customer_id'=>$cust_id,
									'bank_id'=>$bankinfo,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('bank_received', $bankRec);
							}
							elseif($pay_method=="bKash"){
								$bkash_no = $this->input->get('bkash_no');
								$tranid = $this->input->get('tranid');
								$bkashRec=array(
									'customer_id'=>$cust_id,
									'account_no'=>$bkash_no,
									'tran_id'=>$tranid,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('bkash_received', $bkashRec);
							}
							elseif($pay_method=="Cash"){
								$cashRec=array(
									'customer_id'=>$cust_id,
									'total_amount'=>$paid_amount,
									'payment_date'=>date('Y-m-d'),
									'subimition_date'=>date('Y-m-d')
								);
								$this->Index_model->inertTable('cashbook', $cashRec);
							}
					}
					else{
						$bankinfo='';
						$tranid='';
					}
			
				$arrayCredit=array(
						'userid'=>$cust_id,
						'voucher' =>  $voucher,
						'amount'=>$amount,
						'pay_method'=>$pay_method,
						'received_by'=>$this->input->get('received_by'),
						'particulars'=>$this->input->get('particulars'),
						'payment_date'=>$pdate,
						'subimition_date'=>$sdate
						);
				
				$this->Index_model->inertTable('credit_voucher', $arrayCredit);
				
				$customerPayment=array(
						'customer_id'=>$cust_id,
						'invoice_type' => 'Voucher',
						'voucher' =>  $voucher,
						'sale_amount'=>'0',
						'paid_amount'=>$amount,
						'pay_method'=>$pay_method,
						'payment_date'=>$pdate
						);
				$this->Index_model->inertTable('customer_payment', $customerPayment);		
						
				$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
				$fmsg = $this->session->flashdata('jobseekerssuccessMsg');
				
				$data['custid']=$cust_id;
				$data['cost_by']=$this->input->get('received_by');
				$data['amount_in_word']=$this->session->userdata('amount_in_word');
				$data['serial_no']=$voucher;
				$data['paymentfor']=$this->input->get('particulars');
				$data['amount'] = $amount;
				$data['pay_date'] =  $pdate;
				$this->load->view('admin/debit_credit/credit_form',$data);
				//$jsondata = array('msg'=>$fmsg);
				//echo json_encode($jsondata);
	}
	
	function debit_voucher_action()
	
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Payment Update | CMSN Networks";
			if($this->input->get('submitbtn')!="" && $this->input->get('submitbtn')=='creditvoucher'){
					$pay_date=date('Y-m-d',strtotime($this->input->get('pay_date')));
					$supp_id=$this->input->get('supp_id');
					$asset=$this->input->get('asset');
					$voucher=$this->input->get('voucher');
					$amount=$this->input->get('amount');
					$pay_method=$this->input->get('pay_method');
					$cost_by=$this->input->get('cost_by');
					$particulars=$this->input->get('particulars');
				}
				else{
					$supp_id=$this->session->userdata('supp_id');
					$pay_date=$this->session->userdata('pay_date');
					$asset=$this->session->userdata('asset');
					$voucher=$this->session->userdata('voucher');
					$amount=$this->session->userdata('amount');
					$pay_method=$this->session->userdata('pay_method');
					$cost_by=$this->session->userdata('cost_by');
					$particulars=$this->session->userdata('particulars');
				}
				$sessiondata = array(
							'pay_date'=>$pay_date,
							'asset'=> $asset,
							'voucher'=> $voucher,
							'amount'=> $amount,
							'pay_method'=> $pay_method,
							'cost_by'=> $cost_by,
							'particulars'=> $particulars
						   );
			$this->session->set_userdata($sessiondata);			
			$data['pay_date']=$this->session->userdata('pay_date');
			$data['asset']=$this->session->userdata('asset');
			$data['voucher']=$this->session->userdata('voucher');
			$data['amount']=$this->session->userdata('amount');
			$data['pay_method']=$this->session->userdata('pay_method');
			$data['cost_by']=$this->session->userdata('cost_by');
			$data['particulars']=$this->session->userdata('particulars');
			$sdate = date('Y-m-d');
				
				$arrayCredit=array(
						'supp_id'=> $supp_id,
						'asset'=> $asset,
						'voucher'=> $voucher,
						'amount'=> $amount,
						'pay_method'=> $pay_method,
						'cost_by'=> $cost_by,
						'particulars'=> $particulars,
						'payment_date'=>$pay_date,
						'subimition_date'=>$sdate
						);
				
				$this->Index_model->inertTable('debit_voucher', $arrayCredit);
				$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
				$fmsg = $this->session->flashdata('jobseekerssuccessMsg');
				
				$data['suppid']=$supp_id;
				$data['cost_by']=$cost_by;
				$data['amount_in_word']=$this->session->userdata('amount_in_word');
				$data['serial_no']=$voucher;
				$data['paymentfor']=$particulars;
				$data['amount'] = $amount;
				$data['pay_date'] =  $pay_date;
				$this->load->view('admin/debit_credit/debit_form',$data);
				//$jsondata = array('msg'=>$fmsg);
				//echo json_encode($jsondata);
	}	
	
	
	
	
	
	
	
	/////////////==============================TA/DA Statement==========================////////////////////
	function tada_statement()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['title']="Debit/Credit | CMSN Networks";
		
		
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('tada_statement','','','','','par_id','desc');
		
		$data['main_content']="admin/tada_statement/tada_list";
		$this->load->view('admin_template', $data);
	}	
	
	
	
	
	
	function tada_statement_action()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['salserepres'] = $this->Index_model->getAllItemTable('sales_represntative','','','','','user_id','desc');
		if($this->input->post('tadasubmit') && $this->input->post('tadasubmit')=='Save'){		
			$data['title']="Payment Update | CMSN Networks";
			$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
			$save['salse_id'] = $this->input->post('salse_id');
			$save['particulars'] = $this->input->post('particulars');
			$save['rickshaw'] = $this->input->post('rickshaw');
			$save['bus'] = $this->input->post('bus');
			$save['motorcycle']= $this->input->post('motorcycle');
			$save['cng'] = $this->input->post('cng');
			$save['mobile'] = $this->input->post('mobile');
			$save['foods'] = $this->input->post('foods');
			$save['hotel'] = $this->input->post('hotel');
			$save['misc'] = $this->input->post('misc');
			$save['others'] = $this->input->post('others');
			$save['voucher'] = $this->input->post('voucher');
			$save['cost_by'] = $this->input->post('cost_by');
			$save['subimition_date'] = $this->input->post('pay_date');
					
			$this->Index_model->inertTable('tada_statement', $save);
			$this->session->set_userdata($save);
			 
			$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
			redirect('admin/tada_statement_voucher','refresh');
		}
		else{
			$data['main_content']="admin/tada_statement/action";
			$this->load->view('admin_template', $data);
		}
	}	
	
	
	function tada_statement_voucher()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Payment Update | CMSN Networks";
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		
		
		$salse_id = $this->session->userdata('salse_id');
	    $data['particulars'] = $this->session->userdata('particulars');
		$data['rickshaw'] = $this->session->userdata('rickshaw');
		$data['bus'] = $this->session->userdata('bus');
		$data['motorcycle']= $this->session->userdata('motorcycle');
		$data['cng'] = $this->session->userdata('cng');
		$data['mobile'] = $this->session->userdata('mobile');
		$data['foods'] = $this->session->userdata('foods');
		$data['hotel'] = $this->session->userdata('hotel');
		$data['misc'] = $this->session->userdata('misc');
		$data['others'] = $this->session->userdata('others');
		$data['voucher'] = $this->session->userdata('voucher');
		$data['subimition_date'] = $this->session->userdata('subimition_date');
        
		
		$data['totalamouont']  = 	$this->session->userdata('rickshaw') + 
									$this->session->userdata('bus') + 
									$this->session->userdata('motorcycle') + 
									$this->session->userdata('cng') + 
									$this->session->userdata('mobile') +
									$this->session->userdata('foods') + 
									$this->session->userdata('misc') + 
									$this->session->userdata('others') + 
									$this->session->userdata('hotel');
		$salserepres = $this->Index_model->getAllItemTable('sales_represntative','user_id',$salse_id,'','','user_id','desc');
		$saleinfo = $salserepres->row_array();
		$data['salsename'] = $saleinfo['username'];
		$this->load->view('admin/tada_statement/payment_print_form',$data);
	}	
	
	
	
/////////////////////////================== Sale =======================/////////////////////////	
	
		
	
	
	function buyerAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('custid')!=""){
			$sid=$this->input->post('custid');

					$querypay=$this->db->query("SELECT SUM(sale_amount) AS total, SUM(paid_amount) AS paid FROM customer_payment WHERE customer_id='".$sid."'");
					if($querypay->num_rows() > 0){
						foreach($querypay->result() as $payrow);
						$payable_amount=$payrow->total;
						$paid_amount=$payrow->paid;
						$due=$payable_amount - $paid_amount;
					}
					else{
						$payable_amount=0;
						$paid_amount=0;
						$due = 0;
					}
				
			$arrayData = array("total"=>$payable_amount,"paid"=>$paid_amount,"due"=>$due);
			echo json_encode($arrayData);
		}

	}
	
	
	function getProductAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('keyword')!=""){
			$key=$this->input->post('keyword');
				$str='';
				
				$str .= '<ul class="autocomplete">';
					$querypay=$this->db->query("SELECT * FROM product WHERE product_name LIKE '%$key%' OR pro_code LIKE '%$key%'");
						foreach($querypay->result() as $payrow):
							$pro_id=$payrow->product_id;
							$product_name=$payrow->product_name;
							$passval = '"'.$product_name.'"';
							$str .='<li onclick=ajaxProduct('.$pro_id.');>'.$product_name.'</li>
							<input type="hidden" value="'.$product_name.'" name="proname" id="proname'.$pro_id.'">';
							
						endforeach;
			
			$str .= '</ul>';	
			$arrayData = array("prodlist"=>$str);
			echo json_encode($arrayData);
		}

	}
	
	
	
	function getPurProductAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('keyword')!=""){
			$key=$this->input->post('keyword');
				$str='';
				
				$str .= '<ul class="autocomplete">';
					$querypay=$this->db->query("SELECT * FROM product WHERE product_name LIKE '%$key%' OR pro_code LIKE '%$key%'");
						foreach($querypay->result() as $payrow):
							$pro_id=$payrow->product_id;
							$product_name=$payrow->product_name;
							$passval = '"'.$product_name.'"';
							$str .='<li onclick=ajaxPurProduct('.$pro_id.');>'.$product_name.'</li>
							<input type="hidden" value="'.$product_name.'" name="proname" id="proname'.$pro_id.'">';
							
						endforeach;
			
			$str .= '</ul>';	
			$arrayData = array("prodlist"=>$str);
			echo json_encode($arrayData);
		}

	}
	
	function saleProductAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('pro_id')!=""){
			$sid=$this->input->post('pro_id');

					$querypay=$this->db->query("SELECT * FROM product WHERE product_id='".$sid."'");
					if($querypay->num_rows() > 0){
						foreach($querypay->result() as $payrow);
						$pro_code=$payrow->pro_code;
						$price=$payrow->price;
						$qty=$payrow->qty;
						$size=$payrow->size;
						$vat=$payrow->vat;
						$commission=$payrow->commission;
					}
					else{
						$pro_code=0;
						$price=0;
						$size = 0;
						$vat = 0;
						$commission = 0;
						$qty  = 0;
					}
				
			$arrayData = array("pcode"=>$pro_code,"uprice"=>$price,"size"=>$size,"stock"=>$qty,"vat"=>$vat,"commission"=>$commission);
			echo json_encode($arrayData);
		}

	}
	
	
	
	function getCustomerAjax()
	{
	//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('keyword')!=""){
			$key=$this->input->post('keyword');
				$str='';
				
				$str .= '<ul class="autocomplete">';
					$querypay=$this->db->query("SELECT * FROM customers WHERE name LIKE '%$key%' OR cid LIKE '%$key%'");
						foreach($querypay->result() as $payrow):
							$customer_id=$payrow->customer_id;
							$name=$payrow->name;
							$passval = '"'.$name.'"';
							$str .='<li onclick=ajaxBuyer('.$customer_id.');>'.$name.'</li>
							<input type="hidden" value="'.$name.'" name="custname" id="custname'.$customer_id.'">';
							
						endforeach;
			
			$str .= '</ul>';	
			$arrayData = array("custlist"=>$str);
			echo json_encode($arrayData);
		}

	}
	
	
	function saleCustomerAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('customer_id')!=""){
			$sid=$this->input->post('customer_id');

					$querypay=$this->db->query("SELECT * FROM customers WHERE customer_id='".$sid."'");
					if($querypay->num_rows() > 0){
						foreach($querypay->result() as $payrow);
						$name=$payrow->name;
						$cid=$payrow->cid;
						$mobile=$payrow->mobile;
					}
					else{
						$name='';
						$cid=0;
						$mobile = 0;
					}
				
			$arrayData = array("ccode"=>$cid,"cname"=>$name,"cmobile"=>$mobile);
			echo json_encode($arrayData);
		}

	}
	
	
	function getSupplierAjax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('keyword')!=""){
			$key=$this->input->post('keyword');
				$str='';				
				$str .= '<ul class="autocomplete">';
					$querypay=$this->db->query("SELECT * FROM supplier WHERE username LIKE '%$key%' OR code LIKE '%$key%'");
						foreach($querypay->result() as $payrow):
							$user_id=$payrow->user_id;
							$name=$payrow->username;
							$passval = '"'.$name.'"';
							$str .='<li onclick=ajaxSupplier('.$user_id.');>'.$name.'</li>
							<input type="hidden" value="'.$name.'" name="suppname" id="suppname'.$user_id.'">';
							
						endforeach;
			
			$str .= '</ul>';	
			$arrayData = array("supplist"=>$str);
			echo json_encode($arrayData);
		}

	}
	
	
	/*function saleentry_action()
	{
		$data['title']="Payment Update | CMSN Networks";
		//$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		//$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		
				$strData ='';				
				$bill_no = $this->input->post('bill_no');
				$checkBillInfo = $this->Index_model->getAllItemTable('sale_details','bill_no',$bill_no,'','','id','desc');
				
				if($this->input->post('buyer_type')=="Existing Customer"){
					$cust_id = $this->input->post('cust_id');
				}
				elseif($this->input->post('buyer_type')=="New Customer"){
					$ncustinfo['name'] = $this->input->post('nc_name');
					$ncustinfo['cid'] = $this->input->post('nc_code');
					$ncustinfo['mobile'] = $this->input->post('nc_mobile');
					$ncustinfo['email'] = $this->input->post('nc_email');
					$ncustinfo['address'] = $this->input->post('nc_address');
					
					if($checkBillInfo->num_rows() > 0){
						$rowd = $checkBillInfo->row_array();
						$cust_id = $rowd['cust_id'];
					}
					else{
						$cust_id = $this->Index_model->inertTable('customers', $ncustinfo);
					}
				}				
				
				$save['cust_id'] = $cust_id;
				$save['bill_no'] = $bill_no;
				$save['received_by'] = $this->input->post('received_by');
				$save['transport_cost'] = $this->input->post('transport_cost');
				$save['sale_date'] = date('Y-m-d',strtotime($this->input->post('sale_date')));
				$save['total_qty'] = $this->input->post('total_qty');
				$save['total_amount'] = $this->input->post('total_amount');
				$save['payment'] = $this->input->post('payment');
				$save['commission'] = $this->input->post('commission');
				$save['vat'] = $this->input->post('vat');
				$save['due'] = $this->input->post('due');
				$save['net_amount'] = $this->input->post('net_amount');
				$save['comments'] = $this->input->post('comments');
				$save['date'] = date('Y-m-d');
			
			    
				if($checkBillInfo->num_rows() > 0){
					$lastid = $this->Index_model->update_table('sale_details','bill_no',$bill_no,$save);
				}
				else{
					$lastid = $this->Index_model->inertTable('sale_details', $save);
				}
				
				 $sessiondata = array(
							'bill_no'=>$bill_no,
							'cust_id'=> $cust_id
						   );
				$this->session->set_userdata($sessiondata);
							
				$product_id = $this->input->post('product_id');
				$savePro['cust_id'] = $this->input->post('cust_id');
				$savePro['product_id'] = $product_id;
				$savePro['bill_no'] =  $bill_no;
				$savePro['total_qty'] = $this->input->post('pro_qty');
				$savePro['commission'] = $this->input->post('pro_commission');
				$savePro['vat'] = $this->input->post('pro_vat');
				$savePro['sale_price'] = $this->input->post('sale_price');
				$savePro['total_amount'] = $this->input->post('total_pro_price');
				$savePro['date'] = date('Y-m-d');
				
				$checkBillInfo = $this->Index_model->getAllItemTable('sale_product_info','bill_no',$bill_no,'product_id',$product_id,'id','desc');
				if($checkBillInfo->num_rows() > 0){
					$rowPro = $checkBillInfo->row_array();
					$spId = $rowPro['id'];
					$this->Index_model->update_table('sale_product_info','id',$spId,$savePro);
				}
				else{
					$this->Index_model->inertTable('sale_product_info', $savePro);
				}
				
				$getBillProduct = $this->Index_model->getAllItemTable('sale_product_info','bill_no',$bill_no,'','','id','desc');
				if($getBillProduct->num_rows() > 0){
					$strData .= '<table class="table" width="100%" style="background:#fff; color:#000">
									<tr bgcolor="#666" style="color:#fff">
										<th>SI</th>
										<th>Product Code</th>
										<th>Product Name</th>
										<th>Size</th>
										<th>Qty</th>
										<th>Unit Price</th>
										<th>Sale Price</th>
										<th>Comission</th>
										<th>Vat</th>
										<th>Total</th>
										<th>Action</th>
									</tr>';
						 $i=1;
						 $totalPrice = 0;
						 $totalQty = 0;
						 $totalVat = 0;
						 $totalCom = 0;
						 $unitPr = 0;
						 foreach($getBillProduct->result() as $pinf):
						 
						 	 $spid = $pinf->id;
							 $productInfo = $this->Index_model->getAllItemTable('product','product_id',$pinf->product_id,'','','product_id','desc');
							 $pRow = $productInfo->row_array();
							 $pCode = 	$pRow['pro_code'];
							 $pName = 	$pRow['product_name'];
							 $pSize = 	$pRow['size'];
							 $pPrice = 	$pRow['price'];
								$strData .= '<tr id="deleted_item'.$spid.'">
												<th>'.$i.'</th>
												<th>'.$pCode.'</th>
												<th>'.$pName.'</th>
												<th>'.$pSize.'</th>
												<th>'.$pinf->total_qty.'</th>
												<th>'.$pPrice.'</th>
												<th>'.$pinf->sale_price.'</th>
												<th>'.$pinf->vat.'</th>
												<th>'.$pinf->commission.'</th>
												<th>'.$pinf->total_amount.'</th>
												<th align="right">
													<a onclick=masterDelete("'.$spid.'","sale_product_info","id") style="cursor:pointer"><i class="fa fa-trash"></i></a>
												</th>
											</tr>';
								$i++;
								
							$unitPr = $unitPr + $pPrice;
							$totalPrice = $totalPrice + $pinf->total_amount;
							$totalQty = $totalQty + $pinf->total_qty;
							$totalVat = $totalVat + $pinf->vat;
							$totalCom = $totalCom + $pinf->commission;
						endforeach;						
						$strData .= '</table>';
						$strData .= '<table width="100%" bgcolor="#fff"><tr style="color:green">
												<td colspan=2><strong>QTY: '.$totalQty.' pcs</strong></td>
												<td colspan=2><strong>Unit Rate: '.$unitPr.' Tk</strong></td>
												<td colspan=2><strong>Sale Rate: '.$unitPr.' Tk</strong></td>
												<td><strong>'.$totalVat.'%</strong></td>
												<td><strong>'.$totalCom.'%</strong></td>
												<td colspan=3><strong>Total: '.$totalPrice.' Tk</strong></td>												
											</tr></table>';
				 }
				
				$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
				$fmsg = $this->session->flashdata('jobseekerssuccessMsg');
				
				$jsondata = array('msg'=>$fmsg,'productinfo'=>$strData,'tQty'=>$totalQty,'tPrice'=>$totalPrice,'tCom'=>$totalCom,'tVat'=>$totalVat);
				echo json_encode($jsondata);
	}	*/
	
	
	function saleentry()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$artiId=$this->uri->segment(3);
		$data['title']="Sale | CMSN Networks";
		
		$data['paymentUpdate'] = $this->Index_model->getAllItemTable('customer_payment','id',$artiId,'','','id','desc');
		$data['bank_list'] = $this->Index_model->getTable('bank','b_id','desc');
		
		  $data['main_content']="admin/sale/action";
		  $this->load->view('admin_template', $data);
	}
	
	function saleentry_action()
	{
		$data['title']="Payment Update | CMSN Networks";
		$bill_no = $this->input->post('bill_no');
		
		if($this->input->post('buyer_type')=="1"){
			$cust_id = $this->input->post('cust_id');
		}
		elseif($this->input->post('buyer_type')=="2"){
			$ncustinfo['name'] = $this->input->post('nc_name');
			$ncustinfo['cid'] = $this->input->post('nc_code');
			$ncustinfo['mobile'] = $this->input->post('nc_mobile');
			$ncustinfo['email'] = $this->input->post('nc_email');
			$ncustinfo['address'] = $this->input->post('nc_address');
			$cust_id = $this->Index_model->inertTable('customers', $ncustinfo);
		}				
		
		$save['cust_id'] = $cust_id;
		$save['bill_no'] = $bill_no;
		$save['received_by'] = $this->input->post('received_by');
		$save['transport_cost'] = $this->input->post('transport_cost');
		$save['sale_date'] = date('Y-m-d',strtotime($this->input->post('sale_date')));
		$save['total_qty'] = $this->input->post('total_qty');
		$save['total_amount'] = $this->input->post('total_amount');
		$save['payment'] = $this->input->post('payment');
		$save['com_type'] = $this->input->post('com_type');
		$save['commission'] = $this->input->post('commission');
		$save['vat'] = $this->input->post('vat');
		$save['due'] = $this->input->post('net_amount');
		$save['net_amount'] = $this->input->post('due');
		$save['comments'] = $this->input->post('comments');
		$save['date'] = date('Y-m-d');
	
		 $lastid = $this->Index_model->inertTable('sale_details', $save);
		 $sessiondata = array(
					'bill_no'=>$bill_no,
					'cust_id'=> $cust_id
				   );
		$this->session->set_userdata($sessiondata);
					
					
		/*$product_id = $this->input->post('product_id');
		$pro_qty = $this->input->post('pro_qty');
		$pro_commission = $this->input->post('pro_commission');
		$pro_vat = $this->input->post('pro_vat');
		$sale_price = $this->input->post('sale_price');
		$total_pro_price = $this->input->post('total_pro_price');*/
		$product_id = $this->input->post('pid');
		$pro_qty = $this->input->post('pqty');
		$pro_commission = $this->input->post('pcom');
		$pro_vat = $this->input->post('pvat');
		$sale_price = $this->input->post('psprice');
		$total_pro_price = $this->input->post('ptotal');
		$endate = date('Y-m-d');
		
		foreach($product_id as $k=>$v){
			$savePro = array(
				'cust_id' =>$cust_id,
				'bill_no' =>$bill_no,
				'product_id' =>$product_id[$k],
				'total_qty' =>$pro_qty[$k],
				'commission' =>$pro_commission[$k],
				'vat' =>$pro_vat[$k],
				'sale_price' =>$sale_price[$k],
				'total_amount' =>$total_pro_price[$k],
				'date' =>$endate
			);
			$this->Index_model->inertTable('sale_product_info', $savePro);
		}	
		$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
		redirect('admin/new_sale_invoice','refresh');
	}	
	
	
	////////////////// Sale Invoice///////////////////////////////////////
	
	function new_sale_invoice(){
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			if($this->session->userdata('bill_no') && $this->session->userdata('bill_no')!=""){
				$bill_no=$this->session->userdata('bill_no');
				$cust_id=$this->session->userdata('cust_id');
				
				$data['saleinfo'] = $this->Index_model->getAllItemTable('sale_details','bill_no',$bill_no,'','','id','desc');
				foreach($data['saleinfo']->result() as $rowq);
				$bill_no=$rowq->bill_no;
				$sale_date=$rowq->sale_date;
				$net_amount=$rowq->net_amount;
				$total_amount=$rowq->total_amount;
				
				$digits = 3;
				$invoiceid = rand(pow(100, $digits-1), pow(100, $digits)-1);
				$invoiceGen=array(
						'cust_id'=>$cust_id,
						'bill_no'=>$bill_no,
						'invoice_id'=>$invoiceid,
						'create_date'=>date('Y-m-d')
						);
				$lastInvoiceId = $this->Index_model->inertTable('sale_invoice', $invoiceGen);
				
				//Get total invoice for customer
				$custinvoice = $this->Index_model->getDataById('invoice','cust_id',$cust_id,'inv_id','desc','');
				$custTotalInv = $custinvoice->num_rows();
				
				//Get total invoice for table
				$totalDBInvQue = $this->Index_model->getDataById('invoice','','','inv_id','desc','');
				$totalDBInv = $totalDBInvQue->num_rows();
			
					$customerPayment=array(
						'customer_id'=>$cust_id,
						'invoice_type'=>'Invoice',
						'invoice'=>$bill_no,
						'sale_amount'=>$total_amount,
						'paid_amount'=>$net_amount,
						'total_invoice'=>$custTotalInv+1,
						'total_db_invoice'=>$totalDBInv,
						'pay_method'=>'Cash',
						'payment_date'=>date('Y-m-d')
						);
				$this->Index_model->inertTable('customer_payment', $customerPayment);	
				redirect('admin/sale_invoice/'.$lastInvoiceId);
			}
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}
	}
	
	function sale_invoice($inpoiceId)
	 {
		 //if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		 	
			if(!$inpoiceId) redirect('error');
		 	$invoiceData= $this->Index_model->getDataById('sale_invoice','inv_id',$inpoiceId,'inv_id','desc','1');
			foreach($invoiceData->result() as $inv);
			$invoice_id = $inv->invoice_id;
			$bill = $inv->bill_no;
			$inv_id = $inv->inv_id;
			$data['invoice_id']=$invoice_id;
			$data['billno']=$bill;
			$data['inv_id']=$inv_id;
			$data['title']="Sale Invoice for ".$bill." No Bill | CMSN Networks";
			
			$data['saleinfo'] = $this->Index_model->getAllItemTable('sale_details','bill_no',$bill,'','','id','desc');
			if($data['saleinfo']->num_rows() > 0){
				foreach($data['saleinfo']->result() as $rowq);
				$bill_no=$rowq->bill_no;
				$customer_id=$rowq->cust_id;
				$transport_cost=$rowq->transport_cost;
				$sale_date=$rowq->sale_date;
				$total_qty=$rowq->total_qty;
				$total_amount=number_format($rowq->total_amount,'2','.',',');
				$payment=number_format($rowq->payment,'2','.',',');
				$com_type=$rowq->com_type;
				$commission=$rowq->commission;
				$vat=$rowq->vat;
				$due=number_format($rowq->due,'2','.',',');
				$net_amount=number_format($rowq->net_amount,'2','.',',');
			}
			else{
				$bill_no='';
				$customer_id='';
				$transport_cost=0;
				$sale_date=0;
				$total_qty=0;
				$total_amount=0;
				$payment=0;
				$com_type=0;
				$commission=0;
				$vat=0;
				$due=0;
				$net_amount=0;
			}
			
			$data['bill_no']=$bill_no;
			$data['transport_cost']=$transport_cost;
			$data['sale_date']=$sale_date;
			$data['total_qty']=$total_qty;
			$data['billamount']=$total_amount;
			$data['payment']=$payment;
			$data['com_type']=$com_type;
			$data['commission']=$commission;
			$data['totalvat']=$vat;
			$data['net_amount']=$net_amount;
			$data['billdue']=$due;
			
			$data['customer_info']= $this->Index_model->getDataById('customers','customer_id',$customer_id,'customer_id','desc','');
			$data['sale_pro_info']= $this->Index_model->getDataById('sale_product_info','bill_no',$bill_no,'id','desc','');
			
			$querypay=$this->db->query("SELECT SUM(sale_amount) AS total,SUM(paid_amount) AS paid FROM customer_payment WHERE customer_id='".$customer_id."'");
			if($querypay->num_rows() > 0){
				$rowPay = $querypay->row_array();
				$prevTotal = $rowPay['total'];
				$prevPaid = $rowPay['paid'];
				$fprevd = $prevTotal-$prevPaid;
			}
			else{
				$fprevd = 0;
			}
			$data['prevDue']=$fprevd;
			
			if($this->input->get('status') && $this->input->get('status')!=""){
				$this->load->view('admin/sale/invoice_print', $data);
			}
			else{
				$data['main_content']="admin/sale/invoice";
				$this->load->view('admin_template', $data);
			}
	}
		
	
	
	
	
	
	///////////  Reports Information ///////////////////////
	function daily_sale_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Daily Sale Reports | CMSN Networksbd";
		$today=date('Y-m-d');
		$data['todayOrder'] = $this->Index_model->getAllItemTable('orders','date',$today,'','','order_id','desc');
		
		
		if(!$printsegment){
			$data['main_content']='admin/reports/dailysell/dailySaleReport';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/dailysell/dailySaleReportPrint',$data);
		}
	} 
	
	
	function datewise_sale_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Date Wise Sale Reports | CMSN Networksbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/datewisesellreports/dateWiseReport';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/datewisesellreports/dateWiseReportPrint',$data);
		}
	} 
	
	
	function datewise_sale_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			if($this->input->get('printdata')!="" && $this->input->get('printdata')=='print'){
				$fromdate=$this->input->get('fdate');
				$todate=$this->input->get('tdate');
			}
			else{
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
		$sessiondata = array(
						'fromDate'=>$fromdate,
						'toDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		
		//$today=date('Y-m-d');
		//$data['datewisOrder'] = $this->db->query("SELECT * FROM orders WHERE date BETWEEN ('$fromdate' AND '$todate') ORDER BY order_id DESC");
		$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','','','date',$fromdate,$todate,'order_id','desc');
		
		$this->load->view('admin/reports/datewisesellreports/dateWiseReportAjax',$data);
	} 
	
	
	
	
	
	
//////////////////////////////////// Part Ladger//////////////////////
	
	
	function party_ladger()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$keywords = $this->input->post('keywords');
		 
		$data['title']="Date Wise Sale Reports | CMSN Networks";
		$data['customerslist'] = $this->Index_model->getTable('customers','customer_id','desc');
		$totalrecord = $this->Index_model->party_ladger_count($keywords);
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/party_ladger');
		$config['total_rows'] = $totalrecord;
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['partyladger'] = $this->Index_model->party_ladger($keywords,$config['per_page'],$page);
		
		if(!$printsegment){
			$data['main_content']='admin/reports/party_ladger/party_ladger';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/party_ladger/party_ladgerPrint',$data);
		}
	} 
	
	
	
	function party_ladger_details()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		$partyid=$this->uri->segment(3);
		$data['cuid'] = $partyid;
		$partyinfo = $this->Index_model->getAllItemTable('customers','customer_id',$partyid,'','','customer_id','desc');
		$crow = $partyinfo->row_array();
		$data['customername'] = $crow['name'];
		$data['prev_balance'] = $crow['prev_balance'];
		
		if($this->input->get('fdate')!="" && $this->input->get('tdate')!=""){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		$data['datewisOrder'] = $this->Index_model->getItemBetween('customer_payment','customer_id',$partyid,'date',$fromdate,$todate,'id','asc');

		$data['main_content']='admin/reports/party_ladger/party_details';
		$this->load->view('admin_template',$data);
	}
	
	
	function party_ladger_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		$partyid=$this->uri->segment(3);
		$partyinfo = $this->Index_model->getAllItemTable('customers','customer_id',$partyid,'','','customer_id','desc');
		$crow = $partyinfo->row_array();
		$data['custcode'] = $crow['cid'];
		$data['customername'] = $crow['name'];
		$data['custphone'] = $crow['mobile'];
		$data['address'] = $crow['address'];
		$data['prev_balance'] = $crow['prev_balance'];
		
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		$data['datewisOrder'] = $this->Index_model->getItemBetween('customer_payment','customer_id',$partyid,'date',$fromdate,$todate,'id','asc');

		$this->load->view('admin/reports/party_ladger/party_ladgerPrint',$data);
	} 
	
	
	function party_details()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		$partyid=$this->uri->segment(3);
		$partyinfo = $this->Index_model->getAllItemTable('customers','customer_id',$partyid,'','','customer_id','desc');
		$crow = $partyinfo->row_array();
		$data['customername'] = $crow['name'];
		
		if($this->input->get('fdate')!="" && $this->input->get('tdate')!=""){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		
		
		$data['datewisOrder'] = $this->Index_model->getItemBetween('orders','customer_id',$partyid,'date',$fromdate,$todate,'order_id','desc');
		$data['main_content']='admin/reports/sale_reports/party_details';
		$this->load->view('admin_template',$data);
	} 
	
///////////////////// Sale Reports Buyer and Date wise ////////////////////////////////	
	function sale_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		
		$data['title']="Date Wise Sale Reports | CMSN Networks";
		$data['customerslist'] = $this->Index_model->getTable('customers','customer_id','desc');
		$totalrecord = $this->Index_model->sale_reports_count('customers','name');
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/sale_reports');
		$config['total_rows'] = $totalrecord;
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['partyladger'] = $this->Index_model->sale_reports('customers','name',$config['per_page'],$page);
		
		/*$sessiondata = array(
							'fromDate'=>'',
							'toDate'=> '',
							'customerid'=> ''
						   );
		$this->session->set_userdata($sessiondata);*/
			
		if(!$printsegment){
			$data['main_content']='admin/reports/sale_reports/sale_reports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/sale_reports/sale_reportsPrint',$data);
		}
	} 
	
	
	function sale_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->get('fdate')!="" && $this->input->get('tdate')!=""){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$customerid=$this->input->get('customer_id');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'customerid'=> $customerid
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$customerid=$this->session->userdata('customerid');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$customerid=$this->session->userdata('customerid');
		}
		$data['customerid']=$customerid;
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		
		$data['partyladger'] = $this->Index_model->getAllItemTable('customers','customer_id',$customerid,'','','customer_id','desc');		
		$this->load->view('admin/reports/sale_reports/sale_reportsAjax',$data);
	} 
	
	


///////////////////// Sale Reports Buyer and Date wise ////////////////////////////////	
	function sale_products_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['customerslist'] = $this->Index_model->getTable('customers','customer_id','desc');
		
		$data['title']="Date Wise Sale Reports | CMSN Networks";
		$totalrecord = $this->Index_model->sale_reports_count('product','product_name');
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/sale_reports');
		$config['total_rows'] = $totalrecord;
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		//$data['partyladger'] = $this->Index_model->sale_reports('product','product_name',$config['per_page'],$page);
		$data['saleproductinfo'] = $this->Index_model->sale_reports('sale_product_info','date',$config['per_page'],$page);
			
		if(!$printsegment){
			$data['main_content']='admin/reports/sale_reports/sale_products_reports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/sale_reports/sale_products_reportsPrint',$data);
		}
	} 
	
	
	function sale_products_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->get('sum_type')!=""){
			if($this->input->get('fdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			}
			else{
				$fromdate='';
			}
			if($this->input->get('tdate')!=""){
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
			else{
				$todate='';
			}	
			
			$sum_type=$this->input->get('sum_type');
			$pro_id=$this->input->get('pro_id');
			$customerid=$this->input->get('customer_id');
			$reporttype=$this->input->get('reporttype');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'sum_type'=> $sum_type,
							'pro_id'=> $pro_id,
							'reporttype'=> $reporttype,
							'customerid'=> $customerid
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sum_type=$this->session->userdata('sum_type');
			$pro_id=$this->session->userdata('pro_id');
			$customerid=$this->session->userdata('customerid');
			$reporttype=$this->session->userdata('reporttype');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sum_type=$this->session->userdata('sum_type');
			$pro_id=$this->session->userdata('pro_id');
			$customerid=$this->session->userdata('customerid');
			$reporttype=$this->session->userdata('reporttype');
		}
		$data['sum_type']=$sum_type;
		$data['pro_id']=$pro_id;
		$data['customerid']=$customerid;
		$data['reporttype']=$reporttype;
		$data['todate']=$todate;
		$data['fromdate']=$fromdate;
		$today = date('Y-m-d');
		
		if($sum_type=="Daily"){
			if($pro_id=="" && $customerid!=""){
				$sql = "SELECT * FROM sale_product_info WHERE cust_id = '".$customerid."' AND date = '".$today."'";
			}
			elseif($pro_id!="" && $customerid==""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."' AND date = '".$today."'";
			}
			else{
				$sql = "SELECT * FROM sale_product_info";
			}
		}
		else{
			if($pro_id!="" && $customerid!="" && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."' AND cust_id = '".$customerid."' AND (date BETWEEN '$fromdate' AND '$todate')";
			}
			elseif($pro_id!="" && $customerid!=""  && $fromdate!=""  && $todate==""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."'  AND cust_id = '".$customerid."' AND date = '".$fromdate."'";
			}
			elseif($pro_id!="" && $customerid!=""  && $fromdate==""  && $todate!=""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."' AND cust_id = '".$customerid."'  AND date = '".$todate."'";
			}
			elseif($pro_id!="" && $customerid!=""  && $fromdate==""  && $todate==""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."' AND cust_id = '".$customerid."' ";
			}
			elseif($pro_id=="" && $customerid!=""  && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM sale_product_info WHERE cust_id = '".$customerid."'  AND (date BETWEEN '$fromdate' AND '$todate')";
			}
			elseif($pro_id!="" && $customerid==""  && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM sale_product_info WHERE product_id = '".$pro_id."'  AND (date BETWEEN '$fromdate' AND '$todate')";
			}
			else{
				$sql = "SELECT * FROM sale_product_info";
			}
		}
		
		$data['saleproductinfo'] = $this->db->query($sql);
		if($reporttype=="By Bill"){
			$pagename = 'sale_bill_reportsAjax';
		}
		else{
			$pagename = 'sale_products_reportsAjax';
		}			
		$this->load->view('admin/reports/sale_reports/'.$pagename, $data);
	} 
	
	
	
	
///////////////////// Sale Reports Buyer and Date wise ////////////////////////////////	
	function purchase_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		
		$data['title']="Date Wise Sale Reports | CMSN Networks";
		$totalrecord = $this->Index_model->sale_reports_count('product','product_name');
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/purchase_reports');
		$config['total_rows'] = $totalrecord;
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
			
		if(!$printsegment){
			$data['main_content']='admin/reports/purchase_repports/pur_products_reports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/purchase_repports/pur_products_reportsPrint',$data);
		}
	} 
	
	
	function purchase_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->get('sum_type')!=""){
			if($this->input->get('fdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			}
			else{
				$fromdate='';
			}
			if($this->input->get('tdate')!=""){
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
			else{
				$todate='';
			}	
			
			$sum_type=$this->input->get('sum_type');
			$pro_id=$this->input->get('pro_id');
			$supplier_id=$this->input->get('supplier_id');
			$reporttype=$this->input->get('reporttype');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'sum_type'=> $sum_type,
							'pro_id'=> $pro_id,
							'reporttype'=> $reporttype,
							'supplier_id'=> $supplier_id
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sum_type=$this->session->userdata('sum_type');
			$pro_id=$this->session->userdata('pro_id');
			$supplier_id=$this->session->userdata('supplier_id');
			$reporttype=$this->session->userdata('reporttype');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sum_type=$this->session->userdata('sum_type');
			$pro_id=$this->session->userdata('pro_id');
			$supplier_id=$this->session->userdata('supplier_id');
			$reporttype=$this->session->userdata('reporttype');
		}
		$data['sum_type']=$sum_type;
		$data['pro_id']=$pro_id;
		$data['supplier_id']=$supplier_id;
		$data['reporttype']=$reporttype;
		$data['todate']=$todate;
		$data['fromdate']=$fromdate;
		$today = date('Y-m-d');
		
		if($sum_type=="Daily"){
			if($pro_id=="" && $supplier_id!=""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE supplier_id = '".$supplier_id."' AND bid_todaydate = '".$today."'";
			}
			elseif($pro_id!="" && $supplier_id==""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."' AND bid_todaydate = '".$today."'";
			}
			else{
				$sql = "SELECT * FROM purchase_invoice_details";
			}
		}
		else{
			if($pro_id!="" && $supplier_id!="" && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."' AND supplier_id = '".$supplier_id."' AND (bid_todaydate BETWEEN '$fromdate' AND '$todate')";
			}
			elseif($pro_id!="" && $supplier_id!=""  && $fromdate!=""  && $todate==""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."'  AND supplier_id = '".$supplier_id."' AND bid_todaydate = '".$fromdate."'";
			}
			elseif($pro_id!="" && $supplier_id!=""  && $fromdate==""  && $todate!=""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."' AND supplier_id = '".$supplier_id."'  AND bid_todaydate = '".$todate."'";
			}
			elseif($pro_id!="" && $supplier_id!=""  && $fromdate==""  && $todate==""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."' AND supplier_id = '".$supplier_id."' ";
			}
			elseif($pro_id=="" && $supplier_id!=""  && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE supplier_id = '".$supplier_id."'  AND (bid_todaydate BETWEEN '$fromdate' AND '$todate')";
			}
			elseif($pro_id!="" && $supplier_id==""  && $fromdate!=""  && $todate!=""){
				$sql = "SELECT * FROM purchase_invoice_details WHERE bid_pid = '".$pro_id."'  AND (bid_todaydate BETWEEN '$fromdate' AND '$todate')";
			}
			else{
				$sql = "SELECT * FROM purchase_invoice_details";
			}
		}
		
		$data['purproductinfo'] = $this->db->query($sql);
		if($reporttype=="By Supplier"){
			$pagename = 'pur_bill_reportsAjax';
		}
		else{
			$pagename = 'pur_products_reportsAjax';
		}			
		$this->load->view('admin/reports/purchase_repports/'.$pagename, $data);
	} 



		
//////////////////////// Cash book ////////////////////////
	function cashbook()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Party Details| CMSN Networksbd";
		$data['main_content']='admin/reports/cashbook/cashbook';
		$data['salse_rep'] = $this->Index_model->getAllItemTable('sales_represntative','','','','','user_id','desc');
		//$this->load->view('admin/reports/cashbook/cashbook',$data);
		$this->load->view('admin_template',$data);
	}
	
	
	function cashbook_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		$sales_id=$this->input->get('sales_id');
		$srinfo = $this->Index_model->getAllItemTable('sales_represntative','user_id',$sales_id,'','','user_id','desc');
		$crow = $srinfo->row_array();
		$data['srname'] = $crow['username'];
		$data['srcode'] = $crow['code'];
		$data['salserepid'] = $crow['user_id'];
		
		if($this->input->get('action')!="" && $this->input->get('action')=='View Reports'){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sales_id=$this->input->get('sales_id');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'sales_id'=> $sales_id,
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sales_id=$this->session->userdata('sales_id');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$sales_id=$this->session->userdata('sales_id');
		}
		$data['sales_id']=$sales_id;
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		$data['todaydate']=date('Y-m-d');
		$today = date('Y-m-d');
		
		$sql = "SELECT * FROM customer_payment WHERE (payment_date BETWEEN '$fromdate' AND '$todate')";
		$data['party_pay_list'] = $this->db->query($sql);
		
		$this->load->view('admin/reports/cashbook/cashbook_print',$data);
	}
	
	
	
	function today_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Today Reports | CMSN Networksbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/todayReports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/todayReportsPrint',$data);
		}
	} 
	
	function datewise_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Date Wise Reports| CMSN Networksbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/dateWiseReports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/dateWiseReportsPrint',$data);
		}
	} 
	
	
	function datewise_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
	    $todate=date('Y-m-d',strtotime($this->input->get('tdate')));
		$sessiondata = array(
						'toDate'=>$fromdate,
						'fromDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$data['fromdate']=$this->session->userdata('toDate');
		$data['todate']=$this->session->userdata('fromDate');
		$this->load->view('admin/reports/dateWiseReportAjax',$data);
	} 
	
	
	function purchasereport()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Purchase Invoice Reports| CMSN Networksbd";
		if(!$printsegment){
			$data['main_content']='admin/reports/purchaseinvoice_report';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/purchaseinvoice_reportPrint',$data);
		}
	} 
	
	function purchase_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
	    $todate=date('Y-m-d',strtotime($this->input->get('tdate')));

		$sessiondata = array(
						'toDate'=>$fromdate,
						'fromDate'=> $todate
					   );
		$this->session->set_userdata($sessiondata);
		$data['fromdate']=$this->session->userdata('toDate');
		$data['todate']=$this->session->userdata('fromDate');
		$this->load->view('admin/reports/purchaseReportAjax',$data);
	} 
	
	
	
	//============================== Purchase ===================================
	
	
	
	
	function getAllSupplierProduct()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->get('supplierid')!=""){
			$rid=$this->input->get('supplierid');
			$sroot_menu = $this->Index_model->getAllItemTable('product','supplier',$rid,'','','product_name','asc');
			$svar='<select name="pro_name" id="pro_name" class="form-control" required onchange="selectedItem();hoverChange(this.id);" >
								<option value="">Select Product</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->product_id.'~'.$rootmenu->product_name.'">'.$rootmenu->product_name.'</option>';
								endforeach;
							$svar .= '</select>';
		}
		else{
			$svar='<select name="pro_name" id="pro_name" class="form-control" required onchange="selectedItem();hoverChange(this.id)" >
								<option value="">Select Product</option>
					</select>';
		}
	
		echo $svar;
	}
	
	function purchase()
	{
	 	//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']		= "Dashboard CMSN Networks | inventory";
		$data['inv_no']		= $this->Stock_model->purchaseinvoice();
		$data['product'] = $this->Index_model->getInstockProduct();
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		$data['stocklist'] = $this->Index_model->getTable('stock_manage','id','asc');
		$data['unitslist'] = $this->Index_model->getTable('units','unit_id','desc');
		
		
		$data['main_content']="admin/purchase/purchase_invoice_view";
        $this->load->view('admin_template',$data);
	
	}
	
	function stockProduct()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']			= "Stock";
		$data['product_list'] = $this->Index_model->getInstockProduct();
		
		$data['main_content']="admin/stock/stock";
        $this->load->view('admin_template',$data);
	
	}
	
	function stockTransfer()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']			= "Stock Transfer";
		$data['stock_list'] = $this->Index_model->getTable('stock_manage','id','desc');
		if($this->input->post('stocktransfer') && $this->input->post('stocktransfer')!=""){
			$stock_form = $this->input->post('stock_from');
			$stock_to = $this->input->post('stock_to');
			$transfer_date = $this->input->post('transfer_date');
			$pro_id = $this->input->post('products_id');
			$transfer_qty = $this->input->post('transfer_qty');
		
			$save = array(
				'stock_from'=>$stock_form,
				'qty'=>$transfer_qty,
				'stock_to'=>$stock_to,
				'transfer_date'=>$transfer_date,
				'pro_id'=>$pro_id
			);
			$query = $this->Index_model->inertTable('stock_transfer', $save);
			if($query){	
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Trasfer</h2>');
				redirect('admin/stockTransfer', 'refresh');
			}	
		}
		else{
			$data['main_content']="admin/stock/transfer";
        	$this->load->view('admin_template',$data);
		}
	}
	
	
	function getStockQty()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
			$value=$this->input->get('value');
			$trnType=$this->input->get('trnType');
			
			if($trnType=="stockfrom"){
				$querypay=$this->db->query("SELECT SUM(init_qty) AS iQty, 
					SUM(pur_qty) AS pQty, 
					SUM(stk_in) AS sinQty, 
					SUM(stk_out) AS soQty , 
					SUM(sale_qty) AS slQty FROM stock WHERE stock_id ='".$value."'");
						$stRow = $querypay->row_array();
							$purQty = $stRow['pQty'];
							$iniQty = $stRow['iQty'];
							$stinQty = $stRow['sinQty'];							
							$sOutnQty = $stRow['soQty'];
							$saleQty = $stRow['slQty'];
							
							$plusQty = $purQty + $iniQty + $stinQty;							
							$minusQty = $sOutnQty + $saleQty;
							
						$totalQty = intval($plusQty) - intval($minusQty);
				$arrayData = array("id"=>"stk_from_qty","totalQty"=>$totalQty);
				echo json_encode($arrayData);
			}
			elseif($trnType=="stockto"){
				$querypay=$this->db->query("SELECT SUM(init_qty) AS iQty, 
					SUM(pur_qty) AS pQty, 
					SUM(stk_in) AS sinQty, 
					SUM(stk_out) AS soQty , 
					SUM(sale_qty) AS slQty FROM stock WHERE stock_id ='".$value."'");
						$stRow = $querypay->row_array();
							$purQty = $stRow['pQty'];
							$iniQty = $stRow['iQty'];
							$stinQty = $stRow['sinQty'];							
							$sOutnQty = $stRow['soQty'];
							$saleQty = $stRow['slQty'];
							
							$plusQty = $purQty + $iniQty + $stinQty;							
							$minusQty = $sOutnQty + $saleQty;
							
						$totalQty = intval($plusQty) - intval($minusQty);
				$arrayData = array("id"=>"stk_to_qty","totalQty"=>$totalQty);
				echo json_encode($arrayData);
			}
					
	}
	
	
	
	function finditem()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$itemname = $this->input->post('pro_name');
		$data = $this->Stock_model->finditem_($itemname);
		echo $data;
	}
	
	public function purchaseinvoice()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$invNO=$this->input->post('invoice');
		
		$date=$this->input->post('date');
		list($month,$day,$year)=explode('/',$date);
		$mainDate=$year.'-'.$month.'-'.$day;
		
		$supplier_id=$this->input->post('supplier');
		$stockid=$this->input->post('stockid');
		$minvoice=$this->input->post('minvoice');

		$net_total=$this->input->post('net_total');

		$pro_code 		= $this->input->post('pro_code1');
		$pro_name	 	= $this->input->post('pro_name1');
		$pro_id			= $this->input->post('pro_id1');
		$qty			= $this->input->post('qty1');
		$price 			= $this->input->post('price1');
		$net			= $this->input->post('net1');
		
		$this->Stock_model->invoice_submit($invNO,$stockid,$supplier_id,$mainDate,$mainDeliDate,$net_total,$pro_code,$pro_name,$pro_id,$units,$qty,$price,$net,$minvoice);
		
		redirect('Stockmanagement/purchase');
	}
	
	function stock_update()
	{	
	//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$update['pro_id']=$this->input->post('product_id');
		
			$query = $this->db->query("select * from stock where pro_id ='".$update['pro_id']."'");
			if($query->num_rows() > 0){
				foreach($query->result() as $row);
				$qty = $row->pro_qty; 
			}
			else{
				$qty=0;	
			}	
		$add = $this->input->post('add');
		$minus = $this->input->post('minus');
		$return = $this->input->post('return');
		
			if(isset($add) && $add=='Add'){
				//$update['increase']=$this->input->post('pluse_qty');
				//$update['increase_note']=$this->input->post('pluse_note');
				$update['pro_qty']=$qty + $this->input->post('pluse_qty');
				$update['date']=date('Y-m-d');
				$save="";
				$status = 'stockin';
			}
			elseif(isset($minus) && $minus=='Minus'){
				//$update['decrease']=$this->input->post('minus_qty');
				//$update['decrease_note']=$this->input->post('minus_note');
				$update['pro_qty']=$qty - $this->input->post('minus_qty');
				$update['date']=date('Y-m-d');
				
				$save['pro_id']=$this->input->post('product_id');
				$save['buy_type']="Whole Sale";
				$save['buyername']=$this->input->post('buyername');
				$save['buyercontact']=$this->input->post('buyercontact');
				$save['buyeremail']=$this->input->post('buyeremail');
				$save['pro_qty']=$this->input->post('minus_qty');
				$save['remarks']=$this->input->post('remarks');
				$save['out_date']=date('Y-m-d');
				$status = 'stockout';
			}
			elseif(isset($return) && $return=='Return'){
				//$update['return_qty']=$this->input->post('return_qty');
				//$update['return_notes']=$this->input->post('return_notes');
				$update['pro_qty']=$qty + $this->input->post('return_qty');
				$update['date']=date('Y-m-d');
				
				$save['pro_id']=$this->input->post('product_id');
				$save['invoiceno']=$this->input->post('invoiceno');
				$save['sell_type']=$this->input->post('sell_type');
				$save['buyername']=$this->input->post('buyername');
				$save['buyercontact']=$this->input->post('buyercontact');
				$save['buyeremail']=$this->input->post('buyeremail');
				$save['pro_qty']=$this->input->post('return_qty');
				$save['remarks']=$this->input->post('remarks');
				$save['ret_date']=date('Y-m-d');
				$status = 'return';
			}
		$this->Index_model->stock_update($update,$save,$status); 
		redirect('admin/purchasestock', '');
	}
	
	
///////////////////////////////////////////// Stock Reports//////////////////////////////////

function stock()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']="Party Details| CMSN Networksbd";
		$data['main_content']='admin/reports/stock/stock';
		$data['salse_rep'] = $this->Index_model->getAllItemTable('sales_represntative','','','','','user_id','desc');
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		$data['stocklist'] = $this->Index_model->getTable('stock_manage','id','asc');
		//$this->load->view('admin/reports/stock/stock',$data);
		$this->load->view('admin_template',$data);
	}
	
	
	function stock_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		
		if($this->input->get('action')!="" && $this->input->get('action')=='Reports'){
			if($this->input->get('fdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			}
			else{
				$fromdate='';
			}
			if($this->input->get('tdate')!=""){
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			}
			else{
				$todate='';
			}	

			$products_id=$this->input->get('products_id');
			$supplier=$this->input->get('supplier');
			$stockid=$this->input->get('stockid');
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate,
							'products_id'=> $products_id,
							'supplier'=> $supplier,
							'stockid'=> $stockid
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$products_id=$this->session->userdata('products_id');
			$supplier=$this->session->userdata('supplier');
			$stockid=$this->session->userdata('stockid');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
			$products_id=$this->session->userdata('products_id');
			$supplier=$this->session->userdata('supplier');
			$stockid=$this->session->userdata('stockid');
		}
		$data['supplier']=$supplier;
		$data['stockid']=$stockid;
		$data['products_id']=$products_id;
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		$today = date('Y-m-d');
		
		
		
		if($supplier!="" && $stockid!="" && $products_id!="" && $fromdate!=""  && $todate!=""){
			$sql = "SELECT * FROM stock WHERE product_id = '".$products_id."' AND stock_id = '".$stockid."' 
			AND supplier_id = '".$supplier_id."' AND (date BETWEEN '$fromdate' AND '$todate')";
		}
		elseif($supplier!="" && $stockid!="" && $products_id!="" && $fromdate!=""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE product_id = '".$products_id."' AND stock_id = '".$stockid."' 
			AND supplier_id = '".$supplier_id."' AND date = '".$fromdate."'";
		}
		elseif($supplier!="" && $stockid!="" && $products_id!="" && $fromdate==""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE product_id = '".$products_id."' AND stock_id = '".$stockid."' 
			AND supplier_id = '".$supplier_id."'";
		}
		elseif($supplier!="" && $stockid!="" && $products_id=="" && $fromdate==""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE stock_id = '".$stockid."' AND supplier_id = '".$supplier_id."'";
		}
		elseif($supplier=="" && $stockid=="" && $products_id!="" && $fromdate==""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE product_id = '".$products_id."'";
		}
		elseif($supplier!="" && $stockid=="" && $products_id=="" && $fromdate==""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE supplier_id = '".$supplier_id."'";
		}
		elseif($supplier=="" && $stockid="" && $products_id=="" && $fromdate==""  && $todate==""){
			$sql = "SELECT * FROM stock WHERE stock_id = '".$stockid."'";
		}
		elseif($supplier=="" && $stockid=="" && $products_id=="" && $fromdate!=""  && $todate!=""){
			$sql = "SELECT * FROM stock WHERE (date BETWEEN '$fromdate' AND '$todate')";
		}
		else{
			$sql = "SELECT * FROM stock";
		}
		
		
		
		$data['party_pay_list'] = $this->db->query($sql);
		$this->load->view('admin/reports/stock/stock_print',$data);
	}
	
	
	function stockin_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$data['title']="Current Stock Reports | CMSN Networks";
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		if(!$printsegment){
			$data['main_content']='admin/reports/stockin/stockinReport';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/stockin/stockinReportPrint',$data);
		}
	} 
	
	
	function stockin_reports_ajax()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
			
			if($this->input->get('key')!=""){
				$keyword = $this->input->get('key');
				$sessiondata = array(
							'keyval'=>$keyword
						   );
				$this->session->set_userdata($sessiondata);
				$proKey=$this->session->userdata('keyval');
				
				$sqlPeo=$this->db->query("select * from product where (product_name LIKE '%$proKey%' OR pro_code LIKE '%$proKey%') order by product_id desc");
				foreach($sqlPeo->result() as $pr){
					$proid[] = $pr->product_id;
				}
				$arrPro = join(',',$proid);
				$sql=$this->db->query("select * from stock where pro_id IN($arrPro) order by s_id desc");
			}
			
			elseif($this->input->get('currentstock')!=""){
				$sql=$this->db->query("select * from stock order by s_id desc");
			}
			elseif($this->input->get('tdate')!=""){
				$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
				$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
				$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
				$this->session->set_userdata($sessiondata);
				$fromdate=$this->session->userdata('fromDate');
				$todate=$this->session->userdata('toDate');
				$sql=$this->db->query("select * from stock where (date between '$fromdate' and '$todate') order by s_id desc");
			}
			
			
		$data['stockreport'] = $sql;
		$this->load->view('admin/reports/stockin/stockinReportAjax',$data);
	} 
	
	
	
//////////////////////////////////////////Pre Order Panel//////////*****************************/////////////////////////////////////////
////////////////////===========================++++++++++++++++++=======================================================///	
	
	
	
	
//////////////////////////////////////////Common for all/////////*****************************/////////////////////////////////////////
////////////////////===========================++++++++++++++++++=======================================================///	
	
	
	function cleareCachDate()
	{
		$sessiondata = array(
						'toDate'=>'',
						'fromDate'=> '',
						'customerid'=> ''
					   );
		$this->session->set_userdata($sessiondata);
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	} 
	
	

	
	
	function _CreatePageThumbnail($filename, $dir,$w,$h) {
        $config['image_library']    = "gd2";      
        $config['source_image']     = $dir.$filename; 
		$config['new_image']		= $dir.'thumnail';
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = $w;      
        $config['height'] = $h;
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize()):
            echo $this->image_lib->display_errors();
       	endif;   
    }
		
///////////  All  Delete///////////////////////
	
public function pre_deleteData($tableName,$colId){
	//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}	
	
	function ajaxMenu()
	{
		if($this->input->get('menu_id')!=""){
			$rid=$this->input->get('menu_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
			$svar='<select name="root_id" id="root_id" class="form-control">
								<option value="">Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->slug.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxCategory()
	{
		if($this->input->get('class_id')!=""){
			$rid=$this->input->get('class_id');
			$url="'".base_url()."admin/ajaxCategory?cat_id='+this.value+''";
			
			
			$sroot_menu = $this->Index_model->getAllItemTable('category','class_id',$rid,'','','cat_name','asc');
			$svar='<select name="cat_id" id="cat_id" class="form-control" required onChange="getCategory('.$url.')">
								<option value="">Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->caegory_title.'">'.$rootmenu->cat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('cat_id')!=""){
			$rid=$this->input->get('cat_id');
			$url="'".base_url()."admin/ajaxCategory?subcat_id='+this.value+''";
			$urlsize="'".base_url()."admin/ajaxCategorySize?cat_id='+this.value+'&&size='+size'";
			$sroot_menu = $this->Index_model->getAllItemTable('sub_category','cat_id',$rid,'','','sub_cat_name','asc');
			$svar='<select name="subcat_id" id="subcat_id" class="form-control" onChange="getSubCategory('.$url.');getCity_size('.$urlsize.')">
								<option value="">Sub Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->sub_cat_title.'">'.$rootmenu->sub_cat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('subcat_id')!=""){
			$rid=$this->input->get('subcat_id');
			$sroot_menu = $this->Index_model->getAllItemTable('last_category','subcat_id',$rid,'','','lastcat_name','asc');
			$svar='<select name="lastcat_id" id="lastcat_id" class="form-control">
								<option value="">Last Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->last_cat_title.'">'.$rootmenu->lastcat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxCategorySize()
	{
		//if($this->input->get('cat_id')!="" && $this->input->get('size')=="size"){
			$cat_id=$this->input->get('cat_id');
			$catSize = $this->Index_model->getAllItemTable('size','cat_id',$cat_id,'','','size','asc');
			$svar='<select name="pro_size[]" id="size_id" class="form-control"  multiple="multiple" style="min-height:150px">
					  <option value="">Product Size</option>';
					   foreach($catSize->result() as $sizeval):
						  $svar .= '<option value="'.$sizeval->size.'">'.$sizeval->size.'</option>';
					  endforeach;
				$svar .= '</select>';
			echo $svar;
		//}
	}
	
	
	
	
	
	
	
	public function ajaxdata_()
	{
		$idSelect =$this->input->get('q');
        $this->Stock_model->ajaxdata_($idSelect);
	}	
	
	public function preajaxData_()
	{
		$idSelect =$this->input->get('q');
        $this->Pre_stock_model->ajaxData_($idSelect);
	}
	
	public function datapro()
	{
		$pro_name =$this->input->get('pro_name');
        $data=$this->Stock_model->datapro($pro_name);
 		echo $data;
	}
	public function predatapro()
	{
		$pro_name =$this->input->get('pro_name');
        $data=$this->Pre_Pre_stock_model->datapro($pro_name);
 		echo $data;
	}
	
	
	function sequenceManage()
	{
		$tbl=$this->input->get('tbl');
		$tid=$this->input->get('tid');
		$seqence=$this->input->get('sequence');
		$id=$this->input->get('id');
		
		$query = $this->db->query("select * from ".$tbl." where sequence='".$seqence."'");
			foreach($query->result() as $row);
			$sequenceVal=$row->sequence;
			$nid=$row->$tid;
			
			if($seqence!=$sequenceVal){
				$update=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
			else{
				$query1 = "select * from ".$tbl." where ".$tid."='".$id."'";
				$results1 = $this->db->query($query1);
				foreach($results1->result() as $row1);
				$sequenceVal1=$row1->sequence;
				$nid1=$row1->$tid;
			
				$update=$this->db->query("update ".$tbl." set sequence='".$sequenceVal1."' where ".$tid."='".$nid."'");
				$update1=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	
	
	
	
	
	
	/////////////////////// supplier shop  ////////////////////////////////	 
	function supplier_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="supplier Shop List | ".$this->cname;
		$data['supplierlist'] = $this->Index_model->getTable('supplier','user_id','desc');
		$data['main_content']="admin/supplier/supplier_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function supplier_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$artiId=$this->uri->segment(3);
		$data['title']="New supplier | ".$this->cname;
		$expensecode = $this->Index_model->getAllItemTable('supplier','','','','','code','desc');
		$rowExp = $expensecode->row_array();
		$data['lastCode'] = $rowExp['code']+1;

		$data['supplierUpdate'] = $this->Index_model->getAllItemTable('supplier','user_id',$artiId,'','','user_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			
		$this->form_validation->set_rules('supplier_name','supplier Name','required|trim');
		$this->form_validation->set_rules('code', 'Code', 'trim|required|is_unique[supplier.code]');
		
		if($this->form_validation->run() != false){
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/supplier/';
			$config['charset'] = "UTF-8";
			$new_name = "supplier_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (isset($_FILES['companyLogo']['name']))
			{
			if($this->upload->do_upload('companyLogo')){
					$upload_data	= $this->upload->data();
					$save['photo']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('stillImg');
					$save['photo']	= $upload_data;	
				}
			}
			
			$save['code']	    = $this->input->post('code');
			$save['username']	    = $this->input->post('supplier_name');
			$save['telephone']	    = $this->input->post('telephone');
			$save['mobile']	    = $this->input->post('mobile');
			$save['address']	    = $this->input->post('address');
			$save['website']	    = $this->input->post('website');
			$save['ownername']	    = $this->input->post('owner');
			$save['email']	    = $this->input->post('email');
			$save['date']	    = date('Y-m-d');
			$save['active']	    = 1;
			
			
				
				if($this->input->post('supplier_id')!=""){
					$b_id=$this->input->post('supplier_id');
					$query = $this->Index_model->update_table('supplier','user_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('supplier', $save);
					$s='Inserted';
					}
				if($query){	
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
					redirect('admin/supplier_list', 'refresh');
				}
			}
			else{
				$data['main_content']="admin/supplier/supplier_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/supplier/supplier_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	/////////////////////// sales_represntative shop  ////////////////////////////////	 
	function sales_represntative_list()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="sales_represntative Shop List | Butikbd";
		$data['sales_represntativelist'] = $this->Index_model->getTable('sales_represntative','user_id','desc');
		$data['main_content']="admin/sales_represntative/sales_represntative_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function sales_represntative_registration()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$artiId=$this->uri->segment(3);
		$data['title']="New sales_represntative Shop | Butikbd";
		

		$data['sales_represntativeUpdate'] = $this->Index_model->getAllItemTable('sales_represntative','user_id',$artiId,'','','user_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			
		$this->form_validation->set_rules('sales_represntative_name','sales_represntative Name','required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[sales_represntative.email]');
		$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[sales_represntative.mobile]');
				
		if($this->form_validation->run() != false){
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/sales_represntative/';
			$config['charset'] = "UTF-8";
			$new_name = "sales_represntative_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (isset($_FILES['companyLogo']['name']))
			{
			if($this->upload->do_upload('companyLogo')){
					$upload_data	= $this->upload->data();
					$save['photo']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('stillImg');
					$save['photo']	= $upload_data;	
				}
			}
			
			$save['username']	    = $this->input->post('sales_represntative_name');
			$save['mobile']	   		 = $this->input->post('mobile');
			$save['address']	    = $this->input->post('address');
			$save['email']	   		 = $this->input->post('email');
			$save['password']	    = md5($this->input->post('password'));
			$save['passwordHints']	= $this->input->post('password');
			$save['date']	    = date('Y-m-d');
			$save['active']	    = 1;
			
			
				
				if($this->input->post('sales_represntative_id')!=""){
					$b_id=$this->input->post('sales_represntative_id');
					$query = $this->Index_model->update_table('sales_represntative','user_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('sales_represntative', $save);
					$s='Inserted';
					}
				if($query){	
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
					redirect('admin/sales_represntative_list', 'refresh');
				}
			}
			else{
				$data['main_content']="admin/sales_represntative/sales_represntative_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/sales_represntative/sales_represntative_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	function approve()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_approve($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function deapprove()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_deapprove($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
///////////  All  Delete///////////////////////
public function deleteData($tableName,$colId){
	if(!$this->session->userdata('AdminAccessMail')) redirect("index");
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
		redirect($_SERVER['HTTP_REFERER'],'refresh');
}



//////////////////////////////////// Salse Representative Reports//////////////////////
	
	
	function sr_reports()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$printsegment=$this->uri->segment(3);
		$keywords = $this->input->post('keywords');
		 
		$data['title']="Date Wise Sale Reports | CMSN Networks";
		$data['customerslist'] = $this->Index_model->getTable('sales_represntative','user_id','desc');
		$totalrecord = $this->Index_model->sr_reports_count($keywords);
		
		$config = array();
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('admin/sr_reports');
		$config['total_rows'] = $totalrecord;
		$config['num_links'] = 10;
      	$config['per_page'] = 50;
		$config['uri_segment'] =3;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['partyladger'] = $this->Index_model->sr_reports($keywords,$config['per_page'],$page);
		
		if(!$printsegment){
			$data['main_content']='admin/reports/sr_reports/sr_reports';
			$this->load->view('admin_template',$data);
		}
		elseif($printsegment=='print'){
			$this->load->view('admin/reports/sr_reports/sr_reportsPrint',$data);
		}
	} 
	
	
	
	function sr_party_details()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		$partyid=$this->uri->segment(3);
		$data['cuid'] = $partyid;
		$srinfo = $this->Index_model->getAllItemTable('sales_represntative','user_id',$partyid,'','','user_id','desc');
		$crow = $srinfo->row_array();
		$data['srname'] = $crow['username'];
		$data['srcode'] = $crow['code'];
		$data['salserepid'] = $crow['user_id'];
		
		
		$data['party_pay_list'] = $this->Index_model->getAllItemTable('customer_payment','sales_id',$partyid,'','','id','desc');
		//$crow = $partyinfo->row_array();
		//$data['customername'] = $crow['name'];
		//$data['prev_balance'] = $crow['prev_balance'];
		
		/*if($this->input->get('fdate')!="" && $this->input->get('tdate')!=""){
			$fromdate=date('Y-m-d',strtotime($this->input->get('fdate')));
			$todate=date('Y-m-d',strtotime($this->input->get('tdate')));
			$sessiondata = array(
							'fromDate'=>$fromdate,
							'toDate'=> $todate
						   );
			$this->session->set_userdata($sessiondata);
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		else{
			$fromdate=$this->session->userdata('fromDate');
			$todate=$this->session->userdata('toDate');
		}
		
		$data['fromdate']=$fromdate;
		$data['todate']=$todate;
		$data['datewisOrder'] = $this->Index_model->getItemBetween('customer_payment','customer_id',$partyid,'date',$fromdate,$todate,'id','asc');*/

		$data['main_content']='admin/reports/sr_reports/party_details';
		$this->load->view('admin_template',$data);
	}
	
	
	function salse_party_print()
	{
		//if(!$this->session->userdata('AdminAccessMail')) redirect("admin");
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		$data['title']="Party Details| CMSN Networksbd";
		
		$partyid=$this->uri->segment(3);
		$data['cuid'] = $partyid;
		$srinfo = $this->Index_model->getAllItemTable('sales_represntative','user_id',$partyid,'','','user_id','desc');
		$crow = $srinfo->row_array();
		$data['srname'] = $crow['username'];
		$data['srcode'] = $crow['code'];
		$data['sraddress'] = $crow['address'];
		$data['salserepid'] = $crow['user_id'];
		
		
		$data['party_pay_list'] = $this->Index_model->getAllItemTable('customer_payment','sales_id',$partyid,'','','id','desc');
		
		$fromdate=$this->session->userdata('fromDate');
		$todate=$this->session->userdata('toDate');
		$data['fromdate']=$this->session->userdata('fromDate');
		$data['todate']=$this->session->userdata('toDate');
		//$data['datewisOrder'] = $this->Index_model->getItemBetween('customer_payment','customer_id',$partyid,'date',$fromdate,$todate,'id','asc');

		$this->load->view('admin/reports/sr_reports/sr_reportsPrint',$data);
	} 
	
}	
	
?>
