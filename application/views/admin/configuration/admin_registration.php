<?php
if($configurationUpdate->num_rows()>0){
	foreach($configurationUpdate->result() as $adminData);
	$user_id=$adminData->id;
	$username=$adminData->company_name;
	$contactno=$adminData->contact;
	$email=$adminData->email;
	$address=$adminData->address;
	$logo=$adminData->logo;
}
else{
	$user_id='';
	$username=set_value('username');
	$contactno='';
	$email=set_value('email');
	$address=set_value('address');
	$logo='';
	}
?>
<style>
.required{
	color:#f00;
}
</style>
<script>
function userAccess(){
		var userType = document.getElementById('userRoll').value;
		//alert(userType);
		if(userType=='Precident' || userType=='CEO' || userType=='Country Manager'){
			document.getElementById('user_access').style.display='none';
		}
		else{
			document.getElementById('user_access').style.display='block';	
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
                                    <h2>General Information</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo $this->session->flashdata('successMsg');?>
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                    
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        			    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" name="username" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Username' value="<?php echo $username; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Username'">
                                                         <?php echo form_error('username', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                    </div>
                                     				  <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                                            Contact No.<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="contactno" required class="form-control col-md-7 col-xs-12" 
                                                                placeholder='Contact No' value="<?php echo $contactno; ?>"  
                                                                onFocus="this.placeholder=''" onBlur="this.placeholder='Contact No'">
                                                            </div>
                                                        </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="email" name="email" required class="form-control col-md-7 col-xs-12"
                                                                placeholder='Login Email' onFocus="this.placeholder=''" value="<?php echo $email; ?>" onBlur="this.placeholder='Login Email'">
                                                                 <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                            </div>
                                                        </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea name="address" required class="form-control col-md-7 col-xs-12"><?php echo $address;?></textarea>
                                                            </div>
                                                        </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Logo<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" name="logo" required class="form-control col-md-7">
                                                                <?php 
																	if($logo!=""){
																		echo '<img src="'.base_url('uploads/images/company/'.$logo).'" style="width:100px; height:auto" />';
																	}
																?>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
               