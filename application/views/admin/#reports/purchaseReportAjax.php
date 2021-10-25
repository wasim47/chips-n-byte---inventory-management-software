<div class="container">
<table class="table-striped" align="center" width="50%" border="0">
<tr>
        <td width="100%" height="44" align="center"><h4><?php echo 'Report Summary for <strong>'.$fromdate.' To '.$todate.'</strong>'; ?> </h4> </td>
    </tr>
   <?php
if($t_r_amount>=$t_p_amount){
    $c='green';
    $conl="Cash in Hands : ";
    $profit=$t_r_amount-$t_p_amount;
}
else{
    $c='red';
    $profit=$t_p_amount-$t_r_amount;
    $conl="Today loss : ";
    }
?>
</table>
</div>
<div class="container">
  <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
  <table class="table table-striped" width="100%">
    <tr bgcolor="#ccc">
         <th width="16%" height="34" align="left">Invoice No</th>
      <th width="21%" align="left">Manual Invoice No</th>
         <th width="25%" align="left">Supplier</th>
         <th width="19%" colspan="2" align="right">Invoice Total</th>
         <th width="19%" align="right">&nbsp;</th>
      </tr>
    <?php
    $i=0;
    $costCount = 0;
    
	if($supplier=='')
	{
		$queryCost=$this->db->query("SELECT purchase_invoice.*,supplier.user_id,supplier.username 
		FROM
		purchase_invoice 
		LEFT JOIN supplier ON purchase_invoice.bi_cname=supplier.user_id
		WHERE purchase_invoice.bi_date between '$fromdate' and '$todate'");
	}
	else
	{
		$queryCost=$this->db->query("SELECT purchase_invoice.*,supplier.user_id,supplier.username 
		FROM
		purchase_invoice 
		LEFT JOIN supplier ON purchase_invoice.bi_cname=supplier.user_id
		WHERE purchase_invoice.bi_cname='$supplier' AND purchase_invoice.bi_date between '$fromdate' and '$todate'");
	}	
	
	
    foreach($queryCost->result() as $payrow){
                                      
    if($i%2==0){
        $clr='#fff';
    }
    else{
        $clr='#eaeaea';
    }
    $i++;
    
    ?>
    
    
    <tr bgcolor="<?php echo $clr;?>">
        <td align="left"><?php echo $payrow->bi_id;?></td>
        <td align="left"><?php echo $payrow->minvoice; ?></td>
        <td align="left"><?php echo $payrow->username; ?></td>
        <td colspan="2" align="center"><?php echo $payrow->bi_totalnet; ?></td>
        <td align="right">&nbsp;</td>
    </tr>
    
    <?php
    $costCount = $costCount + $payrow->bi_totalnet;
    }	
    
    ?>
    
     <tr>
         <th align="right" colspan="6">
         Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></th>
      </tr>
    </table>
</div>
