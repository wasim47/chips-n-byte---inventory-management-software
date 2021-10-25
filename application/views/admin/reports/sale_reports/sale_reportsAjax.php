<div class="container">
   <table width="100%" class="summTable" border="1">
    <tr class="theadline">
      <td width="57" height="28" align="center">SI</td>
      <td width="282" align="center">Buyer Name </td>
      <td width="168" align="center">Bill No </td>
      <td width="172" align="center">Date </td>
      <td width="166" align="center">Quantity </td>
      <td width="133" align="center">Total Price </td>
      <td width="109" align="center">Paid </td>
      <td width="124" align="center">Due </td>
      <!--<td width="90" align="center">Details </td>-->
 </tr>
    <?php
        $i=0;
        $tqty = 0;
        $tprice = 0;
        $tpaid = 0;
        $tdue = 0;
      foreach($partyladger->result() as $rowq){													  
          $buyername=$rowq->name;
          $byerid=$rowq->customer_id;
      
          ///////////////// total quantity by order and invoice///////////////
		  if($fromdate!=""){
		  	$orderquery= $this->Index_model->getItemBetween('orders','customer_id',$byerid,'date',$fromdate,$todate,'order_id','asc');
		  }
		  else{
		  	$orderquery= $this->Index_model->getItemBetween('orders','customer_id',$byerid,'','','','order_id','asc');
		  }
          
		  
          if($orderquery->num_rows() > 0){
              foreach($orderquery->result() as $odata){
                $order_id[]=$odata->order_id;
              }
              $arrayord = join(',',$order_id);
              $ordque = $this->db->query("SELECT SUM(qty) AS totalqty FROM orders_products WHERE order_id IN($arrayord)");
              $ordr = $ordque->row_array();
              $qty = $ordr['totalqty'];
            }
            else{
                $qty = 0;
            }
            
            ///////////////// total quantity by sale and  sale invoice///////////////
              
			  
			   if($fromdate!=""){
				$saledetails = $this->Index_model->getItemBetween('sale_details','cust_id',$byerid,'sale_date',$fromdate,$todate,'id','asc');
			  }
			  else{
				$saledetails = $this->Index_model->getItemBetween('sale_details','cust_id',$byerid,'','','','id','asc');
			  }
			 // $this->db->query("SELECT * FROM  sale_details WHERE cust_id = '".$byerid."' ORDER BY id DESC");
                if($saledetails->num_rows() > 0){
                    foreach($saledetails->result() as $ressl){
                      $stqty[] = $ressl->total_qty;
                      $sale_date = $ressl->sale_date;
                      $bill_no = $ressl->bill_no;
                  }
                  $totqty = array_sum($stqty);
                }
                else{
                    $totqty = 0;
                    $sale_date = '';
                    $bill_no ='';
                }
             $totalqty = $qty+$totqty;
             
            ///////////////// Get total Price///////////////
			   if($fromdate!=""){
				$paymentDet = $this->db->query("SELECT * FROM  customer_payment WHERE customer_id = '".$byerid."' 
			  AND invoice_type='Invoice' AND payment_date BETWEEN '$fromdate' and '$todate' ORDER BY id DESC");
			  }
			  else{
				$paymentDet = $this->db->query("SELECT * FROM  customer_payment WHERE customer_id = '".$byerid."' AND invoice_type='Invoice' ORDER BY id DESC");
			  }
			  
			  
                if($paymentDet->num_rows() > 0){
                    foreach($paymentDet->result() as $ressl){
                      $paid_amount[] = $ressl->paid_amount;
                      $sale_amount[] = $ressl->sale_amount;
                  }
                  $tsaleam = array_sum($sale_amount);
                  $tpaidam = array_sum($paid_amount);
                  $tdueam = $tsaleam - $tpaidam;
                }
                else{
                    $tsaleam ='';
                    $tpaidam ='';
                    $tdueam ='';
                } 
             
          /*
          $invoicequery= $this->Index_model->getAllItemTable('invoice','cust_id',$byerid,'','','inv_id','desc');	
          if($invoicequery->num_rows() > 0){
              $inv = $invoicequery->row_array();
              $inv_id=$inv['inv_id'];
          }
          else{
              $inv_id=0;
          }*/
                                      
       
        $i++;
    ?>

<tr class="trCont">
  <td height="26" align="center"><?php echo $i;?></td>
  <td width="282" align="center"><?php echo $buyername;?></td>
  <td width="168" align="center"><?php echo $bill_no;?></td>
  <td width="172" align="center"><?php echo $sale_date;?></td>
  <td align="center"><?php echo $totalqty;?></td>
 <td width="133" align="center"><?php echo $tsaleam;?></td>
 <td width="109" align="center"><?php echo $tpaidam;?></td>
 <td width="124" align="center"><?php echo $tdueam;?></td>
 <!--<td width="90" align="center">
 <a href="<?php echo base_url('admin/party_details/'.$byerid);?>"><i class="fa fa-eye"></i> View</a></td>-->
 
 
 
</tr>
<?php

 $tqty = $tqty + $totalqty;
$tprice = $tprice + $tsaleam;
$tpaid = $tpaid + $tpaidam;
$tdue = $tdue + $tdueam;

}
?>
<tr>
                                                <td height="31" colspan="4">&nbsp;</td>
                                              <td align="center"><h4 style="color:#000066; font-size:15px;"><?php echo 'Total Qty: <strong>'.$tqty.'</strong>';?></h4></td>
                                                <td align="center"><h4 style="color:#999900; font-size:15px;"><?php echo 'Total Price: BDT <strong>'.$tprice.'</strong>';?></h4></td>
                                                <td width="20" align="center"><h4 style="color:#009900; font-size:15px;"><?php echo 'Total Paid: BDT <strong>'.$tpaid.'</strong>';?></h4></td>
                                              <td width="22" align="center"><h4 style="color:#FF0000; font-size:15px;"><?php echo 'Total Due: BDT <strong>'.$tdue.'</strong>';?></h4></td>
                                            </tr>

</table>                          
</div>