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
                  <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Record (<?php echo $payment_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('admin/bank_deposit_registration');?>" class="btn btn-primary">New Deposit</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                        <th>Bank Name</th>
                                        <th>Acount No</th>                                        
                                        <th>Total payment</th>
                                        <th>Deposit By</th>
                                        <th>Deposit Date</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($payment_list->result() as $paymentData):
									$bd_id=$paymentData->bd_id;
									$bank_id=$paymentData->bank_name;
									$account_no=$paymentData->account_no;
									$deposit_by=$paymentData->deposit_by;
									$total_amount=$paymentData->total_amount;									
									$payment_date=$paymentData->payment_date;
									
									 $query=$this->db->query("select * from bank WHERE b_id='".$bank_id."' order by bank_name asc");
									 foreach($query->result() as $parrow);
									 $bank_name=$parrow->bank_name;
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $bank_name; ?></td>
                                        <td><?php echo $account_no; ?></td>
                                        <td><?php echo $deposit_by; ?></td>
                                        <td><?php echo $total_amount; ?></td>
                                        <td><?php echo $payment_date; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('admin/bank_deposit_registration/'.$bd_id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $bd_id;?>','bank_deposit','bd_id');" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-remove-circle"></span> Remove
                                            </a>
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
               