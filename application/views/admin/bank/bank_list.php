<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>admin/pre_deleteData/'+tablename+'/'+colid,
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


function update_sequence(id){
var updateid = document.getElementById("sequence"+id).value;
window.location.href='<?php echo base_url('admin/update_sequence');?>?sequence='+updateid+"&&id="+id;
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Bank Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left">Total Bank (<?php echo $bank_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('admin/bank_registration');?>" class="btn btn-primary">New Bank</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="4%">SI</th>
                                        <th width="16%">Name</th>
                                        <th width="14%">Branch</th>
                                        <th width="16%">Account Name</th>
                                         <th width="12%">Account No.</th>
                                        <th width="29%">Details</th>
                                        <th width="9%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($bank_list->result() as $bankData):
									$b_id=$bankData->b_id;
									$bank_name=$bankData->bank_name;
									$account_name=$bankData->account_name;
									$account_no=$bankData->account_no;
									$branch=$bankData->branch;
									$details=$bankData->details;
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $bank_name; ?></td>
                                        <td><?php echo $branch; ?></td>
                                        <td><?php echo $account_name; ?></td>
                                        <td><?php echo $account_no; ?></td>
                                        <td><?php echo $details; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('admin/bank_registration/'.$b_id);?>" class="btn btn-info btn-xs">
          										<span class="glyphicon glyphicon-edit"></span>
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $b_id;?>','bank','b_id');" class="btn btn-danger btn-xs">
          										<span class="glyphicon glyphicon-remove-circle"></span>
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
               