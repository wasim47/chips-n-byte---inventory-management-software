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
                            <h3 style="width:30%; float:left">Party Ladger</h3>
                        <h2 style="float:left; width:50%">
                            <?php echo form_open('');?>
                                <input type="text" name="keywords" class="form-control" style="width:80%; float:left" 
                                placeholder="Search with Customer ID, Customer Name or Order Number" />
                                <input type="submit" name="submit" value="Search" class="btn btn-success"  style="width:15%; float:left" />
                            <?php echo form_close();?>
                            </h2>
                            <h2 style="text-align:right; float:right; width:20%"><a href="<?php echo base_url('admin/datewise_sale_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/datewise_sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <!--<div class="x_title" style="width:100%; float:left">
                                	<div style="float:left; width:92%">
                                      <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                                        <tr>
                                            <td width="55%">
                                              <table width="53%" border="0" cellspacing="5" cellpadding="0" align="left">
                                              <tr>
                                                  <td width="50%">
                                                  <input name="from_date" class="form-control date-picker" required type="text" id="from_date" placeholder="From Date :"/></td>
                                                  <td width="1%">&nbsp;</td>
                                                  <td width="50%">
                                                  <input name="to_date" class="form-control date-picker" required type="text" id="to_date" placeholder="To Date:" ></td>
                                                  <td width="1%">&nbsp;</td>
                                                  <td width="9%">
                                                  <input type="button" name="button" value="Go" class="btn btn-success" onclick="reportsAjax();" style="margin-top:3px;" /></td>
                                            </tr>
                                                  </table>
                                              <table width="30%" border="0" cellspacing="5" cellpadding="0" align="left">
                                                <tr>
                                          <td width="87%">
                                            <select name="supplierval" id="supplierval" class="form-control" onchange="supplierWiseStock();" style="margin-top:3px; margin-left:20px">
    
                                                <option value="">Select Buyer</option>
                                                <?php
                                                foreach($customerslist->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->customer_id; ?>"><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                          </td>
                                          
                                        </tr>
                                              </table>
                                          </td>
                                          
                                      </tr>
                                      </table>
                                    </div>
                                  	<div style="float:right; width:8%"><a href="<?php echo base_url('admin/cleareCachDate');?>" class="btn btn-danger">Clear Cach</a></div>
                                </div>-->
                                <div class="x_content">
                                		<div id="reportsdisplay">
                                        	<div class="container">
                                               <table width="100%" class="ordertable">
                                                <tr bgcolor="#e5e5e5" class="trTitle">
                                                  <td width="57" height="33" align="center">SI</td>
                                                  <td width="273" align="center">Buyer Name </td>
                                                  <td width="170" align="center">Buyer Contact</td>
                                                  <td width="153" align="center">Last Order Date</td>
                                                  <td width="153" align="center">Total Invoice</td>
                                                  <td width="96" align="center">Last Invoice</td>                                                  
                                                  <td width="90" align="center">Details </td>
                                             </tr>
                                                <?php
                                                    $i=0;
                                                    $tqty = 0;
                                                    $tprice = 0;
                                                    $tpaid = 0;
                                                    $tdue = 0;
                                                  foreach($partyladger->result() as $rowq){													  
													  $buyername=$rowq->name;
													  $mobile=$rowq->mobile;
													  $byerid=$rowq->customer_id;
                                                  
													  $orderquery= $this->Index_model->getAllItemTable('orders','customer_id',$byerid,'','','order_id','desc');	
													  if($orderquery->num_rows() > 0){
													  	  $totalOrder = $orderquery->num_rows();
														  $odata = $orderquery->row_array();
														  $order_id=$odata['order_id'];
														  $order_time=$odata['order_time'];
													  }
													  else{
													  	  $totalOrder ='';
														  $order_id='';
														  $order_time='';
													  }
													  
													  
													  
													  $invoicequery= $this->Index_model->getAllItemTable('invoice','cust_id',$byerid,'','','inv_id','desc');	
													  if($invoicequery->num_rows() > 0){
													  	  $toatlinv = $invoicequery->num_rows();
														  $inv = $invoicequery->row_array();
														  $inv_id=$inv['inv_id'];
													  }
													  else{
														  $inv_id=0;
														  $toatlinv = 0;
													  }
                                                                                  
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
                                              <td align="center"><?php echo $order_time;?></td>
                                              <td align="center"><?php echo $toatlinv;?></td>
                                              <td align="center"><?php echo $inv_id;?></td>                                              
                                             <td width="90" align="center"><a href="<?php echo base_url('admin/party_ladger_details/'.$byerid);?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a></td>
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