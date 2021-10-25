<?php
	$id='';
	$cust_id='';
	$product_id='';
	$received_by='';
	$transport_cost='';
	$sale_date=date('Y-m-d');
	$total_qty='';
	$total_amount='';
	$payment='';
	$commission='';
	$vat='';
	$due='';
	$net_amount='';
	$comments='';
	$sale_price='';
	
	$digits = 4;
	$bill_no = rand(pow(10, $digits-1), pow(10, $digits)-1);
?>
<script>

function ajaxBuyer(custid){
	 // alert(custid);
   	  var surl = '<?php echo base_url('admin/buyerAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'custid':custid},
        cache : false, 
        success: function(response) { 
		  
		   $("#total_buyer_amount").val(response.total);
		   $("#due_amount").val(response.due);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  
}

function buyerType(val){
	if(val=="New Customer"){
		$("#newbuyer").show(500);
		$("#existbuyer").hide(500);
	}
	else if(val=="Existing Customer"){
		$("#newbuyer").hide(500);
		$("#existbuyer").show(500);
	}
}
</script>


<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:50%; float:left; padding:0; margin:10px 0 0 0">Sale Entry Form</h2>
                     <h2 style="width:50%; float:right; text-align:right; padding:0; margin:10px 0 0 0">
                     <a href="<?php echo base_url('admin/new_sale_invoice');?>">Get Invoice</a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                     <div class="productinfo-tab">
                        <ul class="nav nav-tabs">
                          
                          <li class="active" style="width:50%; text-align:center;"><a href="#productinfo" data-toggle="tab">Product Information</a></li>
                          <li style="width:50%; background:none; text-align:center;"><a href="#customerinfo" data-toggle="tab">Sale Information</a></li>
                        </ul>
                    
                    
                       <div class="tab-content">
                       		<div class="tab-pane active" id="productinfo">
                            	<div class="col-sm-3">
									<?php //$this->load->view('includes/leftcat_sale');?>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row" style="background:#f5f5f5; padding:10px">
                                        
                                   <div class="col-sm-6" style="margin:0; padding:0">
                                   
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Product Name<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_id" id="pro_id" onkeyup="getProduct();" class="form-control" />
                                            <input type="hidden" id="products_id"/>                                        
                                            <div id="prodlist"></div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Product Code<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_code"  id="pro_code" placeholder="Product Code" required class="form-control col-md-7 col-xs-12"
                                             readonly="readonly">
                                        </div>
                                    </div>
                                     <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Size<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                           <input type="text" name="size" id="size" placeholder="Size" class="form-control"  readonly="readonly"/>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Unit Price<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="unit_price"  id="unit_price" required class="form-control col-md-7 col-xs-12"  
                                            placeholder='Unit Price' onFocus="this.placeholder=''"  readonly="readonly"
                                            onBlur="this.placeholder='Unit Price'">
                                        </div>
                                    </div>
                                   <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Sale Price<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="sale_price" id="sale_price" required class="form-control" 
                                            placeholder='Sale Price' value="<?php echo $sale_price; ?>" onkeyup="proQtyUpdate();" onkeypress="proQtyUpdate();" onblur="proQtyUpdate();">
                                        </div>
                                    </div>
                                           
                                  </div> 
                                  
                                  
                                   <div class="col-sm-6" style="margin:0; padding:0">
                                   
                                   
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Quantity<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                           <input type="text" name="pro_qty" id="pro_qty" placeholder="Qty" class="form-control" 
                                           onkeyup="proQtyUpdate();" onkeypress="proQtyUpdate();" onblur="proQtyUpdate();" />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Commission<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_commission" id="pro_commission" required class="form-control" 
                                            placeholder='Total Commission' value="<?php echo $commission; ?>"
                                             onkeyup="proQtyUpdate();" onkeypress="proQtyUpdate();" onblur="proQtyUpdate();">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Vat<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_vat"  id="pro_vat" required class="form-control col-md-7 col-xs-12"  
                                            placeholder='Total Vat' value="<?php echo $vat; ?>" onkeyup="proQtyUpdate();" onkeypress="proQtyUpdate();" onblur="proQtyUpdate();">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Price<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                           <input type="text" name="total_pro_price" id="total_pro_price" placeholder="Total Price" class="form-control" />
                                        </div>
                                    </div>
                                    
                                           
                                  </div>
                                  
                                            
                                </div>
                                    <div class="row" style="text-align:center; margin-top:10px;">
                                        <div id="succes_insert"></div>
                                        <span id="loaderHide">
                                         <button type="button" class="btn btn-success btn-sm" value="Submit" onclick="saleEntry();">
                                            <i class="fa fa-plus"></i> Add More</button>
                                        </span>
                                        <span id="LoadingImage" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                            <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
                                    </div>
		                        </div>
                          </div>
                            <div class="tab-pane" id="customerinfo">
                              	<div class="row">
                                	<div class="col-sm-3 col-sm-offset-5">
                                    <select name="buyer_type" id="buyer_type" class="form-control" onchange="buyerType(this.value);">
                                        <option value="Existing Customer" selected="selected">Existing Customer</option>
                                        <option value="New Customer">New Customer</option>
                                    </select>
                                    </div>
                               </div>
                              
                              
                              <div class="row" style="background:#f5f5f5; padding:10px;">
                               <div class="col-sm-4" style="margin:0; padding:0">
                               <div id="existbuyer">
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Buyer<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                          <select class="form-control" name="userid" id="cust_id" required onchange="ajaxBuyer(this.value);">
                                            <option value="">Buyer</option>
                                            <?php
                                                    $queryS=$this->db->query("SELECT * FROM customers");
                                                    foreach($queryS->result() as $rowS){
                                                    $custid=$rowS->customer_id;
                                                    $name=$rowS->name;
                                                    $cid=$rowS->cid;
                                                    ?>
                                            <option value="<?php echo $custid;?>"><?php echo $name.' - '.$cid;?></option>
                                            <?php
                                                }
                                             ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Buyer Total Amount<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="total_buyer_amount"  id="total_buyer_amount" required class="form-control col-md-7 col-xs-12"  
                                            placeholder='Total Amount'  onFocus="this.placeholder=''"  readonly="readonly"
                                            onBlur="this.placeholder='Total Amount'">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Buyer Due Amount<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="due_amount"  id="due_amount" required class="form-control col-md-7 col-xs-12"  
                                            placeholder='Due Amount'  onFocus="this.placeholder=''"  readonly="readonly"
                                            onBlur="this.placeholder='Due Amount'">
                                        </div>
                                    </div>
                                </div>
                                
                                 <div id="newbuyer" style="display:none">
                                    <div class="form-group">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Code<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="code" id="nc_code" required class="form-control col-md-7 col-xs-12">
                                     <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12"> Customer Name: <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="customerName" id="nc_name" class="form-control" type="text" required="required" placeholder="customer Name"/>
                                    <?php echo form_error('customerName', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                                    <div class="form-group">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12"> Mobile: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="mobile" id="nc_mobile" type="text" class="form-control col-md-7 col-xs-12" required="required" placeholder="Mobile No."/>
                                    <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                              		<div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12"> Mailing Address : </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="address" class="form-control col-md-7 col-xs-12" id="nc_address" placeholder="Mailing Address"></textarea>
                                </div>
                          </div>
                          		    <div class="form-group">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12"> Email: </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="email" id="nc_email" class="form-control col-md-7 col-xs-12"  type="email"  required="required" placeholder="Email Address"/>
                                <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                          </div>
                                </div>
                                
                                
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Receive By<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="received_by" id="received_by" required class="form-control" 
                                        placeholder='Received By' value="<?php echo $received_by; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Received By">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Transport Cost<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="transport_cost" id="transport_cost" required class="form-control" 
                                        placeholder='Transport Cost' value="<?php echo $transport_cost; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Transport Cost">
                                    </div>
                                </div>
                              </div> 
                               <div class="col-sm-4" style="margin:0; padding:0">
                               
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Bill No.<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="bill_no"  id="bill_no" required class="form-control col-md-7 col-xs-12"  
                                        placeholder='Bill No.' value="<?php echo $bill_no; ?>"  onFocus="this.placeholder=''" readonly="readonly" 
                                        onBlur="this.placeholder='Bill No.'">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Sale Date<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="sale_date"  id="sale_date" required class="form-control date-picker col-md-7 col-xs-12"  
                                        placeholder='Sale Date' value="<?php echo $sale_date; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Sale Date'">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Quantity<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="total_qty"  id="total_qty" required class="form-control col-md-7 col-xs-12"  
                                        placeholder='Total Quantity' value="<?php echo $total_qty; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Total Quantity'"  readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Amount<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="total_amount" id="total_amount" required class="form-control" 
                                        placeholder='Total Amount' value="<?php echo $total_amount; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Total Amount"  readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Payment<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="payment" id="payment" required class="form-control" 
                                        placeholder='Payment' value="<?php echo $payment; ?>" onkeyup="paymentFunc();" onkeydown="paymentFunc();" onblur="paymentFunc();">
                                    </div>
                                </div>
                                
                                
                                       
                              </div>
                               <div class="col-sm-4" style="margin:0; padding:0">
                               
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Commission<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="commission" id="commission" required class="form-control" 
                                        placeholder='Total Commission' value="<?php echo $commission; ?>" onkeyup="paymentFunc();" onkeydown="paymentFunc();" onblur="paymentFunc();">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Vat<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="vat"  id="vat" required class="form-control col-md-7 col-xs-12"  
                                        placeholder='Total Vat' value="<?php echo $vat; ?>"  onkeyup="paymentFunc();" onkeydown="paymentFunc();" onblur="paymentFunc();">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Total due<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="due"  id="due" required class="form-control col-md-7 col-xs-12"  
                                        placeholder='Total due' value="<?php echo $due; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Total due'" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Net Amount<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <input type="text" name="net_amount"  id="net_amount" required class="form-control col-md-7 col-xs-12"  
                                        placeholder='Net Amount' value="<?php echo $net_amount; ?>"  onFocus="this.placeholder=''" 
                                        onBlur="this.placeholder='Net Amount'" readonly="readonly">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Comments<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <textarea name="comments" id="comments" class="form-control" placeholder="Comments"><?php echo $comments;?></textarea>
                                    </div>
                                </div>
                                
                                       
                              </div>
                            </div>
                          </div>
                           
                       </div>
                   	   
                    </div>
               <?php echo form_close();?>
                </div>
                
                <div class="col-sm-12" style="border:1px solid #333; padding:0; margin:20px 0">
                	<div id="product_list"></div>
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
	
	
	
	var currentBoxNumber = 0;
	$(".form-control").keyup(function (event) {
		if (event.keyCode == 13) {
			textboxes = $("input.form-control");
			currentBoxNumber = textboxes.index(this);
			console.log(textboxes.index(this));
			if (textboxes[currentBoxNumber + 1] != null) {
				nextBox = textboxes[currentBoxNumber + 1];
				nextBox.focus();
				nextBox.select();
				event.preventDefault();
				return false;
			}
		}
	});
});

		
	</script>
    
    
    