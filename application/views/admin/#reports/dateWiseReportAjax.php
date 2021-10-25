<div class="container">
<table class="table-striped" align="center" width="50%" border="0">
<tr>
        <td height="44" colspan="3" align="center"><h4><?php echo 'Report Summary for <strong>'.$fromdate.' To '.$todate.'</strong>'; ?> </h4> </td>
    </tr>
    <tr>
        <td width="57%" height="30" align="right"><h5>Total Received from customer</h5></td>
        <td width="3%" align="center">:</td>
      <td width="40%" align="left">
            <h5><strong><?php
            $sql1=$this->db->query("select sum(total_amount) as amount from income_source where subimition_date between '$fromdate' and '$todate' order by inc_id asc");
            if($sql1->num_rows() > 0)
            {
            foreach($sql1->result() as $row1);												
            $t_r_amount=$row1->amount;
            echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
            }
            ?></strong>   </h5>                                                     </td>
  </tr>
    <tr>
        <td height="31" align="right"><h5>Total Expenses</h5> </td>
        <td height="31" align="center">:</td>
      <td align="left">
            <h5>
            <strong><?php
            $sql2=$this->db->query("select sum(total_amount) as amount from internal_cost where payment_date between '$fromdate' and '$todate' order by pay_id asc");
            if($sql2->num_rows() > 0)
            {
            foreach($sql2->result() as $row2);												
            $t_p_amount=$row2->amount;
            echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
            }
            ?></strong>  </h5>                                                      </td>
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

    <tr style="color:<?php echo $c;?>">
        <td height="34" align="right" class="flink"><?php echo $conl;?></td>
        <td height="34" align="center" class="flink">:</td>
        <td align="left"><strong>
        <?php echo 'TK '.number_format($profit,2,'.',',').' /=';?>		
        </strong>                                                    </td>
  </tr>
</table>
</div>
<div class="container">
  <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;">Total Cost</div>
  <table class="table table-striped" width="100%">
    <tr bgcolor="#666">
         <th width="3%" align="center">SI</th>
         <th width="16%" align="center">Payment For</th>
         <th width="16%" align="center">Total Amount</th>
         <th width="16%" align="center">Discount</th>
         <th width="16%" align="center">Payable Amount</th>
         <th width="15%" align="center">Payment Date</th>
         <th width="18%" align="center">Remarks</th>
      </tr>
    <?php
    $i=0;
    $costCount = 0;
    
    $queryCost=$this->db->query("select * from internal_cost where payment_date between '$fromdate' and '$todate'");
    foreach($queryCost->result() as $payrow){
    $paymentfor=$payrow->paymentfor;
    $costAmount=$payrow->total_amount;	
    $cost_by=$payrow->cost_by;
    $voucherno=$payrow->serial_no;
    $remarks=$payrow->remarks;
    $payment_date=$payrow->payment_date;
    
    
    $querypaymentfor=$this->db->query("select * from asset_investment where par_id='".$paymentfor."'");
    foreach($querypaymentfor->result() as $pfor);
    
                                  
    if($i%2==0){
        $clr='#fff';
    }
    else{
        $clr='#eaeaea';
    }
    $i++;
    
    ?>
    
    
    <tr bgcolor="<?php echo $clr;?>">
        <td align="center"><?php echo $i;?></td>
        <td align="center"><?php echo $pfor->asset_investment_name; ?></td>
        <td align="center"><?php echo $costAmount; ?></td>
        <td align="center"><?php echo $cost_by; ?></td>
        <td align="center"><?php echo $voucherno; ?></td>
        <td align="center"><?php echo $remarks; ?></td>
        <td align="center"><?php echo $payment_date; ?></td>
    </tr>
    
    <?php
    $costCount = $costCount + $costAmount;
    }	
    
    ?>
    
     <tr>
         <th align="center" colspan="5">&nbsp;</th>
         <th align="right" colspan="2" style="font-size:16px; text-align:right">
         Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></th>
      </tr>
    </table>
</div>

<div class="container">
  <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;">Total Income</div>
  <table class="table table-striped" width="100%">
    <tr bgcolor="#666">
         <th width="3%" align="center">SI</th>
         <th width="16%" align="center">Order Number</th>
         <th width="16%" align="center">Total Amount</th>
         <th width="16%" align="center">Sold By</th>
         <th width="16%" align="center">Sold to</th>
         <th width="15%" align="center">Invoice No.</th>
         <th width="18%" align="center">Payment Dat</th>
      </tr>
    <?php
    $j=0;
    $incomeCount = 0;
    
   $queryIncome=$this->db->query("select * from income_source where subimition_date between '$fromdate' and '$todate'");
    foreach($queryIncome->result() as $rowS){
    $incomeAmount=$rowS->total_amount;
    $order_number=$rowS->order_number;
    $user_id=$rowS->user_id;
    $admin_id=$rowS->admin_id;
    $invoiceid=$rowS->invoiceid;
    $order_id=$rowS->order_id;
    $subimition_date=$rowS->subimition_date;
    
            
    $queryUser=$this->db->query("select * from customer where user_id='".$user_id."'");
    foreach($queryUser->result() as $userinf);  
    
    $queryAdmin=$this->db->query("select * from users where id='".$admin_id."'");
    foreach($queryAdmin->result() as $adminInfo);  
                      
    if($j%2==0){
        $clr='#fff';
    }
    else{
        $clr='#eaeaea';
    }
    $j++;
    
    ?>
    
    
    <tr bgcolor="<?php echo $clr;?>">
        <td align="center"><?php echo $j;?></td>
        <td align="center"><?php echo $order_number; ?></td>
        <td align="center"><?php echo $incomeAmount; ?></td>
        <td align="center"><?php echo $adminInfo->username; ?></td>
        <td align="center"><?php echo $userinf->username; ?></td>
        <td align="center"><?php echo $invoiceid; ?></td>
        <td align="center"><?php echo $subimition_date; ?></td>
    </tr>
    
    <?php
    $incomeCount = $incomeCount + $incomeAmount;
    }	
    
    ?>
    
     <tr bgcolor="#F9F9F9">
         <th align="center" colspan="5">&nbsp;</th>
         <th align="right" colspan="2" style="font-size:16px; text-align:right">
         Total Amount = <?php echo 'TK '.number_format($incomeCount,2,'.',',').' /=';?></th>
      </tr>
    </table>
</div>
<div class="container" style="font-size:20px; border-top:1px solid #ccc; float:left; text-align:center; width:100%; margin-bottom:5px;">
<?php
if($incomeCount>=$costCount){
    $c='green';
    $con="Gross Amount as Balance : ";
    $loss=number_format($incomeCount-$costCount,2,'.',',');
}
else{
    $c='red';
    $loss=number_format($costCount-$incomeCount,2,'.',',');;
    $con="Gross Amount as Outstanding : ";
    }
?>
<strong style="color:<?php echo $c;?>"><?php echo $con.' TK '.$loss.' /='; ?></strong></div>