<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var supplier_id=document.getElementById('supplier_id').value;
	var sum_type=document.getElementById('sum_type').value;
	var pro_id=document.getElementById('products_id').value;
	var reporttype=document.getElementById('reporttype').value;
	/*if(reporttype=="By Bill"){
		var url = '<?php echo base_url('admin/purchase_reports_ajax')?>';
	}
	else if(reporttype=="By Product"){
		var url = '<?php echo base_url('admin/purchase_reports_ajax')?>';
	}*/
	var data = '?fdate='+fromdate+'&tdate='+todate+'&supplier_id='+supplier_id+'&sum_type='+sum_type+'&pro_id='+pro_id+"&reporttype="+reporttype;
	var url = '<?php echo base_url('admin/purchase_reports_ajax')?>';
	 window.open(url+data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1200,height=1024");
}
function reportSummType()
{
	var sum_type=document.getElementById('sum_type').value;
	if(sum_type=="Date wise"){
		document.getElementById('daterange').style.display='inline';
	}
	else{
		document.getElementById('daterange').style.display='none';
	}
}

function reportType()
{
	var reporttype=document.getElementById('reporttype').value;
	if(reporttype=="By Supplier"){
		document.getElementById('productdisp').style.display='none';
	}
	else{
		document.getElementById('productdisp').style.display='block';
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
                            <h3>Purchase Reports</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/sale_products_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/sale_products_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div class="col-sm-6 col-sm-offset-2">
                                     <table width="100%" border="0" cellspacing="5" cellpadding="0" align="left">
                                             		<tr>
                                                 	 <td width="38%" height="45" align="right">Report Type</td>
                                                     <td width="4%" height="45" align="right">&nbsp;</td>
                                                     <td colspan="2">
                                                      <select name="reporttype" id="reporttype" class="form-control" onchange="reportType();">
                                                            <option value="By Product">By Product</option>
                                                            <option value="By Supplier">By Supplier</option>
                                                     </select></td>
                                            	</tr>
                                                    <tr>
                                                        <td width="38%" height="40" align="right">Summery Type</td>
                                                        <td width="4%" align="right">&nbsp;</td>
                                                      <td colspan="2">
                                                          <select name="sum_type" id="sum_type" class="form-control" onchange="reportSummType();">            
                                                             <option value="Daily">Daily</option>
                                                            <!-- <option value="Monthly">Monthly</option>
                                                             <option value="Yearly">Yearly</option>-->
                                                             <option value="Date wise">Date wise</option>
                                                        </select>
                                                        <div id="daterange" style="display:none; margin-top:5px; width:100%; float:left">
                                                      <div style="width:45%; float:left; margin-right:10px">
                                                      <input name="from_date" class="form-control date-picker" required="required" type="text" id="from_date" 
                                                      placeholder="From Date :"/>
                                                      </div>
                                                      <div style="width:45%; float:left">
                                                      <input name="to_date" class="form-control date-picker" required="required" type="text" id="to_date" 
                                                      placeholder="To Date:" />        
                                                      </div>    
                                      				 </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                       
                                                    <tr id="productdisp">
                                                    	<td colspan="3" style="width:100%; float:left; margin-left:160px">
                                                        	<table width="100%">
                                                            	 <tr>
                                                            	<td width="38%" height="41" align="right">Product</td>
                                                                <td width="4%" height="41" align="right">&nbsp;</td>
                                                                <td colspan="2">
                                                                 <input type="text" name="pro_id" id="pro_id" onkeyup="getProduct();" class="form-control"/>
                                                                 <input type="hidden" id="products_id"/>
                                                                <div id="prodlist"></div></td>
                                                                </tr>
                                                            </table>
                                                        </td>                                                      
                                                    </tr>
                                                    <tr>
                                                        <td width="38%" height="46" align="right">By Supplier</td>
                                                        <td width="4%" height="46" align="right">&nbsp;</td>
                                                      <td colspan="2">
                                                          <select name="supplier_id" id="supplier_id" class="form-control">
            
                                                        <option value="">Select Supplier</option>
                                                        <?php
                                                        foreach($supplierlist->result() as $row){
                                                        ?>
                                                        <option value="<?php echo $row->user_id; ?>"><?php echo $row->username; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        </select></td>
                                                    </tr>
                                                    
                                                    
                        							
                                                    
                                                    
                                                    
														
                                                     <tr>
                                                        <td colspan="6" align="center">
                                                        <input type="button" name="button" value="Reports" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                                    </tr>
                                              </table>
                                  </div>
                                </div>
                                <div class="x_content">
                                		<div id="reportsdisplay"></div>
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