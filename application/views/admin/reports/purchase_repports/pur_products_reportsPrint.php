<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var customer_id=document.getElementById('customer_id').value;
	//alert(customer_id);
	if(customer_id!='' || fromdate!="" || todate!=""){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/sale_reports_ajax')?>',
			   data: {'fdate':fromdate,'tdate':todate,'customer_id':customer_id},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
}
window.onload=reportsAjax;
</script>

<input name="from_date" class="form-control"  type="hidden" id="from_date" value="<?php echo $this->session->userdata('fromDate');?>"/>
<input name="to_date" class="form-control"  type="hidden" id="to_date" value="<?php echo $this->session->userdata('toDate');?>"/>
<input name="customer_id" class="form-control"  type="hidden" id="customer_id" value="<?php echo $this->session->userdata('customerid');?>"/>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:2px 5px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}

		body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: #fff;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  /*height: 29.7cm;*/ 
	  height:auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	 /* height: 21cm;  */
	 height:auto;
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
</style>
<page size="A4" layout="portrait">
    <div style="padding:1cm;">
            <div class="row">
            <div style="width:100%; float:left">	
               <div style="text-align:center; padding:5px 0">
                                    
                                    <h2 style="padding:0; margin:0"><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100px; height:auto" 
                                        title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></h2>           
                                <p><?php echo $cadd;?></p>
                                    </div>           	  		
            </div>
            <div class="clearfix"></div>
            <div class="row">
        
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <div id="reportPrintDisplay">
                                
                                <div class="row">
                                       <table width="100%" class="summTable" border="1">
                                                <tr class="theadline">
                                                  <td width="57" height="28" align="center">SI</td>
                                                  <td width="136" align="center">Date </td>
                                                  <td width="136" align="center">Code </td>
                                                  <td width="440" align="center">Product Name </td>
                                                  <td width="128" align="center">Quantity </td>
                                                   <td width="113" align="center">Rate </td>
                                                  <td width="102" align="center">Commission </td>
                                                  <td width="153" align="center">Total Price </td>
                                             </tr>
                                                <?php
                                                    $i=0;
                                                    $tqty = 0;
                                                    $tprice = 0;
                                                    $tpaid = 0;
                                                    $tdue = 0;
                                                  foreach($partyladger->result() as $rowq){													  
													  $product_name=$rowq->product_name;
													  $pro_code=$rowq->pro_code;
													  $product_id=$rowq->product_id;
                                                  
												  	 ///////////////// total quantity by order and invoice///////////////
													    $sql = "SELECT SUM(qty) AS tq,SUM(total_price) AS tp,SUM(unit_price) AS up FROM orders_products WHERE product_id = ?";
													    $ordque = $this->db->query($sql,$product_id);
														if($ordque->num_rows() > 0){
														  $ordr = $ordque->row_array();
														  $qty = $ordr['tq'];
														  $urice = $ordr['up'];
														  $tprice = $ordr['tp'];
														}
														else{
															$qty = 0;
															$urice = 0;
															$tprice = 0;
														}
														
														
														
														///////////////// total quantity by sale and  sale invoice///////////////
														  /*$saledetails = $this->db->query("SELECT * FROM  sale_product_info WHERE product_id = '".$product_id."' ORDER BY id DESC");
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
															}*/
															
															
															
													$sqls = "SELECT SUM(total_qty) AS tq,SUM(sale_price) AS sp,SUM(total_amount) AS tm FROM sale_product_info WHERE product_id = ?";
														$saledetails = $this->db->query($sqls,$product_id);
														if($saledetails->num_rows() > 0){
														  $ordrs = $saledetails->row_array();
														  $sqty = $ordrs['tq'];
														  $surice = $ordrs['sp'];
														  $stprice = $ordrs['tm'];
														}
														else{
															$sqty = 0;
															$surice = 0;
															$stprice = 0;
														}
														
														 $totalqty = $qty+$sqty;
														 $totalrate = $urice+$surice;
														 $totalprice = $tprice+$stprice;
													 /*	///////////////// Get total Price///////////////
														  $paymentDet = $this->db->query("SELECT * FROM  customer_payment 
														  WHERE customer_id = '".$product_id."' AND invoice_type='Invoice' ORDER BY id DESC");
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
															} */
	                                                    $i++;
                                                ?>
                                            
                                            <tr class="trCont">
                                              <td height="26" align="center"><?php echo $i;?></td>
                                              <td width="136" align="center"><?php //echo $product_name;?></td>
                                              <td width="136" align="center"><?php echo $pro_code;?></td>
                                              <td width="440" align="left"><?php echo $product_name;?></td>
                                              <td align="right"><?php echo $totalqty;?></td>
                                              <td width="113" align="right"><?php echo number_format($totalrate,2,'.',',');?></td>
                                              <td width="102" align="right">0</td>
                                              <td width="153" align="right"><?php echo number_format($totalprice,2,'.',',');?></td>
                                            </tr>
                                            <?php
                                            /*$tqty = $tqty + $totalqty;
                                            $tprice = $tprice + $tsaleam;
                                            $tpaid = $tpaid + $tpaidam;
                                            $tdue = $tdue + $tdueam;*/
                                            
                                            }
                                            ?>
                                            <?php /*?><tr>
                                                <td height="31" colspan="4">&nbsp;</td>
                                              <td align="center"><h4 style="color:#000066; font-size:15px;"><?php echo 'Total Qty: <strong>'.$tqty.'</strong>';?></h4></td>
                                                <td align="center"><h4 style="color:#999900; font-size:15px;"><?php echo 'Total Price: BDT <strong>'.$tprice.'</strong>';?></h4></td>
                                                <td width="20" align="center"><h4 style="color:#009900; font-size:15px;"><?php echo 'Total Paid: BDT <strong>'.$tpaid.'</strong>';?></h4></td>
                                              <td width="22" align="center"><h4 style="color:#FF0000; font-size:15px;"><?php echo 'Total Due: BDT <strong>'.$tdue.'</strong>';?></h4></td>
                                            </tr><?php */?>
                                            
                                           
                                            </table>                          
                                  </div>
                            
                            </div>
                        </div>
                </div>
            </div>
        
        </div>
            </div>
    </div>
</page>             