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
                            <h3>Stock Registration Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total Stock (<?php echo $stock_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('admin/stock_registration');?>" class="btn btn-primary">New Stock</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                        <th>Stock Name</th>
                                        <th>Stock In Charge</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($stock_list->result() as $adminData):
										$id=$adminData->id;
										$stock_name=$adminData->stock_name;
										$stock_incharge=$adminData->stock_incharge;
										$address=$adminData->address;
										$mobile=$adminData->mobile;
										$email=$adminData->email;
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $stock_name; ?></td>
                                        <td><?php echo $stock_incharge; ?></td>
                                        <td><?php echo $mobile; ?></td>
                                        <td><?php echo $email; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('admin/stock_registration/'.$id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $id;?>','stock_manage','id');" class="btn btn-default btn-sm">
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
               