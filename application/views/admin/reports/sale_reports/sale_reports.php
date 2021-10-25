<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var customer_id=document.getElementById('customer_id').value;
	//alert(customer_id);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/sale_reports_ajax')?>',
			   data: {'fdate':fromdate,'tdate':todate,'customer_id':customer_id},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
</script>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}
</style>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Daily Sale Reports</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/sale_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:92%">
                                      <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                                        <tr>
                                            <td width="55%">
                                              <table width="100%" border="0" cellspacing="5" cellpadding="0" align="left">
                                              <tr>
                                                  <td width="25%">
                                                <input name="from_date" class="form-control date-picker" required type="text" id="from_date" placeholder="From Date :"/></td>
                                                <td width="3%">&nbsp;</td>
                                                <td width="19%">
                                                <input name="to_date" class="form-control date-picker" required type="text" id="to_date" placeholder="To Date:" ></td>
                                                <td width="4%">&nbsp;</td>
                                                  <td width="33%">
                                                  <select name="customer_id" id="customer_id" class="form-control"  style="margin-top:3px; margin-left:20px">
    
                                                <option value="">Select Buyer</option>
                                                <?php
                                                foreach($customerslist->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->customer_id; ?>"><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                </select></td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="14%">
                                                <input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                            </tr>
                                                  </table>
                                              
                                          </td>
                                          
                                      </tr>
                                      </table>
                                    </div>
                                  	<div style="float:right; width:8%"><a href="<?php echo base_url('admin/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a></div>
                                </div>
                                <div class="x_content">
                                		<div id="reportsdisplay">
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
												 	  $orderquery= $this->Index_model->getAllItemTable('orders','customer_id',$byerid,'','','order_id','desc');	
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
														  $saledetails = $this->db->query("SELECT * FROM  sale_details WHERE cust_id = '".$byerid."' ORDER BY id DESC");
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
														  $paymentDet = $this->db->query("SELECT * FROM  customer_payment 
														  WHERE customer_id = '".$byerid."' AND invoice_type='Invoice' ORDER BY id DESC");
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
                                        </div>
                                </div>
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