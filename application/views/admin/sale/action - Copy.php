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
<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="<?php echo base_url('asset/js/sale_script.js');?>" type="text/javascript"></script>-->


<!--<div class="right_col" role="main" ng-app="commonApp" ng-controller="commonContrl">-->
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
                                            <input type="text" id="pro_id" onKeyUp="getProduct();" class="form-control" name="pname" ng-model="data.pname"/>
                                            <input type="hidden" id="products_id"/>                                        
                                            <div id="prodlist"></div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Product Code<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_code"  id="pro_code" placeholder="Product Code" required class="form-control col-md-7 col-xs-12"
                                              ng-model="data.pcode">
                                        </div>
                                    </div>
                                     <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Size<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                           <input type="text" name="size" id="size" placeholder="Size" class="form-control"  readonly="readonly"  ng-model="data.psize"/>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Unit Price<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" id="unit_price" class="form-control" readonly="readonly" ng-model="data.pprice">
                                        </div>
                                    </div>
                                   <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Sale Price<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="sale_price" id="sale_price" required class="form-control" 
                                            placeholder='Sale Price' value="<?php echo $sale_price; ?>" onKeyUp="proQtyUpdate();" onKeyPress="proQtyUpdate();" onBlur="proQtyUpdate();">
                                        </div>
                                    </div>
                                           
                                  </div> 
                                  
                                  
                                   <div class="col-sm-6" style="margin:0; padding:0">
                                   
                                   
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Quantity<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                           <input type="text" name="pro_qty" id="pro_qty" placeholder="Qty" class="form-control" 
                                           onkeyup="proQtyUpdate();" onKeyPress="proQtyUpdate();" onBlur="proQtyUpdate();" />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Commission<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_commission" id="pro_commission" required class="form-control" 
                                            placeholder='Total Commission' value="<?php echo $commission; ?>"
                                             onkeyup="proQtyUpdate();" onKeyPress="proQtyUpdate();" onBlur="proQtyUpdate();">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:0 0 5px 0; padding:0">
                                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Total Vat<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <input type="text" name="pro_vat"  id="pro_vat" required class="form-control col-md-7 col-xs-12"  
                                            placeholder='Total Vat' value="<?php echo $vat; ?>" onKeyUp="proQtyUpdate();" onKeyPress="proQtyUpdate();" onBlur="proQtyUpdate();">
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
                      <?php /*?><div class="row" style="text-align:center; margin-top:10px;">
                                        <div id="succes_insert"></div>
                                        <span id="loaderHide">
                                         <!--<button type="button" class="btn btn-success btn-sm" value="Submit" onClick="saleEntry('<?php echo base_url('admin/saleentry_action');?>');">
                                            <i class="fa fa-plus"></i> Add More</button>
                                            <a href="javascript:void();" onclick="insRow()" class="btn btn-success btn-sm">+ Add</a>-->
                                        </span>
                                        <span id="LoadingImage" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                            <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
                                    </div><?php */?>              
		          </div>
               <?php echo form_close();?>
                </div>
                
                <div class="col-sm-12" style=" padding:0; margin:20px 0">
                	<!--<div id="product_list"></div>-->
                    <div class="col-sm-12">
                        	<div class="row pull-right">
                                <button type="button" class="btn btn-success" onclick="addRow('dataTable')" ><i class="fa fa-plus"></i> Add</button>
                                <button type="button" class="btn btn-danger" onclick="deleteRow('dataTable')"><i class="fa fa-close"></i> Remove</button>
                            </div>
                    		<div class="row">
                           	 <table class="table" style="background:#fff" id="dataTable" width="100%">
                                <tr style="font-size:13px;">
                                    <th width="2%">&nbsp;</th>
                                    <th width="35%">Product Name</th>
                                    <th width="7%">Code</th>
                                    <th width="8%">Size</th>     
                                    <th width="6%">Qty</th>                          
                                    <th width="10%">Unit Price</th>
                                    <th width="10%">Sale Price</th>
                                    <th width="7%">Comission</th>
                                  <th width="4%">Vat</th>
                                  <th width="11%">Total</th>
                               </tr>
                            </table>
                            </div>
        			</div>
                </div>
            </div>
        </div>
    </div>              
                
   <!--<script type="text/javascript">
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

		
	</script>-->
    
    
    