 <link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
   <style>
    
 .table_header{
	color:#fff;
	background:#000c10;
	padding:5px;
}
.trTitle{
	color:#fff;
	background:#000c10;
}

.trCont{
	padding:10px;
}
   </style>
  <?php
   if($order_q->num_rows() > 0){
	  foreach($order_q->result() as $rowq);
	  $order_id=$rowq->order_id;
	  $order_number=$rowq->order_number;
	  $order_time=$rowq->order_time;
	  $customer_id=$rowq->customer_id;
	  $status=$rowq->status;
	  $total_price=$rowq->total_price;
	  $paid_amount=$rowq->paid_amount;
	  $due_amount = $total_price - $paid_amount;
	  $payment_status=$rowq->payment_status;
  }
  else{
  	  $order_id='';
	  $order_number='';
	  $order_time='';
	  $customer_id='';
	  $status='';
	   $total_price='';
	  $paid_amount='';
	  $due_amount='';
	  $payment_status='';
  }
  if($customerQ->num_rows() > 0){
	  foreach($customerQ->result() as $rowc);
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
window.onload=print();
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
       <div class="row">
                                <div class="col-sm-12">
                                	<div class="col-sm-2" style="width:20%; float:left">
                                    <h2><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100%; height:auto" 
                                        title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></h2>
                                        </div>
                                    <div style="width:80%; float:left">
                                    	<address class="printfontsize">
                                           <h3><?php echo $cname;?></h3>                                            
                                            <p><?php echo $cadd;?></p>
    
                                        </address>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                	<div class="row" style="font-size:18px; border-bottom:1px solid #333; text-align:center">Bill/Invoice</div>
                                    <div class="col-sm-4">
                                    	<h4 class="text-left printfontsize">Invoice No. <?php echo $inv_id;?></h4>
                                    </div>
                                     <div class="col-sm-4">
                                    	<h4 class="text-center printfontsize">Order No. <?php echo $order_number;?></h4>
                                    </div>
                                     <div class="col-sm-4">
                                    	<h4 class="text-right printfontsize">Date. <?php echo date('Y-m-d');?></h4>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-12" style="margin-top:20px;">
                                        <table width="98%" border="0" cellspacing="1" cellpadding="1" class="printfontsize">
                                          <tr>
                                            <td width="17%">Buyer Name</td>
                                            <td width="4%" align="center">:</td>
                                            <td width="79%"><?php echo $acc_name;?></td>
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
                               	 <table width="100%" cellpadding="2" cellspacing="1" class="printfontsize" border="1" style="border-collapse:collapse; border-color:#000;">
          
                                  <tr  class="table_header">
                                    <td width="56" height="34" align="center"><span class="style2">SI</span></td>
                                    <td width="274" align="center" class="printfontsize">Name</td>
                                    <td width="128" align="center"class="printfontsize">Category</td>
                                    <td width="157" align="center"class="printfontsize"> Code</td>
                                    <td width="113" align="center"class="printfontsize"> Size</td>
                                    <td width="159" align="center"class="printfontsize">Quantity</td>
                                    <td width="126" align="center"class="printfontsize">Price</td>
                                    <td width="147" align="center"class="printfontsize"><span class="style2">Total Price</span></td>
                                  </tr>
                                  <?php
                           $i=0;
                           $grand_total=0;
                         
                          
                          $order_q=$this->db->query("select * from orders_products where order_id ='".$order_id."'");
                          foreach($order_q->result() as $rowq){
                          $order_id=$rowq->order_id;
                          $product_id=$rowq->product_id;
                          $qty=$rowq->qty;
                          $unit_price=$rowq->unit_price;
                          $sub_total=$rowq->total_price;
                          
                              $order_pro=$this->db->query("select * from product where product_id ='".$product_id."'");
                              foreach($order_pro->result() as $rowpro);
                              $main_image=$rowpro->main_image;
                              $product_name=$rowpro->product_name;
                              $pro_code=$rowpro->pro_code;
							  $cat_id=$rowpro->cat_id;
							  $size=$rowpro->size;
                              $grand_total=$grand_total+$sub_total;
                           
                            $i++;
                            ?>
                                 <tr class="printfontsize">
                                    <td height="22" align="center"><h6><?php echo $i;?></h6></td>
                                    <td align="center"><h6 class="printfontsize"><?php echo $product_name;?></h6></td>
                                    <td align="center" ><h6 class="printfontsize"><?php echo $cat_id;?></h6></td>
                                    <td align="center" ><h6 class="printfontsize"><?php echo $pro_code;?></h6></td>
                                    <td align="center" ><h6 class="printfontsize"><?php echo $size;?></h6></td>
                                    <td align="center"><h6 class="printfontsize"><?php echo $qty;?></h6></td>
                                    <td align="center"><h6 class="printfontsize"><?php echo $unit_price;?></h6></td>
                                    <td align="center"><h6 class="printfontsize"><?php echo $sub_total;?></h6></td>
                                </tr>
                                  <?php
                          }
                          ?>
                          		<tr><td height="36" colspan="9" align="center">&nbsp;</td></tr>
                                <tr>
                                   <td height="44" colspan="6" align="center">&nbsp;</td>
                                   <td align="center">Total Amount</td>
                                   <td align="center">TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></td>
                                </tr>
                                <tr>
                                   <td height="44" colspan="6" align="center">&nbsp;</td>
                                   <td align="center">Paid Amount</td>
                                   <td align="center">TK&nbsp;&nbsp;<?php echo number_format($paid_amount);?></td>
                                </tr>
                                <tr>
                                   <td height="44" colspan="6" align="center">&nbsp;</td>
                                   <td align="center">Due Amount</td>
                                   <td align="center">TK&nbsp;&nbsp;<?php echo number_format($due_amount);?></td>
                                </tr>
                                </table>
                                </div>
                                
                                
                                
                                
                                
                                </div>                         
  </div>
 </page>              