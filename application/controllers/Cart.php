<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public $cname;
	private $cmob;
	private $cem;
	private $cadd;
	private $clogo;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->model('Index_model');
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
		$data['title']	= 'Shopping Cart';
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if (!$this->cart->contents()){
			$this->data['message'] = '<p>Your cart is empty!</p>';
		}else{
			$this->data['message'] = $this->session->flashdata('message');
		}
		$this->session->set_flashdata('cartMsg', '<div class="alert alert-success">Your Item added into Shopping Cart</div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function shopping_cart()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['title']	= 'Shopping Cart';
		$data['message']	= '<p>Your cart is empty!</p>';
		//$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['main_content']="frontend/shopping_cart";
        $this->load->view('template', $data);
	}
			
	
	function view_trolly()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		$data['page_title']	= 'View Trolly';
		$data['message']	= '<p>Your cart is empty!</p>';
		$this->load->view('frontend/viewTrolly', $data);
	}
	
	function add()
	{
		$data['cname'] = $this->cname;
		$data['cmob'] = $this->cmob;
		$data['cem'] = $this->cem;
		$data['cadd'] = $this->cadd;
		$data['clogo'] = $this->clogo;
		
		if($this->input->post('productQuantity')!=""){
			$qty=$this->input->post('productQuantity');	
		}
		else{
			$qty=1;
		}
		$insert_room = array(
			'id'=> $this->input->post('id'),
			'name'=> preg_replace("/'/", '', $this->input->post('name')),
			'price' => $this->input->post('price'),
			'qty' => $qty,
			'options' => array(
					'shipment' => $this->input->post('shipment'))
		     );		
		$this->cart->insert($insert_room);
		//$jsondata = array('apply'=>'Successfully Added','user'=>'Loggedin','color'=>'#0e9a46');
		$this->session->set_flashdata('jobseekerssuccessMsg', '<div style="text-align:center; color:#02d652; margin-bottom:5px;">Successfully Added</div>');
		$fmsg = $this->session->flashdata('jobseekerssuccessMsg');
		
		$cartinfo = $this->cartinfo();
		$totalcart = $this->totalcartitem();
		$jsondata = array('msg'=>$fmsg,"cart_info"=>$cartinfo,"totalc"=>$totalcart);
		echo json_encode($jsondata);
		//redirect('cart');
	}
	
	public function totalcartitem(){
		$cart = $this->cart->contents();
		$totalItem=count($cart);
		//$totalItem=0;
		return $totalItem;
	}
	
	public function cartinfo(){
		 $str = '';
		 
		$cart = $this->cart->contents();
                                                               
		 $str .= '<ul class="dropdown-menu pull-right cart-dropdown-menu" style="margin:0; padding:10;max-height:500px; overflow:scroll; overflow-x:hidden">';
		 	$str .= '<li>
					  <table class="table"  width="100%" style="margin:0; padding:0;">
						<tbody>
						  <tr style="background:#2d2d2d; color:#fff">
							<td width="3%">Image</td>
							<td width="43%" style="padding:0; margin:0; font-size:10px;">Name</td>
							<td width="17%" style="padding:0; margin:0; font-size:10px;">Price</td>
							<td width="25%" style="padding:0; margin:0; font-size:10px;">Qty</td>
							<td width="12%" style="padding:0; margin:0; font-size:10px;" align="center" title="Remove">
							<i class="fa fa-times" aria-hidden="true" title="Remove"></i></td>
						  </tr>
						</tbody>
					  </table>
				 </li>';
							
							
			$grand_total = 0; $i = 1;
			foreach ($cart as $item):
				form_hidden('cart['. $item['id'] .'][id]', $item['id']);
				form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
				form_hidden('cart['. $item['id'] .'][name]', $item['name']);
				form_hidden('cart['. $item['id'] .'][price]', $item['price']);
				form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
				
				  $pro_id=$item['id'];
				  $result=$this->db->query("select * from product where product_id='$pro_id'");
				  $resPro=$result->result();
				  foreach($resPro as $pro);
				  $proslug = $pro->slug;
				  $main_image=$pro->main_image;
				  $pro_price=$pro->price;
				  $quantityBang = $pro->qty;
				  $grand_total = $grand_total + $item['subtotal'];
				  
				  $itemname = $item['name'];
				  $rowid = $item['rowid'];
				  
				  if(is_numeric($pro_price)){
						$convertTPrice =  number_format($pro_price,2);
					}
					else{
						$convertTPrice =  $pro_price;
					}
				 				  
				  $str .='
					<li>
					  <table class="table" style="margin:0; padding:0;">
						<tbody>
						  <tr>
							<td class="text-center"><a href="'.base_url("products/".$proslug).'">
							<img style="width:80px; height:40px" alt="'.$itemname.'" title="'.$itemname.'" 
							src="'.base_url().'uploads/images/product/main_img/'.$main_image.'"></a></td>
							<td class="text-left"><a href="'.base_url("products/".$proslug).'" style="font-size:11px;">'.$itemname.'</a></td>
							<td class="text-right">x '.$quantityBang.'</td>
							<td class="text-right">'.$convertTPrice.'</td>
							<td class="text-center">
							<button class="btn btn-danger btn-xs" title="Remove" type="button" style="padding:3px" 
							onclick="window.location.href='.base_url('cart/remove/'.$rowid).'"><i class="fa fa-times"></i></button>
							</td>
						  </tr>
						</tbody>
					  </table>
					</li>
				';
			endforeach;
			
			$grandTotalPrice = $grand_total;
				$str .= '<li>
							<table width="100%" style="margin:0; padding:0;">
								<tr style="background:#f8f8f8; padding:10px; width:100%; float:left">
									<td style="width:50%; font-weight:bold; font-size:16px; text-align:left; float:left" colspan="2" align="left">Total</td>
									<td style="width:50%; font-weight:bold; font-size:16px; text-align:right; float:right" align="right">'.$grandTotalPrice.'</td>
								</tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr>
									<td colspan="2" align="center" style="padding:10px;">
									<a href="'.base_url('cart/shopping_cart').'" class="btn btn-success" 
									style="font-size:18px; text-align:center; border-radius:10px;">Order Now</a></td>
								</tr>
							</table>
					  </li>';
		 $str .= '</ul>';
		return $str;
	}
	
	
	function remove($rowid) {
		if ($rowid=="all"){
			$this->cart->destroy();
			redirect('index');
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
			redirect('cart');
		}
		
		
	}	

	function update_cart(){
 		foreach($_POST['cart'] as $id => $cart)
		{			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->Cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
		}
		
		redirect('cart');
	}

}