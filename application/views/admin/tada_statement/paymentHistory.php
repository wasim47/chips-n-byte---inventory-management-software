<?php
 $sid=$this->input->get('custid');
			
$queryS=$this->db->query("select * from customers where customer_id='".$sid."'");
foreach($queryS->result() as $rowS);
$std_name=$rowS->name;
$student_id=$rowS->customer_id;

$querypay=$this->db->query("SELECT SUM(sale_amount) AS total,
					SUM(paid_amount) AS paid,SUM(due_amount) AS due FROM customer_payment where customer_id='".$sid."'");
foreach($querypay->result() as $payrow);
	$payable_amount=$payrow->total;
	$paid=$payrow->paid;
	$due=$payrow->due;

?>

<table class="table table-striped" width="100%" cellpadding="0" cellspacing="0">
	<tr><th align="center" colspan="6"><h1>Payment History</h1></th></tr>
    <tr bgcolor="#f5f5f5">
     <th width="1%" align="center">&nbsp;</th>
     <th width="26%" align="left"><h3 style="padding:10px 0 0 0">Student Name : <?php echo $std_name;?></h3></th>
     <th width="23%" align="left"><h3 style="padding:10px 0 0 0; color:#FFCC00">Total Amount : <?php echo $payable_amount;?></h3></th>
     <th width="19%" align="left"><h3 style="padding:10px 0 0 0; color:#00CC00">Paid Amount : <?php echo $paid;?></h3></th>
     <th width="19%" align="left"><h3 style="padding:10px 0 0 0; color:#f00">Due Amount : <?php echo $due;?></h3></th>
  </tr>
</table>
<table class="table table-striped" width="100%">


  <tr bgcolor="#666" style="color:#fff">
     <th align="center" style="padding:10px">SI</th>
     <th align="center">Total Amount</th>
     <th align="center">Paid Amount</th>
     <th align="center">Due Amount</th>
     <th align="center">Payment Method/th>
     <th align="center">Payment Date</th>
  </tr>
<?php
$i=0;
$querypay=$this->db->query("select * from customer_payment where customer_id='".$sid."'");
foreach($querypay->result() as $payrow){
	$sale_amount=$payrow->sale_amount;
	$paid_amount=$payrow->paid_amount;
	$due_amount=$payrow->due_amount;
	$pay_method=$payrow->pay_method;
	$paid_date=$payrow->payment_date;

if($i%2==0){
	$clr='#ccc';
}
else{
	$clr='#eaeaea';
}
$i++;
?>


<tr bgcolor="<?php echo $clr;?>">
    <td align="center" style="padding:10px"><?php echo $i;?></td>
    <td align="center"><?php echo $sale_amount; ?></td>
    <td align="center"><?php echo $paid_amount; ?></td>
    <td align="center"><?php echo $due_amount; ?></td>
     <td align="center"><?php echo $pay_method; ?></td>
    <td align="center"><?php echo $paid_date; ?></td>
</tr>

<?php
}	
?>
</table>