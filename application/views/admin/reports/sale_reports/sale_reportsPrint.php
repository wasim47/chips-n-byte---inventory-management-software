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
	padding:2px;
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
                            <div id="reportPrintDisplay">
                                
                                <div class="row">
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
    </div>
</page>             