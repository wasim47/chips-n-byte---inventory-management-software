<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsPrintAjax()
{

	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var printd = "print";
	//alert(fromdate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_sale_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,printdata:printd},
			   success: function(data) {
				 // alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=reportsPrintAjax;
</script>

<input name="from_date" class="form-control"  type="hidden" id="from_date" value="<?php echo $this->session->userdata('fromDate');?>"/>
<input name="to_date" class="form-control"  type="hidden" id="to_date" value="<?php echo $this->session->userdata('toDate');?>"/>
<div class="right_col" role="main">
                <div class="">

                    <div style="width:100%; float:left">	
                                  	  		<div style="text-align:center; padding:5px 0">
                                        	
                                            <img src="<?php echo base_url('assets/images/logo.png')?>" style="width:15%; height:auto" />
                                            <address style="font-size:13px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                               		<div id="reportPrintDisplay"></div>
                            	</div>
                        </div>
                    </div>

                </div>
               