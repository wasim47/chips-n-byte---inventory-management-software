<?php
Class Index_model extends CI_Model
{
	
	

// Menu 		
function getDataById($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($colId!=""){
				$this->db->where($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
	
	function subcategory_exist($key,$catid)
		{
			$this->db->where('sub_cat_name',$key);
			$this->db->where('cat_id',$catid);
			$query = $this->db->get('sub_category');
			return $query;
		}
		
	function totalOrder() 
	{
		$this->db->select('*');
		$this->db->from('orders');	
		$result=$this->db->get();
		return $result->num_rows();
	}
	
	
	function completedOrder($start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('orders');	
		$this->db->where('status','Delivered');
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}	
	
	
	function orderWithSearch($keyword,$custid,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('orders');	
		if($keyword!=""){
			if($custid!=""){
				$this->db->where('customer_id',$custid);
			}	
			else{
				$this->db->where('order_number',$keyword);
			}		
		}
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}	
	
	function getItemBetween($table,$colum,$id,$date,$startdate,$enddate,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($startdate!=""){
				  $this->db->where($date.' >=', $startdate);
				  $this->db->where($date.' <=', $enddate);
			  }
			  
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}
	

function getInstockProduct() 
	{
		$result=$this->db
			->order_by('product_id', 'desc')
		    ->get('product');
		    return $result;
	}
	
	function product_gallery($keyword,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('product');	
		if($keyword!=""){
			$this->db->like('product_name',$keyword);
		}	
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}	
	
	function sale_reports_count($table,$order) 
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order,'asc');	
		$result=$this->db->get();
		return $result->num_rows();
	}
	
	function sale_reports($table,$order,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from($table);	
		$this->db->order_by($order,'asc');
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}
	
	
	function party_ladger_count($keywords) 
	{
		$this->db->select('*');
		$this->db->from('customers');	
		if($keywords!=""){
			$this->db->where('customer_id',$keywords);
		}	
		$result=$this->db->get();
		return $result->num_rows();
	}
	
	function party_ladger($keywords,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('customers');	
		if($keywords!=""){
			$this->db->where('cid',$keywords);
			$this->db->or_like('mobile',$keywords);
			$this->db->or_like('name',$keywords);
		}
		$this->db->order_by('name','asc');
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}
	
	function sr_reports_count($keywords) 
	{
		$this->db->select('*');
		$this->db->from('sales_represntative');	
		if($keywords!=""){
			$this->db->where('user_id',$keywords);
		}	
		$result=$this->db->get();
		return $result->num_rows();
	}
	
	function sr_reports($keywords,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('sales_represntative');	
		if($keywords!=""){
			$this->db->where('code',$keywords);
			$this->db->or_like('mobile',$keywords);
			$this->db->or_like('username',$keywords);
		}
		$this->db->order_by('username','asc');
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}
	
	
	
	function getTable($table,$column,$order){
		$query =   $this->db
						->order_by($column, $order)
						->get($table);
		return $query;	
	}

function getOneItemTable($table,$tableColum,$userColum,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->get($table);
		return $query->row_array();	
	}
// Display All data with id
function getAllItemTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($status!=""){
				  $this->db->where($statusColum,$status);
			  }
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}



/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
	function get_AdminLogin($usr, $pwd)
     {
		     $reader =    $this->db->get_where('users', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
			 return $reader;
     }
	 
	 
	function get_userLogin($usr,$pwd)
     {
			 $customer =  $this->db->get_where('customers', array('email'=> $usr, 'password'=>md5($pwd), 'status'=> 1));
			 return $customer;
     }
	 
	 
	 function getLastInsertedId($table,$orderId)
     {
		$query = $this->db
						->order_by($orderId,'desc')
						->limit(1)
						->get($table);
		return $query->row_array();
     }






/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $insertData){
		if($this->db->insert($table, $insertData)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}

	 
	function update_table($table, $colid,$idval, $uvalue){
		$this->db->where($colid,$idval);
		$dbquery = $this->db->update($table, $uvalue); 
		if($dbquery)
			return true;
		else
			return false;
	}
	
	function updateTable($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	 /*function checkOldPass($table,$old_password,$cid)
		{
			$this->db->where('email', $this->session->userdata('userAccessMail'));
			$this->db->where('user_id', $cid);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
			
		}*/
		
 function checkOldPass($table,$dbuser,$sesionmail,$dbpass,$old_password,$dbid,$cid)
	{
		$this->db->where($dbuser, $sesionmail);
		$this->db->where($dbid, $cid);
		$this->db->where($dbpass, $old_password);
		$query = $this->db->get($table);
		return $query;
	}
		

 function update_status($table,$status,$id)
	{
		 $save=array('status'=>$status);
			$this->db->where('order_id', $id);
			$this->db->update($table, $save);
			return false;
	}
	
	function stock_update($update,$savedata,$status)
	{
		$this->db->where('pro_id', $update['pro_id']);
		$this->db->update('stock', $update);
		
		if($status=="stockout"){
			$this->db->insert('stock_out', $savedata);
		}
		elseif($status=="return"){
			$this->db->insert('return_product', $savedata);
		}
		return false;
	}
function update_inventory($update)
	{
		$this->db->where('product_id', $update['product_id']);
		$this->db->update('inventory', $update);
		return false;
	}
	
/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}
	
	function get_approve($approve_val,$table,$id,$status)
	{
	   $setval = array(
		   $status => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	function get_deapprove($approve_val,$table,$id,$status)
	{
		 $setval = array(
		   $status => 0,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	
	function get_category_approve($approve_val,$table)
	{
	   $setval = array(
		   'active' => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		//return false;
	}
	
	function get_category_deapprove($deapprove_val,$table)
	{
		$setval = array(
               'active' => 0,
         );
		$array=join(',',$deapprove_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	function wishlistProductSave($save)
	{
			$this->db->insert('customer_wishlist', $save);
			return $this->db->insert_id();
	}

}

?>