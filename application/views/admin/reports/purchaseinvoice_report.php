<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var supplier=document.getElementById('supplier').value;
	
	if(fromdate=='' || todate=='')
	{
		if(fromdate=='')
		{
			document.getElementById('from_date').focus();
			return true
		}
		if(todate=='')
		{
			document.getElementById('to_date').focus();
			return true
		}
	}
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/purchase_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,supplier:supplier},
			   success: function(data) {
				  //alert("Successfully saved");
				 $("#reportsdisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
</script>
<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Purchase Invoice Reports</h3>
                        </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/purchasereport/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/purchasereport/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:92%">
                                    	<table width="80%" border="0" cellspacing="5" cellpadding="0" align="center">
                                    <tr>
                                      <td width="11%"><label class="control-label">From Date :</label></td>
                                      <td width="19%"><input name="from_date" class="form-control date-picker"  type="text" id="from_date"/></td>
                                      <td width="2%">&nbsp;</td>
                                      <td width="9%"><label class="control-label">To Date:</label></td>
                                      <td width="19%"><input name="to_date" class="form-control date-picker" type="text" id="to_date" ></td><td width="2%">&nbsp;</td>
                                      <td width="8%">Supplier: </td>
                                      <td width="24%">
                                        <select name="supplier" id="supplier" class="form-control" required onchange="hoverChange(this.id)" >
                                        
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach($supplier as $row){
                                        ?>
                                        <option value="<?php echo $row->user_id; ?>"><?php echo $row->username; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                      </td>
                                      <td width="8%"><input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                    </tr>
                                  </table>
                                    </div>
                                  	<div style="float:right; width:8%"><a href="<?php echo base_url('admin/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a></div>
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