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

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total product (<?php echo $paymentUpdate->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('admin/tada_statement_action');?>" class="btn btn-primary">New Entry</a></h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="34%">Particulars</th>
                                        <th width="34%">Rickshaw</th>
                                        <th width="34%">Bus</th>
                                        <th width="34%">Motorcycle</th>
                                        <th width="34%">CNG</th>
                                        <th width="34%">Mobile</th>
                                        <th width="22%">Foods</th>
                                        <th width="22%">Hotel</th>
                                        <th width="22%">Misc</th>
                                        <th width="22%">Voucher</th>
                                        <th width="22%">Othres</th>
                                        <th width="22%">User</th>
                                        <th width="18%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($paymentUpdate->result() as $tadaData):
									$par_id=$tadaData->par_id;
									$salse_id=$tadaData->salse_id;
									$particulars=$tadaData->particulars;
									$rickshaw=$tadaData->rickshaw;
									$bus=$tadaData->bus;
									$motorcycle=$tadaData->motorcycle;
									$mobile=$tadaData->mobile;
									$cng=$tadaData->cng;
									$foods=$tadaData->foods;
									$hotel=$tadaData->hotel;
									$misc=$tadaData->misc;
									$voucher=$tadaData->voucher;
									$others=$tadaData->others;
									$cost_by=$tadaData->cost_by;
									
									$supplierq=$this->Index_model->getAllItemTable('sales_represntative','user_id',$salse_id,'','','user_id','desc');
									if($supplierq->num_rows() > 0){
										foreach($supplierq->result() as $cat_row);
										$username=$cat_row->username;
									}
									else{
										$username='NULL';
										}
									
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $particulars; ?></td>
                                        <td><?php echo $rickshaw; ?></td>
                                        <td><?php echo $bus; ?></td>
                                        <td><?php echo $motorcycle; ?></td>
                                        <td><?php echo $cng; ?></td>
                                        <td><?php echo $mobile; ?></td>
                                        <td><?php echo $foods; ?></td>
                                        <td><?php echo $hotel; ?></td>
                                        <td><?php echo $misc; ?></td>
                                        <td><?php echo $voucher; ?></td>
                                        <td><?php echo $others; ?></td>
                                        <td><?php echo $username; ?></td>
                                        
                                         <td> 
                                         	<a href="<?php echo base_url('admin/product_registration/'.$par_id);?>" class="btn btn-info btn-xs">
          										<span class="glyphicon glyphicon-edit"></span>
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $par_id;?>','tada_statement','par_id');" class="btn btn-danger btn-xs">
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

                  

                </div>
               