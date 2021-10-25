<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate},
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
                            <h3>Date Wise Reports</h3>
                        </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/datewise_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/datewise_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:92%">
                                    	<table width="50%" border="0" cellspacing="5" cellpadding="0" align="center">
                                    <tr>
                                      <td width="19%"><label class="control-label">From Date :</label></td>
                                      <td width="30%"><input name="from_date" class="form-control date-picker"  type="text" id="from_date"/></td>
                                      <td width="4%">&nbsp;</td>
                                      <td width="12%"><label class="control-label">To Date:</label></td>
                                      <td width="26%"><input name="to_date" class="form-control date-picker" type="text" id="to_date" ></td>
                                      <td width="9%"><input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
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

                </div>
               