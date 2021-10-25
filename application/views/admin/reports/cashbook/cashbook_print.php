<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsPrintAjax()
{

	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var printd = "print";
	//alert(fromdate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_sale_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,printdata:printd},
			   success: function(data) {
				 // alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=reportsPrintAjax;
</script>
<style>
	body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: white;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  min-height: 29.7cm; 
	  height: auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	   min-height: 29.7cm; 
	   height: auto; 
	}
	page[size="A3"] {
	  width: 29.7cm;
	  height: 42cm;
	}
	page[size="A3"][layout="portrait"] {
	  width: 42cm;
	  height: 29.7cm;  
	}
	page[size="A5"] {
	  width: 14.8cm;
	  height: 21cm;
	}
	page[size="A5"][layout="portrait"] {
	  width: 21cm;
	  height: 14.8cm;  
	}
	@media print {
	  body, page {
		margin: 0;
		box-shadow: 0;
	  }
	}
	
	
	.printfontsize{
		font-size:18px;
		border-color:#000;
	}
</style>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:0px 10px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}
</style>
<page size="A4" layout="portrait">
<div style="padding:0.5cm;">
    <div style="width:100%; float:left">	
        <div style="text-align:center; padding:5px 0; width:20%; float:left">&nbsp;</div>
         <div style="text-align:center; padding:5px 0; width:60%; float:left">
                            <!--<img src="<?php echo base_url('assets/images/logo.png')?>" style="width:100px; height:auto" />-->
                            <div style="font-size:13px; text-align:center; margin-bottom:10px;">
                                <h1 style="margin:0; padding:0">KRC International</h1>
                                Imamgonj, Dhaka<br />
                                <h2 style="font-size:22px;margin:0; padding:0; text-decoration:underline">Cash Book</h2>
                                <?php  if($fromdate!=""){?>
                                <h3 style="font-size:18px;"><?php echo $fromdate.' To '.$todate;?></h3>
                                <?php }?>
                            </div>
      </div>
         <div style="text-align:center; padding:5px 0; width:20%; float:left">
            <table align="right">
                <tr>
                    <td>Printing Date</td>
                    <td>:</td>
                    <td><?php echo date('d-m-Y');?></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>:</td>
                    <td><?php echo date('H:i:s A');?></td>
                </tr>
                
            </table>
         </div>         	  		
    </div>
    <div style="width:100%; float:left">	
      <div style="text-align:left; padding:5px 0; width:50%; float:left"></div>
                            
    </div>
  <div style="width:100%; height:auto;" class="printfontsize">
          <div style="border:none; font-size:22px; width:50%; float:left"><strong>Income</strong></div>
          <div style="border:none; font-size:22px; width:50%; float:left"><strong>Expense</strong></div>
        <div style="width:50%; float:left">
        	<table width="100%" class="summTable" border="1">
            <tr style="font-weight:bold;">
              <td width="61" rowspan="2" align="center">Code</td>
              <!--<td width="127" rowspan="2"  align="center">Party Name</td>-->
              <td width="121" rowspan="2" align="center">Date </td>
              <td width="134" rowspan="2" align="center">Partiulars </td>
              <td height="33" colspan="2" align="center">Received </td>
              </tr>
            <tr style="font-weight:bold;">
              <td align="center">Cash</td>
              <td align="center">Bank</td>
            </tr>
           
            
            <?php
                $i=0;
                $tbank = 0;
                $tcash = 0;
               foreach($party_pay_list->result() as $rowcash){													  
                   $cpid=$rowcash->id;
                   $custid=$rowcash->customer_id;												   
                   $invoice_type=$rowcash->invoice_type;													  
                   $total_invoice=$rowcash->total_invoice;
                   $total_db_invoice=$rowcash->total_db_invoice;
                   $payment_date = $rowcash->payment_date;
                   $pay_method = $rowcash->pay_method;
                   $bank_id = $rowcash->bank_id;
                   
                   if($pay_method=='Cash'){
                    $totalcash = $rowcash->paid_amount;
                    $totalbank='-';
                    $bank_name='';
                    $account_no ='';
                    $branch ='';
                   }
                   else{
                    $totalbank = $rowcash->paid_amount;
                    $totalcash='-';
                    $bankinfo = $this->db->query("SELECT * FROM bank WHERE b_id = '".$bank_id."'");
                        if($bankinfo->num_rows() > 0){
                            foreach($bankinfo->result() as $br);
                            $bank_name=$br->bank_name;
                            $account_no=$br->account_no;
                            $branch = $br->branch;
                        }
                        else{
                            $bank_name='';
                            $account_no='';
                            $branch = '';
                        }
                   }
                                                                    
                    $custinfo = $this->db->query("SELECT * FROM customers WHERE customer_id = '".$custid."'");
                    foreach($custinfo->result() as $rowq);
                    if($custinfo->num_rows() > 0){
                        $buyername=$rowq->name;
                        $buyercode=$rowq->cid;
                        $buyeraddress=$rowq->address;
                    }
                    else{
                        $buyername= '';
                        $buyercode= '';
                        $buyeraddress= '';
                    }
                    $custinfo = $this->db->query("SELECT SUM(prev_balance) AS totalprev FROM customers WHERE salse_id = '".$salserepid."'");
                    if($custinfo->num_rows() > 0){
                        $rowprev = $custinfo->row_array();
                        $prev_balance = $rowprev['totalprev'];
                        $prevdisplay = number_format($prev_balance,2,'.',',');
                    }
                    else{
                        $prev_balance = '';
                        $prevdisplay =0;
                    }
                        
                    $custinfo = $this->db->query("SELECT SUM(prev_balance) AS totalprev FROM customers WHERE salse_id = '".$salserepid."'");
                    if($custinfo->num_rows() > 0){
                        $rowprev = $custinfo->row_array();
                        $prev_balance = $rowprev['totalprev'];
                        $prevdisplay = number_format($prev_balance,2,'.',',');
                    }
                    else{
                        $prev_balance = '';
                        $prevdisplay =0;
                    }
                    
                    $sqld = "SELECT SUM(amount) AS debitAmount FROM debit_voucher WHERE (payment_date BETWEEN '$fromdate' AND '$todate')";
                    $dAmountRow = $this->db->query($sqld);
                    if($dAmountRow->num_rows() > 0){
                        $row = $dAmountRow->row_array();
                        $debitAMount = $row['debitAmount'];
                    }
                    else{
                        $debitAMount = 0;
                    }
                    

                    $i++;
            ?>
        
        <tr class="trCont">
          <td width="61" height="22" align="center"><?php echo $buyercode;?></td>
          <!--<td width="127" align="center"><?php echo $buyername;?></td>-->
          <td align="center"><?php echo $payment_date;?></td>
          <td align="center">&nbsp;</td>
          <td width="57" align="center"><?php echo $totalcash;?></td>
          <td width="91" align="center"><?php echo $totalbank;?></td>
         </tr>
        <?php
        
        $tcash = $tcash + $totalcash;
        $tbank = $tbank + $totalbank;
       // $tdue = $tdue + $due_amount;
       // $tqty = $tqty + $qty;											
        }
        ?>
        </table>
        </div>
        <div style="width:50%; float:left">
        	<table width="100%" class="summTable" border="1">
              <tr style="font-weight:bold;">
                <td rowspan="2" align="center">Code</td>
                <!--<td width="127" rowspan="2"  align="center">Party Name</td>-->
                <td rowspan="2" align="center">Date </td>
                <td rowspan="2" align="center">Partiulars </td>
                <td height="33" colspan="2" align="center">Payment </td>
              </tr>
              <tr style="font-weight:bold;">
                <td align="center">Cash</td>
                <td align="center">Bank</td>
              </tr>
            
           
            
            <?php
                $i=0;
                $tbank = 0;
                $tcash = 0;
                    $sqld = "SELECT SUM(amount) AS debitAmount FROM debit_voucher WHERE (payment_date BETWEEN '$fromdate' AND '$todate')";
                    $dAmountRow = $this->db->query($sqld);
                    if($dAmountRow->num_rows() > 0){
					 foreach($dAmountRow->result() as $rowDV){	
                        $debitAMount = $rowDV->debitAmount;
                    $i++;
            ?>
        
        <tr class="trCont">
          <td width="64" height="22" align="center"><?php echo $i;?></td>
          <!--<td width="109" align="center"><?php echo $buyercode;?></td>-->
          <td width="128" align="center"><?php echo $payment_date;?></td>
          <td width="126" align="center">&nbsp;</td>
          <td width="71" align="center"><?php echo $debitAMount;?></td>
          <td width="93" align="center">0</td>
</tr>
        <?php
        
       // $tcash = $tcash + $totalcash;
       // $tbank = $tbank + $totalbank;
       // $tdue = $tdue + $due_amount;
       // $tqty = $tqty + $qty;											
        }
		}
        ?>
        </table>
        </div> 
          
        
        
                                        
  </div>
    
    <div style="width:100%; height:auto; float:left; margin-top:2cm;">	
            <div style="width:15%; text-align:left; float:left; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Account Officer</div>        	
            <div style="width:15%; text-align:left; float:right; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Owner</div>
        	
    </div>
</div>      
 </page>        