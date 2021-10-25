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
			var hrefdata ="<?php echo base_url();?>admin/approve?approve_val="+data+"&tablename=brand"+"&id=cid"+"&status=status";
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
			var hrefdata ="<?php echo base_url();?>admin/deapprove?approve_val="+data+"&tablename=brand"+"&id=cid"+"&status=status";
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


function update_sequence(id){
var updateid = document.getElementById("sequence"+id).value;
window.location.href='<?php echo base_url();?>admin/sequenceManage?sequence='+updateid+"&&id="+id+"&tbl=brand"+"&tid=cid";
}

</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>brand Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php echo form_open('', 'name="formUserSearch" id="form_check"');?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Total brand (<?php echo $brand_list->num_rows();?>)</h2>
                                    <h2 style="float:right">
                                    <a href="<?php echo base_url('admin/brand_registration');?>" class="btn btn-primary">New brand </a>
                                    <input type="button" class="btn btn-primary" style="background-color:#093"  onclick="approve();" value="Approve"/>
                                    <input type="button" class="btn btn-primary" style="background-color:#690"  onclick="deapprove();" value="Disapprove" />
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
                                        <th width="23%">brand Name</th>
                                        <th width="21%">Sequence</th>
                                        <th width="11%">Status</th>
                                        <th width="19%">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
                                    foreach($brand_list->result() as $brandData):
									$cid=$brandData->cid;
									$cat_name=$brandData->cat_name;
									$status=$brandData->status;
									$squence=$brandData->sequence;

									$i++;
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                         <td>
                                        <input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="<?php echo $cid;?>" /></td>
                                        <td><?php echo $cat_name; ?></td>
                                        <td>
                           <input type="text" id="sequence<?php echo $cid;?>" value="<?php echo $squence;?>" style="width:50%; float:left" class="form-control" />
        <input type="button" id="update" value="Save" style="width:30%;float:left" class="btn btn-primary" onclick="update_sequence(<?php echo $cid;?>);" />
                                        </td>
                                        <td width="11%" align="left">
                                        	<?php
                                            	if($status==1){
													?>
														<span style="background:#060; padding:5px; color:white;"><i class="fa fa-check"></i></span>
													<?php
													}
													else{
														?>
														<span style="background:#C00; padding:5px; color:white;"><i class="fa fa-close"></i></span>
                                                        <?php
														}
											?>
                                        </td>
                                         <td> 
                                         	<a href="<?php echo base_url('admin/brand_registration/'.$cid);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $cid;?>','brand','cid');" class="btn btn-default btn-sm">
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
               