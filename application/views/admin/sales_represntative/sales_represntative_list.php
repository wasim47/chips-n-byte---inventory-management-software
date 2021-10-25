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
<script type="text/javascript">
checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}
function approve(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url();?>admin/approve?approve_val="+data+"&tablename=sales_represntative"+"&id=user_id"+"&status=active";
			window.location.href=hrefdata;
	}
	
}

function deapprove(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="<?php echo base_url();?>admin/deapprove?approve_val="+data+"&tablename=sales_represntative"+"&id=user_id"+"&status=active";
			window.location.href=hrefdata;
	}
	
}

function deletedata(){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;
			
		}
		
	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
		var b = window.confirm('Are you sure, you want to delete this ?');
		if(b==true){
			var hrefdata ="<?php echo base_url();?>admin/delete?brid="+data;
			window.location.href=hrefdata;
			}
			else{
			 return;
			 }
	}
	
}
</script>
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php echo form_open('', 'name="formUserSearch" id="form_check"');?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total User (<?php echo $sales_represntativelist->num_rows();?>)</h2>
                                    <h2 style="float:right">
                                    <a href="<?php echo base_url('admin/sales_represntative_registration');?>" class="btn btn-primary">New User</a>
                                    <input type="button" class="btn btn-primary" style="background-color:#f00" onclick="deletedata();" value="Delete" />
                                    </h2>
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%">SI</th>
                                        <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" /></th>
                                        <th width="18%">User Name</th>
                                        <th width="17%">Contact</th>
                                        <th width="14%">Email</th>
                                        <th width="21%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                   foreach($sales_represntativelist->result() as $sales_represntative):
										$sales_represntative_id=$sales_represntative->user_id;
										$sales_represntative_name=$sales_represntative->username;
										$mobile=$sales_represntative->mobile;
										$email=$sales_represntative->email;
									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
                                        <input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="<?php echo $sales_represntative_id;?>" /></td>
                                        <td><?php echo $sales_represntative_name; ?></td>
                                        <td><?php echo $mobile; ?></td>
                                        <td><?php echo $email; ?></td>
                                        
                                        
                                         <td> 
                                         	<a href="<?php echo base_url('admin/sales_represntative_registration/'.$sales_represntative_id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $sales_represntative_id;?>','sales_represntative','user_id');" class="btn btn-default btn-sm">
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
                         <?php echo form_close();?> 
                        </div>
                    </div>


                </div>
               