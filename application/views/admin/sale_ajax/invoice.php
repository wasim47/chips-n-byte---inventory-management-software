 <?php
  if($customer_info->num_rows() > 0){
	  foreach($customer_info->result() as $rowc);
	  $customer_id=$rowc->customer_id;
	  $acc_address=$rowc->address;
	  $acc_contact=$rowc->mobile;
	  $acc_name=$rowc->name;
	  $acc_code=$rowc->cid;
  }
  else{
  	  $customer_id='';
	  $acc_address='';
	  $acc_contact='';
	  $acc_name='';
	  $acc_code='';
  }
  
  
?>
<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status").value;
window.location.href='<?php echo base_url();?>admin/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
</script>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:5px;
	color:#000;
}
</style>

<div class="right_col" role="main">
                    <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                <div class="col-sm-12">
                                	<div class="col-sm-2">
                                    	<h2><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100%; height:auto" 
                                        title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></h2>
                                    </div>
                                    <div class="col-sm-4">
                                    	<address style="width:85%; float:left">
                                            <h3><?php echo $cname;?></h3>                                            
                                            <p><?php echo $cadd;?></p>
    
                                        </address>
                                    </div>
                                    <div class="col-sm-1 pull-right">
                                    <a href="<?php echo base_url('admin/sale_invoice/'.$inv_id.'/?status=print');?>" 
                                    onclick="javascript:void window.open('<?php echo base_url('admin/sale_invoice/'.$inv_id.'/?status=print');?>','','width=1200,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=100,top=30');return false;"><i class="fa fa-print"></i> Print</a></div>
                                </div>
                                <div class="col-sm-12">
                                	<div class="row" style="font-size:18px; border-bottom:1px solid #333; text-align:center">Bill/Invoice</div>
                                    <div class="col-sm-4">
                                    	<h4 class="text-left">Invoice No. <?php echo $invoice_id;?></h4>
                                    </div>
                                     <div class="col-sm-4">
                                    	<h4 class="text-center">&nbsp;</h4>
                                    </div>
                                     <div class="col-sm-4">
                                    	<h4 class="text-right">Date. <?php echo date('Y-m-d');?></h4>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4" style="margin-top:20px;">
                                        <table width="98%" border="0" cellspacing="1" cellpadding="1">
                                          <tr>
                                            <td width="29%">Buyer Name</td>
                                            <td width="6%" align="center">:</td>
                                            <td width="65%"><?php echo $acc_name;?></td>
                                          </tr>
                                          <tr>
                                            <td>Buyer Code</td>
                                            <td align="center">:</td>
                                            <td><?php echo $acc_code;?></td>
                                          </tr>
                                          <tr>
                                            <td>Buyer Address</td>
                                            <td align="center">:</td>
                                            <td><?php echo $acc_address;?></td>
                                          </tr>
                                          <tr>
                                            <td>Buyer Phone</td>
                                            <td align="center">:</td>
                                            <td><?php echo $acc_contact;?></td>
                                          </tr>
                                        </table>
                                    </div>
                                     
                                </div>
                              	
                                
                                <div class="col-sm-12" style="margin-top:30px;">
                                	<?php 
                               	 	if($sale_pro_info->num_rows() > 0){
                                        echo '<table width="100%" border="1" style="background:#fff; color:#000" class="summTable">
                                                <tr bgcolor="#ccc">
                                                    <th>SI</th>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Size</th>
                                                    <th>Qty</th>
                                                    <th>Unit Price</th>
                                                    <th>Sale Price</th>
                                                    <th>Comission</th>
                                                    <th>Vat</th>
                                                    <th>Total</th>
                                                </tr>';
                                             $i=1;
											 $billamount = 0;
                                             foreach($sale_pro_info->result() as $pinf):
                                                 $productInfo = $this->Index_model->getAllItemTable('product','product_id',$pinf->product_id,'','','product_id','desc');
                                                 $pRow = $productInfo->row_array();
                                                 $pCode = 	$pRow['pro_code'];
                                                 $pName = 	$pRow['product_name'];
                                                 $pSize = 	$pRow['size'];
                                                 $pPrice = 	$pRow['price'];
												 $totalformate = number_format($pinf->total_amount,'2','.',',');
                                                    echo '<tr>
                                                                    <th>'.$i.'</th>
                                                                    <th>'.$pCode.'</th>
                                                                    <th>'.$pName.'</th>
                                                                    <th>'.$pSize.'</th>
                                                                    <th>'.$pinf->total_qty.'</th>
                                                                    <th>'.$pPrice.'</th>
                                                                    <th>'.$pinf->sale_price.'</th>
                                                                    <th>'.$pinf->vat.'</th>
                                                                    <th>'.$pinf->commission.'</th>
                                                                    <th>'.$totalformate.'</th>
                                                                </tr>';
                                                    $i++;
													$billamount = $billamount + $pinf->total_amount;
                                            endforeach;
                                            
                                           echo '</table>';
										 }
										 
										 $totalwithCo = floatval($billamount) - floatval($commission);
										 $totalLesPrev = floatval($totalwithCo) + floatval($prevDue);
										 $grandTotal = floatval($totalLesPrev) - floatval($payment);
									?>
                                    
                                    
                                    <table width="40%" border="1" align="right" class="summTable">
                                          <tr>
                                            <td width="43%">Bill Amount</td>
                                            <td width="10%" align="center">:</td>
                                            <td width="47%"><?php echo $billamount;?></td>
                                      </tr>
                                          <tr>
                                            <td>Discount</td>
                                            <td align="center">:</td>
                                            <td><?php echo $commission;?></td>
                                          </tr>
                                          <tr>
                                            <td>Transport Cost</td>
                                            <td align="center">:</td>
                                            <td><?php echo $transport_cost;?></td>
                                          </tr>
                                          <tr>
                                            <td>Total</td>
                                            <td align="center">:</td>
                                            <td><?php echo $totalwithCo;?></td>
                                          </tr>
                                          <tr>
                                            <td>Previous Due</td>
                                            <td align="center">:</td>
                                            <td><?php echo $prevDue;?></td>
                                          </tr>
                                          <tr>
                                            <td>Paid</td>
                                            <td align="center">:</td>
                                            <td><?php echo $payment;?></td>
                                          </tr>
                                          <tr>
                                            <td>Grant Total</td>
                                            <td align="center">:</td>
                                            <td><?php echo $grandTotal;?></td>
                                          </tr>
                                        </table>
                                </div>
                                
                                
                                
                                
                                
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
               