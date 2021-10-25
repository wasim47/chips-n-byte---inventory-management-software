 <?php
  foreach($order_q->result() as $rowq);
  $order_id=$rowq->order_id;
  $order_number=$rowq->order_number;
  $order_time=$rowq->order_time;
  $customer_id=$rowq->customer_id;
  $salse_id=$rowq->salse_id;
  $status=$rowq->status;
  $total_price=$rowq->total_price;
  $paid_amount=$rowq->paid_amount;
  $due_amount = $total_price - $paid_amount;
  $payment_status=$rowq->payment_status;
  
  foreach($customerQ->result() as $rowc);
  $acc_email=$rowc->email;
  $acc_contact=$rowc->mobile;
  $acc_name=$rowc->name;
  $acc_address=$rowc->address;
  
 
?>
<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status").value;
window.location.href='<?php echo base_url();?>admin/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}


function paymentMethod(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('bankinfo').style.display="inline";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('tranid').style.display="inline";
		document.getElementById('bkash_no').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	/*else if(status=="Others"){
		document.getElementById('othersval').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
	}*/
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
}
function checkPay(){
	var total_price = document.getElementById("total_price").value;
	var paid_amount = document.getElementById("paid_amount").value;
	var exspaid = document.getElementById("exspaid").value;
	
	var finalPaid = parseInt(exspaid) + parseInt(paid_amount);
	if(parseInt(finalPaid) > parseInt(total_price)){
		//alert("You can't pay more than Order Total price and not less than 10 Taka");
		document.getElementById("paid_amount").value='';
		document.getElementById("errormsg").innerHTML="You can't pay more than Order Total price and not less than 10 Taka";
		document.getElementById("errormsg").style.color="#dd5044";
		document.getElementById("paid_amount").focus();
		//return false;
	}
	else{
		document.getElementById("errormsg").innerHTML="Valid Data";
		document.getElementById("errormsg").style.color="#19a15f";
	}
}


function updateOrdeStatus(id){
	  var confirmval = confirm("\t\t Are you sure ? \n You want to change Quantity and Price ?");
		if(confirmval == true){
			var orderid = $("#orderid").val();
			var pid = $("#prodid"+id).val();
			var cqty = $("#changeQty"+id).val();
			var cprice = $("#changePrice"+id).val();
			var surl = '<?php echo base_url('admin/update_quantity');?>';

			//alert(surl);
			  $.ajax({ 
				type: "POST", 
				dataType: "json",
				url: surl,  
				data:{'oid':orderid,'opid':id,'product_id':pid,'cqty':cqty,'cprice':cprice},
				cache : false, 
				success: function(response) { 
				  $("#userstatus").html(response.jsonmsg);
				   $("#userstatus").css('color',response.color);
				   window.location.reload();
				}, 
				error: function (xhr, status) {  
				  alert('Unknown error ' + status); 
				}    
			  });  
		}
		else{
			return false;
		}
	  
    }
	
</script>
<style>
.tableborder{
	padding:10px;
}
.tableborder td{
	padding:3px 5px;
}
</style>

<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                
                                	<?php 
									if($orderstatus=="Delivered"){
									?>
                                    <h2 style="float:right; width:100%; text-align:right">
                                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoiceModal">Get Invoice</button>
                                    <div class="modal fade" id="invoiceModal">
                                    	<div class="modal-dialog" role="dialog">
                                        	<div class="modal-content">
                                            	<div class="modal-header">
                                                	<button type="button" class="close" data-dismiss="modal">&times;</button>
        											<h4 class="modal-title" style="text-align:left">Payment</h4>                                                     
                                                </div>
                                        		<div class="modal-body">
                                                	<?php echo form_open('admin/new_invoice');?>
                                                	<table width="100%" border="1" bordercolor="#ccc" class="tableborder">
                                                      <tr>
                                                            <td width="31%" align="left">
                                                              <span style="font-size:15px; font-weight:bold">Total Amount</span></td>
                                                            <td width="7%" align="center">:</td>
                                                        <td width="62%" align="left"><span style="font-size:15px; font-weight:bold"><?php echo 'BDT '.$total_price;?></span></td>
                                                      </tr>
                                                       <tr>
                                                            <td width="31%" align="left">
                                                              <span style="font-size:15px; font-weight:bold">Paid Amount</span></td>
                                                            <td width="7%" align="center">:</td>
                                                        <td width="62%" align="left"><span style="font-size:15px; font-weight:bold"><?php echo 'BDT '.$paid_amount;?></span></td>
                                                      </tr>
                                                          <tr>
                                                            <td width="31%" align="left">
                                                                <span style="font-size:15px; font-weight:bold">Due Amount</span></td>
                                                            <td width="7%" align="center">:</td>
                                                            <td width="62%" align="left"><span style="font-size:15px; font-weight:bold"><?php echo 'BDT '.$due_amount;?></span></td>
                                                      </tr>
                                                          <tr>
                                                            <td width="31%" align="left">
                                                                <span style="font-size:15px; font-weight:bold">Payment Status</span></td>
                                                            <td width="7%" align="center">:</td>
                                                            <td width="62%" align="left"><span style="font-size:15px; font-weight:bold"><?php echo $payment_status;?></span></td>
                                                      </tr>
                                                      </tr>
                                                          <tr>
                                                            <td width="31%" align="left">
                                                                <span style="font-size:15px; font-weight:bold">Payment Method</span></td>
                                                            <td width="7%" align="center">:</td>
                                                            <td width="62%" align="left">
																<select class="form-control" name="pay_method" style="width:50%; float:left" onchange="paymentMethod(this.value)">
                                                                	<option value="Cash">Cash</option>
                                                                    <option value="Bank">Bank</option>
                                                                    <option value="bKash">bKash</option>
                                                                   <!-- <option value="Others">Others</option>-->
                                                                </select>
                                                                <select class="form-control" name="bankinfo" id="bankinfo" style="width:50%; float:left; display:none">
                                                                	<?php foreach($bank_list->result() as $brow):?>
                                                                		<option value="<?php echo $brow->b_id;?>">
																		<?php echo $brow->bank_name.' - '.$brow->account_no;?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                                <div  style="width:50%; float:left;">
                                                              <input type="text" name="tranid" id="tranid" class="form-control" style="width:100%; float:left; display:none" 
                                                              placeholder="Transaction ID" />
                                                              <input type="text" name="bkash_no" id="bkash_no" class="form-control" style="width:100%; float:left; display:none" 
                                                              placeholder="bKash No." />
                                                              </div>
                                                              <!--<input type="text" name="othersval" id="othersval" class="form-control" style="width:50%; float:left; display:none"
                                                              placeholder="Others" />-->
                                                                
                                                            </td>
                                                      </tr>
                                                          <tr>
                                                            <td width="31%" align="left">
                                                                <span style="font-size:15px; font-weight:bold">Pay Amount</span></td>
                                                            <td width="7%" align="center">:</td>
                                                            <td width="62%" align="left">
                                                            
															   <input type="text" name="paid_amount" id="paid_amount" onkeyup="checkPay()" onblur="checkPay();"  
                                                                class="form-control" placeholder="Paid Amount" style="width:50%; float:left" />
                                                                 
                                                                 <input type="hidden" name="total_price" id="total_price" value="<?php echo $total_price;?>" />
                                                                 <input type="hidden" name="exspaid" id="exspaid" value="<?php echo $paid_amount;?>" />
                                                                 <input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
                                                                 <input type="hidden" name="salse_id" value="<?php echo $salse_id;?>" />
                                                                 <input type="hidden" name="orderNumber" value="<?php echo $order_number;?>" />
                                                                 <input type="hidden" name="cust_id" value="<?php echo $customer_id;?>" />
                                                                <input type="submit" name="invoiceCreate" value="Get Invoice" class="btn btn-primary" />
                                                           
                                                            </td>
                                                      </tr>
                                                      <tr><td colspan="3" align="center"><div id="errormsg" style="font-size:12px; padding:2px; text-align:center"></div></td></tr>
                                                    </table>
                                                     <?php echo form_close();?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </h2>
                                    <?php 
									}
									?>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('failedMsg');?></div>
                                <div class="container">
                                  <table width="100%" border="0" cellspacing="3" cellpadding="3">
                                      <tr>
                                        <td width="25%"><h3>Account Info</h3></td>
                                        <td width="1%">&nbsp;</td>
                                        <td width="32%"><h3>Customer Information</h3></td>
                                        <td width="1%">&nbsp;</td>
                                        <td width="18%"><h3>Order Status</h3></td>
                                        <td width="23%">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td height="43" valign="top">
                                            <table width="98%" border="0" cellspacing="1" cellpadding="1">
                                              <tr>
                                                <td><?php echo $acc_name;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $acc_email;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $acc_contact;?></td>
                                              </tr>
                                            </table>    </td>
                                        <td>&nbsp;</td>
                                        <td valign="top">
                                            <table width="98%" border="0" cellspacing="1" cellpadding="1">
                                              <tr>
                                                <td><?php echo $acc_name;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $acc_address;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $acc_email;?></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $acc_contact;?></td>
                                              </tr>
                                            </table>    </td>
                                        <td>&nbsp;</td>
                                        
                                        <td valign="top" colspan="3">
                                            <select name="status" id="status" class="form-control" style="width:60%; float:left; margin:3px;padding:5px">
                                                        <option value="<?php echo $orderstatus;?>"><?php echo $status;?></option>
                                                        <option value="Processing">Processing</option>
                                                        <option value="Cancelled">Cancelled</option>
                                                        <option value="Delivered">Delivered</option>
                                                    </select>
                                             <button type="button" onclick="update_status(<?php echo $order_id;?>);" class="btn btn-primary" style="margin:3px;">
                                             Save</button>                                        </td>  
                                        </tr>
                                     
  
                                      <tr><td colspan="6"  height="20">&nbsp;</td></tr>
                                      <tr><td colspan="5"  height="40" bgcolor="#FFFFFF"><h3 style="padding:0; margin:0">Order Products</h3></td>
                                        <td  height="40" bgcolor="#FFFFFF"><div id="userstatus"></div></td>
                                      </tr>
                                      <tr><td colspan="6"  height="5"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                  <tr>
                                    <td colspan="6" valign="top">
                                        <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
                                          
                                          <tr class="table_header">
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
                                          <input type="hidden" value="<?php echo $order_id;?>" id="orderid" />
                                          <?php
                                   $i=0;
                                   $grand_total=0;
                                 
                                  
                                  $order_q=$this->db->query("select * from orders_products where order_id ='".$order_id."'");
                                  foreach($order_q->result() as $rowq){
                                  $opid=$rowq->id;
              					  $order_id=$rowq->order_id;
			                      $product_id=$rowq->product_id;
                                  $qty=$rowq->qty;
                                  $unit_price=$rowq->unit_price;
                                  $sub_total=$rowq->total_price;
                                  
								  $order_pro=$this->db->query("select * from product where product_id ='".$product_id."'");
								  foreach($order_pro->result() as $rowpro);
								  $main_image=$rowpro->main_image;
								  $product_name=$rowpro->product_name;
								  $cat_id=$rowpro->cat_id;
								  $size=$rowpro->size;
								  $pro_code=$rowpro->pro_code;
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
                                       		  <td align="right" >
                                            	 <input type="number"  value="<?php echo $qty;?>" id="changeQty<?php echo $opid;?>"
                                                 style="width:60px; height:auto; padding:3px; float:left; font-size:14px; border:1px solid #999; text-align:center;" />                                            </td>
                                           <!-- <td align="center" ><h6><strong><?php //echo $unit_price;?></strong></h6></td>-->
                                            
                                            <td align="right" >
                                            		<input type="hidden" value="<?php echo $product_id;?>" id="prodid<?php echo $opid;?>" />
                                            	 <input type="text"  value="<?php echo $unit_price;?>" id="changePrice<?php echo $opid;?>"
                                                 style="width:60px; height:auto; padding:3px; float:left; font-size:14px; border:1px solid #999; text-align:center;" />
                                                <button type="button" onclick="updateOrdeStatus('<?php echo $opid;?>');" class="btn btn-primary" 
                                                style="width:30px; height:auto; float:left; padding:5px; font-size:12px;"><i class="fa fa-refresh"></i></button>                                            </td>
                                            
                                           <td align="center" ><h6><strong><?php echo $sub_total;?></strong></h6></td>
                                            </tr>
                                          <?php
                                  }
                                  ?>
                                  <tr><td colspan="9"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                        <tr>
                                            <td height="44" colspan="4" align="left"><h2><strong>Grand Total</strong></h2></td>
                                             <td align="left" >&nbsp;</td>
                                            <td align="center" >&nbsp;</td>
                                            <td align="left" >&nbsp;</td>
                                             <td align="left" >&nbsp;</td>
                                            <td align="right"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></strong></h2></td>
                                            </tr>
                                        </table>                                    </td>
                                  </tr>
                                </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               