<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsPrintAjax(id,type)
{
		$.ajax({
			   type: "GET",
			   dataType: "json",
			   url: '<?php echo base_url('admin/getStockQty')?>',
			   data: {'value':id,'trnType':type},
			   cache : false, 
			   success: function(data) {
				  //alert(data);
				  $("#"+data.id).val(data.totalQty);
				// $("#reportPrintDisplay").html(data.mQty);
				},
				error: function (xhr, status) {
				  alert('Unknown error ' + status); 
				}
		 });
}


function qtyCheck(){
//alert('dfd');
	var stock_from = document.getElementById("stk_from_qty").value;
	var stock_to = document.getElementById("stk_to_qty").value;
	var transfer_qty = document.getElementById("transfer_qty").value;
		
	if(transfer_qty!=0 || transfer_qty!=""){
		
		if(parseInt(transfer_qty) > parseInt(stock_from)){
			alert("Limit Exceed");
		}
		else{
			document.getElementById("stk_to_qty").value = parseInt(stock_to) + parseInt(transfer_qty);
		}
	}
	else{
		document.getElementById("stk_to_qty").value = parseInt(stock_to);
	}
}
</script>
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:5px 10px;
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
                            <h3>Stock Transfer</h3>
                      </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div class="col-sm-7 col-sm-offset-2">
                                    <?php echo form_open('');
									echo $this->session->flashdata('successMsg');
									?>
                                   	  <table width="100%" border="0" cellspacing="5" cellpadding="0" align="left">
                                             		<tr>
                                                 	 <td width="38%" height="22" align="right">Stock</td>
                                                     <td width="4%" height="22" align="right">&nbsp;</td>
                                                  <td colspan="2">
                                                     
                                                          <select name="stock_from" id="stock_from" class="form-control" 
                                                          style="width:48%; float:left; margin-right:5px;" onchange="reportsPrintAjax(this.value,'stockfrom');">
                                                      	<option value="">From </option>
                                                      	<?php foreach($stock_list->result() as $stockl):?>
                                                            <option value="<?php echo $stockl->id;?>"><?php echo $stockl->stock_name;?></option>
                                                            <?php endforeach;?>
                                                            
                                                     </select>
                                                     
                                                     <select name="stock_to" id="stock_to" class="form-control" onchange="reportsPrintAjax(this.value,'stockto');" style="width:48%; float:left">
                                                      	<option value="">To </option>
                                                      	<?php foreach($stock_list->result() as $stockl):?>
                                                            <option value="<?php echo $stockl->id;?>"><?php echo $stockl->stock_name;?></option>
                                                            <?php endforeach;?>
                                                            
                                                     </select>
                                                     </td>
                                            	</tr>
                                                
                                                   <tr>
                                                 	 <td width="38%" height="22" align="right">&nbsp;</td>
                                                     <td width="4%" height="22" align="right">&nbsp;</td>
                                                     <td colspan="2">
                                                     
                                                     <input type="text" id="stk_from_qty" name="stk_from_qty" readonly="readonly" 
                                                     placeholder="Qty" class="form-control"  style="width:48%; float:left; margin-right:5px;" />
                                                     
                                                      <input type="text" id="stk_to_qty" name="stk_to_qty" readonly="readonly"
                                                      placeholder="Qty" class="form-control"  style="width:48%; float:left; margin-right:5px;" />
                                                     </td>
                                            	</tr>
                                                
                                                
                                                    <tr>
                                                        <td width="38%" height="40" align="right">Quantity</td>
                                                        <td width="4%" align="right">&nbsp;</td>
                                                          <td colspan="2">
                                                              <input class="form-control" required="required" type="text" name="transfer_qty" id="transfer_qty" placeholder="Transfer Qty"
                                                               onchange="qtyCheck()" onkeyup="qtyCheck();"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="38%" height="40" align="right">Date</td>
                                                        <td width="4%" align="right">&nbsp;</td>
                                                          <td colspan="2">
                                                              <input name="transfer_date" class="form-control date-picker" required="required" 
                                                              type="text" id="from_date" placeholder="From Date :"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                      <td width="38%" height="40" align="right">Product</td>
                                                      <td width="4%" align="right">&nbsp;</td>
                                                      <td colspan="2">
                                                          <input type="text" name="pro_id" id="pro_id" onkeyup="getProduct();" class="form-control"/>
                                                          <input type="hidden" id="products_id" name="products_id"/>
                                                          <div id="prodlist"></div>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td colspan="6" align="center">
                                                        <input type="submit" name="stocktransfer" value="Submit" class="btn btn-success" /></td>
                                                    </tr>
                                              </table>
                                    <?php echo form_close();?>
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