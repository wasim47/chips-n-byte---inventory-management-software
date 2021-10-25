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
</script>

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
                                    <a href="<?php echo base_url('admin/invoice/'.$inv_id.'/?status=print');?>" 
                                    onclick="javascript:void window.open('<?php echo base_url('admin/invoice/'.$inv_id.'/?status=print');?>','','width=1200,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=100,top=30');return false;"><i class="fa fa-print"></i> Print</a></div>
                                </div>
                                <div class="col-sm-12">
                                	<div class="row" style="font-size:18px; border-bottom:1px solid #333; text-align:center">Bill/Invoice</div>
                                    <div class="col-sm-4">
                                    	<h4 class="text-left">Invoice No. <?php echo $inv_id;?></h4>
                                    </div>
                                     <div class="col-sm-4">
                                    	<h4 class="text-center">Order No. <?php echo $order_number;?></h4>
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
                               	 <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
                                  <tr  class="table_header">
                                    <td width="56" height="36" align="center"><span class="style2">SI</span></td>
                                    <td width="272" align="center">Name</td>
                                    <td width="127" align="center">Category</td>
                                    <td width="126" align="center">Image</td>
                                    <td width="121" align="center"> Code</td>
                                    <td width="112" align="center"> Size</td>
                                    <td width="158" align="center">Quantity</td>
                                    <td width="125" align="center">Price</td>
                                    <td width="143" align="center"><span class="style2">Total Price</span></td>
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
                                 <tr bgcolor="<?php echo $c; ?>" style="border-bottom:1px solid #ccc; font-size:13px;">
                                   <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                                            <td align="center" ><h6><?php echo $product_name;?></h6></td>
                                            <td align="center" ><h6><?php echo $cat_id;?></h6></td>
                                   <td align="center" >
                                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" 
                                                   style="width:80px; height:50px; margin:5px; border:1px solid #333" />                                            </td>
                                              <td align="center" ><h6><?php echo $pro_code;?></h6></td>
                                              <td align="center" ><h6><?php echo $size;?></h6></td>
                                       		  <td align="center" ><?php echo $qty;?></td>
                                   <td align="center" ><?php echo $unit_price;?></td>
                                            
                                   <td align="center" ><h6><strong><?php echo $sub_total;?></strong></h6></td>
                                            </tr>
                                  <?php
                          }
                          ?>
                          <tr><td colspan="9" align="center"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                <tr>
                                    <td height="44" colspan="4" align="center">&nbsp;</td>
                                   <td align="center" class="section">&nbsp;</td>
                                   <td align="center" class="section">&nbsp;</td>
                                   <td align="center" class="section">&nbsp;</td>
                                	<td align="center" colspan="2">
                                    	<table width="100%" align="center">
                                        	<tr>
                                            	<td><h2>Total Amount</h2></td>
                                                <td align="right"><h2 style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></h2></td>
                                            </tr>
                                            <tr>
                                            	<td><h2>Paid Amount</h2></td>
                                                <td align="right"><h2 style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($paid_amount);?></h2></td>
                                            </tr>
                                            <tr>
                                            	<td><h2>Due Amount</h2></td>
                                                <td align="right"><h2 style="padding:0; margin:0">TK&nbsp;&nbsp;<?php echo number_format($due_amount);?></h2></td>
                                            </tr>
                                        </table>
                                    
                                    </td>
                                   </tr>
                                </table>
                                </div>
                                
                                
                                
                                
                                
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
               