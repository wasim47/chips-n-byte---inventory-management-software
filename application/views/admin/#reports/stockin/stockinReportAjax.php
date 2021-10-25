<?php
/*function proNameFunc($pid){
	$db = new PDO('mysql:host=localhost;dbname=wellshop_bangla;charset=utf8mb4', 'root', '');
	  $ordproductquery=$db->query("select * from orders_products where order_id='$pid' order by id asc");
	  foreach($ordproductquery as $ordpro){
		  $product_id=$ordpro['product_id'];

	   	  $productquery=$db->query("select * from product where product_id='".$product_id."' order by product_id asc");
		  foreach($productquery as $pro);
		  echo $pro['product_name'].'<br>';
	  }
}

function proQtyFunc($pid){
	$db = new PDO('mysql:host=localhost;dbname=wellshop_bangla;charset=utf8mb4', 'root', '');
	  $ordproductquery=$db->query("select * from orders_products where order_id='$pid' order by id asc");
	  foreach($ordproductquery as $ordpro){
		  echo $ordpro['qty'].'<br>';
	  }
}


function proCodeFunc($pid){
	  $db = new PDO('mysql:host=localhost;dbname=wellshop_bangla;charset=utf8mb4', 'root', '');
	  $ordproductquery=$db->query("select * from orders_products where order_id='$pid' order by id asc");
	  foreach($ordproductquery as $ordpro){
		  $product_id=$ordpro['product_id'];
		  
	   	  $productquery=$db->query("select * from product where product_id='".$product_id."' order by product_id asc");
		  foreach($productquery as $pro);
		  echo $pro['pro_code'].'<br>';
	  }
}



function supplierFunc($pid){
	$db = new PDO('mysql:host=localhost;dbname=wellshop_bangla;charset=utf8mb4', 'root', '');
	  $ordproductquery=$db->query("select * from orders_products where order_id='$pid' order by id asc");
	  foreach($ordproductquery as $ordpro){
		  $supplier_id=$ordpro['supplier'];
		  
		$supplierquery=$db->query("select * from supplier where user_id ='".$supplier_id."' order by user_id desc");
		  foreach($supplierquery as $supp);
			echo $supp['username'].'<br>';
	  }
}*/
?>

<div class="container">
                             <table class="table table-striped" width="100%">
                                            <tr bgcolor="#ccc">
                                              <th width="23%" height="34" align="left">Product Name</th>
                                              <th width="13%" height="34" align="left">Product Code</th>
                                               <th width="13%" align="left">Quantity</th>
                                              <th width="16%" colspan="2" align="right"> Total Stock</th>
                                            </tr>
                                            <?php
                                            $i=0;
                                            $costCount = 0;
											
                                            foreach($stockreport->result() as $payrow){
											  
											  $productquery=$this->db->query("select * from product where product_id='".$payrow->pro_id."' order by product_id asc");
											  foreach($productquery->result() as $pro);
											  
											  
		  
																								  
                                            if($i%2==0){
                                                $clr='#fff';
                                            }
                                            else{
                                                $clr='#eaeaea';
                                            }
                                            $i++;
                                            
                                            ?>
                                            
                                            
                                            <tr bgcolor="<?php echo $clr;?>">
                                              <td height="31" align="left"><?php echo $pro->product_name;?></td>
                                              <td align="left"><?php echo $pro->pro_code;?></td>
                                              <td align="left"><?php echo $payrow->pro_qty?></td>
                                              <td colspan="2" align="center" valign="bottom" style="bottom:0;"><?php echo $payrow->pro_qty;?></td>
                               </tr>
                                            
                                            <?php
                                            $costCount = $costCount + $payrow->pro_qty;
                                            }	
                                            
                                            ?>
                                            
                                             <tr>
                                                 <th align="right" colspan="8">
                                                 <div style="float:right; font-size:18px">Total Product = <?php echo $costCount;?></div></th>
                                              </tr>
                                            </table>
</div>