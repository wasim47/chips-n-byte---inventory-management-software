<script type="text/JavaScript">
function reportsAjax()
{
	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	//alert(fromdate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_sale_reports_ajax')?>',
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
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left" style="width:100%">
                            <h3 style="width:30%; float:left">Salse Representative</h3>
                        <h2 style="float:left; width:50%">
                            <?php echo form_open('');?>
                                <input type="text" name="keywords" class="form-control" style="width:80%; float:left" 
                                placeholder="Search with Customer ID, Customer Name or Order Number" />
                                <input type="submit" name="submit" value="Search" class="btn btn-success"  style="width:15%; float:left" />
                            <?php echo form_close();?>
                            </h2>
                            <h2 style="text-align:right; float:right; width:20%"><a href="<?php echo base_url('admin/datewise_sale_reports/print');?>" 
                            onclick="javascript:void window.open('<?php echo base_url('admin/datewise_sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;">
                            <i class="fa fa-print"></i> Print</a></h2>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                               
                                <div class="x_content">
                                		<div id="reportsdisplay">
                                        	<div class="container">
                                               <table width="100%" class="ordertable">
                                                <tr bgcolor="#e5e5e5" class="trTitle">
                                                  <td width="57" height="33" align="center">SI</td>
                                                  <td width="273" align="center">Salse Representative Name </td>
                                                  <td width="170" align="center">Contact</td>
                                                  <td width="153" align="center">TotalBuyer</td>                                              
                                                  <td width="90" align="center">Details </td>
                                             </tr>
                                                <?php
                                                    $i=0;
                                                  foreach($partyladger->result() as $rowq){													  
													  $buyername=$rowq->username;
													  $mobile=$rowq->mobile;
													  $byerid=$rowq->user_id;
                                                  
													  $buyerQ= $this->Index_model->getAllItemTable('customers','salse_id',$byerid,'','','customer_id','desc');	
													  $totalcust = $buyerQ->num_rows();
													                     
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
                                            
                                            <tr class="trCont" bgcolor="<?php echo $c; ?>">
                                              <td height="44" align="center"><?php echo $i;?></td>
                                              <td width="273" align="center"><?php echo $buyername;?></td>
                                              <td width="170" align="center"><?php echo $mobile;?></td>
                                              <td align="center"><?php echo $totalcust;?></td>                                        
                                             <td width="90" align="center"><a href="<?php echo base_url('admin/sr_party_details/'.$byerid);?>" 
                                             class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a></td>
                                            </tr>
                                            <?php
											
                                            }
                                            ?>
                                            </table>                          
										  </div>
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