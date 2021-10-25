<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h5>Sales Reresentative Code : <?php echo $srcode;?></h5>
                            <h5>Sales Reresentative Name : <?php echo $srname;?></h5>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/salse_party_print/'.$cuid);?>" onclick="javascript:void window.open('<?php echo base_url('admin/salse_party_print/'.$cuid);?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                    <div class="container">
                                       <table width="100%" class="ordertable" border="1">
                                        <tr bgcolor="#333" class="trTitle">
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
											//$prev_balance = '';
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
												if($custinfo->num_rows() > 0){
													$rowprev = $custinfo->row_array();
													$prev_balance = $rowprev['totalprev'];
													$prevdisplay = number_format($prev_balance,2,'.',',');
												}
												else{
													$prev_balance = '';
													$prevdisplay =0;
												}
												    
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
                                    
                                    <tr class="trCont" bgcolor="<?php echo $c; ?>">
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
                                       <td align="center" style="border-top:none"><strong><?php echo $prevdisplay;?></strong></td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
