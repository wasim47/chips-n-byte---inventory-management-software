<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/stockin_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}

function productWiseStock()
{
	  var keywordVal=document.getElementById('keyword').value;
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/stockin_reports_ajax')?>',
			   data: {key:keywordVal},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  //alert("There was an error. Try again please!");
				}
		 });
}
function supplierWiseStock()
{
	  var keywordVal=document.getElementById('supplierval').value;
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/stockin_reports_ajax')?>',
			   data: {supplier:keywordVal},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  //alert("There was an error. Try again please!");
				}
		 });
}
function currentStock()
{
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/stockin_reports_ajax')?>',
			   data: {currentstock:'currentstock'},
			   success: function(data) {
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=currentStock;
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Current Stock Reports</h3>
                      </div>
                        <div class="title_right">
                        	<div style="text-align:right; float:right; width:50%;">
                            <a href="<?php echo base_url('admin/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a>
                            <a href="<?php echo base_url('admin/datewise_sale_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/datewise_sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;">
                            <h2 style="float:left"><i class="fa fa-print"></i> Print</h2></a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:100%">
                                    	<table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                                        	<tr>
                                            	<td width="55%">
                                               	  <table width="53%" border="0" cellspacing="5" cellpadding="0" align="left">
                                                   	<tr>
                                              <td width="46%"><input name="from_date" class="form-control date-picker" required type="text" id="from_date" placeholder="From Date :"/></td>
                                              <td width="44%"><input name="to_date" class="form-control date-picker" required type="text" id="to_date" placeholder="To Date:" ></td>
                                              <td width="10%"><input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                            </tr>
                                                  </table>
                                                  <table width="47%" border="0" cellspacing="5" cellpadding="0" align="left">
                                                   	<tr>
                                              
                                              
                                            </tr>
                                                  </table>
                                              </td>
                                              <td width="45%">
                                                <table width="100%" border="0" cellspacing="5" cellpadding="0" align="left">
                                                  <tr>
                                                    <td width="59%">
                                                    <input class="form-control"  placeholder="Search Product Name or Product Code" type="text" id="keyword" onchange="productWiseStock();" onkeydown="productWiseStock();"/></td>
                                                                          <td width="1%">&nbsp;</td>
                                                                          <td width="21%" align="right"><input type="button" name="button" value="All Products" class="btn btn-info" onclick="currentStock();" style="margin-top:3px;" /></td>
                                                                        </tr>
                                                </table>
                                              </td>
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