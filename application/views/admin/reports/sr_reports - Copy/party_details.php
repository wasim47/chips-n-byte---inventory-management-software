<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h5>Sales Reresentative Code : <?php echo $srcode;?></h5>
                            <h5>Sales Reresentative Name : <?php echo $srname;?></h5>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/sr_reports_print/'.$cuid);?>" onclick="javascript:void window.open('<?php echo base_url('admin/sr_reports_print/'.$cuid);?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
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
                                          <td width="189" align="center">Date </td>
                                          <td colspan="2" align="center">P.T</td>
                                          <td width="139" align="center">P.Code</td>
                                          <td width="179" align="center">Party Name</td>
                                          <td width="190" align="center">Party Address</td>
                                          <td width="80" align="center">Cash</td>
                                          <td width="64" align="center">Bank </td>
                                          <td width="147" align="center">Bank Name </td>
                                     </tr>
                                     
                                     <!--<tr class="trCont">
                                      <td height="44" align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td width="99" align="center">&nbsp;</td>
                                      <td width="111" align="center">&nbsp;</td>
                                       <td width="307" align="center" style="padding:5px">Previous Balance</td>
                                      <td width="157" align="center" style="padding:5px">&nbsp;</td>
                                      <td width="156" align="center" style="padding:5px">&nbsp;</td>
                                      <td width="191" align="center" style="padding:5px"><?php echo $prev_balance;?></td>
                                    </tr>-->
                                        <?php
                                            $i=0;
                                            $tqty = 0;
                                            $tprice = 0;
                                            $tpaid = 0;
                                            $tdue = 0;
                                            //$dueamo = $prev_balance;
                                           foreach($party_list->result() as $rowq){													  
												  $custid=$rowq->customer_id;
												   $buyername=$rowq->name;
												  $buyercode=$rowq->cid;
												  $buyeraddress=$rowq->address;
										   $cashpayment = $this->db->query("SELECT SUM(paid_amount) AS totalcash FROM customer_payment 
										   WHERE pay_method='Cash' AND customer_id = '".$custid."'");
										   $rowcash = $cashpayment->row_array();
										   $totalcash = $rowcash['totalcash'];
										   
										   $bankpayment = $this->db->query("SELECT SUM(paid_amount) AS totalbank FROM customer_payment 
										   WHERE pay_method='Bank' AND customer_id = '".$custid."'");
										   $rowbank = $bankpayment->row_array();
										   $totalbank = $rowbank['totalbank'];
												 // $invoice_type=$rowq->invoice_type;													  
												  //$sale_amount = $rowq->sale_amount;
												 // $paid_amount = $rowq->paid_amount;
												 // $total_invoice=$rowq->total_invoice;
												  //$total_db_invoice=$rowq->total_db_invoice;
                                             /* $id=$rowq->id;
                                              $customer_id=$rowq->customer_id;
                                              $invoice_type=$rowq->invoice_type;													  
                                              $sale_amount = $rowq->sale_amount;
                                              $paid_amount = $rowq->paid_amount;
                                             $total_invoice=$rowq->total_invoice;
                                             $total_db_invoice=$rowq->total_db_invoice;
                                            
                                              $dueamo += $sale_amount - $paid_amount;
                                              //$due_amount =  $dueamo;
                                              $due_amount = $dueamo;
                                              $date = $rowq->date;
                                              $payment_date = $rowq->payment_date;
                                              $order_id=$rowq->order_id;
                                          
                                                                                          
                                           $ordque = $this->db->query("SELECT SUM(qty) AS totalqty FROM orders_products WHERE order_id = '".$order_id."'");
                                           if($ordque->num_rows() > 0){
                                             $ordr = $ordque->row_array();
                                             $qty = $ordr['totalqty'];
                                          }
                                          else{
                                             $qty = 0;
                                          }
                                          
                                          if($invoice_type!=''){    
                                                if($invoice_type=='Invoice'){															
                                                     $particular = 'Sales '.$qty.' Piece';
                                                 }
                                                 elseif($invoice_type=='Voucher'){
                                                    $total_invoice='V - '.$rowq->voucher;
                                                    $total_db_invoice='';
                                                    $particular = 'Cash Recived';
                                                 }
                                            }
                                            else{
                                                $particular = 'Sales '.$qty.' Piece';
                                            }*/
                                                                     
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
                                      <td align="center"><?php //echo $payment_date;?></td>
                                      <td width="99" align="center"><?php //echo $total_db_invoice;?></td>
                                      <td width="111" align="center"><?php //echo $total_invoice;?></td>
                                      <td width="139" align="center" style="padding:5px"><?php echo $buyercode;?></td>
                                      <td width="179" align="center" style="padding:5px"><?php echo $buyername;?></td>
                                      <td width="190" align="center" style="padding:5px"><?php echo $buyeraddress;?></td>
                                      <td width="80" align="center" style="padding:5px"><?php echo $totalcash;?></td>
                                      <td width="64" align="center" style="padding:5px"><?php echo $totalbank;?></td>
                                      <td width="147" align="center" style="padding:5px"><?php //echo $date;?></td>
                                    </tr>
                                    <?php
                                    
                                    //$tprice = $tprice + $sale_amount;
                                    //$tpaid = $tpaid + $paid_amount;
                                   // $tdue = $tdue + $due_amount;
                                   // $tqty = $tqty + $qty;											
                                    }
                                    ?>
                                    <!--<tr>
                                        <td height="50" colspan="6">&nbsp;</td>
                                        <td align="center"><strong><?php echo $tqty.' Piece';?></strong></td>
                                        <td align="center"><strong><?php echo $tprice;?></strong></td>
                                        <td align="center"><strong><?php echo $tpaid;?></strong></td>
                                        <td align="center"><strong><?php //echo $tdue;?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                         <td height="39" colspan="2">&nbsp;</td>
                                        <td align="center" colspan="1"><h4 style="color:#000066;"><?php echo 'Total Qty: <strong>'.$tqty.'</strong>';?></h4></td>
                                        <td align="center" colspan="3"><h4 style="color:#999900;"><?php echo 'Total Price: BDT <strong>'.$tprice.'</strong> /= TK';?></h4></td>
                                        <td align="center" colspan="3"><h4 style="color:#009900;"><?php echo 'Total Paid: BDT <strong>'.$tpaid.'</strong> /= TK';?></h4></td>
                                        <td align="center" colspan="3"><h4 style="color:#FF0000;"><?php echo 'Total Due: BDT <strong>'.$tdue.'</strong> /= TK';?></h4></td>
                                    </tr>-->
                                    </table>                          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
