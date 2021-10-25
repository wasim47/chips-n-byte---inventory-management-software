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
<page size="A4" layout="portrait">
<div style="padding:1cm;">
    <div style="width:100%; float:left">	
        <div style="text-align:center; padding:5px 0; width:20%; float:left">&nbsp;</div>
         <div style="text-align:center; padding:5px 0; width:60%; float:left">
                            <!--<img src="<?php echo base_url('assets/images/logo.png')?>" style="width:100px; height:auto" />-->
                            <div style="font-size:13px; text-align:center; margin-bottom:10px;">
                                <h1 style="margin:0; padding:0">KRC International</h1>
                                Imamgonj, Dhaka<br />
                                <h2 style="font-size:22px;margin:0; padding:0; text-decoration:underline">Salse Representative Collection Statement</h2>
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
         <div style="text-align:left; padding:5px 0; width:50%; float:left">
             <table align="left" width="100%" class="printfontsize">
                <tr>
                    <td width="53%" class="printfontsize">Sales Representative Code</td>
                  <td width="4%" class="printfontsize">:</td>
                  <td width="43%" class="printfontsize"><?php echo $srcode;?></td>
               </tr>
                <tr>
                    <td class="printfontsize">Sales Representative Name</td>
                    <td class="printfontsize">:</td>
                    <td class="printfontsize"><strong><?php echo $srname;?></strong></td>
                </tr>
                <tr>
                    <td class="printfontsize">Working Area</td>
                    <td class="printfontsize">:</td>
                    <td class="printfontsize"><?php echo $sraddress;?></td>
                </tr>
               
                
            </table>
        </div>
                            
    </div>
    <div style="width:100%; height:auto;" class="printfontsize">
       <table width="100%" border="1" class="printfontsize" style="border-collapse:collapse">
                                        <tr style="font-weight:bold;" class="printfontsize">
                                          <td width="55" height="33" align="center">SI</td>
                                          <td width="135" align="center">Date </td>
                                          <td colspan="2" align="center">P.T</td>
                                          <td width="123" align="center">P.Code</td>
                                          <td width="211" align="center">Party Name</td>
                                          <td width="229" align="center">Party Address</td>
                                          <td width="92" align="center">Cash</td>
                                          <td width="67" align="center">Bank </td>
                                          <td width="204" align="center">Bank Name & Branch</td>
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
											  // $bkash_id = $rowcash->bkash_id;
											   //$cash_id = $rowcash->cash_id;
											   
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
												foreach($bankinfo->result() as $br);
												$bank_name=$br->bank_name;
												$account_no=$br->account_no;
												$branch = $br->branch;
											   }
												
												
												$custinfo = $this->db->query("SELECT * FROM customers WHERE customer_id = '".$custid."'");
												foreach($custinfo->result() as $rowq);
												$buyername=$rowq->name;
												$buyercode=$rowq->cid;
												$buyeraddress=$rowq->address;
												
												$custinfo = $this->db->query("SELECT SUM(prev_balance) AS totalprev FROM customers WHERE salse_id = '".$salserepid."'");
												$rowprev = $custinfo->row_array();
												$prev_balance=$rowprev['totalprev'];
												    
												if($i%2!=0)
												{
												$c="#f5f5f5";
												}
												else
												{
												$c="#FFFFFF";
												}
												$i++;
                                        ?>
                                    
                                    <tr class="printfontsize" bgcolor="<?php echo $c; ?>"> 
                                      <td height="44" align="center"><?php echo $i;?></td>
                                      <td align="center"><?php echo $payment_date;?></td>
                                      <td width="72" align="center"><?php echo $total_db_invoice;?></td>
                                      <td width="65" align="center"><?php echo $total_invoice;?></td>
                                      <td width="123" align="center" style="padding:5px"><?php echo $buyercode;?></td>
                                      <td width="211" align="center" style="padding:5px"><?php echo $buyername;?></td>
                                      <td width="229" align="center" style="padding:5px"><?php echo $buyeraddress;?></td>
                                      <td width="92" align="center" style="padding:5px"><?php echo $totalcash;?></td>
                                      <td width="67" align="center" style="padding:5px"><?php echo $totalbank;?></td>
                                      <td width="204" align="center" style="padding:5px" title="<?php echo $account_no; ?>"><?php echo $bank_name.', '.$branch;?></td>
                                    </tr>
                                    <?php
                                    
                                    $tcash = $tcash + $totalcash;
                                    $tbank = $tbank + $totalbank;
                                   // $tdue = $tdue + $due_amount;
                                   // $tqty = $tqty + $qty;											
                                    }
                                    ?>
                                    <tr>
                                         <td height="29" colspan="5" style="border:none">&nbsp;</td>
                                      <td style="border:none" align="right">Total</td>
                                        <td style="border:none" align="right">&nbsp;</td>
                                        <td align="center" style="border-bottom:none"><strong><?php echo number_format($tcash,2,'.',',');?></strong></td>
                                        <td align="center" style="border-top:none"><strong><?php echo number_format($tbank,2,'.',',');?></strong></td>
                                    </tr>
                                     <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Previous</td>
                                       <td  style="border:none" align="right">&nbsp;</td>
                                       <td align="center" style="border-top:none"><strong><?php echo number_format($prev_balance,2,'.',',');?></strong></td>
                                    </tr>
                                    <?php 
									$gtotalcash = $tcash + $prev_balance;
									$bankdep = 10000;
									$tada = 2160;
									$salary = 1350;
									$editbon = 500;
									$totalcost = $bankdep + $tada + $salary + $editbon;
									$cashinhand = $gtotalcash - $totalcost;
									 ?>
                                    <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Total Cash</td>
                                       <td  style="border:none" align="right">&nbsp;</td>
                                       <td align="center" style="border-top:none;border-bottom:none"><strong><?php echo number_format($gtotalcash,2,'.',',');?></strong></td>
                                    </tr>
                                     <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Bank Deposit</td>
                                       <td  style="border:none" align="right"><strong style="margin-right:5px"><?php echo number_format($bankdep,2,'.',',');?></strong></td>
                                       <td align="center" style="border-top:none;border-bottom:none">&nbsp;</td>
                                    </tr>
                                     
                                     <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Total TA/DA</td>
                                       <td  style="border:none" align="right"><strong style="margin-right:5px"><?php echo number_format($tada,2,'.',',');?></strong></td>
                                       <td align="center" style="border-top:none;border-bottom:none">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Salary</td>
                                       <td  style="border:none" align="right"><strong style="margin-right:5px"><?php echo number_format($salary,2,'.',',');?></strong></td>
                                       <td align="center" style="border-top:none;border-bottom:none">&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Edit Bonus</td>
                                       <td  style="border:none" align="right"><strong style="margin-right:5px"><?php echo number_format($editbon,2,'.',',');?></strong></td>
                                       <td align="center" style="border-top:none;border-bottom:none"><strong style="margin-right:5px">
									   <?php echo number_format($totalcost,2,'.',',');?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                       <td height="30" colspan="5" style="border:none">&nbsp;</td>
                                       <td  style="border:none" align="right">Cas in Hand</td>
                                       <td  style="border:none" align="right">&nbsp;</td>
                                       <td align="center"><strong style="margin-right:5px"><?php echo number_format($cashinhand,2,'.',',');?></strong></td>
                                    </tr>
                                    
                                    </table>                                   
    </div>
    
    <div style="width:100%; height:auto; float:left; margin-top:2cm;">	
            <div style="width:15%; text-align:left; float:left; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Account Officer</div>        	
            <div style="width:15%; text-align:left; float:right; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Owner</div>
        	
    </div>
 </div>      
 </page>        