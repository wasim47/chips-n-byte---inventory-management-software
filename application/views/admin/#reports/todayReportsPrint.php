<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
                <div class="">

                    <div style="width:100%; float:left">	
                                  	  		<div style="text-align:center; padding:5px 0">
                                        	
                                            <img src="<?php echo base_url('assets/images/logo.png')?>" style="width:15%; height:auto" />
                                            <address style="font-size:13px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                        <div class="container">
                                        	<table align="center" width="40%"  style="border:1px solid #ccc;" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="26" colspan="3" align="center"><span style="font-size:18px; font-weight:bold">Today's Report Summary </span></td>
                                              </tr>
                                                <tr>
                                                    <td width="57%" height="25" align="right"><span style="font-size:18px">Total Received from customer</span></td>
                                                  <td width="3%" align="center">:</td>
                                                  <td width="40%" align="left">
                                                        <span style="font-size:18px"><?php
                                                        $sql1=$this->db->query("select sum(total_amount) as amount from income_source where subimition_date='".$today."' order by inc_id asc");
                                                        if($sql1->num_rows() > 0)
                                                        {
                                                        foreach($sql1->result() as $row1);												
                                                        $t_r_amount=$row1->amount;
														echo 'TK '.number_format($t_r_amount,2,'.',',').' /=';
                                                        }
                                                        ?></span>                                                        </td>
                                              </tr>
                                                <tr>
                                                    <td height="24" align="right"><span style="font-size:18px">Total Expenses</span> </td>
                                                  <td height="24" align="center">:</td>
                                       <td align="left">
                                                       <span style="font-size:18px"><?php
                                                        $sql2=$this->db->query("select sum(total_amount) as amount from internal_cost where payment_date='".$today."' order by pay_id asc");
                                                        if($sql2->num_rows() > 0)
                                                        {
                                                        foreach($sql2->result() as $row2);												
                                                        $t_p_amount=$row2->amount;
                                                        echo 'TK '.number_format($t_p_amount,2,'.',',').' /=';
                                                        }
                                                        ?></span>                                                      </td>
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
                                                    <td height="23" align="right" class="flink"><?php echo $conl;?></td>
                                                  <td height="23" align="center" class="flink">:</td>
                                            <td align="left"><strong>
                                                    <?php echo 'TK '.number_format($profit,2,'.',',').' /=';?>		
                                                    </strong>                                                    </td>
                                              </tr>
                                            </table>
                                        </div>
                                        <div class="container">
                                           <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px; margin-top:20px; font-weight:bold">Total Cost</div>
                                          <table border="1" width="100%" style="border-collapse:collapse" bordercolor="#ccc">
                                            <tr bgcolor="#eaeaea">
                                                 <th width="3%" height="27" align="center">SI</th>
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
                                            
                                            $queryCost=$this->db->query("select * from internal_cost where payment_date='".$today."'");
                                            foreach($queryCost->result() as $payrow){
                                            $paymentfor=$payrow->paymentfor;
                                            $costAmount=$payrow->total_amount;	
                                            $cost_by=$payrow->cost_by;
                                            $voucherno=$payrow->serial_no;
                                            $remarks=$payrow->remarks;
                                            $payment_date=$payrow->payment_date;
                                            
                                            
                                            $querypaymentfor=$this->db->query("select * from asset_investment where par_id='".$paymentfor."'");
                                            foreach($querypaymentfor->result() as $pfor);
                                            $clr='#fff';
                                            
                                            $i++;
                                            
                                            ?>
                                            
                                            
                                            <tr bgcolor="<?php echo $clr;?>">
                                                <td height="27" align="center"><?php echo $i;?></td>
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
                                            
                                            <tr bgcolor="#F9F9F9">
                                                 <th height="32" colspan="5" align="center">&nbsp;</th>
                                               <th align="right" colspan="2" style="font-size:16px; text-align:right">
                                                 Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></th>
                                              </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="container">
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px; margin-top:20px; font-weight:bold">Total Income</div>
                                          <table border="1" width="100%" style="border-collapse:collapse" bordercolor="#ccc">
                                            <tr bgcolor="#eaeaea">
                                                 <th width="3%" height="28" align="center">SI</th>
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
                                            
                                           $queryIncome=$this->db->query("select * from income_source where subimition_date='".$today."'");
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
                                             $clr='#fff';
                                            
                                            $j++;
                                            
                                            ?>
                                            
                                            
                                            <tr bgcolor="<?php echo $clr;?>">
                                                <td height="24" align="center"><?php echo $j;?></td>
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
                                                 <th height="33" colspan="5" align="center">&nbsp;</th>
                                               <th align="right" colspan="2" style="font-size:16px; text-align:right">
                                                 Total Amount = <?php echo 'TK '.number_format($incomeCount,2,'.',',').' /=';?></th>
                                              </tr>
                                            </table>
                                        </div>
                                        <div class="container" style="font-size:20px; border-top:1px solid #ccc; float:left; text-align:center; width:100%; margin-bottom:5px; margin-top:20px">
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>

                </div>
               