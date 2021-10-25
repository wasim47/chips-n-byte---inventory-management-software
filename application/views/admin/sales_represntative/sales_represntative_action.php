<?php
if($sales_represntativeUpdate->num_rows()>0){
	foreach($sales_represntativeUpdate->result() as $sales_represntative);
		$sales_represntative_id=$sales_represntative->user_id;
		$image=$sales_represntative->photo;
		$sales_represntative_name=$sales_represntative->username;
		$address=$sales_represntative->address;
		$mobile=$sales_represntative->mobile;
		$email=$sales_represntative->email;
		$password=$sales_represntative->passwordHints;
}
else{
		$sales_represntative_id='';
		$image='';
		$sales_represntative_name=set_value('sales_represntative_name');
		$address=set_value('address');
		$mobile=set_value('mobile');
		$email=set_value('email');
		$password=set_value('password');
}
?>
	
<div class="right_col" role="main">
  <div>
     
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Salse Representative Registration Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   User Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> User Name: <font color="#FF0000">&nbsp;*</font></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="sales_represntative_name" id="sales_represntative_name" value="<?php echo $sales_represntative_name;?>" class="form-control col-md-7 col-xs-12" type="text"  required="required"/>
                                    <?php echo form_error('sales_represntative_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                              
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Address : <font color="#FF0000">&nbsp;*</font></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="address" class="form-control ckeditor" rows="6" cols="40"  required="required"><?php echo $address;?></textarea>
                                    </div>
                                </div>
                              
                              
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Logo: <font color="#FF0000">&nbsp;*</font> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"><input type="file" class="form-control col-md-7 col-xs-12" name="companyLogo" id="file"/>
                                   </div>
                                </div>
                                  
                                 
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="mobile" id="mobile" type="number" maxlength="15" value="<?php echo $mobile;?>" class="form-control col-md-7 col-xs-12" />
                                         <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                   
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Email: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="email" id="email" class="form-control col-md-7 col-xs-12"  value="<?php echo $email;?>" type="email"/>
                                         <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                  
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Password: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="password" id="password" class="form-control col-md-7 col-xs-12"  value="<?php echo $password;?>" type="empasswordail"/>
                                        <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                          	</div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                       <input type="hidden" name="sales_represntative_id" value="<?php echo $sales_represntative_id;?>" />
                                        <input type="hidden" name="stillImg" value="<?php echo $image;?>" />

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
               