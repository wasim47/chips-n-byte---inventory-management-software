<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>admin/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>

<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>payment Details</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total payment (<?php echo $payment_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('admin/payment_registration');?>" class="btn btn-primary">New payment</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                         <th>Customer Name</th>
                                         <th>Contact</th>
                                         <th>Total Amount</th>
                                         <th>Paid </th>
                                        <th>Due </th>
                                         <th>Payment Method</th>
                                        <th>Last Pay Date</th>
                                         <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($payment_list->result() as $paymentData):
										$id=$paymentData->id;
										$customer_id=$paymentData->customer_id;
										$sale_amount=$paymentData->sale_amount;
										$paid_amount=$paymentData->paid_amount;
										$due_amount=$paymentData->due_amount;
										$pay_method=$paymentData->pay_method;
										$paid_date=$paymentData->payment_date;
										
										$queryStd=$this->db->query("select * from customers where customer_id='".$customer_id."'");
										foreach($queryStd->result() as $rowSt);
										$custname=$rowSt->name;
										$contact=$rowSt->mobile;
										$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $custname; ?></td>
                                        <td><?php echo $contact; ?></td>
                                        <td><?php echo $sale_amount; ?></td>
                                        <td><?php echo $paid_amount; ?></td>
                                        <td><?php echo $due_amount; ?></td>
                                        <td><?php echo $pay_method; ?></td>
                                        <td><?php echo $paid_date; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('admin/payment_registration/'.$id);?>" class="btn btn-info btn-xs">
          										<span class="glyphicon glyphicon-edit"></span>
                                            </a> 
                                            <!--<a href="javascript:void();" onclick="openPage1('<?php echo $id;?>','customer_payment','id');" class="btn btn-danger btn-xs">
          										<span class="glyphicon glyphicon-remove-circle"></span> Remove
                                            </a>-->
                                            </td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                    </tbody>
                                  </table>
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

                </div>
               