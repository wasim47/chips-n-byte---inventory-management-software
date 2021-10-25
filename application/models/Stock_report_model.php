<?php 

class Stock_report_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function stock_data($from_date,$to_date,$item,$type)
    {
		list($month,$day,$year)=explode('/',$from_date);
		$fdate=$year.'-'.$month.'-'.$day;
		
		list($month,$day,$year)=explode('/',$to_date);
		$tdate=$year.'-'.$month.'-'.$day;
		
		if($item!='')
		{
			
			if($type!='')
			{
				$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_proid='$item' AND as_type='$type' AND as_date BETWEEN '$fdate' AND '$tdate' ORDER BY as_date DESC");
			return $query->result();
			}
			else
			{
				$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_proid='$item' AND as_date BETWEEN '$fdate' AND '$tdate' ORDER BY as_date DESC");
			return $query->result();
			}
		}
		else
		{
			if($type!='')
			{
				$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_date BETWEEN '$fdate' AND '$tdate' AND as_type='$type' ORDER BY as_date DESC");
				return $query->result();
			}
			else
			{
				$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_date BETWEEN '$fdate' AND '$tdate' ORDER BY as_date DESC");
				return $query->result();
			}
		}
		
	}
	
	function stock_plus($from_date,$to_date)
    {
		list($month,$day,$year)=explode('/',$from_date);
		$fdate=$year.'-'.$month.'-'.$day;
		
		list($month,$day,$year)=explode('/',$to_date);
		$tdate=$year.'-'.$month.'-'.$day;
		
	
		$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_type='Plus' AND as_date BETWEEN '$fdate' AND '$tdate'");
		return $query->result();
		
	}
	
	function stock_minus($from_date,$to_date)
    {
		list($month,$day,$year)=explode('/',$from_date);
		$fdate=$year.'-'.$month.'-'.$day;
		
		list($month,$day,$year)=explode('/',$to_date);
		$tdate=$year.'-'.$month.'-'.$day;
		
	
		$query=$this->db->query("SELECT * FROM admin_stock_history WHERE as_type='Minus' AND as_date BETWEEN '$fdate' AND '$tdate'");
		return $query->result();
		
	}
	
	function stock_outdata($from_date,$to_date,$branch,$masudrana)
    {
		list($month,$day,$year)=explode('/',$from_date);
		$fdate=$year.'-'.$month.'-'.$day;
		
		list($month,$day,$year)=explode('/',$to_date);
		$tdate=$year.'-'.$month.'-'.$day;
		
	
		if($branch=='1'){
		
			$query=$this->db->query("SELECT * FROM bh_invoice WHERE inv_deli_date BETWEEN '$fdate' AND '$tdate' AND inv_salesman_id='0' AND inv_hub_id='$masudrana' ORDER BY inv_hub_id,inv_id");
			return $query->result();
		}
		else
		{
			$query=$this->db->query("SELECT * FROM bh_invoice WHERE inv_deli_date BETWEEN '$fdate' AND '$tdate' AND inv_hub_id='0' AND inv_salesman_id='$masudrana' ORDER BY inv_hub_id,inv_id");
			return $query->result();	
		}
		
	}
	
	function stock_outitem($from_date,$to_date,$branch,$masudrana,$itemid)
    {
		list($month,$day,$year)=explode('/',$from_date);
		$fdate=$year.'-'.$month.'-'.$day;
		
		list($month,$day,$year)=explode('/',$to_date);
		$tdate=$year.'-'.$month.'-'.$day;
		
	
		$query=$this->db->query("SELECT bh_invoice_details.*,product.p_prize,product.p_brandname,product.p_code FROM bh_invoice_details LEFT JOIN product ON bh_invoice_details.id_procode=product.p_code WHERE
		bh_invoice_details.id_deli_date BETWEEN '$fdate' AND '$tdate' AND inv_salesm_id='$masudrana' AND bh_invoice_details.id_procode='$itemid' ORDER BY bh_invoice_details.id_procode,bh_invoice_details.inv_id");
		return $query->result();
		
	}
	
	function stock_invoice($invid)
    {
		$query=$this->db->query("SELECT * FROM bh_invoice WHERE inv_id='$invid'");
		return $query->result();
		
	}
	
	function stock_details($invid)
    {
		$query=$this->db->query("SELECT * FROM bh_invoice_details WHERE inv_id='$invid'");
		return $query->result();
		
	}
}

?>