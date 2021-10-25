<?php
Class checkout_model extends CI_Model
{
	
	function save($orderId,$productId,$check_id,$product_id,$qty,$unit_price,$total_price,$date)
	{
			$array=explode(',', $productId);
			//print_r($array);
			//print_r($product_id);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
				if(isset($product_id[$i]) && ($product_id[$i]!='' || $product_id[$i]!=0)){
				//echo $product_id[$i];
					$this->db->query("insert into orders_products values('','".$orderId."','".$product_id[$i]."','".$qty[$i]."','".$unit_price[$i]."',
					'".$total_price[$i]."','".$date."')");
				}
		
				 $sql = "SELECT * FROM stock WHERE product_id = '".$product_id[$i]."'";
					$queryCheck = $this->db->query($sql);
					if($queryCheck->num_rows() >0 ){
						//$rowval = $queryCheck->row_array();
						foreach($queryCheck->result() as $rowval);
						$stid = $rowval->s_id;
						$exqty = $rowval->sale_qty;
						$mainStock=($exqty + $qty[$i]);
						$stockData = array(
							'stock_id'=>1,
							'product_id'=>$product_id[$i],
							'sale_qty'=>$mainStock,
							'sale_date'=>$date,
							'date'=>$date
						);
						$this->Index_model->update_table('stock','s_id',$rowval->s_id,$stockData);
					}
					else{
						$stockData = array(
							'stock_id'=>1,
							'product_id'=>$product_id[$i],
							'sale_qty'=>$qty[$i],
							'sale_date'=>$date,
							'date'=>$date
						);
						$this->Index_model->inertTable('stock', $stockData);
					}	
		}
	}
}