<?php 

class Pre_stock_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_data($search)
    {
		if($search!=""){
			$query=$this->db->query("SELECT * FROM product WHERE preorder=1 AND (product_name LIKE '%$search' OR product_name LIKE '$search%' OR product_name LIKE '%$search%') ORDER BY product_name");
			return $query->result();
		}
		else
		{
			$query=$this->db->query("SELECT * FROM product WHERE preorder=1 ORDER BY cat_id,product_name");
			return $query->result();
		}
	}
	
	
	//================================ Purchase
	
	function purchaseinvoice()
    {
		$query	= $this->db->query("SELECT bi_id FROM pre_purchase_invoice ORDER BY bi_id DESC LIMIT 1");
		$data 	= $query->row();
		$inv_id	= $data->bi_id;
		
		if($inv_id=='')
		{
			return $result=$inv_id + 1;
		}
		else
		{
			return $result=$inv_id + 1;
		}
	}
	
	
	
	function finditem_($itemname)
	{
		if($itemname!='')
		{
			$ex = explode('~',$itemname);
			$id = $ex[0];
			$query = $this->db->query("SELECT * FROM product WHERE preorder=1 AND product_id='$id'");
			$rdata = $query->row();
			
			echo $rdata->pro_code.'~'.$rdata->price.'~'.$rdata->product_id;
		}
		else
		{
			echo 0;
		}
	}
	
	function invoice_submit($invNO,$mainDate,$mainDeliDate,$net_total,$pro_code,$pro_name,$pro_id,$qty,$price,$net,$minvoice)
	{
		
		$query=$this->db->query("INSERT INTO pre_purchase_invoice VALUES('','$minvoice','','','$mainDate','','','$net_total','','$payment','','','','','')");
		
		$query=$this->db->query("SELECT * FROM pre_purchase_invoice WHERE hub_id='$hubID' ORDER BY bi_id DESC");
		$rows=$query->row();
		$inv_id=$rows->bi_id;
		
		$proInv=count($pro_code);
		
		for($i=0;$i<$proInv;$i++)
		{
			if(($qty[$i]!='' && $qty[$i]>0))
			{
				$query1=$this->db->query("SELECT * FROM pre_stock WHERE pro_id='$pro_id[$i]'");
				$date=date('Y-m-d');
				
				if($query1->num_rows()>0)
				{
					$data1=$query1->row();
					$as_qty=$data1->pro_qty;
					$mainStock=($as_qty + $qty[$i]);
					$this->db->query("UPDATE pre_stock SET pro_qty='$mainStock' WHERE pro_id='$pro_id[$i]'");
				}
				else
				{
					$this->db->query("INSERT INTO pre_stock VALUES('','','','$qty[$i]','$pro_id[$i]','$date')");
				}
				
				
				$query=$this->db->query("INSERT INTO pre_purchase_invoice_details VALUES('','$inv_id','$minvoice','$pro_name[$i]','$pro_code[$i]','$pro_id[$i]','','','$qty[$i]','','','','$price[$i]','$net[$i]','','','$mainDate','','','','')");
					
			}
		}
	
	}
	
	
	function stock_pro($id)
	{
		$this->db->where('p_id',$id);
		$this->db->where('preorder',1);
		$query=$this->db->get('product');
		return $query->result();
	}
	
	function stock_pro_stock($id)
	{
		$this->db->where('as_proid',$id);
		
		$query=$this->db->get('admin_stock');
		return $query->result();
	}
	
	function check_data()
	{
		$query=$this->db->query("SELECT * FROM product WHERE preorder=1");
		return $query->num_rows();
	}
	
	function stock_check($product_id,$qty)
	{
		$query=mysql_query("SELECT * FROM admin_stock WHERE as_proid='$product_id'");
		$data=mysql_fetch_array($query);
		$qty1=$data['as_qty'];
		
		$mainqty=$qty1-$qty;
		
		if($qty1 < $qty)
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	
	
	function stock_insert($product_id,$as_procatid,$as_qty,$as_challan,$as_date,$as_vd)
    {
		
		$uid=$this->session->userdata('a_id');
		
		$query=mysql_query("SELECT * FROM admin_stock WHERE as_proid='$product_id'");
		$data=mysql_fetch_array($query);
		$qty=$data['as_qty'];
		$as_proid12=$data['as_proid'];
		
		$mainqty=$qty +$as_qty;
		
		
		if($product_id==$as_proid12)
		{
			$update=mysql_query("UPDATE admin_stock SET as_qty='$mainqty' WHERE as_proid='$product_id'");
			
			$insert=mysql_query("INSERT INTO admin_stock_history VALUES('','$product_id','$uid','$as_procatid','$as_qty','$as_challan','Plus','$as_date','$as_vd')");
		}
		else
		{
			$insert=mysql_query("INSERT INTO admin_stock VALUES('','$product_id','$as_qty','$as_date','$as_vd')");
			
			$insert=mysql_query("INSERT INTO admin_stock_history VALUES('','$product_id','$uid','$as_procatid','$as_qty','$as_challan','Plus','$as_date','$as_vd')");
		}
	}
	
	
	
	function stock_update($product_id,$as_procatid,$as_qty,$as_challan,$as_date,$as_vd)
    {
		$uid=$this->session->userdata('a_id');
		
		$query=mysql_query("SELECT * FROM admin_stock WHERE as_proid='$product_id'");
		$data=mysql_fetch_array($query);
		$qty=$data['as_qty'];
		$as_proid12=$data['as_proid'];
		
		$mainqty=$qty-$as_qty;
		
		
		if($product_id==$as_proid12)
		{
			$update=mysql_query("UPDATE admin_stock SET as_qty='$mainqty' WHERE as_proid='$product_id'");
			
			$insert=mysql_query("INSERT INTO admin_stock_history VALUES('','$product_id','$uid','$as_procatid','$as_qty','$as_challan','Minus','$as_date','$as_vd')");
		}
	}
	
	/*
	================================ Report ============================
	*/
	
	function check_hub()
	{
		$query=$this->db->query("SELECT * FROM business_hub WHERE bh_publish='1' ORDER BY bh_name");
		return $query->result();
	}
	
	function invoice()
    {
		$query=mysql_query("SELECT inv_id FROM bh_invoice ORDER BY inv_id");
		$data=mysql_fetch_array($query);
		$inv_id=$data['inv_id'];
		
		if($inv_id=='')
		{
			$result=$inv_id +1;
		}
		
		return $result;
		
	}
	
	function ajaxData($idSelect)
	{
		
		$sql = "SELECT p_name FROM `product` WHERE preorder=1 AND p_name LIKE '".$idSelect."%'";
		$data=mysql_query($sql);
		$arrcnt = -1;
		$dataArray = array();
			while($temp = mysql_fetch_assoc($data)):
				foreach($temp as $key=>$val)
				 {
				$temp[$key] = stripslashes($val);
				$arrcnt++;
				  }
				$dataArray[$arrcnt] = $temp;
			endwhile;
			//return $dataArray ;
	
			foreach ($dataArray as $key => $value) {
		
				echo $value['supplier_name']."\n";
		
			}
		}
		
		
		
	function view_data()
	{
		$query=$this->db->query("SELECT product.*,category.c_id,category.c_name,admin_stock.as_proid,admin_stock.as_qty FROM product LEFT JOIN category ON product.p_category=category.c_id LEFT JOIN admin_stock ON product.p_id=admin_stock.as_proid WHERE product.preorder=1 ORDER BY category.c_id,product.p_name");
		return $query->result();
	}
	
}

?>